# TRƯỜNG ĐẠI HỌC THỦ ĐÔ HÀ NỘI
### KHOA: TOÁN-CNTT · HỌC PHẦN: LẬP TRÌNH WEB & ỨNG DỤNG
---

## 👤 THÔNG TIN SINH VIÊN
* **Họ và tên:** **Trần Thục Linh**
* **Mã sinh viên:** **224001729**
* **Lớp:** **Toán Ứng Dụng D2024** (Khóa tuyển sinh: D2024 · Niên khóa: 2024–2028)
* **Khoa:** **Khoa: Toán-CNTT**
* **Email sinh viên trường:** `224001729@daihocthudo.edu.vn`
* **Nhóm Bài tập lớn:** **Nhóm 1** (Chủ đề 9: *Hệ thống Tiếp nhận & Xử lý Yêu cầu Hỗ trợ CNTT Trực tuyến - Helpdesk Online Đại học Thủ Đô Hà Nội*)
* **Phân hệ phụ trách độc quyền:** **User Management & Auth Security** (Xác thực & Bảo mật tài khoản)
  * **Model phụ trách:** `User.php` (bảng `users`), `PasswordReset.php` (bảng `password_resets`)
  * **Nhiệm vụ:** Xác thực Bcrypt, cơ chế khóa mềm 30 phút chống Brute-force, khóa cứng kỷ luật thôi học (`lock_reason = 'expelled'`), tự phục vụ quên mật khẩu qua Email (SSPR) hiệu lực 15 phút, tiếp nhận Guest Ticket tra cứu PIN.

---

## 📑 MỤC LỤC BÀI TẬP CÁC BUỔI THEO TIẾN ĐỘ HỌC PHẦN

| Buổi | Tên Bài tập & Nội dung thực hành | Thư mục & Đường dẫn chi tiết | Trạng thái |
|:---:|---|---|:---:|
| **Buổi 1** | Cấu trúc thư mục chuẩn, `index.php` và `about.php` | [`Buoi1/README.md`](Buoi1/README.md) | ✅ Hoàn thành |
| **Buổi 2** | Lập trình PHP Cơ bản: Hóa đơn, Bảng điểm, Xếp loại học lực | [`Buoi2/README.md`](Buoi2/README.md) (BT2.7, BT2.8, BT2.9) | ✅ Hoàn thành |
| **Buổi 3** | **Thiết kế CSDL MySQL & Truy vấn SQL (Phân hệ User Management & Auth)** | [`Buoi3/README.md`](Buoi3/README.md) | 🌟 Hoàn thành |

> 📌 **Chi tiết Bài tập Buổi 3 (Bài 4 slide: Thiết kế CSDL & SQL) của cá nhân:**
> * Sơ đồ ERD & Đặc tả dữ liệu: [`Buoi3/erd_user_management.md`](Buoi3/erd_user_management.md)
> * Tập tin DDL tạo bảng: [`Buoi3/schema_user_auth.sql`](Buoi3/schema_user_auth.sql)
> * Dữ liệu Seed mẫu tiếng Việt: [`Buoi3/seed_user_auth.sql`](Buoi3/seed_user_auth.sql)
> * 6 câu truy vấn SELECT thực chiến: [`Buoi3/queries_user_auth.sql`](Buoi3/queries_user_auth.sql)
> * Giao diện xem trực quan HTML: [`Buoi3/index.html`](Buoi3/index.html)
> * Script kiểm thử tự động một lệnh: [`Buoi3/run_demo.php`](Buoi3/run_demo.php) (`php Buoi3/run_demo.php`)

---

# I. PHÂN TẦNG PHẠM VI (P0 / P1 / P2) & VAI TRÒ NGƯỜI DÙNG

## 1. Phân tầng phạm vi thực hiện theo 10 buổi học

Để đảm bảo hệ thống chạy ổn định và vừa sức với nhóm 5 sinh viên trong 10 buổi học, toàn bộ chức năng được chia thành 3 tầng ưu tiên:

### Tầng P0 (Bắt buộc — Hoàn thành từ Buổi 4 đến Buổi 7)

- Đăng nhập, đăng xuất (password_hash, password_verify), phân quyền 3 vai trò (requester, agent, admin), bảo vệ CSRF (hash_equals).
- CRUD phiếu hỗ trợ (tickets), danh mục sự cố (categories), mức độ ưu tiên (priorities — tách bảng riêng để CRUD theo đúng đề bài) và tài khoản nhân viên (users).
- Máy trạng thái (State Machine) 4 bước: new → in_progress → resolved → closed (kèm nhánh reopen dành riêng cho Admin) và lưu vết vào bảng lịch sử (ticket_histories).
- Admin phân công nhân viên thủ công có kiểm tra định mức tải tối đa (max_capacity) trong Transaction.
- Gửi phản hồi trao đổi theo phiếu (ticket_replies), khóa phản hồi khi phiếu đã closed.
- Tìm kiếm theo từ khóa/mã phiếu, lọc đa tiêu chí (theo trạng thái, danh mục, mức ưu tiên, kỹ thuật viên) và phân trang (LIMIT / OFFSET).
- Hai Endpoint JSON bắt buộc dùng Fetch API: lấy số lượng phiếu chưa xử lý (GET /api/tickets/open-count) và tải lịch sử phiếu (GET /api/tickets/history?code=...).

### Tầng P1 (Mở rộng cốt lõi — Hoàn thành từ Buổi 7 đến Buổi 8)

