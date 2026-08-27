---
name: add_feature
description: Quy trình thêm nhanh một tính năng/resource/endpoint mới vào backend Laravel ecommere-core theo đúng kiến trúc, bảo mật và i18n của dự án. Dùng khi user yêu cầu "thêm tính năng", "thêm CRUD", "thêm API", "thêm model/bảng".
---

# Skill: Thêm tính năng mới cho `ecommere-core`

Mục tiêu: mọi tính năng đi theo cùng một khuôn — an toàn, có test, đa ngôn ngữ, nhất quán.
Đọc kèm [../../../docs/ARCHITECTURE.md](../../../docs/ARCHITECTURE.md) và [../../RULES.md](../../RULES.md).

## Bước 0 — Định hướng bằng codegraph (BẮT BUỘC)
- `codegraph_context "<mô tả>"` → tìm resource tương tự (Brand, Voucher, Post) rồi **copy pattern**.
- `codegraph_impact <symbol>` trước khi sửa symbol dùng chung.

## Bước 1 — Migration
- `php artisan make:migration ...`. Tiền tệ luôn `decimal(15,2)`. Thêm index cho cột lọc/sort/FK.
- Không sửa migration đã chạy — tạo migration mới.

## Bước 2 — Model
- `$fillable` tường minh (không `$guarded = []`). Không đưa cột nhạy cảm (role_id, is_active của user) vào fillable nếu client không được set.
- `casts()` cho boolean/datetime/decimal. Field JSON nhạy cảm → cast `EncryptedJson`.

## Bước 3 — Form Request
- `php artisan make:request Admin/<Name>Request`. Whitelist rule chặt.
- Upload ảnh: `['nullable','file','mimes:jpg,jpeg,png,webp,gif','max:2048']` — KHÔNG dùng rule `image`.

## Bước 4 — Service (nếu có nghiệp vụ)
- Logic vào `app/Services/**`, controller chỉ điều phối.
- Đơn hàng/kho/thanh toán: `DB::transaction` + `lockForUpdate`; trạng thái qua `OrderStateTransitionService`; kho qua `OrderStockService`.
- Callback ngoài: verify chữ ký `hash_equals` + khớp số tiền + idempotent.

## Bước 5 — Controller
- API public: trả qua `ApiResponse::success()/error()`.
- Admin: trả view Blade, dùng Form Request.

## Bước 6 — Route
- API → `routes/api.php` (nhóm `public`) + `throttle:<limiter>` cho endpoint ghi/công khai.
- Admin → `routes/admin.php` trong `['auth','admin']`; thêm `feature:<code>` và `can:<permission>` khi cần.
- Endpoint dev/mock: bọc `if (! app()->isProduction())`.

## Bước 7 — i18n
- Thêm chuỗi vào `lang/vi`, `lang/en`, `lang/ko` (đủ 3), gọi `__('ns.key')`.

## Bước 8 — Test (BẮT BUỘC)
- Tạo `tests/Feature/<Name>Test.php`: happy path, validation fail, phân quyền (guest/admin/superadmin), edge case.

## Bước 9 — Kết thúc
- `php -l` các file PHP đã sửa. Rà checklist bảo mật ([../../RULES.md](../../RULES.md) R3).
- Commit local theo R1. Tóm tắt file đã tạo/sửa, route mới, cột DB mới cho user.
