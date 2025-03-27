<?php
// Detect environment
define('ENVIRONMENT', isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'localhost') === false ? 'production' : 'development');

// Adjust BASE_PATH for Hostinger
if (ENVIRONMENT === 'production') {
    define('BASE_PATH', dirname(dirname(dirname($_SERVER['DOCUMENT_ROOT']))));
} else {
    define('BASE_PATH', dirname(dirname(__DIR__)));
}

define('DATA_PATH', BASE_PATH . '/data');
define('PRODUCTS_FILE', DATA_PATH . '/products.json');
define('CATEGORIES_FILE', DATA_PATH . '/categories.json');

// Create cache directory if it doesn't exist
$cacheDir = BASE_PATH . '/cache';
if (!file_exists($cacheDir)) {
    mkdir($cacheDir, 0777, true);
}

// Error reporting based on environment
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', BASE_PATH . '/logs/error.log');
}

// Session security settings
session_start();
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
if (ENVIRONMENT === 'production') {
    ini_set('session.cookie_secure', 1);
}

// Check file permissions
$requiredFiles = [PRODUCTS_FILE, CATEGORIES_FILE];
foreach ($requiredFiles as $file) {
    if (!is_readable($file)) {
        error_log("Error: Cannot read file $file. Please check file permissions.");
        die("Configuration error. Please check error logs.");
    }
}
