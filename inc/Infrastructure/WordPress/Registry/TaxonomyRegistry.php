<?php
namespace TravelBooking\Infrastructure\WordPress\Registry;

use Dotenv\Exception\ValidationException;
use TravelBooking\Infrastructure\Logger\Logger;

final class TaxonomyRegistry extends RegistryBase
{

    private static ?self $instance  = null;
    protected function getConfigPath(): string
    {
        return TB_CONFIG_PATH . 'WordPress/tax';
    }
    protected static function defineCacheKey(): string
    {
        return 'tax_register';
    }

    /**
     * Private constructor for Singleton
     */
    private function __construct() {
        parent::__construct();

        // Auto-register on init
        add_action('init', [$this, 'register'], 0);

    }

    /**
     * Get singleton instance
     */
    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function register(): bool {
      $configs = $this->getConfigs();

      if (empty($configs)) {
          Logger::log("[Taxonomy Registry] Configuration is empty");
          throw new ValidationException('Config files not found');
      }

      foreach ($configs as $config) {
          kecb_register_taxonomy($config);
      }

      return true;

    }
}