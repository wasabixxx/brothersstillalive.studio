<?php
/**
 * Brothers Still Alive - Home/About Page
 * Website: brothersstillalive.studio
 */

// Configuration
$site_name = "Brothers Still Alive";
$site_description = "Brothers Still Alive (BSA) - Rap Label từ Việt Nam. Khám phá câu chuyện, nghệ sĩ và âm nhạc của chúng tôi.";
$base_url = "https://brothersstillalive.studio";

// Include header
include 'includes/header.php';
?>

<!-- Intro Splash Section -->
<section class="aboutIntroSplash">
    <div class="aboutIntroImage">
        <!-- Placeholder - replace with actual image later -->
        <div class="aboutIntroImageContent" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); width: 100%; height: 100%;"></div>
    </div>

    <div class="aboutIntroText">
        <!-- Logo SVG - Replace with actual BSA logo -->
        <svg class="aboutIntroLogo" overflow="visible" viewBox="0 0 600 120">
            <text x="50%" y="60" dominant-baseline="middle" text-anchor="middle" fill="currentColor" font-family="Inter" font-weight="800" font-size="80">BSA</text>
            <text x="85%" y="60" dominant-baseline="middle" text-anchor="middle" fill="#d4003a" font-family="Inter" font-weight="800" font-size="80">+</text>
        </svg>
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

<!-- About Paragraph Section 1 -->
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
        <!-- Placeholder images - replace with actual images later -->
        <li data-fade="2" class="aboutSlideItem">
            <div class="aboutSlideImage" style="background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);"></div>
        </li>
        <li data-fade="2" class="aboutSlideItem">
            <div class="aboutSlideImage" style="background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);"></div>
        </li>
        <li data-fade="2" class="aboutSlideItem">
            <div class="aboutSlideImage" style="background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);"></div>
        </li>
        <li data-fade="2" class="aboutSlideItem">
            <div class="aboutSlideImage" style="background: linear-gradient(45deg, #43e97b 0%, #38f9d7 100%);"></div>
        </li>
        <li data-fade="2" class="aboutSlideItem">
            <div class="aboutSlideImage" style="background: linear-gradient(45deg, #fa709a 0%, #fee140 100%);"></div>
        </li>
    </ul>

    <!-- Background Logo -->
    <svg class="aboutSlideSVG" viewBox="0 0 600 120">
        <text x="50%" y="80" dominant-baseline="middle" text-anchor="middle" fill="currentColor" font-family="Inter" font-weight="800" font-size="100">BSA+</text>
    </svg>
</section>

<!-- About Paragraph Section 2 -->
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
    <!-- Artist names will loop - replace with actual artist names -->
    <div class="artistLine artistLineOdd">
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 1</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 2</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 3</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 4</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 1</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 2</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 3</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 4</a>
    </div>
    <div class="artistLine artistLineEven">
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 1</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 2</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 3</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 4</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 1</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 2</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 3</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 4</a>
    </div>
    <div class="artistLine artistLineOdd">
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 1</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 2</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 3</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 4</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 1</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 2</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 3</a>
        <p>+</p>
        <a data-cursor="plus" class="artistLineItem link" href="#">Artist 4</a>
    </div>
</section>

<!-- About Paragraph Section 3 -->
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

<!-- Contact Section -->
<section class="homeContact sectionAnimate">
    <h2 data-fade="1" class="textRed textExtraBold"><b>Contact Us</b></h2>
    <div class="homeAddress">
        <p data-fade="1"><strong>Phone:</strong> (+84) xxx xxx xxx</p>
        <p data-fade="1"><strong>Email:</strong> <a href="mailto:contact@brothersstillalive.studio">contact@brothersstillalive.studio</a></p>
        <p data-fade="1"><strong>Location:</strong> Việt Nam</p>
    </div>
    <div class="homeSocial">
        <h3 data-fade="2" class="h5">Follow Us:</h3>
        <ul class="flex homeSocialList">
            <li data-cursor="icon" data-fade="2">
                <a class="linkIcon" href="#" target="_blank" rel="noopener">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li data-cursor="icon" data-fade="2">
                <a class="linkIcon" href="#" target="_blank" rel="noopener">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
            <li data-cursor="icon" data-fade="2">
                <a class="linkIcon" href="#" target="_blank" rel="noopener">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
            <li data-cursor="icon" data-fade="2">
                <a class="linkIcon" href="#" target="_blank" rel="noopener">
                    <i class="fab fa-soundcloud"></i>
                </a>
            </li>
            <li data-cursor="icon" data-fade="2">
                <a class="linkIcon" href="#" target="_blank" rel="noopener">
                    <i class="fab fa-spotify"></i>
                </a>
            </li>
            <li data-cursor="icon" data-fade="2">
                <a class="linkIcon" href="#" target="_blank" rel="noopener">
                    <i class="fab fa-tiktok"></i>
                </a>
            </li>
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
            <button data-cursor="min" type="submit" class="buttonSolid">
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

<?php include 'includes/footer.php'; ?>
