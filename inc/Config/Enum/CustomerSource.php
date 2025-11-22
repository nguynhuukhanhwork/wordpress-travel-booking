<?php

namespace TravelBooking\Config\Enum;

use MyCLabs\Enum\Enum;

ENUM CustomerSource: string
{
    case WEBSITE        = 'website';
    case FACEBOOK       = 'facebook';
    case ZALO           = 'zalo';
    case TIKTOK         = 'tiktok';
    case GOOGLE         = 'google';
    case PARTNER        = 'partner';     // Đại lý giới thiệu
    case RETURNING      = 'returning';   // Khách cũ quay lại (vàng!)
    case WALK_IN        = 'walk_in';     // Khách đến trực tiếp
}