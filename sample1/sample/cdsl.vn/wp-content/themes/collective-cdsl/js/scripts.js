const loadingSVG = `
<?xml version="1.0" encoding="utf-8"?>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; fill: var(--color-accent); display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
<g transform="rotate(0 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9166666666666666s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(30 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8333333333333334s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(60 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(90 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6666666666666666s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(120 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5833333333333334s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(150 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(180 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.4166666666666667s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(210 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.3333333333333333s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(240 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(270 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.16666666666666666s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(300 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.08333333333333333s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(330 50 50)">
  <rect x="47" y="24" rx="3" ry="6" width="6" height="12">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate>
  </rect>
</g>
</svg>
`

// replaceAll() polyfill
if (!String.prototype.replaceAll) {
	String.prototype.replaceAll = function(str, newStr){

		// If a regex pattern
		if (Object.prototype.toString.call(str).toLowerCase() === '[object regexp]') {
			return this.replace(str, newStr);
		}

		// If a string
		return this.replace(new RegExp(str, 'g'), newStr);

	};
}

// debounce function from https://www.freecodecamp.org/news/javascript-debounce-example/
function debounce(func, timeout = 300) {
    let timer
    return (...args) => {
        clearTimeout(timer)
        timer = setTimeout(() => {
            func.apply(this, args)
        }, timeout)
    }
}

function handleSearchResponse(response, $element, $hiddenElement = null) {
	if (response === '[]' || response === '') {
		$($element).html('<p class="searchNoResult">No result</p>')
		if ($hiddenElement) {
			$($hiddenElement).addClass('hidden')
		}
	} else {
		const responseParsed = JSON.parse(response)
		$($element).html('')
		responseParsed.forEach((element) => {
			$($element).html($($element).html() + element)
		})
		if ($hiddenElement) {
			$($hiddenElement).removeClass('hidden')
		}
	}
}

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

function sectionAnimate() {
	$(".sectionAnimate").each((index, element) => {
		let $object = $(element);
		let $fade1 = $object.find('*[data-fade="1"]');
		let $fade2 = $object.find('*[data-fade="2"]');
		let $fadeRight = $object.find('*[data-fade="right"]');
		let tl = gsap.timeline({
			scrollTrigger: {
				trigger: $object,
				once: true,
				start: "top 90%", // when the top of the trigger hits the top of the viewport
			},
		});

		$object.find('*[data-text-fade="1"]').each((index, element) => {
			var splitText = new SplitText($(element), {
				type: "lines",
			});
			tl.from(
				splitText.lines,
				0.45,
				{
					y: "+=40",
					alpha: 0,
					stagger: 0.1,
				},
				"start"
			);
		});

		tl.from(
			$fade1,
			0.45,
			{
				y: "+=40",
				autoAlpha: 0,
				stagger: 0.15,
			},
			"start"
		);
		tl.from(
			$fade2,
			0.45,
			{
				y: "+=40",
				autoAlpha: 0,
				stagger: 0.15,
				delay: 0.25,
			},
			"start"
		);
		tl.from(
			$fadeRight,
			0.45,
			{
				x: "-=80",
				autoAlpha: 0,
				stagger: 0.15,
				delay: 0.25,
			},
			"start"
		);
	});
}

function selfAnimate() {
	$(".selfAnimate").each((index, element) => {
		let $object = $(element);
		gsap.from(
			$object,
			0.45,
			{
				x: "-=80",
				autoAlpha: 0,
				scrollTrigger: {
					trigger: $object,
					once: true,
					start: "top 90%", // when the top of the trigger hits the top of the viewport
				},
				stagger: 0.15,
			},
			"start"
		);
	});
}

var $menuButton = $(".navMobileButton");
var $menu = $(".navMobileContent");
var $searchToggleButton = $(".searchToggleButton");
var $search = $(".search");

gsap.registerPlugin(ScrollTrigger, SplitText);

$menuButton.on("click", menuToggle);

function menuToggle() {
	$menu.toggleClass("openMenu");
	$menuButton.toggleClass("closeBurger");
	console.log("menuOpen");
}

$searchToggleButton.on("click", searchToggle);

function searchToggle() {
	$search.toggleClass("searchOpen");
	console.log("searchOpen");
}

