# Mô hình miền (Domain Model)

Thực thể chính và quan hệ. Chi tiết cột xem migration; ở đây ghi *ý nghĩa nghiệp vụ* và ràng buộc.

## Catalog (danh mục sản phẩm)
- **Category** — cây danh mục (`parent_id` tự tham chiếu), `is_active`, `sort_order`. Đa ngôn ngữ tên/mô tả (Spatie Translatable).
- **Brand** — thương hiệu, `is_active`, `sort_order`.
- **Product** — sản phẩm. Trường dịch: `name`, `short_description`, `description`, `meta_title`, `meta_description`. Giá `price` (`decimal:2`), `compare_at_price`, `cost_price`. Kho: `stock_quantity` + `manage_stock`.
  - **Quan trọng:** `usesVariantInventory()` = có ít nhất một `ProductOptionGroup`. Khi đúng, tồn kho & giá được quản lý ở cấp **variant (SKU)**, KHÔNG dùng `stock_quantity`/`price` của product.
- **ProductOptionGroup** → **ProductOptionValue** — thuộc tính (vd "Màu", "Size") và giá trị ("Đỏ", "M"). `display_type` ∈ `select|color|image`.
- **ProductVariant** — một SKU cụ thể = tổ hợp các option value. Có `option_signature` (chuỗi ký định danh tổ hợp), `price` (nullable → fallback về giá product), `sku`, `is_active`.
  - SKU được resolve từ `option_value_ids` client gửi qua `ProductVariantResolver` (khớp `option_signature`).

## Order (đơn hàng)
- **Order** — đơn. `order_number` (`ORD-` + 10 ký tự random, unique). `status` ∈ `pending|processing|completed|cancelled`. `payment_status` ∈ `pending|paid|failed|partially_refunded|refunded`. Tiền: `subtotal`, `discount`, `promotion_discount`, `shipping_fee`, `grand_total` (đều `decimal:2`). `user_id` nullable (hỗ trợ khách vãng lai).
- **OrderItem** — dòng hàng, **snapshot** tại thời điểm mua: `product_name`, `variant_name`, `sku`, `original_price`, `promotion_discount`, `price` (đơn giá sau KM), `quantity`, `total`. Giữ `product_id`/`product_variant_id`/`promotion_id` để tham chiếu.
- **OrderStatusHistory** — nhật ký mọi lần đổi `status`/`payment_status` (from/to + note). Ghi bởi mọi luồng đổi trạng thái.
- **OrderRefund** / **OrderRefundItem** — hoàn tiền (một phần/toàn phần).
- **PaymentTransaction** — giao dịch thanh toán (gateway VNPAY IPN, COD...), dùng để **idempotent** hoá IPN.
- **InventoryMovement** — bút toán xuất/nhập kho (audit trail tồn kho).

## Khuyến mãi & giảm giá
- **Promotion** — chương trình KM cấp *sản phẩm/SKU*. `discount_type` ∈ `percentage|fixed_amount|fixed_price`. `applies_to` ∈ `all_products|selected`. Có `priority`, `min_quantity`, `used_count`, quota (`isAvailableFor`), thời gian hiệu lực (`activeNow`).
- **PromotionTarget** — SKU/sản phẩm cụ thể trong một Promotion `selected`, có `quantity_limit`/`used_count` (flash-sale suất theo SKU, `canReserve`).
- **Voucher** — mã giảm giá cấp *đơn hàng* (nhập tay lúc checkout). `type` ∈ `percentage|fixed`. Có `min_order_amount`, `max_discount_amount`, `quantity`/`used_count`, thời gian. `code` luôn lưu UPPERCASE.

> Phân biệt: **Promotion** tự động theo sản phẩm/SKU; **Voucher** do khách nhập mã. Xem [business-rules.md](business-rules.md#khuyến-mãi-vs-voucher).

## Người dùng & phân quyền
- **User** — cả admin lẫn khách. `role_id === null` ⇒ khách (customer); khác null ⇒ có quyền vào admin. Xem [access-control.md](access-control.md).
- **Role** — `permissions` (mảng JSON code quyền; `'*'` = toàn quyền). `is_system` = vai trò hệ thống (không sửa/xoá qua UID).
- **Permission** — danh mục quyền (`code`, `group`), làm nguồn cho form role.
- **UserAddress** — sổ địa chỉ giao hàng của khách (có `is_default`).

## Gói dịch vụ & tính năng (SaaS gating)
- **Package** → **Feature** (qua **PackageFeature**: `is_enabled`, `limit_value`, `config`).
- **ProjectSubscription** — gói hiện tại của project (bảng `project_subscription`, `status`, `started_at`, `expired_at`).
- **FeatureSetting** — trạng thái bật/tắt & `limit_value`/`config` *thực tế đang áp dụng* cho từng `feature_code`. Đây là nguồn cho `FeatureGate`.
- **Addon** — tính năng mua thêm.

## Nội dung & khác
- **Post** / **PostCategory** — blog/CMS (gated bởi feature `cms_page`).
- **Review** — đánh giá sản phẩm (`rating` 1–5, `is_visible`). Chỉ người đã mua mới được gửi.
- **Banner**, **ShippingPartner**, **PaymentMethod**, **ProjectSetting** (settings hệ thống, một số mã hoá), **Invoice**, **AdminActivityLog**.

## Thuật ngữ (Glossary)
- **SKU / Variant** — một tổ hợp thuộc tính bán được của sản phẩm.
- **option_signature** — chuỗi định danh duy nhất một tổ hợp option value → tìm variant.
- **Feature gate** — cơ chế bật/tắt tính năng theo `feature_code`.
- **Superadmin** — role có quyền `'*'` và (`is_system` hoặc tên `Superadmin`); bypass mọi feature gate.
- **Mock VNPAY** — cổng thanh toán giả lập cho dev/test (đã chặn ở production).
