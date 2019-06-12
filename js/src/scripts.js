/**
 * Air theme JavaScript.
 */

// Define Javascript is active by changing the body class
document.body.classList.remove('no-js');
document.body.classList.add('js');

// jQuery start
(function($) {
	$('.open-popup-link, .product-link').magnificPopup({
		type: 'inline',
		midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
	});

	$('#image-popups').magnificPopup({
		delegate: 'a',
		type: 'image',
		removalDelay: 500, //delay removal by X to allow out-animation
		callbacks: {
			beforeOpen: function() {
				// just a hack that adds mfp-anim class to markup
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				this.st.mainClass = this.st.el.attr('data-effect');
			}
		},
		closeOnContentClick: true,
		midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
	});

	$('.popup-vimeo').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,

		fixedContentPos: false
	});
	// Hide or show the "back to top" link
	$(window).scroll(function() {
		// Back to top
		var offset = 300; // Browser window scroll (in pixels) after which the "back to top" link is shown
		var offset_opacity = 1200; // Browser window scroll (in pixels) after which the link opacity is reduced
		var scroll_top_duration = 700; // Duration of the top scrolling animation (in ms)
		var link_class = '.top';

		if ($(this).scrollTop() > offset) {
			$(link_class).addClass('is-visible');
		} else {
			$(link_class).removeClass('is-visible');
		}

		if ($(this).scrollTop() > offset_opacity) {
			$(link_class).addClass('fade-out');
		} else {
			$(link_class).removeClass('fade-out');
		}
	});

	// Document ready start
	$(function() {
		$('.slider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			dots: true,
			fade: true
		});

		$('#clear').click(function() {
			$('#keyword').val('');
			$('#datafetch').html('');
		});

		var iframe = $('iframe')[0];
		var player = $f(iframe);
		var status = $('.status');

		// When the player is ready, add listeners for pause, finish, and playProgress
		player.addEvent('ready', function() {
			status.text('ready');

			player.addEvent('pause', onPause);
			player.addEvent('finish', onFinish);
			player.addEvent('playProgress', onPlayProgress);
		});

		// Call the API when a button is pressed
		$('button').bind('click', function() {
			player.api($(this).text().toLowerCase());
		});

		function onPause() {
			status.text('paused');
		}

		function onFinish() {
			status.text('finished');
		}

		function onPlayProgress(data) {
			status.text(data.seconds + 's played');
		}

		$('.paakategoria').click(function() {
			$(this).siblings().removeClass('active');
			//$(this).next().siblings().removeClass('active');
			//$('.paakategoria > .close').siblings().removeClass('active');

			$('.alakategoria-tuote').hide();
			$(this).toggleClass('active');
			$('.close').removeClass('active');

			if ($(this).hasClass('active')) {
				$('.close', this).toggleClass('active');
			}

			$(this).each(function() {
				$(this).nextUntil('.paakategoria').fadeIn(400);

				if (!$(this).hasClass('active')) {
					$('.alakategoria-tuote').hide();
				}

				if ($(this).next('.paakategoria')) {
					return true;
				}
			});
		});

		// Set up back to top link
		var moveTo = new MoveTo();
		var target = document.getElementById('target');
		moveTo.move(target);

		// Register a back to top trigger
		var trigger = document.getElementsByClassName('js-trigger')[0];
		moveTo.registerTrigger(trigger);
	});
})(jQuery);
