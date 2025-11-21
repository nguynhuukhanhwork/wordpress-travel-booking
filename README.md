# TourBooking Pro – Hệ thống đặt tour tự động

## Mục tiêu
Xây dựng hệ thống đặt tour hoàn chỉnh: **tìm kiếm, đặt tour, lưu DB, gửi Telegram, quản trị**.

## Công nghệ
- WordPress + Custom Post Type + ACF
- Clean Architecture + Repository Pattern
- REST API + Vanilla JS (Shortcode)
- Custom DB Tables + Cache
- Telegram Bot Notification
- Unit Test + Documentation

## Demo
- Frontend: `[tour_search]` shortcode
- API: `/wp-json/travel-booking/v1/search-tours`
- Admin: Quản lý tour, booking, khách hàng

## Link 
- GitHub:
- Demo: 

##
Câu hỏi,Trả lời (bạn nói)
"""Bạn làm gì trong dự án?""","""Em xây toàn bộ từ A-Z: CPT, REST API, form xử lý, Telegram bot, custom table, test..."""
"""Kiến trúc thế nào?""","""Em dùng Clean Architecture: Presentation → Application → Domain → Infrastructure. Dễ test, dễ mở rộng."""
"""Khó nhất là gì?""","""Tách Notification ra khỏi Infrastructure, dùng Event để gửi Telegram + log – tránh tight coupling."""# wordpress-travel-booking
