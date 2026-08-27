# Kiểm soát truy cập (Access Control)

Hệ thống có **2 lớp độc lập**: (A) Feature gate theo gói dịch vụ, (B) Role/Permission.

## Lớp A — Feature gate (SaaS gating)
- Nguồn sự thật: bảng `feature_settings` (`feature_code`, `is_enabled`, `limit_value`, `config`).
- `FeatureGate::enabled($code)` / `limit($code)` / `require($code)` (abort 403 kèm `SUPPORT_MESSAGE`).
- Middleware **`feature:<code>`** (`EnsureFeatureEnabled`) gate route. Ví dụ feature: `multi_admin`, `review`, `cms_page`, `voucher`.
- **Superadmin bypass** mọi feature gate.
- Mô hình gói: `Package` ↔ `Feature` (pivot `PackageFeature`); `ProjectSubscription` là gói hiện tại. `feature_settings` là trạng thái *đang áp dụng thực tế* (được seed/đồng bộ từ gói) — code đọc `feature_settings`, không đọc thẳng Package.

## Lớp B — Role & Permission
- **User.role_id === null** ⇒ khách hàng (không vào được admin). Khác null ⇒ có thể vào panel (middleware `admin` = `EnsureUserIsAdmin`).
- **Role.permissions** = mảng code quyền JSON. `'*'` = toàn quyền. `Role::hasPermission($code)` true nếu có `'*'` hoặc đúng code.
- Kiểm quyền chi tiết bằng Gate **`can:<permission>`** trên route (vd `can:manage_users`, `manage_posts`, `manage_roles`, `manage_products`, `manage_orders`, `manage_vouchers`). Danh mục quyền lấy từ bảng `permissions`.
- **Superadmin**: `Role::hasPermission('*')` && (`is_system` || tên = `Superadmin`). Xem `User::isSuperAdmin()`.

### Bất biến quan trọng (đừng phá)
1. Middleware `admin` **chỉ** chặn khách (`role_id null`) — KHÔNG phân quyền chi tiết. Mọi route admin nhạy cảm **phải** thêm `can:<permission>` hoặc `superadmin`. Xem [../SECURITY_AUDIT.md](../SECURITY_AUDIT.md) mục 5.
2. **Vai trò hệ thống** (`is_system=true`) không được sửa/xoá qua UI (`RoleController` chặn). Non-superadmin không thấy/không quản lý được role hệ thống và role `Superadmin`.
3. Không xoá được role đang có user sử dụng.
4. Quản lý user cần đồng thời `feature:multi_admin` + `can:manage_users`. Admin thường không thấy/sửa được user superadmin (`UserController` chặn).
5. Đăng nhập nhanh (impersonate) lưu `impersonated_by` trong session; chỉ superadmin mới impersonate được superadmin.

## Ghi log hành động
- Thay đổi role/nhạy cảm được ghi qua `ActivityLogger::log(...)` vào `admin_activity_logs` (audit trail).
