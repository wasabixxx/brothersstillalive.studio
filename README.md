# Brothers Still Alive - Official Website

 **BSA+** - Rap Label Vi?t Nam

Website: [brothersstillalive.studio](https://brothersstillalive.studio)

## Gi?i thi?u

Website chính th?c c?a **Brothers Still Alive** - m?t rap label/nhóm nh?c rap Vi?t Nam. Website du?c xây d?ng b?ng **PHP thu?n** d? d?m b?o tuong thích v?i m?i hosting.

## C?u trúc thu m?c

```
brothersstillalive.studio/
 css/
    styles.css          # Stylesheet chính
 js/
    scripts.js          # JavaScript chính
 images/
    songs/              # Cover art bài hát
    og-image.jpg        # ?nh cho social sharing
 includes/
    header.php          # Header template
    footer.php          # Footer template
 .htaccess               # Apache URL rewriting
 index.php               # Trang ch? (About)
 song.php                # Template trang bài hát
 README.md
```

## Tính nang

-  Trang About gi?i thi?u nhóm
-  Trang bài hát v?i URL d?p (`/ten-bai-hat`)
-  Dark theme aesthetic
-  Responsive design (mobile-first)
-  Custom cursor effects
-  GSAP scroll animations
-  SEO optimized v?i meta tags & structured data
-  Social sharing links

## URL Structure

| URL | Mô t? |
|-----|-------|
| `/` | Trang ch? (About) |
| `/{slug}` | Trang bài hát (VD: `/baithunhat`) |

## Cài d?t

1. Upload toàn b? files lên hosting
2. Ð?m b?o `mod_rewrite` du?c b?t trên Apache
3. Thêm bài hát vào array `$songs` trong `song.php`
4. Thêm cover images vào `images/songs/`

## Thêm bài hát m?i

M? file `song.php` và thêm vào array `$songs`:

```php
$songs = [
    'ten-bai-hat' => [
        'title' => 'Tên Bài Hát',
        'artist' => 'Tên Ngh? Si',
        'release_date' => '2024-01-15',
        'cover_image' => 'images/songs/ten-bai-hat.jpg',
        'description' => 'Mô t? bài hát...',
        'lyrics' => "Lyrics bài hát...",
        'spotify_url' => 'https://open.spotify.com/track/xxx',
        'apple_music_url' => 'https://music.apple.com/xxx',
        'youtube_url' => 'https://youtube.com/watch?v=xxx',
        'soundcloud_url' => 'https://soundcloud.com/xxx'
    ],
    // ... thêm bài hát khác
];
```

## Yêu c?u hosting

- PHP 7.4+
- Apache v?i mod_rewrite
- Không c?n database (d? li?u hardcoded)

## Phát tri?n trong tuong lai

- [ ] Tích h?p database (MySQL/SQLite)
- [ ] Admin panel d? qu?n lý bài hát
- [ ] Trang danh sách t?t c? bài hát
- [ ] Trang profile ngh? si
- [ ] Newsletter subscription
- [ ] Events calendar

## Credits

- Design inspiration: Modern hip-hop aesthetics
- Animations: GSAP (GreenSock)
- Icons: Font Awesome
- Fonts: Inter (Google Fonts)

---

Made with  by **Brothers Still Alive**
