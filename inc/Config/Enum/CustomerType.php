<?php

namespace TravelBooking\Config\Enum;

enum CustomerType: string
{
    case INDIVIDUAL      = 'individual';     // Khách lẻ bình thường
    case FAMILY          = 'family';         // Gia đình, nhóm nhỏ
    case GROUP           = 'group';          // Đoàn ≥10 người
    case CORPORATE       = 'corporate';      // Công ty, doanh nghiệp
    case TRAVEL_AGENT    = 'travel_agent';   // Đại lý du lịch (cần hoa hồng)
    case INFLUENCER      = 'influencer';     // KOL, có mã giảm riêng
    case VIP             = 'vip';            // Khách VIP, chăm sóc đặc biệt
    case BLACKLIST       = 'blacklist';      // Cấm đặt tour (spam, quỵt tiền...)
    case STAFF           = 'staff';         // Nhân viên công ty (giảm giá nội bộ)
}
