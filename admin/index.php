<?php
/**
 * Brothers Still Alive - Admin Panel
 * CRUD cho quản lý bài hát
 */

require_once __DIR__ . '/../core/bootstrap.php';

// Check auth
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    
    // Handle login
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        if ($_POST['username'] === ADMIN_USERNAME && $_POST['password'] === ADMIN_PASSWORD) {
            $_SESSION['admin_logged_in'] = true;
            redirect('index.php');
        } else {
            $login_error = 'Sai tên đăng nhập hoặc mật khẩu!';
        }
    }
    
    // Handle logout
    if (isset($_GET['logout'])) {
        unset($_SESSION['admin_logged_in']);
        redirect('index.php');
    }
    
    // Show login form
    ?>
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login - BSA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body { background: #1a1a1a; color: #fff; min-height: 100vh; display: flex; align-items: center; }
            .card { background: #2a2a2a; border: none; }
            .form-control { background: #333; border-color: #444; color: #fff; }
            .form-control:focus { background: #333; color: #fff; border-color: #d4003a; box-shadow: none; }
            .btn-primary { background: #d4003a; border-color: #d4003a; }
            .btn-primary:hover { background: #ff0044; border-color: #ff0044; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card p-4">
                        <div class="text-center mb-3"><img src="https://s6.imgcdn.dev/YlwyR8.png" height="60"></div>
                        <h3 class="text-center mb-4">Admin Panel</h3>
                        <?php if (isset($login_error)): ?>
                            <div class="alert alert-danger"><?= $login_error ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <input type="hidden" name="login" value="1">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

$db = getDB();

// Auto-create table if not exists
$db->exec("
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
        `is_active` TINYINT(1) DEFAULT 1,
        `view_count` INT(11) DEFAULT 0,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
");

// Handle actions
$action = $_GET['action'] ?? 'list';
$message = '';
$error = '';

// DELETE
if ($action === 'delete' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM songs WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header('Location: index.php?msg=deleted');
    exit;
}

// SAVE (Create/Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_song'])) {
    $id = $_POST['id'] ?? null;
    
    // Handle file upload
    $cover_image = trim($_POST['cover_image']);
    if (isset($_FILES['cover_file']) && $_FILES['cover_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/songs/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $fileExt = strtolower(pathinfo($_FILES['cover_file']['name'], PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
        if (in_array($fileExt, $allowedExts)) {
            $fileName = uniqid('cover_') . '.' . $fileExt;
            $uploadPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['cover_file']['tmp_name'], $uploadPath)) {
                $cover_image = 'images/songs/' . $fileName;
            }
        }
    }
    
    $data = [
        'title' => trim($_POST['title']),
        'slug' => trim($_POST['slug']) ?: generateSlug($_POST['title']),
        'artist' => trim($_POST['artist']) ?: 'BSA',
        'description' => trim($_POST['description']),
        'lyrics' => trim($_POST['lyrics']),
        'cover_image' => $cover_image,
        'release_date' => $_POST['release_date'] ?: null,
        'youtube_video_id' => trim($_POST['youtube_video_id']),
        'spotify_url' => trim($_POST['spotify_url']),
        'apple_music_url' => trim($_POST['apple_music_url']),
        'youtube_music_url' => trim($_POST['youtube_music_url']),
        'youtube_url' => trim($_POST['youtube_url']),
        'amazon_music_url' => trim($_POST['amazon_music_url']),
        'tidal_url' => trim($_POST['tidal_url']),
        'deezer_url' => trim($_POST['deezer_url']),
        'nct_url' => trim($_POST['nct_url']),
        'zing_url' => trim($_POST['zing_url']),
        'soundcloud_url' => trim($_POST['soundcloud_url']),
        'is_active' => isset($_POST['is_active']) ? 1 : 0,
    ];
    
    if ($id) {
        // Update
        $sql = "UPDATE songs SET title=?, slug=?, artist=?, description=?, lyrics=?, cover_image=?, 
                release_date=?, youtube_video_id=?, spotify_url=?, apple_music_url=?, youtube_music_url=?,
                youtube_url=?, amazon_music_url=?, tidal_url=?, deezer_url=?, nct_url=?, zing_url=?, 
                soundcloud_url=?, is_active=? WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([...array_values($data), $id]);
        header('Location: index.php?msg=updated');
    } else {
        // Create
        $sql = "INSERT INTO songs (title, slug, artist, description, lyrics, cover_image, release_date,
                youtube_video_id, spotify_url, apple_music_url, youtube_music_url, youtube_url, 
                amazon_music_url, tidal_url, deezer_url, nct_url, zing_url, soundcloud_url, is_active)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array_values($data));
        header('Location: index.php?msg=created');
    }
    exit;
}

// Messages
if (isset($_GET['msg'])) {
    $messages = [
        'created' => '✅ Đã tạo bài hát mới!',
        'updated' => '✅ Đã cập nhật bài hát!',
        'deleted' => '✅ Đã xóa bài hát!'
    ];
    $message = $messages[$_GET['msg']] ?? '';
}

// Get song for edit
$song = null;
if ($action === 'edit' && isset($_GET['id'])) {
    $stmt = $db->prepare("SELECT * FROM songs WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $song = $stmt->fetch();
}

// Get all songs for list
$songs = [];
if ($action === 'list') {
    $songs = $db->query("SELECT * FROM songs ORDER BY created_at DESC")->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Brothers Still Alive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --accent: #d4003a; }
        body { background: #1a1a1a; color: #e0e0e0; }
        .navbar { background: #111 !important; }
        .navbar-brand { color: #fff !important; font-weight: 700; }
        .card { background: #2a2a2a; border: 1px solid #333; }
        .card-header { background: #222; border-bottom: 1px solid #333; }
        .table { color: #e0e0e0; }
        .table-dark { --bs-table-bg: #222; --bs-table-border-color: #333; }
        .form-control, .form-select { 
            background: #333; border-color: #444; color: #fff; 
        }
        .form-control:focus, .form-select:focus { 
            background: #333; color: #fff; border-color: var(--accent); box-shadow: none; 
        }
        .form-control::placeholder { color: #888; }
        .btn-primary { background: var(--accent); border-color: var(--accent); }
        .btn-primary:hover { background: #ff0044; border-color: #ff0044; }
        .btn-outline-primary { color: var(--accent); border-color: var(--accent); }
        .btn-outline-primary:hover { background: var(--accent); border-color: var(--accent); }
        .form-label { color: #aaa; font-size: 0.875rem; }
        .badge { font-weight: 500; }
        .cover-preview { max-width: 60px; border-radius: 4px; }
        a { color: var(--accent); }
        .form-check-input:checked { background-color: var(--accent); border-color: var(--accent); }
        textarea.form-control { min-height: 120px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="https://s6.imgcdn.dev/YlwyR8.png" height="32" class="me-2"> BSA Admin</a>
            <div>
                <a href="../" target="_blank" class="btn btn-sm btn-outline-light me-2">
                    <i class="fas fa-external-link-alt"></i> Xem site
                </a>
                <a href="?logout=1" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if ($message): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($action === 'list'): ?>
            <!-- LIST VIEW -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>📀 Danh sách bài hát</h2>
                <a href="?action=add" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Thêm bài hát
                </a>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="60">Cover</th>
                                <th>Tên bài hát</th>
                                <th>Nghệ sĩ</th>
                                <th>Slug</th>
                                <th>Ngày phát hành</th>
                                <th>Trạng thái</th>
                                <th width="120">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($songs)): ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Chưa có bài hát nào. <a href="?action=add">Thêm bài hát đầu tiên</a>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($songs as $s): ?>
                                    <tr>
                                        <td>
                                            <?php if ($s['cover_image']): ?>
                                                <img src="../<?= e($s['cover_image']) ?>" class="cover-preview" alt="">
                                            <?php else: ?>
                                                <div class="cover-preview bg-secondary d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                                    <i class="fas fa-music"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td><strong><?= e($s['title']) ?></strong></td>
                                        <td><?= e($s['artist']) ?></td>
                                        <td><code>/<?= e($s['slug']) ?></code></td>
                                        <td><?= $s['release_date'] ? date('d/m/Y', strtotime($s['release_date'])) : '-' ?></td>
                                        <td>
                                            <?php if ($s['is_active']): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Draft</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="?action=edit&id=<?= $s['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="../<?= e($s['slug']) ?>" target="_blank" class="btn btn-sm btn-outline-light">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="?action=delete&id=<?= $s['id'] ?>" class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Xác nhận xóa bài hát này?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php else: ?>
            <!-- ADD/EDIT FORM -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><?= $action === 'edit' ? '✏️ Sửa bài hát' : '➕ Thêm bài hát mới' ?></h2>
                <a href="index.php" class="btn btn-outline-light">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>

            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="save_song" value="1">
                <?php if ($song): ?>
                    <input type="hidden" name="id" value="<?= $song['id'] ?>">
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">📝 Thông tin cơ bản</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tên bài hát *</label>
                                        <input type="text" name="title" class="form-control" required
                                               value="<?= e($song['title'] ?? '') ?>" placeholder="VD: Mưa Đang Bay">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Slug (URL)</label>
                                        <input type="text" name="slug" class="form-control"
                                               value="<?= e($song['slug'] ?? '') ?>" placeholder="Tự động tạo nếu để trống">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nghệ sĩ</label>
                                        <input type="text" name="artist" class="form-control"
                                               value="<?= e($song['artist'] ?? 'BSA') ?>" placeholder="VD: TeuYungBoy">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Ngày phát hành</label>
                                        <input type="date" name="release_date" class="form-control"
                                               value="<?= $song['release_date'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mô tả ngắn</label>
                                    <textarea name="description" class="form-control" rows="2"
                                              placeholder="Mô tả về bài hát..."><?= e($song['description'] ?? '') ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lyrics</label>
                                    <textarea name="lyrics" class="form-control" rows="8"
                                              placeholder="Nhập lyrics bài hát..."><?= e($song['lyrics'] ?? '') ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">🎵 Streaming Links</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><img src="<?= LOGO_SPOTIFY ?>" height="20" class="me-1"> Spotify</label>
                                        <input type="url" name="spotify_url" class="form-control"
                                               value="<?= e($song['spotify_url'] ?? '') ?>" placeholder="https://open.spotify.com/track/...">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><img src="<?= LOGO_APPLE_MUSIC ?>" height="20" class="me-1"> Apple Music</label>
                                        <input type="url" name="apple_music_url" class="form-control"
                                               value="<?= e($song['apple_music_url'] ?? '') ?>" placeholder="https://music.apple.com/...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><img src="<?= LOGO_YOUTUBE_MUSIC ?>" height="20" class="me-1"> YouTube Music</label>
                                        <input type="url" name="youtube_music_url" class="form-control"
                                               value="<?= e($song['youtube_music_url'] ?? '') ?>" placeholder="https://music.youtube.com/...">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><img src="<?= LOGO_YOUTUBE ?>" height="20" class="me-1"> YouTube</label>
                                        <input type="url" name="youtube_url" class="form-control"
                                               value="<?= e($song['youtube_url'] ?? '') ?>" placeholder="https://youtube.com/watch?v=...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><img src="<?= LOGO_AMAZON ?>" height="20" class="me-1"> Amazon Music</label>
                                        <input type="url" name="amazon_music_url" class="form-control"
                                               value="<?= e($song['amazon_music_url'] ?? '') ?>" placeholder="https://music.amazon.com/...">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><img src="<?= LOGO_TIDAL ?>" height="20" class="me-1"> Tidal</label>
                                        <input type="url" name="tidal_url" class="form-control"
                                               value="<?= e($song['tidal_url'] ?? '') ?>" placeholder="https://tidal.com/...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><img src="<?= LOGO_DEEZER ?>" height="20" class="me-1"> Deezer</label>
                                        <input type="url" name="deezer_url" class="form-control"
                                               value="<?= e($song['deezer_url'] ?? '') ?>" placeholder="https://deezer.com/...">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">🎧 NCT</label>
                                        <input type="url" name="nct_url" class="form-control"
                                               value="<?= e($song['nct_url'] ?? '') ?>" placeholder="https://nhaccuatui.com/...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">🎵 Zing MP3</label>
                                        <input type="url" name="zing_url" class="form-control"
                                               value="<?= e($song['zing_url'] ?? '') ?>" placeholder="https://zingmp3.vn/...">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">☁️ SoundCloud</label>
                                        <input type="url" name="soundcloud_url" class="form-control"
                                               value="<?= e($song['soundcloud_url'] ?? '') ?>" placeholder="https://soundcloud.com/...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header">🖼️ Media</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Tải lên Cover Image</label>
                                    <input type="file" name="cover_file" class="form-control" id="coverFile" 
                                           accept="image/jpeg,image/png,image/gif,image/webp">
                                    <div class="form-text">JPG, PNG, GIF, WebP - Max 5MB</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hoặc nhập URL</label>
                                    <input type="text" name="cover_image" class="form-control" id="coverInput"
                                           value="<?= e($song['cover_image'] ?? '') ?>" placeholder="images/songs/ten-bai.jpg">
                                </div>
                                <div id="coverPreview" class="mt-2">
                                    <?php if (!empty($song['cover_image'])): ?>
                                        <img src="../<?= e($song['cover_image']) ?>" class="img-fluid rounded" style="max-height: 200px;">
                                    <?php endif; ?>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">YouTube Video ID (embed)</label>
                                    <input type="text" name="youtube_video_id" class="form-control"
                                           value="<?= e($song['youtube_video_id'] ?? '') ?>" placeholder="dQw4w9WgXcQ">
                                    <div class="form-text">ID video để embed trên trang bài hát</div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">⚙️ Cài đặt</div>
                            <div class="card-body">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive"
                                           <?= ($song['is_active'] ?? 1) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="isActive">Hiển thị bài hát</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> 
                                <?= $song ? 'Cập nhật' : 'Tạo bài hát' ?>
                            </button>
                            <a href="index.php" class="btn btn-outline-secondary">Hủy</a>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview cover image from URL
        document.getElementById('coverInput')?.addEventListener('input', function() {
            const preview = document.getElementById('coverPreview');
            if (this.value) {
                let src = this.value;
                if (!src.startsWith('http')) src = '../' + src;
                preview.innerHTML = `<img src="${src}" class="img-fluid rounded" style="max-height: 200px;" onerror="this.style.display='none'">`;
            } else {
                preview.innerHTML = '';
            }
        });
        
        // Preview cover image from file upload
        document.getElementById('coverFile')?.addEventListener('change', function(e) {
            const preview = document.getElementById('coverPreview');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">`;
                    // Clear URL input when file is selected
                    document.getElementById('coverInput').value = '';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