var merchSwiper = new Swiper(".merchSwiper", {
	loop: true,
	slidesPerView: 1,
	mousewheel: {
		forceToAxis: true,
	},
	zoom: true,

	a11y: {
		prevSlideMessage: "Previous slide",
		nextSlideMessage: "Next slide",
	},

	pagination: {
		el: ".swiper-pagination",
		clickable: true,
		type: "bullets",
	},

	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
});

var genricSwiper = new Swiper(".swiperSlide", {
	loop: true,
	spaceBetween: 16,
	mousewheel: {
		forceToAxis: true,
	},
	slidesPerView: 1,

	a11y: {
		prevSlideMessage: "Previous slide",
		nextSlideMessage: "Next slide",
	},

	pagination: {
		el: ".swiper-pagination",
		clickable: true,
		type: "bullets",
	},

	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
});

var genreSwiper = new Swiper(".genreSlider ", {
	slidesPerView: 1,
	spaceBetween: 16,
	updateOnWindowResize: true,
	mousewheel: {
		forceToAxis: true,
	},

	breakpoints: {
		1250: {
			slidesPerView: "auto",
			spaceBetween: 32,
		},
	},

	a11y: {
		prevSlideMessage: "Previous slide",
		nextSlideMessage: "Next slide",
	},

	pagination: {
		el: ".swiper-pagination",
		clickable: true,
		type: "bullets",
	},

	navigation: {
		prevEl: ".swiper-button-next",
		nextEl: ".swiper-button-prev",
	},
});

var imageSwiper = new Swiper(".imageSwiper", {
	spaceBetween: 16,
	slidesPerView: "auto",
	mousewheel: {
		forceToAxis: true,
	},
	breakpoints: {
		1200: {
			spaceBetween: 32,
		},
	},
	// slidesOffsetBefore: 32,
	// loop: true,
	// loopedSlides: 2,

	a11y: {
		prevSlideMessage: "Previous slide",
		nextSlideMessage: "Next slide",
	},

	navigation: {
		nextEl: ".swiper-button-prev",
		prevEl: ".swiper-button-next",
	},
});

$(".showUpcoming").each((index, element) => {
	let $object = $(element);
	$(".expandButton", element).on("click", function () {
		$object.toggleClass("showOpened");
	});
});

$(".dropdown").click((event) => {
	let $element = event.currentTarget;
	$($element).children(".dropdownMenu").toggleClass("show");
});

const cursor = $(".customCursor");
var cursorVisible = true;
var cursorState = "none";

const getMousePos = (e) => {
	let posx = 0;
	let posy = 0;
	if (!e) e = window.event;
	if (e.pageX || e.pageY) {
		posx = e.pageX;
		posy = e.pageY;
	} else if (e.clientX || e.clientY) {
		posx =
			e.clientX +
			document.body.scrollLeft +
			document.documentElement.scrollLeft;
		posy =
			e.clientY +
			document.body.scrollTop +
			document.documentElement.scrollTop;
	}
	return {
		x: posx,
		y: posy,
	};
};
cursor.toggleClass("novisible");
window.addEventListener("mousemove", mouseFirst);

function mouseFirst() {
	cursor.toggleClass("novisible");
	window.removeEventListener("mousemove", mouseFirst);
}

// window.addEventListener('load', (event) => {
document.addEventListener("mousemove", (e) => {
	const mousePos = getMousePos(e);
	const docScrolls = {
		left: document.body.scrollLeft + document.documentElement.scrollLeft,
		top: document.body.scrollTop + document.documentElement.scrollTop,
	};

	let mouseY = mousePos.y - docScrolls.top;
	let mouseX = mousePos.x - docScrolls.left;

	gsap.to(cursor, 0.01, {
		x: mouseX,
		y: mouseY,
	});
});

document.addEventListener("mouseleave", (e) => {
	let t = e.relatedTarget || e.toElement;
	if (!t || t.nodeName == "HTML") {
		// console.log('leave');
		if (cursorVisible) {
			cursor.toggleClass("disabled");
			cursorVisible = false;
		}
	}
});

document.addEventListener("mouseenter", (e) => {
	// console.log('enter');
	if (!cursorVisible) {
		cursor.toggleClass("disabled");
		cursorVisible = true;
	}
});

// });

const cursorArray = [];

$("[data-cursor]").each((index, element) => {
	let cursorClass = $(element).attr("data-cursor");
	if (cursorArray.indexOf(cursorClass) == -1) {
		cursorArray.push(cursorClass);
	}

	// $(element).addClass('cursorNone');
});

