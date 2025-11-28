<?php
/**
 * Date: 28-11-2025
 */
namespace TravelBooking\Domain\Model\Tour;

use TravelBooking\Domain\Enum\TourStatus;
use TravelBooking\Domain\ValueObject\DateTimeVO;

final class TourFactory
{
    /**
     * Create new Tour Entity
     * @param string $name
     * @param string $tourCode
     * @param bool|null $isFeatured
     * @param string|null $durationSlug
     * @param string|null $linkedSlug
     * @param array|null $gallery
     * @param string|null $typeSlug
     * @param string|null $personRangeSlug
     * @param string|null $locationSlugs
     * @param bool $featuredImage
     * @param int|null $ratingSlug
     * @param TourStatus $status
     * @return Tour
     */
    public static function create(
        string     $name,
        string     $tourCode,
        ?bool      $isFeatured = null,
        ?string    $durationSlug = null,
        ?string    $linkedSlug = null,
        ?array     $gallery = null,
        ?string    $typeSlug = null,
        ?string    $personRangeSlug = null,
        ?string    $locationSlugs = null,
        bool       $featuredImage = false,
        ?int       $ratingSlug = null,
        TourStatus $status = TourStatus::OPEN,
    ): Tour
    {
        return Tour::reconstruct(
            id: null,
            name: $name,
            tourCode: $tourCode,
            isFeatured: $isFeatured ?? false,
            durationSlug: $durationSlug ?? '',
            linkedSlug: $linkedSlug ?? '',
            gallery: $gallery ?? [],
            typeSlug: $typeSlug ?? '',
            personRangeSlug: $personRangeSlug ?? '',
            locationSlugs: $locationSlugs ?? [],
            ratingSlug: $ratingSlug ?? '',
            featuredImage: $featuredImage ?? '',
            createdAt: DateTimeVo::now(),
            updatedAt: DateTimeVo::now(),
            status: $status,
        );
    }
    public static function createFromArray(array $row): Tour
    {
        return Tour::reconstruct(
            id:              isset($row['id']) ? (int)$row['id'] : null,
            name:            $row['name'] ?? '',
            tourCode:        $row['tour_code'] ?? '',
            isFeatured:      isset($row['is_featured']),
            durationSlug:    $row['duration_slug'] ?? '',
            linkedSlug:      $row['linked_slug'] ?? null,
            gallery:         $row['gallery'] ?? [],
            typeSlug:        $row['type_slug'] ?? '',
            personRangeSlug: $row['person_range_slug'] ?? '',
            locationSlugs:   $row['location_slugs'] ?? [],
            ratingSlug:      $row['rating_slug'] ?? '',
            featuredImage:   $row['featured_image'] ?? '',
            createdAt:       DateTimeVO::fromString($row['created_at'] ?? DateTimeVO::null()),
            updatedAt:       DateTimeVO::fromString($row['updated_at'] ?? DateTimeVo::null()),
            status:          TourStatus::tryFrom($row['status'] ?? '') ?? TourStatus::OPEN,
        );
    }
}