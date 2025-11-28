<?php
/**
 * Date: 28-11-2025
 */
namespace TravelBooking\Domain\Model\Notification;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\DateTime;
use TravelBooking\Domain\Enum\NotificationStatus;
use TravelBooking\Domain\Enum\NotificationType;
use TravelBooking\Domain\ValueObject\DateTimeVO;

final class NotificationFactory
{
    private const DEFAULT_TYPE = NotificationType::TELEGRAM;
    private const DEFAULT_STATUS = NotificationStatus::PENDING;

    /**
     * Create new Notification Entity
     * @param NotificationType|string $kind
     * @param string $message
     * @param NotificationStatus|string $status
     * @param string|null $error
     * @return Notification
     */
    public static function create(
        NotificationType|string $kind,
        string $message,
        NotificationStatus|string $status,
        ?string $error = null,
    ): Notification
    {
        // Process Notification if is Enum -> get from string
        $kind = $kind instanceof NotificationType
            ? $kind
            : (NotificationType::tryFrom($kind) ?? self::DEFAULT_TYPE);

        $status = $status instanceof NotificationStatus
            ? $status
            : (NotificationStatus::tryFrom($status) ?? self::DEFAULT_STATUS);

        // Create new Entity
        return Notification::reconstitute(
            id: null,
            kind: $kind,
            message: $message,
            status: $status,
            error: $error,
            sentDate: DateTimeVO::now(),
            createdDate: DateTimeVO::now(),
        );
    }

    /**
     * Reconstruct from database
     * @param array $data
     * @return Notification
     */
    public static function createFromArray(array $data): Notification
    {
        return Notification::reconstitute(
            id: isset($data['id']) ? (int) $data['id'] : null,
            kind: $data['kind'] ?? self::DEFAULT_TYPE,
            message: $data['message'] ?? null,
            status: $data['status'] ?? NotificationStatus::PENDING,
            error: $data['error'] ?? null,
            sentDate: $data['sent_date'] ?? DateTimeVO::null(),
            createdDate: $date['created_date'] ?? DateTimeVO::null(),
        );
    }

}