# 📚 Kho tri thức dự án — `ecommere-core`

Đây là **kho tri thức trung tâm** về dự án: nghiệp vụ, mô hình dữ liệu, quy ước, quyết định thiết kế.
Mọi AI Agent và lập trình viên **đọc kho này trước khi làm việc**, và **bồi đắp nó sau mỗi phiên** khi
phát hiện tri thức mới (quy tắc nghiệp vụ, quyết định, cạm bẫy) chưa được ghi.

> Nguyên tắc: kho tri thức mô tả *tại sao* và *luật nghiệp vụ* — những thứ không đọc được trực tiếp từ code.
> Cấu trúc code thuần tuý thì để codegraph trả lời, đừng chép lại vào đây.

## Mục lục

### Tổng quan & vận hành
- [ARCHITECTURE.md](ARCHITECTURE.md) — Kiến trúc tầng, luồng chính, thư mục.
- [SECURITY_AUDIT.md](SECURITY_AUDIT.md) — Báo cáo bảo mật & nợ kỹ thuật (cập nhật khi vá/ phát sinh).

### Tri thức nghiệp vụ (`knowledge/`)
- [knowledge/domain-model.md](knowledge/domain-model.md) — Thực thể, quan hệ, thuật ngữ (glossary).
- [knowledge/business-rules.md](knowledge/business-rules.md) — Luật nghiệp vụ: vòng đời đơn, thanh toán, khuyến mãi vs voucher, biến thể, tồn kho.
- [knowledge/access-control.md](knowledge/access-control.md) — Gói/tính năng (feature gate) + vai trò/quyền/superadmin.
- [knowledge/integrations.md](knowledge/integrations.md) — Tích hợp ngoài: VNPAY, GHTK, Cloudinary, email/queue.
- [knowledge/conventions.md](knowledge/conventions.md) — Quy ước code & dữ liệu (tiền, i18n, mã hoá settings, response).
- [knowledge/decisions.md](knowledge/decisions.md) — Nhật ký quyết định (ADR): *chọn gì & vì sao*.

### Quy trình & skill
- [../AGENTS.md](../AGENTS.md) — Hướng dẫn agent tổng quát.
- [../.agents/RULES.md](../.agents/RULES.md) — Quy tắc bắt buộc (commit local sau mỗi phiên...).
- [../.agents/skills/](../.agents/skills/) — Bộ skill (dự án + Superpowers).
- [superpowers/](superpowers/) — Kho lưu **output** plan/spec của skill Superpowers (khác kho tri thức này).

## Cách bồi đắp kho tri thức
Khi phát hiện một sự thật nghiệp vụ/quyết định chưa được ghi:
1. Thêm vào file `knowledge/` phù hợp (hoặc tạo mục mới), viết ngắn gọn *luật + lý do*.
2. Nếu là quyết định có đánh đổi → ghi thêm một mục trong [knowledge/decisions.md](knowledge/decisions.md).
3. Commit cùng phiên (theo RULES R1, chỉ local).

### UI/UX Builder — hướng dẫn và kiểm thử 08/09/2026

- [Hướng dẫn sử dụng có 16 ảnh chụp giao diện](uiux-builder/HUONG-DAN-SU-DUNG.md)
- [Báo cáo kiểm thử, lỗi đã sửa và lỗi còn tồn tại](uiux-builder/BAO-CAO-KIEM-THU.md)
- [Quy tắc nghiệp vụ nháp/xuất bản và phần dùng chung](knowledge/uiux-builder-workflow.md)

### Sổ tay PDF UI/UX Builder — 09/09/2026

- [PDF 24 trang thao tác trực tiếp trong Builder](uiux-builder/handbook/HUONG-DAN-UIUX-BUILDER.pdf) — ảnh giao diện giữ nguyên, nhãn đặt trong dải bên phải và nối tới đúng vị trí, hướng dẫn sửa chữ, ảnh, khối, thiết bị, lưu và xuất bản.
- [Bản HTML và cách cập nhật/in lại](uiux-builder/handbook/README.md).
