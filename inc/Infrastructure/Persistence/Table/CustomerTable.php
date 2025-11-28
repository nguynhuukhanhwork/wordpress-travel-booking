<?php
/**
 * @since : 1.0.0
 * @date : 29-11-2025
 */
namespace TravelBooking\Infrastructure\Persistence\Table;

final class CustomerTable
{
    private const TABLE_NAME =  "travel_booking_customer";
    public const ID = "id";
    public const NAME = "name";
    public const EMAIL = "email";
    public const PHONE = "phone";
    public const ADDRESS = "address";
    public const NOTE = "note";
    public const METADATA = "metadata";
    public const CUSTOMER_SOURCE = "customer_source";
    public const CUSTOMER_TYPE = "customer_type";
    public const CREATED_AT = "created_at";
    public const UPDATED_AT = "updated_at";

    public static function getRawTableName(): string
    {
        return self::TABLE_NAME;
    }

    public static function getTableName(): string
    {
        global $wpdb;
        return ($wpdb->prefix ?? '') . self::TABLE_NAME;
    }

    /*** @return string[] */
    public static function getAllCols(): array
    {
        return [
            self::ID,
            self::NAME,
            self::EMAIL,
            self::PHONE,
            self::ADDRESS,
            self::NOTE,
            self::METADATA,
            self::CUSTOMER_SOURCE,
            self::CUSTOMER_TYPE,
            self::CREATED_AT,
            self::UPDATED_AT,
        ];
    }
}