/**
 * Brothers Still Alive - Main Scripts
 */

// Cookie helpers
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

// DOM Ready
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize GSAP if available
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
        initAnimations();
    }
    
    // Mobile menu toggle
    initMobileMenu();
    
    // Dark mode toggle
    initDarkMode();
    
    // Custom cursor
    initCustomCursor();
    
    // Section animations
    initSectionAnimations();
    
    // Smooth scroll for anchor links
    initSmoothScroll();
});

/**
 * Initialize mobile menu
 */
function initMobileMenu() {
    const menuButton = document.querySelector('.navMobileButton');
    const menuContent = document.querySelector('.navMobileContent');
    
    if (menuButton && menuContent) {
        menuButton.addEventListener('click', function() {
            menuContent.classList.toggle('openMenu');
            menuButton.classList.toggle('closeBurger');
        });
        
        // Close menu when clicking on a link
        const menuLinks = menuContent.querySelectorAll('.linkNav');
        menuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                menuContent.classList.remove('openMenu');
                menuButton.classList.remove('closeBurger');
            });
        });
    }
}

/**
 * Initialize dark mode toggle
 */
function initDarkMode() {
    const lightToggles = document.querySelectorAll('.lightToggle');
    
    // Check for saved preference
    if (getCookie('darkmode') === 'off') {
        document.body.classList.remove('dark-theme');
    } else {
        document.body.classList.add('dark-theme');
    }
    
    lightToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-theme');
            
            if (document.body.classList.contains('dark-theme')) {
                setCookie('darkmode', 'on', 365);
            } else {
                setCookie('darkmode', 'off', 365);
            }
        });
    });
}

/**
 * Initialize custom cursor
 */
function initCustomCursor() {
    const cursor = document.querySelector('.customCursor');
    
    if (!cursor || window.innerWidth < 992) return;
    
    document.addEventListener('mousemove', function(e) {
        cursor.style.transform = `translate(${e.clientX}px, ${e.clientY}px)`;
    });
    
    // Cursor hover effects
    const hoverElements = {
        'plus': document.querySelectorAll('[data-cursor="plus"]'),
        'arrow': document.querySelectorAll('[data-cursor="arrow"]'),
        'min': document.querySelectorAll('[data-cursor="min"]'),
        'icon': document.querySelectorAll('[data-cursor="icon"]'),
        'slider': document.querySelectorAll('[data-cursor="slider"]')
    };
    
    Object.keys(hoverElements).forEach(function(type) {
        hoverElements[type].forEach(function(el) {
            el.addEventListener('mouseenter', function() {
                cursor.classList.add(type);
            });
            el.addEventListener('mouseleave', function() {
                cursor.classList.remove(type);
            });
        });
    });
}

/**
 * Initialize GSAP animations
 */
function initAnimations() {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
    
    // Section animations
    const sections = document.querySelectorAll('.sectionAnimate');
    
    sections.forEach(function(section) {
        const fade1Elements = section.querySelectorAll('[data-fade="1"]');
        const fade2Elements = section.querySelectorAll('[data-fade="2"]');
        
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top 90%",
                once: true
            }
        });
        
        // Animate the section itself
        tl.from(section, {
            y: 40,
            opacity: 0,
            duration: 0.45
        }, "start");
        
        // Animate fade1 elements
        if (fade1Elements.length > 0) {
            tl.from(fade1Elements, {
                y: 40,
                opacity: 0,
                duration: 0.45,
                stagger: 0.15
            }, "start");
        }
        
        // Animate fade2 elements with delay
        if (fade2Elements.length > 0) {
            tl.from(fade2Elements, {
                y: 40,
                opacity: 0,
                duration: 0.45,
                stagger: 0.15,
                delay: 0.25
            }, "start");
        }
    });
    
    // Parallax effect
    const parallaxElements = document.querySelectorAll('[data-parallax]');
    
    parallaxElements.forEach(function(el) {
        const speed = el.getAttribute('data-parallax') || 1;
        
        gsap.to(el, {
            y: () => -100 * speed,
            ease: "none",
            scrollTrigger: {
                trigger: el.parentElement,
                start: "top bottom",
                end: "bottom top",
                scrub: true
            }
        });
    });
}

/**
 * Initialize section animations (fallback without GSAP)
 */
function initSectionAnimations() {
    const sections = document.querySelectorAll('.sectionAnimate');
    
    if (typeof IntersectionObserver === 'undefined') {
        // Fallback: show all sections
        sections.forEach(function(section) {
            section.classList.add('visible');
        });
        return;
    }
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                
                // Also animate child elements
                const fadeElements = entry.target.querySelectorAll('[data-fade]');
                fadeElements.forEach(function(el, index) {
                    setTimeout(function() {
                        el.classList.add('visible');
                    }, index * 150);
                });
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    sections.forEach(function(section) {
        observer.observe(section);
    });
}

/**
 * Initialize smooth scroll for anchor links
 */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
                return;
            }
            
            const target = document.querySelector(targetId);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Back to top link
    document.querySelectorAll('a[href="#"], .link[href="#"]').forEach(function(link) {
        if (link.textContent.toLowerCase().includes('back to top')) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    });
}

/**
 * Hide scroll indicator on scroll
 */
window.addEventListener('scroll', function() {
    const scrollIndicator = document.querySelector('.scrollIndicator');
    
    if (scrollIndicator) {
        if (window.scrollY > 100) {
            scrollIndicator.style.opacity = '0';
            scrollIndicator.style.pointerEvents = 'none';
        } else {
            scrollIndicator.style.opacity = '1';
            scrollIndicator.style.pointerEvents = 'auto';
        }
    }
});
