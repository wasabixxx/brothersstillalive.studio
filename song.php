<?php
/**
 * Brothers Still Alive - Song Page
 * Dynamic page for displaying individual songs by slug
 */

// Configuration
$site_name = "Brothers Still Alive";
$base_url = "https://brothersstillalive.studio";

// Get slug from URL
$slug = isset($_GET['slug']) ? htmlspecialchars(trim($_GET['slug'])) : '';

if (empty($slug)) {
    header('Location: /');
    exit;
}

// TODO: In production, fetch song data from database
// For now, use sample data
$songs = [
    'baithunhat' => [
        'title' => 'Bài Thứ Nhất',
        'artist' => 'BSA Crew',
        'release_date' => '2024-01-15',
        'cover_image' => 'images/songs/baithunhat.jpg',
        'description' => 'Single đầu tay của BSA - Câu chuyện về những người anh em và con đường Hip-hop.',
        'lyrics' => "Verse 1:
Đây là câu chuyện của chúng tôi
Những người anh em đứng cạnh nhau
Từ con hẻm nhỏ đến ánh đèn sân khấu
Không bao giờ quên nơi mình bắt đầu

Chorus:
Brothers Still Alive
Vẫn còn sống, vẫn còn cháy
Brothers Still Alive
Mỗi ngày là một trận chiến mới

(Thêm lyrics tại đây...)",
        'spotify_url' => 'https://open.spotify.com/track/xxx',
        'apple_music_url' => 'https://music.apple.com/xxx',
        'youtube_url' => 'https://youtube.com/watch?v=xxx',
        'soundcloud_url' => 'https://soundcloud.com/xxx'
    ],
    'duongve' => [
        'title' => 'Đường Về',
        'artist' => 'BSA Crew',
        'release_date' => '2024-02-20',
        'cover_image' => 'images/songs/duongve.jpg',
        'description' => 'Bản ballad rap đầy cảm xúc về gia đình và quê hương.',
        'lyrics' => "(Lyrics sẽ được thêm sau...)",
        'spotify_url' => 'https://open.spotify.com/track/xxx',
        'apple_music_url' => 'https://music.apple.com/xxx',
        'youtube_url' => 'https://youtube.com/watch?v=xxx',
        'soundcloud_url' => 'https://soundcloud.com/xxx'
    ]
];

// Check if song exists
if (!isset($songs[$slug])) {
    http_response_code(404);
    $page_title = "Không tìm thấy bài hát";
    $site_description = "Bài hát bạn tìm kiếm không tồn tại.";
    include 'includes/header.php';
    ?>
    <section class="notFound">
        <div class="container" style="text-align: center; padding: 150px 20px;">
            <h1>404</h1>
            <h2>Không tìm thấy bài hát</h2>
            <p style="color: var(--color-text-secondary); margin: 20px 0 40px;">Bài hát bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.</p>
            <a href="/" class="buttonSolid" data-cursor="min">
                Về trang chủ
                <svg viewBox="0 0 33 15">
                    <rect y="6.39545" width="31.7181" height="1.92231" rx="0.961156" />
                    <rect x="25.9062" y="0.367493" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(45 25.9062 0.367493)" />
                    <rect x="33" y="7.47278" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(135 33 7.47278)" />
                </svg>
            </a>
        </div>
    </section>
    <?php
    include 'includes/footer.php';
    exit;
}

// Get song data
$song = $songs[$slug];
$page_title = $song['title'] . ' - ' . $song['artist'];
$site_description = $song['description'];

// Include header
include 'includes/header.php';
?>

<!-- Song Hero Section -->
<section class="songHero">
    <div class="container">
        <div class="songHeroContent">
            <!-- Cover Image -->
            <div class="songCover" data-fade="1">
                <?php if (!empty($song['cover_image']) && file_exists($song['cover_image'])): ?>
                    <img src="<?php echo $song['cover_image']; ?>" alt="<?php echo $song['title']; ?> Cover">
                <?php else: ?>
                    <!-- Placeholder cover -->
                    <div class="songCoverPlaceholder" style="background: linear-gradient(135deg, #d4003a 0%, #ff0044 100%);">
                        <span>BSA+</span>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Song Info -->
            <div class="songInfo">
                <p data-fade="1" class="songType">Single</p>
                <h1 data-fade="1" class="songTitle"><?php echo $song['title']; ?></h1>
                <p data-fade="2" class="songArtist"><?php echo $song['artist']; ?></p>
                <p data-fade="2" class="songDate"><?php echo date('d/m/Y', strtotime($song['release_date'])); ?></p>
                <p data-fade="2" class="songDescription"><?php echo $song['description']; ?></p>
                
                <!-- Streaming Links -->
                <div data-fade="3" class="songStreaming">
                    <h3>Nghe ngay trên:</h3>
                    <div class="streamingLinks">
                        <?php if (!empty($song['spotify_url'])): ?>
                            <a href="<?php echo $song['spotify_url']; ?>" target="_blank" rel="noopener" class="streamingBtn spotify" data-cursor="icon">
                                <i class="fab fa-spotify"></i>
                                <span>Spotify</span>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (!empty($song['apple_music_url'])): ?>
                            <a href="<?php echo $song['apple_music_url']; ?>" target="_blank" rel="noopener" class="streamingBtn apple" data-cursor="icon">
                                <i class="fab fa-apple"></i>
                                <span>Apple Music</span>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (!empty($song['youtube_url'])): ?>
                            <a href="<?php echo $song['youtube_url']; ?>" target="_blank" rel="noopener" class="streamingBtn youtube" data-cursor="icon">
                                <i class="fab fa-youtube"></i>
                                <span>YouTube</span>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (!empty($song['soundcloud_url'])): ?>
                            <a href="<?php echo $song['soundcloud_url']; ?>" target="_blank" rel="noopener" class="streamingBtn soundcloud" data-cursor="icon">
                                <i class="fab fa-soundcloud"></i>
                                <span>SoundCloud</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lyrics Section -->
<?php if (!empty($song['lyrics'])): ?>
<section class="songLyrics sectionAnimate">
    <div class="container">
        <h2 data-fade="1">Lyrics</h2>
        <div data-fade="2" class="lyricsContent">
            <pre><?php echo $song['lyrics']; ?></pre>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Share Section -->
<section class="songShare sectionAnimate">
    <div class="container">
        <h3 data-fade="1">Chia sẻ bài hát này</h3>
        <div data-fade="2" class="shareButtons">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($base_url . '/' . $slug); ?>" target="_blank" rel="noopener" class="shareBtn facebook" data-cursor="icon">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($base_url . '/' . $slug); ?>&text=<?php echo urlencode($song['title'] . ' - ' . $song['artist']); ?>" target="_blank" rel="noopener" class="shareBtn twitter" data-cursor="icon">
                <i class="fab fa-twitter"></i>
            </a>
            <button onclick="copyToClipboard('<?php echo $base_url . '/' . $slug; ?>')" class="shareBtn copy" data-cursor="icon">
                <i class="fas fa-link"></i>
            </button>
        </div>
    </div>
</section>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Đã copy link!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>

<!-- Structured Data for SEO -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "MusicRecording",
    "name": "<?php echo $song['title']; ?>",
    "byArtist": {
        "@type": "MusicGroup",
        "name": "<?php echo $song['artist']; ?>"
    },
    "datePublished": "<?php echo $song['release_date']; ?>",
    "description": "<?php echo $song['description']; ?>",
    "url": "<?php echo $base_url . '/' . $slug; ?>"
}
</script>

<?php include 'includes/footer.php'; ?>
