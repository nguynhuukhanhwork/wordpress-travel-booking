<?php
/**
 * Date: 28-11-2025
 */
namespace TravelBooking\Domain\Model\Customer;

use TravelBooking\Domain\Enum\CustomerSource;
use TravelBooking\Domain\Enum\CustomerType;
use TravelBooking\Domain\ValueObject\DateTimeVO;

final class CustomerFactory
{
    private const DEFAULT_TYPE = CustomerType::INDIVIDUAL;
    private const DEFAULT_SOURCE = CustomerSource::WEBSITE;

    /**
     * Reconstruct Entity from Database
     * @param array $row
     * @return Customer Entity Customer of Travel Booking System
     */
    public static function fromRow(array $row): Customer
    {
        return Customer::reconstitute(
            id:             isset($row['id']) ? (int)$row['id'] : null,
            name:           $row['name'] ?? null,
            email:          $row['email'] ?? null,
            phone:          $row['phone'] ?? null,
            address:        $row['address'] ?? null,
            note:           $row['note'] ?? null,
            metadata:       $row['metadata'] ?? null,
            customerSource: CustomerSource::tryFrom($row['customer_source']) ?? self::DEFAULT_SOURCE,
            customerType:   CustomerType::tryFrom($row['customer_type']) ?? self::DEFAULT_TYPE,
            createdAt:      DateTimeVO::fromString($row['created_at']) ?? DateTimeVO::null(),
            updatedAt:      isset($row['updated_at']) ? DateTimeVO::fromString($row['updated_at']) : DateTimeVO::null(),
        );
    }


    public static function create(
        string                $name,
        string                $phone,
        ?string               $email = null,
        ?string               $address = null,
        ?string               $note = null,
        CustomerSource|string $customerSource = CustomerSource::WALK_IN,
        CustomerType|string   $customerType = CustomerType::INDIVIDUAL,
    ): Customer
    {
        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email không hợp lệ');
        }

        $source = $customerSource instanceof CustomerSource
            ? $customerSource
            : (CustomerSource::tryFrom($customerSource) ?? self::DEFAULT_SOURCE);

        $type   = $customerType instanceof CustomerType
            ? $customerType
            : (CustomerType::tryFrom($customerType) ?? self::DEFAULT_TYPE);

        return Customer::reconstitute(
            id: null,
            name: $name,
            email: $email ?? null,
            phone: $phone,
            address: $address ?? null,
            note: $note ?? null,
            metadata: null,
            customerSource: $source,
            customerType: $type,
            createdAt: DateTimeVO::now(),
            updatedAt: DateTimeVO::now(),
        );
    }
}