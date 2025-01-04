$(document).ready(function () {
	// Show and Hide Navbar Menu
	$('.burger').click(function () {
		$('.burger').toggleClass('is-active');
		$('.header-navbar').toggleClass('is-active');
		$('.site-logo').toggleClass('d-none');
		$('body').toggleClass('scroll-inactive');
	});

	// Header Animation
	var didScroll;
	var lastScrollTop = 20;
	var delta = 20;
	var headerHeight = $('.header').outerHeight();
	var header = $('.header');
	// var contactLink = header.find('.contact-link');

	$(window).scroll(function (event) {
		didScroll = true;
	});

	setInterval(function () {
		if (didScroll) {
			hasScrolled();
			didScroll = false;
		}
	}, 250);

	function hasScrolled() {
		var st = $(this).scrollTop();

		if (Math.abs(lastScrollTop - st) <= delta) {
			return;
		}

		st > headerHeight ? header.addClass('scrolled') : header.removeClass('scrolled');

		if (st > lastScrollTop && st > 25) {
			// Scroll Down
			$(header).addClass('header-hide');
			// $(".select2-container").removeClass('select2-container--open');
		} else {
			// Scroll Up
			$(header).removeClass('header-hide');
			// $(".select2-container").addClass('select2-container--open');
		}

		lastScrollTop = st;
	}
});

// Function to format state
function formatState(state) {
	if (!state.id) {
		return state.text;
	}
	var baseUrl = '/user/pages/images/flags'; // Change this to your flag images path if different
	var $state = $(
		'<span><img src="' +
			baseUrl +
			'/' +
			state.element.value.toLowerCase() +
			'.png" class="img-flag" /> ' +
			state.text +
			'</span>',
	);
	return $state;
}

// Function to initialize the select2 with persistent language
function initializeLangSelect(selectId) {
	var langSelectParent = $(selectId).parent();
	$(selectId).select2({
		templateSelection: formatState,
		minimumResultsForSearch: -1,
		width: 'auto',
		dropdownParent: langSelectParent,
	});

	// Set the selected language from local storage if it exists
	var selectedLanguage = localStorage.getItem('selectedLanguage');
	if (selectedLanguage) {
		$(selectId).val(selectedLanguage).trigger('change');
	}

	// Store the selected language in local storage
	$(selectId).on('change', function () {
		localStorage.setItem('selectedLanguage', $(this).val());
	});
}

// Initialize the language selector on document ready
$(document).ready(function () {
	initializeLangSelect('#langSelect');
});

// flag - langSelect selection

function formatState(opt) {
	if (!opt.id) {
		return opt.text.toUpperCase();
	}

	var optvalue = $(opt.element).attr('value');
	// console.log(optvalue)
	if (!optvalue) {
		return opt.text.toUpperCase();
	} else {
		var $opt = $('<span class="d-flex align-items-center font-body-xxs font-color-white">' + optvalue + '</span>');
		return $opt;
	}
}

function hideBannerPopup() {
	document.getElementById('headerBanner').style.display = 'none';
}
$(document).ready(function () {
	document.getElementById('closeBanner')?.addEventListener('click', hideBannerPopup);
});

$(document).on('click', '.language-selector-resp .language-selector-list .language-item', function () {
	$(this).addClass('active').siblings().removeClass('active');
});
