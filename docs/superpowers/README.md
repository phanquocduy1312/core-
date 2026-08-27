# Kho tài liệu quy trình (Superpowers doc store)

Đây là "kho doc" mà các skill Superpowers ([../../.agents/skills/](../../.agents/skills/)) đọc/ghi khi làm việc.
Đừng xoá thư mục này — nhiều skill mặc định lưu output vào đây.

## Cấu trúc

- **`specs/`** — Tài liệu thiết kế/đặc tả (spec). Skill `brainstorming` ghi ra
  `specs/YYYY-MM-DD-<chủ-đề>-design.md` sau khi chốt thiết kế với người dùng.
- **`plans/`** — Kế hoạch triển khai. Skill `writing-plans` ghi ra
  `plans/YYYY-MM-DD-<tên-tính-năng>.md`; `executing-plans` và `subagent-driven-development`
  đọc lại để thực thi từng task.

## Quy ước

- Đặt tên file theo ngày `YYYY-MM-DD-<slug>.md` để dễ tra cứu.
- Mỗi spec/plan là một tài liệu độc lập, đủ ngữ cảnh cho một agent khác đọc và làm theo.
- Commit spec/plan cùng phiên tạo ra chúng (theo [../../.agents/RULES.md](../../.agents/RULES.md) R1 — chỉ local).

> Lưu ý: đường dẫn `docs/superpowers/plans` và `docs/superpowers/specs` là mặc định các skill
> Superpowers tham chiếu tới. Giữ nguyên tên để skill hoạt động đúng.
