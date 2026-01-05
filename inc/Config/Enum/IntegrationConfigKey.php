<?php

namespace TravelBooking\Config\Enum;

enum IntegrationConfigKey
{
    case TELEGRAM_BOT_TOKEN;
    case TELEGRAM_BOT_CHAT_ID;
    case PAYPAL_SANDBOX_TOKEN_ID;
    case PAYPAL_SANDBOX_TOKEN_SECRET;
    case PAYPAL_LIVE_TOKEN_ID;
    case PAYPAL_LIVE_TOKEN_SECRET;
}
