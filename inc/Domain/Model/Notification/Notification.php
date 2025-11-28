<?php
/**
 * Notification – Domain Entity (Aggregate Root)
 *
 * Represents a notification (Telegram, Email, SMS, etc.)
 * This entity is 100% immutable and persistence-ignorant.
 *
 * @package   TravelBooking\Domain\Model\Notification
 * @author    KhanhECB
 * @since     1.0.0 Introduced
 * @version   1.0.0 Added readonly class + factory methods
 *
 * @immutable This entity cannot be modified – only replaced with new instance
 * @internal  Use Notification::create() or Notification::reconstitute() only
 */

namespace TravelBooking\Domain\Model\Notification;
use TravelBooking\Domain\Enum\NotificationStatus;
use TravelBooking\Domain\Enum\NotificationType;
use TravelBooking\Domain\ValueObject\DateTimeVO;

final readonly class Notification
{
    private function __construct(
        public ?int               $id,
        public NotificationType   $kind,
        public string             $message,
        public NotificationStatus $status,
        public ?string            $error,
        public ?DateTimeVO        $sentDate,
        public ?DateTimeVO        $createdDate
    )
    {
    }

    /**
     * Factory method for Mapper database -> Entity
     * @param int|null $id
     * @param NotificationType $kind
     * @param string $message
     * @param NotificationStatus $status
     * @param string|null $error
     * @param DateTimeVO|null $sentDate
     * @param DateTimeVO|null $createdDate
     * @return self
     */
    public static function reconstitute(
        ?int               $id,
        NotificationType   $kind,
        string             $message,
        NotificationStatus $status,
        ?string            $error,
        ?DateTimeVO        $sentDate,
        ?DateTimeVO        $createdDate,
    ): self {
        return new self(
            id: $id,
            kind: $kind,
            message: $message,
            status: $status,
            error: $error,
            sentDate: $sentDate,
            createdDate: $createdDate ?? DateTimeVO::now(),
        );
    }

    /**
     * Change Status form Pending/Error -> Success
     * @return self
     */
    public function markAsSent(): self
    {
        return new self(
            id: $this->id,
            kind: $this->kind,
            message: $this->message,
            status: NotificationStatus::SUCCESS,
            error: null,
            sentDate: DateTimeVO::fromString($this->sentDate) ?? DateTimeVO::now(),
            createdDate: $this->createdDate,
        );
    }

    /**
     * Change Status form Pending/Success -> Error
     * @param string $error
     * @return self
     */
    public function markAsError(string $error): self
    {
        return new self(
            id: $this->id,
            kind: $this->kind,
            message: $this->message,
            status: NotificationStatus::ERROR,
            error: $error,
            sentDate: DateTimeVO::fromString($this->sentDate) ?? DateTimeVO::now(),
            createdDate: $this->createdDate,
        );
    }
}