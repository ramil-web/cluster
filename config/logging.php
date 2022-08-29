<?php

use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [
    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */
    'default'  => env('LOG_CHANNEL', 'stack'),
    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */
    'channels' => [
        'stack'      => [
            'driver'            => 'stack',
            'channels'          => ['daily'],
            'ignore_exceptions' => false,
        ],
        'single'     => [
            'driver' => 'single',
            'path'   => storage_path('logs/laravel.log'),
            'level'  => 'debug',
        ],
        'cron'       => [
            'driver' => 'daily',
            'path'   => storage_path('logs/cron/cron-log.log'),
            'level'  => 'debug',
        ],
        'import'     => [
            'driver' => 'daily',
            'path'   => storage_path('logs/import/import-log.log'),
            'level'  => 'debug',
        ],
        'import_wb'     => [
            'driver' => 'daily',
            'path'   => storage_path('logs/import_wb/import-log.log'),
            'level'  => 'debug',
        ],
        'import_wb_data'     => [
            'driver' => 'daily',
            'path'   => storage_path('logs/import_wb/import-data.log'),
            'level'  => 'debug',
        ],
        'parser_wb'     => [
            'driver' => 'daily',
            'path'   => storage_path('logs/parser_wb/parser-log.log'),
            'level'  => 'debug',
        ],
        'parser_wb_data'     => [
            'driver' => 'daily',
            'path'   => storage_path('logs/parser_wb/parser-data.log'),
            'level'  => 'debug',
        ],
        'parser_wb_rival'     => [
            'driver' => 'daily',
            'path'   => storage_path('logs/parser_wb_rival/parser-log.log'),
            'level'  => 'debug',
        ],

        'undersort_log'     => [
            'driver' => 'daily',
            'path'   => storage_path('logs/undersort_log/undersort-log.log'),
            'level'  => 'debug',
        ],

        'speed_test'     => [
            'driver' => 'daily',
            'path'   => storage_path('logs/speed_test/speed_test-log.log'),
            'level'  => 'debug',
        ],

        'admin_err'    => [
            'driver' => 'daily',
            'path'   => storage_path('logs/errors/admin_err.log'),
            'level'  => 'debug',
            'days'   => 30,
        ],
        'reg_err'    => [
            'driver' => 'daily',
            'path'   => storage_path('logs/errors/reg_err.log'),
            'level'  => 'debug',
            'days'   => 30,
        ],
        'address_err'    => [
            'driver' => 'daily',
            'path'   => storage_path('logs/errors/address_err.log'),
            'level'  => 'debug',
            'days'   => 30,
        ],
        'order_err'    => [
            'driver' => 'daily',
            'path'   => storage_path('logs/errors/order_err.log'),
            'level'  => 'debug',
            'days'   => 30,
        ],
        'merge_orders_err'    => [
            'driver' => 'daily',
            'path'   => storage_path('logs/errors/merge_orders_err.log'),
            'level'  => 'debug',
            'days'   => 30,
        ],
        'daily'      => [
            'driver' => 'daily',
            'path'   => storage_path('logs/laravel.log'),
            'level'  => 'debug',
            'days'   => 14,
        ],
        'slack'      => [
            'driver'   => 'slack',
            'url'      => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji'    => ':boom:',
            'level'    => 'critical',
        ],
        'papertrail' => [
            'driver'       => 'monolog',
            'level'        => 'debug',
            'handler'      => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],
        'stderr'     => [
            'driver'    => 'monolog',
            'handler'   => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with'      => [
                'stream' => 'php://stderr',
            ],
        ],
        'syslog'     => [
            'driver' => 'syslog',
            'level'  => 'debug',
        ],
        'errorlog'   => [
            'driver' => 'errorlog',
            'level'  => 'debug',
        ],
    ],
];