- Tính hạn xử lý due_at tự động và hiển thị nhãn cảnh báo SLA kèm chữ rõ ràng: [Đúng hạn], [Sắp quá hạn], [Quá hạn].
- Đính kèm ảnh chụp màn hình lỗi có kiểm soát 5 lớp tại Server và phục vụ ảnh qua Controller có kiểm tra quyền truy cập (GET /tickets/attachment?code=...).
- Đánh giá mức độ hài lòng CSAT từ 1 đến 5 sao (ticket_ratings, ràng buộc UNIQUE(ticket_id)).
- Xuất báo cáo CSV có UTF-8 BOM cho Microsoft Excel và lọc chống tấn công CSV Formula Injection.

### Tầng P2 (Tùy chọn sau Buổi 8 — Chỉ làm khi P0 và P1 đã chạy ổn định, đủ 20 test case và cài được trên máy sạch)

- Ô "Gợi ý hướng dẫn tự khắc phục": khi người dùng gõ tiêu đề sự cố, trình duyệt gọi GET /api/kb/search?q=... (debounce 300ms), server tìm kiếm bằng LIKE / FULLTEXT trong bảng kb_articles và trả về tối đa 3 bài viết hướng dẫn khớp nhất.
- Cảnh báo nhẹ khi người dùng tạo phiếu trùng category_id và trùng phòng (location_id) trong vòng 30 phút gần nhất bằng một câu truy vấn SELECT.

## 2. Phân quyền 3 Vai trò người dùng (RBAC)

| Vai trò | Giá trị lưu CSDL | Quyền hạn chính | Ràng buộc kiểm tra tại Server |
|---|---|---|---|
| Người yêu cầu | requester | Tạo phiếu hỗ trợ, xem danh sách phiếu cá nhân, gửi phản hồi khi phiếu chưa đóng, đánh giá hài lòng CSAT (1–5 sao). | Chỉ xem được phiếu và ảnh đính kèm có requester_id là chính mình; không được tự phân công hoặc tự đổi trạng thái sang resolved/closed. |
| Kỹ thuật viên | agent | Xem hàng đợi các phiếu được giao cho mình, lọc theo trạng thái và cảnh báo SLA, gửi phản hồi trao đổi, chuyển trạng thái từ in_progress sang resolved. | Chỉ cập nhật được phiếu có assigned_to khớp với ID của mình; không được đóng phiếu (closed) hoặc sửa danh mục hệ thống. |
| Quản trị viên | admin | CRUD danh mục, mức ưu tiên, vị trí phòng, bài viết hướng dẫn và tài khoản nhân viên; phân công phiếu & chốt mức ưu tiên áp dụng (priority_id); đóng/mở lại phiếu; xem Dashboard & xuất CSV. | Kiểm tra role === 'admin' ở Middleware; kiểm tra định mức tải max_capacity của kỹ thuật viên trong Transaction trước khi phân công. |

## 3. Giải pháp nghiệp vụ đơn giản thay thế cho thuật toán AI

- **Xử lý lỗi chưa rõ nguyên nhân:** Trong bảng categories có sẵn danh mục "Chưa rõ nguyên nhân / Sự cố khác". Người dùng không biết lỗi thuộc nhóm nào chỉ cần chọn danh mục này và đính kèm ảnh màn hình lỗi; Admin sẽ xem ảnh và cập nhật lại category_id chính xác khi phân công.
- **Chống khai khống mức Khẩn cấp:** Bảng tickets lưu tách biệt 2 cột: priority_requested_id (mức do người dùng chọn lúc tạo phiếu) và priority_id (mức áp dụng thực tế). Nếu người dùng chọn *Khẩn cấp*, hệ thống lưu nguyên đề xuất đó nhưng khởi tạo priority_id ở mức *Trung bình* chờ Admin duyệt và chốt khi phân công.

## Danh sách 18 Route thống nhất toàn hệ thống

| STT | Method | Đường dẫn | Controller@Action | Vai trò được phép | Tầng |
|---|---|---|---|---|---|
| 1 | GET | `/login` | `AuthController@showLogin` | Khách | P0 |
| 2 | POST | `/login` | `AuthController@login` | Khách | P0 |
| 3 | POST | `/logout` | `AuthController@logout` | Đã đăng nhập | P0 |
| 4 | GET | `/tickets/create` | `TicketController@create` | requester, admin | P0 |
| 5 | POST | `/tickets/create` | `TicketController@store` | requester, admin | P0 |
| 6 | GET | `/tickets/my` | `TicketController@myTickets` | requester | P0 |
| 7 | GET | `/tickets/show?code=...` | `TicketController@show` | Chủ phiếu, agent được giao, admin | P0 |
| 8 | POST | `/tickets/reply` | `TicketController@reply` | Chủ phiếu, agent được giao, admin | P0 |
| 9 | GET | `/tickets/attachment?code=...` | `AttachmentController@download` | Chủ phiếu, agent được giao, admin | P1 |
| 10 | POST | `/tickets/rate` | `TicketController@rate` | requester (chủ phiếu) | P1 |
| 11 | GET | `/agent/queue` | `AgentController@queue` | agent, admin | P0 |
| 12 | POST | `/tickets/status` | `AgentController@updateStatus` | agent (được giao), admin | P0 |
| 13 | GET | `/admin/tickets` | `AdminController@tickets` | admin | P0 |
| 14 | POST | `/admin/tickets/assign` | `AdminController@assign` | admin | P0 |
| 15 | GET/POST | `/admin/master-data` | `AdminController@masterData` | admin | P0 |
| 16 | GET | `/admin/dashboard` | `AdminController@dashboard` | admin | P0 |
| 17 | GET | `/admin/reports/export-csv` | `AdminController@exportCsv` | admin | P1 |
| 18 | GET | `/api/tickets/open-count`, `/api/tickets/history`, `/api/kb/search` | `ApiController@openCount`, `@history`, `@kbSearch` | Đã đăng nhập (theo quyền) | P0 / P2 |
