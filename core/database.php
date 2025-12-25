<?php
/**
 * Brothers Still Alive - Database Configuration & Connection
 * 
 * @package BSA
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('BSA_ROOT')) {
    exit('Direct access not allowed');
}

// Database settings
define('DB_HOST', 'localhost');
define('DB_NAME', 'grjvyjhz_bsadb');
define('DB_USER', 'root');      // Change on production
define('DB_PASS', '');          // Change on production
define('DB_CHARSET', 'utf8mb4');

/**
 * Get PDO database connection (singleton pattern)
 * 
 * @return PDO
 */
function getDB(): PDO
{
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = sprintf(
                "mysql:host=%s;dbname=%s;charset=%s",
                DB_HOST,
                DB_NAME,
                DB_CHARSET
            );
            
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Không thể kết nối database. Vui lòng thử lại sau.");
        }
    }
    
    return $pdo;
}
