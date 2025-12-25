<?php
/**
 * Brothers Still Alive - Database Configuration
 */

// Database settings
define('DB_HOST', 'localhost');
define('DB_NAME', 'grjvyjhz_bsadb');
define('DB_USER', 'root');  // Thay đổi username trên hosting
define('DB_PASS', '');      // Thay đổi password trên hosting
define('DB_CHARSET', 'utf8mb4');

// Site settings
define('SITE_NAME', 'Brothers Still Alive');
define('SITE_URL', 'https://brothersstillalive.studio');
define('SITE_DESCRIPTION', 'Brothers Still Alive (BSA) - Rap Label từ Việt Nam. Khám phá câu chuyện, nghệ sĩ và âm nhạc của chúng tôi.');

// Streaming platform logos
define('LOGO_SPOTIFY', 'https://assets.ams-prd.blv.cloud/images/stores/logo-spotify-label.png');
define('LOGO_APPLE_MUSIC', 'https://assets.ams-prd.blv.cloud/images/stores/logo-appleMusic-label.png');
define('LOGO_YOUTUBE_MUSIC', 'https://assets.ams-prd.blv.cloud/images/stores/logo-youtubeMusic-label.png');
define('LOGO_YOUTUBE', 'https://assets.ams-prd.blv.cloud/images/stores/logo-youtube-label.png');
define('LOGO_TIDAL', 'https://assets.ams-prd.blv.cloud/images/stores/logo-tidal-label.png');
define('LOGO_AMAZON', 'https://assets.ams-prd.blv.cloud/images/stores/logo-amazonMusic-label.png');
define('LOGO_DEEZER', 'https://assets.ams-prd.blv.cloud/images/stores/logo-deezer-label.png');
define('LOGO_NCT', 'https://chiasenhac.vn/imgs/no_cover_my.jpg');
define('LOGO_ZING', 'https://static-zmp3.zmdcdn.me/skins/zmp3-v6.1/images/backgrounds/logo-dark.svg');

// Database connection function
function getDB() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
    return $pdo;
}

// Helper function to sanitize output
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Helper function to generate slug
function generateSlug($string) {
    $string = mb_strtolower($string, 'UTF-8');
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    $string = preg_replace('/[\s-]+/', '-', $string);
    return trim($string, '-');
}
