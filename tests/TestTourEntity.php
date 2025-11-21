<?php

function travel_booking_test_tour_entity(): void
{
    // Chỉ admin + có ?test_tour=1 mới chạy (an toàn tuyệt đối)
    if (!isset($_GET['test_tour']) || !current_user_can('manage_options')) {
        return;
    }


    // Tạo reader "ảo" ngay tại chỗ
    $reader = new \TravelBooking\Infrastructure\WordPress\Taxonomy\TermReader();

    // ==================== TẠO TOUR ====================
    $tour = \TravelBooking\Domain\Entity\Tour::reconstruct(
        id: 999,
        name: 'Hà Nội - Đà Nẵng - Phú Quốc 5N4Đ Bay Vietnam Airlines',
        tourCode: 'HN-DN-PQ-0525',
        isFeatured: true,
        durationSlug: '5n4d',
        linkedSlug: 'co',
        gallery: ['img1.jpg', 'img2.jpg', 'img3.jpg'],
        typeSlug: 'noi-dia',
        personRangeSlug: '10-15',
        locationSlugs: ['ha-noi', 'da-nang', 'phu-quoc'],
        ratingSlug: '5-sao',
        featuredImage: 'https://example.com/featured-hanoi-danang.jpg',
        createdAt: new \DateTimeImmutable('2025-04-01 08:00:00'),
        updatedAt: new \DateTimeImmutable('2025-11-20 14:30:00'),
        status: \TravelBooking\Config\Enum\TourStatus::OPEN,
    );

    // ==================== DÙNG DTO ====================
    $response = new \TravelBooking\Application\DTO\TourDetailResponse($tour);
    $data = $response->toArray($reader);

    // ==================== IN RA ĐẸP NHƯ FRONTEND ====================


    echo '<div style="background:#161b22;padding:20px;border-radius:8px;margin-bottom:20px;">';
    echo '<pre style="font-size:17px;line-height:1.8;color:#fff;">';

    echo $response->toJson();
    echo '</pre>';
    echo '</div>';

    exit;
}
add_action('init', 'travel_booking_test_tour_entity');