<?php

use TravelBooking\Domain\Enum\CustomerSource;

add_action('init', function () {
    $customerSource = 'faceboo';
    $source = $customerSource instanceof CustomerSource ? $customerSource : (CustomerSource::tryFrom($customerSource) ?? CustomerSource::WALK_IN);
    print_r($source);
});