<?php
/**
 * Brothers Still Alive - Bootstrap File
 * Load this file at the beginning of every PHP file
 * 
 * @package BSA
 * @since 1.0.0
 */

// Define root path
define('BSA_ROOT', dirname(__DIR__));

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Load core files
require_once BSA_ROOT . '/core/constants.php';
require_once BSA_ROOT . '/core/database.php';
require_once BSA_ROOT . '/core/helpers.php';

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
