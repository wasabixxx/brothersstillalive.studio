# GitHub Copilot Instructions - Brothers Still Alive Studio

## Tổng quan dự án

Đây là website chính thức của **Brothers Still Alive** - một rap label/nhóm nhạc rap Việt Nam.

- **Domain**: brothersstillalive.studio
- **Framework**: Laravel 10.x
- **Frontend**: Blade templates + Vite (CSS/JS)

## Cấu trúc trang

### Trang chủ (/)
- Trang giới thiệu (About) về nhóm Brothers Still Alive
- Thông tin về các thành viên
- Lịch sử hình thành và phát triển
- Liên hệ và social media links

### Trang bài hát (/{slug})
- Mỗi bài hát có một slug riêng
- Ví dụ: `brothersstillalive.studio/baithunhat`
- Hiển thị thông tin bài hát: tên, nghệ sĩ, lyrics, link streaming platforms

## Quy ước đặt tên

### Database
- Bảng songs: lưu thông tin bài hát
  - `id`, `title`, `slug`, `artist`, `lyrics`, `release_date`, `cover_image`
  - `spotify_url`, `apple_music_url`, `youtube_url`, `soundcloud_url`
  - `created_at`, `updated_at`

### Routes
```php
// routes/web.php
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{slug}', [SongController::class, 'show'])->name('song.show');
```

### Controllers
- `HomeController` - Xử lý trang chủ/about
- `SongController` - Xử lý hiển thị bài hát theo slug

### Models
- `Song` - Model cho bài hát với slug unique

### Views
- `resources/views/home.blade.php` - Trang chủ about
- `resources/views/song.blade.php` - Trang chi tiết bài hát
- `resources/views/layouts/app.blade.php` - Layout chính

## Ngôn ngữ

- Code: Tiếng Anh
- Nội dung/Comments có thể dùng tiếng Việt
- UI/Content hiển thị: Tiếng Việt

## Style Guidelines

### PHP/Laravel
- Sử dụng PSR-12 coding standard
- Sử dụng type hints cho parameters và return types
- Controllers nên thin, logic phức tạp đặt trong Services/Actions
- Sử dụng Form Requests cho validation

### Frontend
- Mobile-first responsive design
- Dark theme phù hợp với aesthetic của rap/hip-hop
- Sử dụng Tailwind CSS (nếu cài đặt) hoặc custom CSS

### SEO
- Mỗi trang bài hát cần có meta tags riêng
- Open Graph tags cho chia sẻ social media
- Structured data cho bài hát (Schema.org MusicRecording)

## Các tính năng cần phát triển

1. **Phase 1 - MVP**
   - [ ] Trang chủ about
   - [ ] Model Song với migration
   - [ ] Trang hiển thị bài hát theo slug
   - [ ] Admin panel đơn giản để thêm bài hát

2. **Phase 2 - Enhancement**
   - [ ] Tích hợp Spotify/Apple Music embed player
   - [ ] Trang danh sách tất cả bài hát
   - [ ] Tìm kiếm bài hát
   - [ ] Filter theo nghệ sĩ

3. **Phase 3 - Advanced**
   - [ ] Quản lý albums
   - [ ] Trang profile từng nghệ sĩ
   - [ ] Events/Shows calendar
   - [ ] Merchandise store integration

## Commands thường dùng

```bash
# Chạy development server
php artisan serve

# Chạy Vite dev
npm run dev

# Tạo migration
php artisan make:migration create_songs_table

# Tạo model với migration, factory, seeder, controller
php artisan make:model Song -mfsc

# Chạy migration
php artisan migrate

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Lưu ý quan trọng

1. **Slug phải unique** - Kiểm tra trùng lặp trước khi tạo
2. **Route /{slug} đặt cuối cùng** - Để tránh conflict với các route khác
3. **Fallback 404** - Xử lý khi slug không tồn tại
4. **Image optimization** - Cover art cần được optimize trước khi upload