console.log(cursorArray);

$("[data-cursor]").each((index, element) => {
	let cursorClass = $(element).attr("data-cursor");
	// console.log(cursorClass);

	$(element).on("mouseenter", function () {
		// console.log(cursorClass, "enter");
		cursorArray.forEach(function (e) {
			if (cursor.hasClass(e) && e != cursorClass) {
				cursor.toggleClass(e);
			}
		});

		if (cursorState != cursorClass) {
			cursor.toggleClass(cursorClass);
			cursorState = cursorClass;
		}
		console.log(cursorState);
	});

	$(element).on("mouseleave", function () {
		// console.log(cursorClass, "enter");
		cursorArray.forEach(function (e) {
			if (cursor.hasClass(e)) {
				cursor.toggleClass(e);
			}
		});

		if (cursorState == cursorClass) {
			// cursor.toggleClass(cursorClass);
			cursorState = "none";
		}
		console.log(cursorState);
	});
});

$.fn.exists = function () {
	return this.length !== 0;
};

var docStyle = getComputedStyle(document.body);

function getProp(value) {
	return docStyle.getPropertyValue(value);
}

if ($(".aboutIntroSplash").exists()) {
	let aboutIntroImage = $(".aboutIntroImage");
	let aboutIntroImageContent = $(".aboutIntroImageContent");
	let aboutIntroText = $(".aboutIntroText");
	let aboutIntroTitle = $(".aboutIntroTitle");
	let aboutIntroLogo = $(".aboutIntroLogo");

	let aboutSplash = gsap.timeline({
		scrollTrigger: {
			trigger: $(".aboutIntroSplash"),
			scrub: 0.25,
			end: "+=100%",
			pin: true,
			start: "101% bottom",
		},
		defaults: {
			ease: "linear",
		},
	});

	aboutSplash.to(
		aboutIntroImage,
		0.5,
		{
			scale: 0.6,
		},
		"start"
	);
	aboutSplash.to(
		aboutIntroImageContent,
		0.5,
		{
			scale: 1.33,
			yPercent: 10,
		},
		"start"
	);
	aboutSplash.to(
		aboutIntroText,
		0.5,
		{
			yPercent: 95,
			"--textColor": getProp("--body-text-color"),
		},
		"start"
	);
}

if ($(".aboutSlide").exists()) {
	console.log("about slide");
	let aboutSlideList = $(".aboutSlideList");
	let aboutSlideItem = $(".aboutSlideItem");
	let aboutSlideImage = $(".aboutSlideImage");
	let aboutArtistSVG = $(".slideSVGLogo");

	gsap.set(aboutArtistSVG, { scale: 3.75, xPercent: 140 });
	// gsap.set(aboutSlideImage,{xPercent:35, scale: 1.35});

	let aboutSlide = gsap.timeline({
		scrollTrigger: {
			trigger: ".aboutSlide",
			scrub: 0.25,
			pin: true,
			start: "top top",
			end: "+=550%",
		},
	});

	aboutSlide.to(aboutSlideItem, 0.3, { scale: 0.75 }, "start");
	aboutSlide.to(aboutSlideImage, 0.3, { scale: 1.45 }, "start");
	aboutSlide.to(
		aboutArtistSVG,
		0.3,
		{ xPercent: 120, ease: "linear" },
		"start"
	);
	aboutSlide.to(
		aboutSlideItem,
		2.5,
		{ xPercent: -400, ease: "linear" },
		"left"
	);
	aboutSlide.to(aboutSlideImage, 2.5, { xPercent: -35 }, "left");
	aboutSlide.to(
		aboutArtistSVG,
		2.5,
		{ xPercent: -100, ease: "linear" },
		"left"
	);
	aboutSlide.to(aboutSlideItem, 0.25, { scale: 1 }, "end");
	aboutSlide.to(
		aboutArtistSVG,
		0.25,
		{ xPercent: -120, ease: "easeout" },
		"end"
	);
	aboutSlide.to(aboutSlideImage, 0.25, { scale: 1, xPercent: 0 }, "end");
}

