<?php

namespace TravelBooking\Infrastructure\Persistence\Table;

final class NotificationTable
{
    private const TABLE_NAME = 'travel_booking_notification';
    public const ID = 'id';
    public const KIND = 'kind';
    public const MESSAGE = 'message';
    public const STATUS = 'status';
    public const ERROR = 'error';
    public const SENT_AT = 'sent_at';
    public const CREATED_AT = 'created_at';

    public static function getTableName(): string
    {
        global $wpdb;
        return ($wpdb->prefix ?? '') . self::TABLE_NAME;
    }

    public static function getRawTableName(): string
    {
        return self::TABLE_NAME;
    }

    /** @return string[] */
    public static function getAllCols(): array
    {
        return [
            self::ID,
            self::KIND,
            self::MESSAGE,
            self::STATUS,
            self::ERROR,
            self::SENT_AT,
            self::CREATED_AT,
        ];
    }
}