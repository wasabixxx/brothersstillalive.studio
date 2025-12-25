-- Brothers Still Alive - Database Schema
-- Database: grjvyjhz_bsadb

CREATE TABLE IF NOT EXISTS `songs` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `artist` VARCHAR(255) NOT NULL DEFAULT 'BSA',
    `description` TEXT,
    `lyrics` TEXT,
    `cover_image` VARCHAR(500),
    `release_date` DATE,
    `youtube_video_id` VARCHAR(50),
    
    -- Streaming URLs
    `spotify_url` VARCHAR(500),
    `apple_music_url` VARCHAR(500),
    `youtube_music_url` VARCHAR(500),
    `youtube_url` VARCHAR(500),
    `amazon_music_url` VARCHAR(500),
    `tidal_url` VARCHAR(500),
    `deezer_url` VARCHAR(500),
    `nct_url` VARCHAR(500),
    `zing_url` VARCHAR(500),
    `soundcloud_url` VARCHAR(500),
    
    -- Meta
    `is_active` TINYINT(1) DEFAULT 1,
    `view_count` INT(11) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX `idx_slug` (`slug`),
    INDEX `idx_active` (`is_active`),
    INDEX `idx_release_date` (`release_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample data
INSERT INTO `songs` (`title`, `slug`, `artist`, `description`, `release_date`, `cover_image`, `spotify_url`, `youtube_url`) VALUES
('Mưa Đang Bay', 'mua-dang-bay', 'TeuYungBoy', 'Single mới nhất từ TeuYungBoy - Mưa Đang Bay', '2024-12-01', 'images/songs/mua-dang-bay.jpg', 'https://open.spotify.com/track/xxx', 'https://youtube.com/watch?v=xxx');