if ($(".aboutArtistLoop").exists()) {
	let aboutLineOdd = $(".artistLineOdd");
	let aboutLineEven = $(".artistLineEven");

	gsap.set(aboutLineOdd, { xPercent: 100 });
	gsap.set(aboutLineEven, { xPercent: -100 });

	let aboutArtist = gsap.timeline({
		scrollTrigger: {
			trigger: ".aboutArtistLoop",
			scrub: 0.25,
			// pin: true,
			start: "20% bottom",
			end: "bottom top",
		},
		defaults: {
			ease: "linear",
		},
	});

	aboutArtist.to(aboutLineOdd, 0.25, { xPercent: -300 }, "start");
	aboutArtist.to(aboutLineEven, 0.25, { xPercent: 300 }, "start");
}

sectionAnimate()
selfAnimate()

$(".childrenAnimate").each((index, element) => {
	let $object = $(element);
	$object.children('*[data-fade-child="1"]').each((index, target) => {
		let $item = $(target);
		gsap.from($item, 0.45, {
			x: "-=80",
			autoAlpha: 0,
			stagger: 0.15,
			delay: 0.25,
			scrollTrigger: {
				trigger: $item,
				once: true,
				scroller: $object,
				// markers: true,
				start: "top 90%", // when the top of the trigger hits the top of the viewport
			},
		});
	});
});

$(".sectionParallax").each((index, element) => {
	let $object = $(element);
	let $layer1 = $object.find('*[data-parallax="1"]');
	let $layer2 = $object.find('*[data-parallax="2"]');
	let $layer3 = $object.find('*[data-parallax="3"]');
	let $layer4 = $object.find('*[data-parallax="4"]');
	let $layer8 = $object.find('*[data-parallax="8"]');
	let $layerset4 = $object.find('*[data-parallax="set4"]');

	gsap.set($layer1, {
		yPercent: -15,
	});
	gsap.set($layer2, {
		yPercent: 15,
	});
	gsap.set($layer3, {
		yPercent: 25,
	});
	gsap.set($layer4, {
		yPercent: 45,
	});
	gsap.set($layer4, {
		yPercent: 80,
	});
	gsap.set($layerset4, {
		y: 400,
	});

	let ptl = gsap.timeline({
		scrollTrigger: {
			trigger: $object,
			scrub: true,
			end: "bottom top",
			// markers: true,
			start: "top bottom",
		},
		defaults: {
			ease: "linear",
		},
	});
	ptl.to(
		$layer1,
		0.5,
		{
			yPercent: 15,
		},
		"start"
	);
	ptl.to(
		$layer2,
		0.5,
		{
			yPercent: -15,
		},
		"start"
	);
	ptl.to(
		$layer3,
		0.5,
		{
			yPercent: -25,
		},
		"start"
	);
	ptl.to(
		$layer4,
		0.5,
		{
			yPercent: -45,
		},
		"start"
	);
	ptl.to(
		$layer8,
		0.5,
		{
			yPercent: -80,
		},
		"start"
	);
	ptl.to(
		$layerset4,
		0.5,
		{
			y: -400,
		},
		"start"
	);
});

$(".homeArtistImageItem").each((index, element) => {
	let $object = $(element);
	let $imageContentA = $object.children(".imageContentA");
	let $imageContentB = $object.children(".imageContentB");
	let $imageContentC = $object.children(".imageContentC");
	let delay = index * 0.15;

	gsap.set($imageContentA, {
		xPercent: 100,
	});
	gsap.set($imageContentB, {
		xPercent: 100,
	});
	gsap.set($imageContentC, {
		xPercent: 100,
	});

	// console.log($object);
	let tl = gsap.timeline({
		repeat: -1,
		repeatRefresh: true,
		delay: delay,
	});

	tl.to(
		$imageContentA,
		0.3,
		{
			xPercent: -100,
		},
		"B"
	);
	tl.to(
		$imageContentB,
		0.3,
		{
			xPercent: 0,
		},
		"B"
	);

	tl.to($imageContentC, 0.5, {
		alpha: 1,
	});
	tl.to($imageContentA, 0.5, {
		alpha: 0,
	});
	tl.to($imageContentA, 0.5, {
		xPercent: 100,
	});

	tl.to(
		$imageContentB,
		0.3,
		{
			xPercent: -100,
		},
		"C"
	);
	tl.to(
		$imageContentC,
		0.3,
		{
			xPercent: 0,
		},
		"C"
	);

	tl.to($imageContentA, 0.5, {
		alpha: 1,
	});
	tl.to($imageContentB, 0.5, {
		alpha: 0,
	});
	tl.to($imageContentB, 0.5, {
		xPercent: 100,
	});

	tl.to(
		$imageContentC,
		0.3,
		{
			xPercent: -100,
		},
		"A"
	);
	tl.to(
		$imageContentA,
		0.3,
		{
			xPercent: 0,
		},
		"A"
	);

	tl.to($imageContentB, 0.5, {
		alpha: 1,
	});
	tl.to($imageContentC, 0.5, {
		alpha: 0,
	});
	tl.to($imageContentC, 0.5, {
		xPercent: 100,
	});
});

