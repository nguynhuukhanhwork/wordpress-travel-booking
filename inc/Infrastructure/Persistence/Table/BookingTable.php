<?php

declare(strict_types=1);

namespace TravelBooking\Infrastructure\Persistence\Table;

final class BookingTable
{
    private const TABLE_NAME = 'travel_booking_bookings';

    public const ID            = 'id';
    public const CODE          = 'code';
    public const CUSTOMER_ID   = 'customer_id';
    public const TOUR_ID       = 'tour_id';
    public const START_DATE    = 'start_date';
    public const END_DATE      = 'end_date';
    public const TOTAL_PERSONS = 'total_persons';
    public const NOTES         = 'notes';
    public const CREATED_AT    = 'created_at';
    public const UPDATED_AT    = 'updated_at';
    public const STATUS        = 'status';

    /** @return list<string> */
    public static function getAll(): array
    {
        return [
            self::ID, self::CODE, self::CUSTOMER_ID, self::TOUR_ID,
            self::START_DATE, self::END_DATE, self::TOTAL_PERSONS,
            self::NOTES, self::CREATED_AT, self::UPDATED_AT, self::STATUS,
        ];
    }

    public static function getRawTableName(): string
    {
        return self::TABLE_NAME;
    }
    public static function getTableName(): string
    {
        global $wpdb;

        // Nếu không có $wpdb (chạy standalone, unit test…), fallback
        return ($wpdb->prefix ?? '') . self::TABLE_NAME;
    }
}