<?php
/**
 * Brothers Still Alive - Song Page
 * Template hiển thị bài hát theo slug (giống Believe/TuneCore)
 */

require_once __DIR__ . '/core/bootstrap.php';

// Get slug from URL
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if (empty($slug)) {
    header('Location: /');
    exit;
}

// Get song from database
$db = getDB();
$stmt = $db->prepare("SELECT * FROM songs WHERE slug = ? AND is_active = 1");
$stmt->execute([$slug]);
$song = $stmt->fetch();

// 404 if not found
if (!$song) {
    http_response_code(404);
    ?>
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>404 - Không tìm thấy | <?= SITE_NAME ?></title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: 'Inter', sans-serif; background: #1a1a1a; color: #fff; min-height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 20px; }
            h1 { font-size: 6rem; color: #d4003a; }
            h2 { font-size: 1.5rem; margin: 1rem 0; }
            p { color: #888; margin-bottom: 2rem; }
            a { display: inline-block; padding: 12px 30px; background: #d4003a; color: #fff; text-decoration: none; border-radius: 50px; font-weight: 500; }
            a:hover { background: #ff0044; }
        </style>
    </head>
    <body>
        <div>
            <h1>404</h1>
            <h2>Không tìm thấy bài hát</h2>
            <p>Bài hát bạn đang tìm không tồn tại hoặc đã bị xóa.</p>
            <a href="/">Về trang chủ</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Update view count
$db->prepare("UPDATE songs SET view_count = view_count + 1 WHERE id = ?")->execute([$song['id']]);

// Get cover image URL
$coverImage = $song['cover_image'] ?: 'images/default-cover.jpg';
// Tạo URL đầy đủ cho meta tags (OG image cần URL tuyệt đối)
$coverImageFull = $coverImage;
if (!str_starts_with($coverImage, 'http')) {
    $coverImageFull = SITE_URL . '/' . $coverImage;
}

// Streaming platforms config
$platforms = [
    ['key' => 'spotify_url', 'name' => 'Spotify', 'logo' => LOGO_SPOTIFY, 'action' => 'Play'],
    ['key' => 'apple_music_url', 'name' => 'Apple Music', 'logo' => LOGO_APPLE_MUSIC, 'action' => 'Play'],
    ['key' => 'youtube_music_url', 'name' => 'YouTube Music', 'logo' => LOGO_YOUTUBE_MUSIC, 'action' => 'Play'],
    ['key' => 'youtube_url', 'name' => 'YouTube', 'logo' => LOGO_YOUTUBE, 'action' => 'Watch'],
    ['key' => 'amazon_music_url', 'name' => 'Amazon Music', 'logo' => LOGO_AMAZON, 'action' => 'Play'],
    ['key' => 'tidal_url', 'name' => 'Tidal', 'logo' => LOGO_TIDAL, 'action' => 'Play'],
    ['key' => 'deezer_url', 'name' => 'Deezer', 'logo' => LOGO_DEEZER, 'action' => 'Play'],
    ['key' => 'nct_url', 'name' => 'NCT', 'logo' => 'https://assets.ams-prd.blv.cloud/images/stores/logo-nhaccuatui-label.png', 'action' => 'Play'],
    ['key' => 'zing_url', 'name' => 'Zing MP3', 'logo' => 'https://assets.ams-prd.blv.cloud/images/stores/logo-zing-label.png', 'action' => 'Play'],
    ['key' => 'soundcloud_url', 'name' => 'SoundCloud', 'logo' => 'https://assets.ams-prd.blv.cloud/images/stores/logo-soundcloud-label.png', 'action' => 'Play'],
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($song['title']) ?> - <?= e($song['artist']) ?> | <?= SITE_NAME ?></title>
    <meta name="description" content="<?= e($song['description'] ?: $song['title'] . ' by ' . $song['artist']) ?>">
    
    <!-- Open Graph -->
    <meta property="og:type" content="music.song">
    <meta property="og:title" content="<?= e($song['title']) ?> - <?= e($song['artist']) ?>">
    <meta property="og:description" content="<?= e($song['description'] ?: 'Nghe ' . $song['title'] . ' trên các nền tảng streaming') ?>">
    <meta property="og:image" content="<?= e($coverImageFull) ?>">
    <meta property="og:url" content="<?= SITE_URL ?>/<?= e($song['slug']) ?>">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($song['title']) ?> - <?= e($song['artist']) ?>">
    <meta name="twitter:image" content="<?= e($coverImageFull) ?>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(180deg, #4a5568 0%, #2d3748 100%);
            min-height: 100vh;
            color: #333;
        }
        
        /* Background blur */
        .bg-blur {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('<?= e($coverImage) ?>');
            background-size: cover;
            background-position: center;
            filter: blur(50px) brightness(0.5) saturate(1.2);
            transform: scale(1.2);
            z-index: -1;
        }
        
        /* Main container */
        .container {
            max-width: 420px;
            margin: 0 auto;
            padding: 20px 15px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        
        /* Card wrapper */
        .card {
            position: relative;
        }
        
        /* Header section - stacked card effect */
        .card-header {
            background: linear-gradient(180deg, #5a6a7e 0%, #3d4a5c 100%);
            padding: 25px 20px 30px;
            text-align: center;
            position: relative;
            border-radius: 20px;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.3);
            z-index: 2;
            margin-bottom: -15px;
        }
        
        /* Streaming card - sits behind header */
        .card-body {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            z-index: 1;
            padding-top: 15px;
            backdrop-filter: blur(10px);
        }
        
        /* Cover image */
        .cover-image {
            width: 180px;
            height: 180px;
            margin: 0 auto 15px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }
        
        .cover-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* YouTube embed */
        .video-embed {
            width: 100%;
            max-width: 280px;
            margin: 0 auto 18px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }
        
        .video-embed iframe {
            width: 100%;
            aspect-ratio: 16/9;
            display: block;
            border: none;
        }
        
        /* Artist & Title */
        .artist-name {
            color: #fff;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 3px;
            letter-spacing: -0.02em;
        }
        
        .song-title {
            color: rgba(255, 255, 255, 0.65);
            font-size: 0.95rem;
            font-weight: 400;
        }
        
        /* Streaming links */
        .streaming-list {
            padding: 0;
            list-style: none;
        }
        
        .streaming-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 35px;
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.2s;
        }
        
        .streaming-item:hover {
            background: #fafafa;
        }
        
        .streaming-item:last-child {
            border-bottom: none;
        }
        
        .streaming-logo {
            height: 36px;
            width: auto;
            max-width: 150px;
            object-fit: contain;
        }
        
        .streaming-btn {
            display: inline-block;
            padding: 8px 22px;
            border: 1.5px solid #e0e0e0;
            border-radius: 50px;
            color: #555;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
            background: transparent;
        }
        
        .streaming-btn:hover {
            background: #333;
            color: #fff;
            border-color: #333;
        }
        
        /* Footer */
        .card-footer {
            padding: 18px 20px;
            text-align: center;
            border-top: 1px solid #f0f0f0;
        }
        
        .footer-links {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 0.8rem;
        }
        
        .footer-links a:hover {
            text-decoration: underline;
        }
        
        .powered-by {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        
        .powered-by-dots {
            display: flex;
            gap: 2px;
            opacity: 0.4;
        }
        
        .powered-by-dots span {
            width: 3px;
            height: 3px;
            background: #999;
            border-radius: 50%;
        }
        
        .powered-by img {
            height: 18px;
            opacity: 0.5;
        }
        
        .powered-by-bsa {
            font-size: 0.7rem;
            color: #999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 12px;
            letter-spacing: 0.5px;
        }
        
        .powered-by-bsa img {
            height: 40px;
            filter: brightness(0);
            opacity: 0.7;
        }
        
        /* Back link */
        .back-link {
            display: block;
            text-align: center;
            padding: 20px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.875rem;
        }
        
        .back-link:hover {
            color: #fff;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .container {
                padding: 15px 10px;
            }
            
            .card-header {
                padding: 20px 15px 18px;
            }
            
            .cover-image {
                width: 150px;
                height: 150px;
            }
            
            .video-embed {
                max-width: 250px;
            }
            
            .artist-name {
                font-size: 1.2rem;
            }
            
            .song-title {
                font-size: 0.9rem;
            }
            
            .streaming-item {
                padding: 12px 25px;
            }
            
            .streaming-logo {
                height: 30px;
                max-width: 120px;
            }
            
            .streaming-btn {
                padding: 6px 18px;
                font-size: 0.8rem;
            }
        }
    </style>
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "MusicRecording",
        "name": "<?= e($song['title']) ?>",
        "byArtist": {
            "@type": "MusicGroup",
            "name": "<?= e($song['artist']) ?>"
        },
        "datePublished": "<?= $song['release_date'] ?>",
        "image": "<?= e($coverImageFull) ?>",
        "url": "<?= SITE_URL ?>/<?= e($song['slug']) ?>"
    }
    </script>
</head>
<body>
    <!-- Background blur -->
    <div class="bg-blur"></div>
    
    <div class="container">
        <div class="card">
            <!-- Header with cover & video -->
            <div class="card-header">
                <!-- Cover Image -->
                <div class="cover-image">
                    <img src="<?= e($coverImage) ?>" alt="<?= e($song['title']) ?>">
                </div>
                
                <!-- YouTube Embed -->
                <?php if ($song['youtube_video_id']): ?>
                <div class="video-embed">
                    <iframe 
                        src="https://www.youtube.com/embed/<?= e($song['youtube_video_id']) ?>?rel=0" 
                        title="<?= e($song['title']) ?>"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <?php endif; ?>
                
                <!-- Artist & Song Title -->
                <h1 class="artist-name"><?= e($song['artist']) ?></h1>
                <p class="song-title"><?= e($song['title']) ?></p>
            </div>
            
            <!-- Streaming Card Body -->
            <div class="card-body">
            <!-- Streaming Links -->
            <ul class="streaming-list">
                <?php foreach ($platforms as $platform): ?>
                    <?php if (!empty($song[$platform['key']])): ?>
                    <li class="streaming-item">
                        <img src="<?= $platform['logo'] ?>" alt="<?= $platform['name'] ?>" class="streaming-logo">
                        <a href="<?= e($song[$platform['key']]) ?>" target="_blank" rel="noopener" class="streaming-btn">
                            <?= $platform['action'] ?>
                        </a>
                    </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            
            <!-- Footer -->
            <div class="card-footer">
                <div class="footer-links">
                    <a href="#">Cookies</a>
                </div>
                <div class="powered-by">
                    <div class="powered-by-dots">
                        <span></span><span></span><span></span><span></span>
                    </div>
                </div>
                <div class="powered-by-bsa">
                    POWERED BY
                    <img src="https://s6.imgcdn.dev/YlwyR8.png" alt="BSA">
                </div>
            </div>
            </div>
        </div>
        
        <!-- Back to home -->
        <a href="/" class="back-link">← Về trang chủ BSA</a>
    </div>
</body>
</html>