$(".lightToggle").each((index, element) => {
	let $object = $(element);
	// console.log('change theme');

	$(element).on("click", function () {
		if (getCookie("darkmode") == "on") {
			setCookie("darkmode", "off", 365);
		} else {
			setCookie("darkmode", "on", 365);
		}

		$("body").toggleClass("dark-theme");
	});
});

$(".soundToggle").each((index, element) => {
	let $object = $(element);

	$(element).on("click", function () {
		if ($("body").css("--soundOn") === "1") {
			$("body").css({ "--soundOn": 0, "--soundMute": 1 });
			setCookie("sound", "off", 365);
			window.soundMute = true;
			window.activePlayer.muted(true);
		} else {
			$("body").css({ "--soundOn": 1, "--soundMute": 0 });
			setCookie("sound", "on", 365);
			window.soundMute = false;
			window.activePlayer.muted(false);
		}
	});
});

gsap.to(".scrollIndicator", 0.5, {
	alpha: 0,
	scrollTrigger: {
		trigger: ".scrollMarker",
		scrub: true,
		end: "+=300",
		start: "top bottom",
	},
});

// Replace by lyric.js
// $(".songLyricsButton").each((index, element) => {
// 	$(element).on("click", function () {
// 		$(".lyricsContainer").toggleClass("closed");
// 	});
// });

$("#lyricCloseButton").on("click", function () {
	$(".lyricsContainer").toggleClass("closed");
});

$(".lyricsClose").on("click", function () {
	$(".lyricsContainer").toggleClass("closed");
});

var searchOn = false;

// TODO: toggle needs also to clear data for search result, and also reset globalSearchContaienr
$(".globalSearchToggle").on("click", function () {
	$(".globalSearch").toggleClass("closed");
	$(".searchOverlay").toggleClass("on");

	if ($(".globalSearchContainer").hasClass("inActive") == false) {
		$(".globalSearchContainer").toggleClass("inActive");
	}
});

$(".searchOverlay").on("click", function () {
	$(".globalSearch").toggleClass("closed");
	$(".searchOverlay").toggleClass("on");

	if ($(".globalSearchContainer").hasClass("inActive") == false) {
		$(".globalSearchContainer").toggleClass("inActive");
	}
});

// $('body').addClass('dark-theme');
(async function ($) {
	if (getCookie("darkmode") === "") {
		if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
			setCookie("darkmode", "on", 365);
			$("body").toggleClass("dark-theme");
		} else {
			setCookie("darkmode", "off", 365);
		}
	}

	if (getCookie("sound") === "") {
		setCookie("sound", "on", 365);
	}

	if (getCookie("sound") === "on") {
		$("body").css({ "--soundOn": 1, "--soundMute": 0 });
		window.soundMute = false;
	} else {
		$("body").css({ "--soundOn": 0, "--soundMute": 1 });
		window.soundMute = true;
	}

	if (getCookie("cookie_accept") === "") {
		setCookie("cookie_accept", "false", 365);
	}

	if (getCookie("cookie_accept") === "false") {
		$("body").addClass("firstTime");
		$(".cookieMessage div button").on("click", function (element) {
			$("body").removeClass("firstTime");
			setCookie("cookie_accept", "true", 365);
		});
	}

	if (getCookie("lang") === "vi") {
		$("body").css({ "--langVie": 1, "--langEng": 0 });
	} else {
		$("body").css({ "--langVie": 0, "--langEng": 1 });
	}

	$(".langToggle").on("click", function (element) {
		if (getCookie("lang") === "vi") {
			setCookie("lang", "en", 365);
			$("body").css({ "--langVie": 0, "--langEng": 1 });
			location.reload();
		} else {
			setCookie("lang", "vi", 365);
			$("body").css({ "--langVie": 1, "--langEng": 0 });
			location.reload();
		}
	});
})(window.jQuery);
