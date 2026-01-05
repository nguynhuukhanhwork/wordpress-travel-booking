<?php


/**
 * Class virtual (stub) for WP-CLI
 */
class WP_CLI
{
    public static function success(string $message){}
    public static function add_command(string $name, $callback){}
    public static function confirm(string $message) {}
    public static function error(string $message) {}
    public static function log(string $message) {}
    public static function warning(string $message) {}
}
