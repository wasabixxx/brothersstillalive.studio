<?php
/**
 * Brothers Still Alive - Constants & Configuration
 * 
 * @package BSA
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('BSA_ROOT')) {
    exit('Direct access not allowed');
}

/*
|--------------------------------------------------------------------------
| Site Configuration
|--------------------------------------------------------------------------
*/
define('SITE_NAME', 'Brothers Still Alive');

// Auto-detect site URL (works for both local and production)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'brothersstillalive.studio';
define('SITE_URL', $protocol . '://' . $host);

define('SITE_DESCRIPTION', 'Brothers Still Alive (BSA) - Rap Label từ Việt Nam. Khám phá câu chuyện, nghệ sĩ và âm nhạc của chúng tôi.');

/*
|--------------------------------------------------------------------------
| BSA Branding
|--------------------------------------------------------------------------
*/
define('LOGO_BSA', 'https://s6.imgcdn.dev/YlwyR8.png');

/*
|--------------------------------------------------------------------------
| Streaming Platform Logos
|--------------------------------------------------------------------------
| Logos from Believe CDN for consistent branding
*/
define('LOGO_SPOTIFY', 'https://assets.ams-prd.blv.cloud/images/stores/logo-spotify-label.png');
define('LOGO_APPLE_MUSIC', 'https://assets.ams-prd.blv.cloud/images/stores/logo-appleMusic-label.png');
define('LOGO_YOUTUBE_MUSIC', 'https://assets.ams-prd.blv.cloud/images/stores/logo-youtubeMusic-label.png');
define('LOGO_YOUTUBE', 'https://assets.ams-prd.blv.cloud/images/stores/logo-youtube-label.png');
define('LOGO_TIDAL', 'https://assets.ams-prd.blv.cloud/images/stores/logo-tidal-label.png');
define('LOGO_AMAZON', 'https://assets.ams-prd.blv.cloud/images/stores/logo-amazonMusic-label.png');
define('LOGO_DEEZER', 'https://assets.ams-prd.blv.cloud/images/stores/logo-deezer-label.png');
define('LOGO_NCT', 'https://assets.ams-prd.blv.cloud/images/stores/logo-nhaccuatui-label.png');
define('LOGO_ZING', 'https://assets.ams-prd.blv.cloud/images/stores/logo-zing-label.png');
define('LOGO_SOUNDCLOUD', 'https://assets.ams-prd.blv.cloud/images/stores/logo-soundcloud-label.png');

/*
|--------------------------------------------------------------------------
| Admin Configuration
|--------------------------------------------------------------------------
*/
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'bsa2024');  // Change on production!

/*
|--------------------------------------------------------------------------
| Upload Configuration
|--------------------------------------------------------------------------
*/
define('UPLOAD_DIR', BSA_ROOT . '/uploads');
define('UPLOAD_URL', SITE_URL . '/uploads');
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024);  // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'webp']);
