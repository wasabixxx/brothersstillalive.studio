<?php
/**
 * Brothers Still Alive - Header Include
 * Common header for all pages
 * 
 * Variables expected:
 * - $page_title (optional) - Page specific title
 */

// Ensure bootstrap is loaded
if (!defined('BSA_ROOT')) {
    require_once dirname(__DIR__) . '/core/bootstrap.php';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- SEO Meta Tags -->
    <title><?= isset($page_title) ? e($page_title) . ' | ' . SITE_NAME : SITE_NAME ?></title>
    <meta name="description" content="<?= e(SITE_DESCRIPTION) ?>">
    <meta name="keywords" content="Brothers Still Alive, BSA, rap, hip hop, Việt Nam, underground, music, nhạc rap">
    <meta name="author" content="Brothers Still Alive">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= SITE_URL ?>">
    <meta property="og:title" content="<?= isset($page_title) ? e($page_title) . ' | ' . SITE_NAME : SITE_NAME ?>">
    <meta property="og:description" content="<?= e(SITE_DESCRIPTION) ?>">
    <meta property="og:image" content="<?= SITE_URL ?>/assets/images/og-image.jpg">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?= SITE_URL ?>">
    <meta name="twitter:title" content="<?= isset($page_title) ? e($page_title) . ' | ' . SITE_NAME : SITE_NAME ?>">
    <meta name="twitter:description" content="<?= e(SITE_DESCRIPTION) ?>">
    <meta name="twitter:image" content="<?= SITE_URL ?>/assets/images/og-image.jpg">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= SITE_URL ?>/favicon.ico">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- GSAP for animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/main.css">
</head>
<body>
    <!-- Custom Cursor -->
    <div id="cursor" class="cursor"></div>
    <div id="cursorFollower" class="cursor-follower"></div>
    
    <!-- Header Navigation -->
    <header id="header" class="header">
        <nav class="nav container">
            <!-- Logo -->
            <a href="/" class="navLogo" data-cursor="plus">
                <span class="logoText">BSA<span class="textRed">+</span></span>
            </a>
            
            <!-- Desktop Navigation -->
            <ul class="navMenu">
                <li class="navItem">
                    <a href="/" class="navLink active" data-cursor="min">About</a>
                </li>
                <li class="navItem">
                    <a href="#" class="navLink" data-cursor="min">Music</a>
                </li>
                <li class="navItem">
                    <a href="#" class="navLink" data-cursor="min">Artists</a>
                </li>
                <li class="navItem">
                    <a href="#" class="navLink" data-cursor="min">Contact</a>
                </li>
            </ul>
            
            <!-- Dark Mode Toggle -->
            <button id="darkModeToggle" class="darkModeToggle" data-cursor="icon" aria-label="Toggle dark mode">
                <i class="fas fa-moon"></i>
            </button>
            
            <!-- Mobile Menu Toggle -->
            <button id="navToggle" class="navToggle" data-cursor="icon" aria-label="Toggle menu">
                <span class="navToggleLine"></span>
                <span class="navToggleLine"></span>
                <span class="navToggleLine"></span>
            </button>
        </nav>
        
        <!-- Mobile Navigation Overlay -->
        <div id="mobileNav" class="mobileNav">
            <ul class="mobileNavMenu">
                <li class="mobileNavItem">
                    <a href="/" class="mobileNavLink" data-cursor="plus">About</a>
                </li>
                <li class="mobileNavItem">
                    <a href="#" class="mobileNavLink" data-cursor="plus">Music</a>
                </li>
                <li class="mobileNavItem">
                    <a href="#" class="mobileNavLink" data-cursor="plus">Artists</a>
                </li>
                <li class="mobileNavItem">
                    <a href="#" class="mobileNavLink" data-cursor="plus">Contact</a>
                </li>
            </ul>
            
            <!-- Mobile Social Links -->
            <div class="mobileNavSocial">
                <a href="#" target="_blank" rel="noopener" data-cursor="icon"><i class="fab fa-facebook"></i></a>
                <a href="#" target="_blank" rel="noopener" data-cursor="icon"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank" rel="noopener" data-cursor="icon"><i class="fab fa-youtube"></i></a>
                <a href="#" target="_blank" rel="noopener" data-cursor="icon"><i class="fab fa-spotify"></i></a>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main id="main" class="main">
