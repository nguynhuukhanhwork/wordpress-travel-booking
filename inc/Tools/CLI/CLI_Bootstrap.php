<?php

namespace TravelBooking\Tools\CLI;

use \WP_CLI;
class CLI_Bootstrap
{
    public static function init(): void
    {
        if (!defined('WP_CLI') || !\WP_CLI) {
            return;
        }

        \WP_CLI::add_command(
            'travel-booking db',
            Tool_Reinstall_Database::class
        );
    }
}