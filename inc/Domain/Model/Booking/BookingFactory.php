<?php

/**
 * Date: 27-11-2025
 */
namespace TravelBooking\Domain\Model\Booking;

use TravelBooking\Domain\Enum\BookingStatus;
use TravelBooking\Domain\ValueObject\DateTimeVO;

final class BookingFactory
{
    /**
     * Reconstruct Booking Entity from Database
     * @param array $row
     * @return Booking
     */
    public static function fromRow(array $row): Booking
    {
        return Booking::reconstruct(
            id: isset($row['id']) ? (int) $row['id'] : null,
            code: $row['code'],
            customerId: (int) $row['customer_id'],
            tourName: $row['tour_name'],
            startDate: isset($row['start_date']) ? DateTimeVO::fromString($row['start_date']) : DateTimeVO::null(),
            totalPersons: (int) $row['total_persons'],
            note: $row['note'],
            createdAt: isset($row['created_at']) ? DateTimeVO::fromString($row['created_at']) : DateTimeVO::null(),
            updatedAt: isset($row['updated_at']) ? DateTimeVO::fromString($row['updated_at']) : DateTimeVO::null(),
            status: BookingStatus::tryFrom($row['status']) ?? BookingStatus::CONFIRMED,
        );
    }

    /**
     * Create Booking Entity from array
     * @param array $data
     * @return Booking
     */
    public function createFromArray(array $data): Booking
    {
        return Booking::create(
            customerId: $data['customer_id'] ? (int) $data['customer_id'] : null,
            tourName: $data['tour_name'] ? (string) $data['tour_name'] : null,
            startDate: $data['start_date'] ? DateTimeVO::fromString($data['start_date']) : DateTimeVO::now(),
            adults: (int) $data['adults'] ?? 0,
            children: (int) $data['children'] ?? 0,
            note: isset($data['note']) ? (string) $data['note'] : null
        );
    }
}