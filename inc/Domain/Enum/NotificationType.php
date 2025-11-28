<?php

namespace TravelBooking\Domain\Enum;

enum NotificationType : string
{
    case TELEGRAM = 'telegram';
    case GOOGLE_SHEET = 'google_sheet';
    case SMTP = 'smtp';

    public function label(): string
    {
        return match ($this) {
            self::TELEGRAM => 'Telegram',
            self::GOOGLE_SHEET => 'Google Sheet',
            self::SMTP => 'SMTP',
        };
    }
}
