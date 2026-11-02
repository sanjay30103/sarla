<?php

declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));

// Static export (GitHub Pages): no sessions, forms are sent via WhatsApp instead.
define('STATIC_EXPORT', getenv('SARLA_STATIC') === '1');

date_default_timezone_set('Asia/Kolkata');

$_SERVER['REQUEST_METHOD'] ??= 'GET';

if (!STATIC_EXPORT) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ]);
}

require __DIR__ . '/config.php';
require __DIR__ . '/functions.php';
require __DIR__ . '/menu-data.php';
