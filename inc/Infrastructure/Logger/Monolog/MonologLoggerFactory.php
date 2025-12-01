<?php
namespace TravelBooking\Infrastructure\Logger;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger as Monolog;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\WebProcessor;

final class MonologLoggerFactory
{
    private static array $instances = [];
    private const LOG_DIR     = WP_CONTENT_DIR . '/logs';
    private const ROTATE_DAYS = 30;

    public static function channel(string $channel): Monolog
    {
        if (isset(self::$instances[$channel])) {
            return self::$instances[$channel];
        }

        $logger = new Monolog($channel);

        if (!is_dir(self::LOG_DIR)) {
            @mkdir(self::LOG_DIR, 0755, true);
        }

        $fileHandler = new RotatingFileHandler(self::LOG_DIR . '/' . $channel . '.log', self::ROTATE_DAYS);

        // ←←←←← ĐOẠN NÀY LÀ HOÀN HẢO NHẤT ←←←←←
        $output = "%datetime% | %channel%.%level_name% | %message%\n%extra%\n%context%\n";

        $formatter = new LineFormatter($output, "Y-m-d H:i:s", true, true);
        $formatter->allowInlineLineBreaks(true);
        $formatter->includeStacktraces(true);
        $formatter->ignoreEmptyContextAndExtra();
        $formatter->setJsonPrettyPrint(true);
        // ←←←←← KẾT THÚC ĐOẠN HOÀN HẢO ←←←←←

        $fileHandler->setFormatter($formatter);
        $logger->pushHandler($fileHandler);

        $logger->pushProcessor(new UidProcessor());
        $logger->pushProcessor(new WebProcessor());

        return self::$instances[$channel] = $logger;
    }
}