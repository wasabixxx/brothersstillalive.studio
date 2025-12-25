<?php
/**
 * Brothers Still Alive - Helper Functions
 * 
 * @package BSA
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('BSA_ROOT')) {
    exit('Direct access not allowed');
}

/**
 * Escape HTML output to prevent XSS
 * 
 * @param string|null $string
 * @return string
 */
function e(?string $string): string
{
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Generate URL-friendly slug from string
 * 
 * @param string $string
 * @return string
 */
function generateSlug(string $string): string
{
    // Convert to lowercase
    $string = mb_strtolower($string, 'UTF-8');
    
    // Vietnamese character mapping
    $vietnamese = [
        'à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ẳ', 'ẵ',
        'è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ',
        'ì', 'í', 'ị', 'ỉ', 'ĩ',
        'ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ',
        'ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ữ',
        'ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ',
        'đ'
    ];
    
    $ascii = [
        'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
        'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
        'i', 'i', 'i', 'i', 'i',
        'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
        'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
        'y', 'y', 'y', 'y', 'y',
        'd'
    ];
    
    $string = str_replace($vietnamese, $ascii, $string);
    
    // Remove non-alphanumeric characters
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    
    // Replace spaces and multiple dashes with single dash
    $string = preg_replace('/[\s-]+/', '-', $string);
    
    return trim($string, '-');
}

/**
 * Get asset URL with cache busting
 * 
 * @param string $path Relative path to asset
 * @return string Full URL to asset
 */
function asset(string $path): string
{
    $file = BSA_ROOT . '/assets/' . ltrim($path, '/');
    $version = file_exists($file) ? filemtime($file) : time();
    
    return SITE_URL . '/assets/' . ltrim($path, '/') . '?v=' . $version;
}

/**
 * Get upload URL
 * 
 * @param string $path Relative path to upload
 * @return string Full URL to upload
 */
function upload(string $path): string
{
    return UPLOAD_URL . '/' . ltrim($path, '/');
}

/**
 * Check if current request is AJAX
 * 
 * @return bool
 */
function isAjax(): bool
{
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

/**
 * Redirect to URL
 * 
 * @param string $url
 * @param int $statusCode
 */
function redirect(string $url, int $statusCode = 302): void
{
    header('Location: ' . $url, true, $statusCode);
    exit;
}

/**
 * Get current URL
 * 
 * @return string
 */
function currentUrl(): string
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * Format date for display
 * 
 * @param string $date
 * @param string $format
 * @return string
 */
function formatDate(string $date, string $format = 'd/m/Y'): string
{
    return date($format, strtotime($date));
}

/**
 * Truncate string with ellipsis
 * 
 * @param string $string
 * @param int $length
 * @param string $suffix
 * @return string
 */
function truncate(string $string, int $length = 100, string $suffix = '...'): string
{
    if (mb_strlen($string) <= $length) {
        return $string;
    }
    
    return mb_substr($string, 0, $length) . $suffix;
}
