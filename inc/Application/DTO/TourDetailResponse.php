<?php

namespace TravelBooking\Application\DTO;

use TravelBooking\Domain\Model\Tour\Tour;
use TravelBooking\Infrastructure\WordPress\Taxonomy\TermReader;

final class TourDetailResponse
{
    public function __construct(private Tour $tour) {}

    /**
     * Convert Tour Entity -> Array data
     * @return array
     */
    public function toArray(): array
    {
        $reader = new TermReader();
        return [
            'id'             => $this->tour->id(),
            'name'           => $this->tour->name(),
            'tourCode'       => $this->tour->tourCode(),
            'isFeatured'     => $this->tour->isFeatured(),
            'featuredImage'  => $this->tour->featuredImage(),
            'gallery'        => $this->tour->gallery(),
            'createdAt'      => $this->tour->createdAt()->format('d/m/Y H:i'),
            'updatedAt'      => $this->tour->updatedAt()?->format('d/m/Y H:i'),

            // DỮ LIỆU ĐÃ ĐƯỢC "DỊCH" ĐẸP NHỜ READER
            'duration'       => $this->tour->durationLabel($reader),
            'linked'         => $this->tour->linkedLabel($reader) ?? 'Không liên kết',
            'type'           => $this->tour->typeLabel($reader),
            'personRange'    => $this->tour->personRangeLabel($reader),
            'locations'      => $this->tour->locationLabels($reader),
            'rating'         => $this->tour->ratingLabel($reader),

            // Slug thô (dành cho filter, URL, debug)
            'slugs'          => [
                'duration'   => $this->tour->durationSlug(),
                'type'       => $this->tour->typeSlug(),
                'locations'  => $this->tour->locationSlugs(),
                'rating'     => $this->tour->ratingSlug(),
            ],

            'status'         => $this->tour->status()->value,
        ];
    }

    /**
     * Convert Tour Entity -> JSON data
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}