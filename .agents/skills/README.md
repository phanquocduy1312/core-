# Bộ skill cho AI Agent — `ecommere-core`

Thư mục này gồm 2 nhóm skill. Mỗi skill là một thư mục chứa `SKILL.md` (frontmatter `name`/`description` + hướng dẫn).

## 🧩 Skill riêng của dự án
- **add_feature** — Thêm nhanh tính năng/CRUD/API/model mới đúng kiến trúc + bảo mật + i18n.
- **security_review** — Checklist rà soát bảo mật trước khi merge/deploy.
- **connect_frontend** — Kết nối frontend tĩnh (HTML/CSS/JS/Tailwind) với REST API public.
- **deploy_laravel_ftp** — Triển khai lên hosting qua FTP/FTPS bằng `deploy.py` (token bảo mật).

## ⚡ Superpowers — phương pháp phát triển phần mềm (obra/superpowers, MIT)
Bộ skill quy trình tự kích hoạt theo ngữ cảnh. Nguồn: https://github.com/obra/superpowers — license: [SUPERPOWERS-LICENSE](SUPERPOWERS-LICENSE).

- **using-superpowers** — Điểm vào: cách tìm & dùng skill; nên đọc đầu mỗi phiên.
- **brainstorming** — Làm rõ ý định/yêu cầu/thiết kế TRƯỚC khi code.
- **writing-plans** — Viết kế hoạch triển khai từ spec.
- **executing-plans** — Thực thi kế hoạch có checkpoint review.
- **test-driven-development** — TDD red/green trước khi viết code triển khai.
- **systematic-debugging** — Debug có hệ thống trước khi vá.
- **verification-before-completion** — Chạy lệnh kiểm chứng trước khi tuyên bố "xong".
- **requesting-code-review** / **receiving-code-review** — Yêu cầu & tiếp nhận review đúng cách.
- **subagent-driven-development** / **dispatching-parallel-agents** — Điều phối subagent, chạy song song task độc lập.
- **using-git-worktrees** — Cô lập workspace bằng git worktree.
- **finishing-a-development-branch** — Hoàn tất & tích hợp nhánh khi xong.
- **writing-skills** — Viết/sửa skill mới.

> Lưu ý: superpowers gốc tự kích hoạt qua hook của plugin Claude Code. Bản nhúng trong repo này dùng như
> tài liệu phương pháp + skill có thể gọi thủ công. Nếu muốn tự kích hoạt đầy đủ, cài plugin:
> `/plugin install superpowers@claude-plugins-official`.

## 📚 Kho tài liệu quy trình (doc store)
Các skill Superpowers lưu/đọc output tại **[../../docs/superpowers/](../../docs/superpowers/)**:
- `docs/superpowers/specs/` — design doc từ `brainstorming`.
- `docs/superpowers/plans/` — kế hoạch từ `writing-plans`, đọc bởi `executing-plans`/`subagent-driven-development`.

Giữ nguyên đường dẫn này — skill tham chiếu tới nó theo mặc định.

---

Quy tắc chung khi làm việc: xem [../RULES.md](../RULES.md) (đặc biệt R1 — commit local sau mỗi phiên).
