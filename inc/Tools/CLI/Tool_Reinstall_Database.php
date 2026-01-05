<?php

/**
 * @description: Tool for work with database: Create Table, Drop table, Truncate table, Clear all Term of Travel Booking System
 * @author: KhanhECB
 * @date: 2025-12-16
 */
namespace TravelBooking\Tools\CLI;

use TravelBooking\Infrastructure\Database\BookingTable;
use TravelBooking\Infrastructure\Database\CustomerTable;
use TravelBooking\Infrastructure\Database\NotificationTable;
use WP_CLI;

class Tool_Reinstall_Database {

    /**
     * Truncate Travel Booking tables
     */
    public function truncate() {
        global $wpdb;

        $prefix = 'wp_travel_booking_';
        $tables = [
            "{$prefix}booking_data",
            "{$prefix}customer",
            "{$prefix}notifications",
        ];

        foreach ($tables as $table) {
            $wpdb->query("TRUNCATE TABLE `$table`");
        }

        WP_CLI::success('Travel Booking tables truncated successfully.');
    }

    /**
     * Clear all Term
     * @return void
     */
    public function clear_term() {
        $taxonomies = [
            'tour_cost',
            'tour_duration',
            'tour_location',
            'tour_person',
            'tour_type',
            'tour_rating'
        ];

        foreach ($taxonomies as $taxonomy) {

            $terms = get_terms([
                'taxonomy'   => $taxonomy,
                'hide_empty' => false,
            ]);

            if (is_wp_error($terms)) {
                WP_CLI::log($terms->get_error_message());
            }

            foreach ($terms as $term) {
                $result = wp_delete_term($term->term_id, $taxonomy);

                if (is_wp_error($result)) {
                    WP_CLI::warning(
                        "Failed deleting term {$term->name}: " . $result->get_error_message()
                    );
                } else {
                    WP_CLI::log("Deleted term: {$term->name}");
                }
            }
        }
    }

    public function drop() {
        error_log('Test');

        global $wpdb;

        $prefix = 'wp_travel_booking_';
        $tables = [
            "{$prefix}booking_data",
            "{$prefix}customer",
            "{$prefix}notifications",
        ];

        foreach ($tables as $table) {
            $wpdb->query(" DROP TABLE IF EXISTS $table");
            WP_CLI::warning("Dropped table: {$table}");
        }

        WP_CLI::success('Travel Booking tables truncated successfully.');
    }

    /**
     * Create table
     * @return void
     */
    public function install() {
        global $wpdb;

        // Create Database
        BookingTable::getInstance()->createTable();
        CustomerTable::getInstance()->createTable();
        NotificationTable::getInstance()->createTable();

        // Check database
        $error = $wpdb->last_error;

        if ($error) {
            WP_CLI::warning($error);
        }

        WP_CLI::success('Database table installed successfully.');
    }
}
