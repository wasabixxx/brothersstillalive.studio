<?php
/**
 * Brothers Still Alive - Home/About Page
 * Clone từ CDSL.vn với cấu trúc tương tự
 */

require_once __DIR__ . '/core/bootstrap.php';

$page_title = 'About';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_title) ?> | <?= SITE_NAME ?></title>
    <meta name="description" content="<?= e(SITE_DESCRIPTION) ?>">
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= SITE_URL ?>">
    <meta property="og:title" content="<?= SITE_NAME ?>">
    <meta property="og:description" content="<?= e(SITE_DESCRIPTION) ?>">
    <meta property="og:image" content="https://placehold.co/1200x630/1a1a1a/ffffff?text=BSA+STUDIO">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/main.css">
</head>
<body>
    <!-- Darkmode check -->
    <script>
        if (localStorage.getItem('darkmode') === 'on') {
            document.body.classList.add('dark-theme');
        }
    </script>

    <!-- Header -->
    <header>
        <!-- Mobile Nav Button -->
        <nav class="navMobile">
            <button class="navMobileButton">
                <svg class="burger" overflow="visible" viewBox="0 0 100 100">
                    <rect class="bar barTop" width="100" height="23.3" />
                    <rect class="bar barMid1" y="41" width="100" height="23.3" />
                    <rect class="bar barMid2" y="41" width="100" height="23.3" />
                    <rect class="bar barBot" y="82" width="64" height="23.3" />
                </svg>
            </button>
            
            <div class="navMobileContent">
                <ul>
                    <li><a class="linkNav" href="/">
                        <img src="<?= LOGO_BSA ?>" alt="BSA" style="height: 40px; filter: brightness(0) invert(1);">
                    </a></li>
                    <li><a class="linkNav active" href="/">About</a></li>
                    <li><a class="linkNav" href="#">Music</a></li>
                    <li><a class="linkNav" href="#">Artists</a></li>
                    <li><a class="linkNav" href="#">Contact</a></li>
                </ul>
            </div>
        </nav>

        <!-- Desktop Nav -->
        <nav class="navDesktop">
            <div class="navLogo">
                <a href="/">
                    <img src="<?= LOGO_BSA ?>" alt="BSA Logo" style="height: 60px; filter: brightness(0) invert(1);">
                </a>
            </div>
            <ul>
                <li><a class="linkNav active" href="/">About</a></li>
                <li><a class="linkNav" href="#">Music</a></li>
                <li><a class="linkNav" href="#">Artists</a></li>
                <li><a class="linkNav" href="#">Contact</a></li>
            </ul>
            <div class="navUiWrapper">
                <button class="navUiItem lightToggle">
                    <svg class="navUiSVG" overflow="visible" viewBox="0 0 50 50">
                        <g class="lightMode">
                            <circle cx="24.1" cy="25" r="9.4"/>
                            <polygon points="36.3,22.9 36.3,27 39.8,24.9"/>
                            <polygon points="33.5,17.1 35.6,20.6 37.7,17.1"/>
                            <polygon points="28.3,13.4 31.9,15.5 31.9,11.4"/>
                            <polygon points="21.9,12.9 26.1,12.9 24,9.3"/>
                            <polygon points="16.1,15.6 19.7,13.5 16.2,11.5"/>
                            <polygon points="12.5,20.8 14.6,17.3 10.4,17.3"/>
                            <polygon points="12,27.2 12,23.1 8.4,25.1"/>
                            <polygon points="14.7,33 12.6,29.4 10.6,33"/>
                            <polygon points="19.9,36.6 16.3,34.6 16.3,38.7"/>
                            <polygon points="26.3,37.2 22.2,37.2 24.2,40.7"/>
                            <polygon points="32.1,34.5 28.5,36.5 32.1,38.6"/>
                            <polygon points="35.7,29.2 33.7,32.8 37.8,32.8"/>
                        </g>
                        <path class="darkMode" d="M32.6 35c.5 0 1 0 1.5-.1-2.1 1.6-4.7 2.5-7.5 2.5-6.8 0-12.4-5.5-12.4-12.4s5.5-12.4 12.4-12.4c2.8 0 5.4.9 7.5 2.5-.5-.1-1-.1-1.5-.1-5.5 0-10 4.5-10 10s4.5 10 10 10z"/>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <main>
        <!-- Intro Splash Section -->
        <section class="aboutIntroSplash">
            <div class="aboutIntroImage">
                <img class="aboutIntroImageContent" src="https://placehold.co/1920x1080/1a1a2e/ffffff?text=BSA+STUDIO" alt="BSA Studio">
            </div>
            <div class="aboutIntroText">
                <img src="<?= LOGO_BSA ?>" alt="BSA Logo" class="aboutIntroLogo" style="height: 80px; filter: brightness(0) invert(1);">
                <h1 class="aboutIntroTitle allCaps">Our Story</h1>
            </div>
        </section>

        <!-- Scroll Indicator -->
        <div class="scrollIndicator">
            <p>Scroll
                <svg class="scrollSVG" viewBox="0 0 33 15">
                    <rect y="6.39545" width="31.7181" height="1.92231" rx="0.961156" />
                    <rect x="25.9062" y="0.367493" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(45 25.9062 0.367493)" />
                    <rect x="33" y="7.47278" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(135 33 7.47278)" />
                </svg>
            </p>
        </div>
        <div class="scrollMarker"></div>

        <!-- About Paragraph 1 -->
        <section class="aboutParagraph sectionAnimate">
            <p data-fade="1">
                <strong>Brothers Still Alive</strong> không chỉ là một rap label - đó là một gia đình, một phong trào, 
                một tiếng nói của thế hệ trẻ Việt Nam. Được thành lập bởi những người anh em cùng chung đam mê với 
                Hip-hop và văn hóa đường phố, BSA ra đời với sứ mệnh mang âm nhạc underground đến gần hơn với công chúng.
            </p>
        </section>

        <!-- Image Slide Section -->
        <section class="aboutSlide">
            <ul class="aboutSlideList">
                <li data-fade="2" class="aboutSlideItem">
                    <img src="https://placehold.co/400x500/667eea/ffffff?text=Studio" alt="Studio" class="aboutSlideImage">
                </li>
                <li data-fade="2" class="aboutSlideItem">
                    <img src="https://placehold.co/400x500/f5576c/ffffff?text=Recording" alt="Recording" class="aboutSlideImage">
                </li>
                <li data-fade="2" class="aboutSlideItem">
                    <img src="https://placehold.co/400x500/4facfe/ffffff?text=Artists" alt="Artists" class="aboutSlideImage">
                </li>
                <li data-fade="2" class="aboutSlideItem">
                    <img src="https://placehold.co/400x500/43e97b/ffffff?text=Live+Show" alt="Live Show" class="aboutSlideImage">
                </li>
                <li data-fade="2" class="aboutSlideItem">
                    <img src="https://placehold.co/400x500/fa709a/ffffff?text=Community" alt="Community" class="aboutSlideImage">
                </li>
            </ul>
            <svg class="aboutSlideSVG" viewBox="0 0 600 120">
                <text x="50%" y="80" dominant-baseline="middle" text-anchor="middle" fill="currentColor" font-family="Inter" font-weight="800" font-size="100">BSA+</text>
            </svg>
        </section>

        <!-- About Paragraph 2 -->
        <section class="aboutParagraph sectionAnimate">
            <p data-fade="1">
                Từ những buổi jam session đầu tiên trong garage nhỏ, chúng tôi đã lớn lên cùng nhau, 
                chia sẻ những giấc mơ, những thất bại và thành công. Mỗi bản beat, mỗi câu verse đều 
                mang trong mình câu chuyện thật - về cuộc sống, về tình yêu, về những đấu tranh hàng ngày 
                của người trẻ Việt Nam.
            </p>
        </section>

        <!-- Artist Loop Section -->
        <section class="aboutArtistLoop">
            <div class="artistLine artistLineOdd">
                <a class="artistLineItem link" href="#">TeuYungBoy</a><p>+</p>
                <a class="artistLineItem link" href="#">VSTRA</a><p>+</p>
                <a class="artistLineItem link" href="#">Artist 3</a><p>+</p>
                <a class="artistLineItem link" href="#">Artist 4</a><p>+</p>
                <a class="artistLineItem link" href="#">TeuYungBoy</a><p>+</p>
                <a class="artistLineItem link" href="#">VSTRA</a>
            </div>
            <div class="artistLine artistLineEven">
                <a class="artistLineItem link" href="#">Artist 3</a><p>+</p>
                <a class="artistLineItem link" href="#">Artist 4</a><p>+</p>
                <a class="artistLineItem link" href="#">TeuYungBoy</a><p>+</p>
                <a class="artistLineItem link" href="#">VSTRA</a><p>+</p>
                <a class="artistLineItem link" href="#">Artist 3</a><p>+</p>
                <a class="artistLineItem link" href="#">Artist 4</a>
            </div>
            <div class="artistLine artistLineOdd">
                <a class="artistLineItem link" href="#">TeuYungBoy</a><p>+</p>
                <a class="artistLineItem link" href="#">VSTRA</a><p>+</p>
                <a class="artistLineItem link" href="#">Artist 3</a><p>+</p>
                <a class="artistLineItem link" href="#">Artist 4</a><p>+</p>
                <a class="artistLineItem link" href="#">TeuYungBoy</a><p>+</p>
                <a class="artistLineItem link" href="#">VSTRA</a>
            </div>
            <div class="artistLine artistLineEven">
                <a class="artistLineItem link" href="#">Artist 3</a><p>+</p>
                <a class="artistLineItem link" href="#">Artist 4</a><p>+</p>
                <a class="artistLineItem link" href="#">TeuYungBoy</a><p>+</p>
                <a class="artistLineItem link" href="#">VSTRA</a><p>+</p>
                <a class="artistLineItem link" href="#">Artist 3</a><p>+</p>
                <a class="artistLineItem link" href="#">Artist 4</a>
            </div>
        </section>

        <!-- About Paragraph 3 -->
        <section class="aboutParagraph sectionAnimate">
            <p data-fade="1">
                BSA+ không chỉ là âm nhạc - đó là cộng đồng. Chúng tôi tin rằng mỗi người đều có một 
                câu chuyện đáng được kể, và Hip-hop là ngôn ngữ để kể những câu chuyện đó. Dù bạn là 
                ai, đến từ đâu, BSA luôn chào đón bạn.
            </p>
        </section>

        <!-- Achievement Section -->
        <section class="aboutAchievement sectionAnimate">
            <h2 data-fade="1">Achievements</h2>
            <div data-fade="2">
                <p>
                    🏆 Đạt Top 40 YouTube Trending với single đầu tay
                    <br><br>
                    🎵 Tổng lượt stream vượt 1,000,000+ trên các nền tảng
                    <br><br>
                    📀 Release thành công 10+ singles và EPs
                    <br><br>
                    🎤 Tổ chức 20+ live shows và events
                    <br><br>
                    🤝 Collab với các nghệ sĩ hàng đầu Việt Nam
                    <br><br>
                    ❤️ Xây dựng cộng đồng fan 50,000+ members
                </p>
            </div>
        </section>

        <!-- News Section -->
        <section class="homeNews sectionAnimate">
            <h2 data-fade="1" class="mb20 homeNewsText">OUR LATEST <span class="textRed textExtraBold">NEWS+</span></h2>
            <div class="newsSlide swiper">
                <ul class="swiper-wrapper">
                    <li data-fade="2" class="swiper-slide newsCard">
                        <div class="newsImage">
                            <a href="#">
                                <img src="https://placehold.co/600x600/d4003a/ffffff?text=News+1" alt="News 1">
                            </a>
                        </div>
                        <div class="newsInfo">
                            <h3 class="h4 textSemiBold">BSA ra mắt single mới "Still Alive"</h3>
                            <p>Sau một năm chuẩn bị, BSA chính thức comeback với single mới...</p>
                            <div class="newsAction">
                                <p>25 / 12 / 2025</p>
                                <a class="buttonOutlineRound" href="#">
                                    <svg viewBox="0 0 33 15">
                                        <rect y="6.39545" width="31.7181" height="1.92231" rx="0.961156" />
                                        <rect x="25.9062" y="0.367493" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(45 25.9062 0.367493)" />
                                        <rect x="33" y="7.47278" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(135 33 7.47278)" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li data-fade="2" class="swiper-slide newsCard">
                        <div class="newsImage">
                            <a href="#">
                                <img src="https://placehold.co/600x600/667eea/ffffff?text=News+2" alt="News 2">
                            </a>
                        </div>
                        <div class="newsInfo">
                            <h3 class="h4 textSemiBold">TeuYungBoy công bố album đầu tay</h3>
                            <p>Nam rapper TeuYungBoy chính thức announce album debut...</p>
                            <div class="newsAction">
                                <p>20 / 12 / 2025</p>
                                <a class="buttonOutlineRound" href="#">
                                    <svg viewBox="0 0 33 15">
                                        <rect y="6.39545" width="31.7181" height="1.92231" rx="0.961156" />
                                        <rect x="25.9062" y="0.367493" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(45 25.9062 0.367493)" />
                                        <rect x="33" y="7.47278" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(135 33 7.47278)" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li data-fade="2" class="swiper-slide newsCard">
                        <div class="newsImage">
                            <a href="#">
                                <img src="https://placehold.co/600x600/43e97b/ffffff?text=News+3" alt="News 3">
                            </a>
                        </div>
                        <div class="newsInfo">
                            <h3 class="h4 textSemiBold">BSA Live Show 2025</h3>
                            <p>Đêm nhạc đặc biệt kỷ niệm 5 năm thành lập BSA...</p>
                            <div class="newsAction">
                                <p>15 / 12 / 2025</p>
                                <a class="buttonOutlineRound" href="#">
                                    <svg viewBox="0 0 33 15">
                                        <rect y="6.39545" width="31.7181" height="1.92231" rx="0.961156" />
                                        <rect x="25.9062" y="0.367493" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(45 25.9062 0.367493)" />
                                        <rect x="33" y="7.47278" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(135 33 7.47278)" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li data-fade="2" class="swiper-slide newsCard">
                        <div class="newsImage">
                            <a href="#">
                                <img src="https://placehold.co/600x600/f5576c/ffffff?text=News+4" alt="News 4">
                            </a>
                        </div>
                        <div class="newsInfo">
                            <h3 class="h4 textSemiBold">Collab đặc biệt với nghệ sĩ quốc tế</h3>
                            <p>BSA hé lộ dự án collab với nghệ sĩ từ Hàn Quốc...</p>
                            <div class="newsAction">
                                <p>10 / 12 / 2025</p>
                                <a class="buttonOutlineRound" href="#">
                                    <svg viewBox="0 0 33 15">
                                        <rect y="6.39545" width="31.7181" height="1.92231" rx="0.961156" />
                                        <rect x="25.9062" y="0.367493" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(45 25.9062 0.367493)" />
                                        <rect x="33" y="7.47278" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(135 33 7.47278)" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="homeContact sectionAnimate">
            <h2 data-fade="1" class="textRed textExtraBold"><b>Contact Us</b></h2>
            <div class="homeAddress">
                <p data-fade="1">(+84) xxx xxx xxx</p>
                <p data-fade="1"><a href="mailto:contact@brothersstillalive.studio">contact@brothersstillalive.studio</a></p>
                <p data-fade="1">Việt Nam</p>
            </div>
            <div class="homeSocial">
                <h3 data-fade="2" class="h5">social media:</h3>
                <ul class="flex homeSocialList">
                    <li data-fade="2"><a class="linkIcon" href="#" target="_blank"><i class="fab fa-facebook"></i></a></li>
                    <li data-fade="2"><a class="linkIcon" href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li data-fade="2"><a class="linkIcon" href="#" target="_blank"><i class="fab fa-youtube"></i></a></li>
                    <li data-fade="2"><a class="linkIcon" href="#" target="_blank"><i class="fab fa-soundcloud"></i></a></li>
                    <li data-fade="2"><a class="linkIcon" href="#" target="_blank"><i class="fab fa-spotify"></i></a></li>
                    <li data-fade="2"><a class="linkIcon" href="#" target="_blank"><i class="fab fa-tiktok"></i></a></li>
                </ul>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="newsletter sectionAnimate">
            <h2 data-fade="1">Join the <span>Movement</span></h2>
            <div class="formContent">
                <p data-fade="1">Đăng ký để nhận thông tin mới nhất về releases, events và exclusive content từ BSA+</p>
                <form action="#" method="post">
                    <div data-fade="2" class="formInput">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="youremail@mail.com" required>
                    </div>
                    <button type="submit" class="buttonSolid">
                        Subscribe
                        <svg viewBox="0 0 33 15">
                            <rect y="6.39545" width="31.7181" height="1.92231" rx="0.961156" />
                            <rect x="25.9062" y="0.367493" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(45 25.9062 0.367493)" />
                            <rect x="33" y="7.47278" width="10.0321" height="2.28002" rx="1.14001" transform="rotate(135 33 7.47278)" />
                        </svg>
                    </button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="siteFooter">
        <div>
            <p>&copy; <?= date('Y') ?> Brothers Still Alive. All rights reserved.</p>
            <a class="link backToTop" href="#">Back to Top</a>
            <p>Made with ❤️ in Vietnam</p>
        </div>
    </footer>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?= SITE_URL ?>/assets/js/main.js"></script>
    
    <script>
        // Initialize Swiper
        const newsSwiper = new Swiper('.newsSlide', {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                },
            },
        });
        
        // Dark mode toggle
        document.querySelectorAll('.lightToggle').forEach(btn => {
            btn.addEventListener('click', function() {
                document.body.classList.toggle('dark-theme');
                localStorage.setItem('darkmode', document.body.classList.contains('dark-theme') ? 'on' : 'off');
            });
        });
        
        // Mobile menu toggle
        document.querySelector('.navMobileButton')?.addEventListener('click', function() {
            document.querySelector('.navMobile').classList.toggle('open');
        });
        
        // Scroll to top
        document.querySelector('.backToTop')?.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
