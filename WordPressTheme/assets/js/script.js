// ローディング判定
jQuery(function ($) {
	jQuery(window).on("load", function() {
		jQuery("body").attr("data-loading", "true");
	});

	// 初期値iosスクロール禁止
	var move = function( event ){
		event.preventDefault();
	}

	// Swiper
	let swipeOption = {
		loop: true,
		effect: 'fade',
		autoplay: {
			delay: 4000,
			disableOnInteraction: false,
		},
		speed: 2000,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		}
	}
	new Swiper('.swiper', swipeOption);

	// メインビュー過ぎたらヘッダーの色変わる
  $(function () {
    //変数fvHeightを定義
    var fvHeight = $(".p-mv").innerHeight();
    var headerHeight = $(".p-header").innerHeight();
    var changePoint = fvHeight - headerHeight;
    /*** ヘッダーの色変更 ***/
  
    $(window).scroll(function () {
      //スクロール量とfvの高さを比較
      if ($(window).scrollTop() > changePoint) {
        //条件を満たした場合：headerのカラー変更
        $(".js-header-color-change").addClass("color-change");
      } else {
        //条件を満たさない場合：headerのカラーを戻す
        $(".js-header-color-change").removeClass("color-change");
      }
    });
  });

	// ドロワーメニュー
	$('.js-hamburger').on('click', function () {
		if ($('.js-hamburger').hasClass('open')) {
			$('.js-drawer').fadeOut();
			$(this).removeClass('open');
			//  iosスクロール許可(スクロール停止を停止)
			$('body').css('overflow','');
			window.removeEventListener( 'touchmove' , move, { passive: false } );
		} else {
			$('.js-drawer').fadeIn();
			$(this).addClass('open');
			// スクロール停止の処理
			$('body').css('overflow','hidden');
			window.addEventListener( 'touchmove' , move , { passive: false } );
		}
	});

	/* スムーススクロール */
	jQuery('a[href^="#"]').click(function() {
		let header = jQuery(".js-header").height();
		let speed = 300;
		let id = jQuery(this).attr("href");
		let target = jQuery("#" == id ? "html" : id);
		let position = jQuery(target).offset().top - header;
		if ("fixed" !== jQuery("#header").css("position")) {
			position = jQuery(target).offset().top;
		}
		if (0 > position) {
			position = 0;
		}
		jQuery("html, body").animate(
			{
				scrollTop: position
			},
			speed
		);
		return false;
	});

	// スクロール判定
	// jQuery(window).on("scroll", function() {
	// 	if (100 < jQuery(this).scrollTop()) {
	// 		jQuery("body").attr("data-scroll", "true");
	// 	} else {
	// 		jQuery("body").attr("data-scroll", "false");
	// 	}
	// });

	/* ドロワー */
	// jQuery(".js-drawer").on("click", function(e) {
	// 	e.preventDefault();
	// 	let targetClass = jQuery(this).attr("data-target");
	// 	jQuery("." + targetClass).toggleClass("is-checked");
	// 	return false;
	// });

	/* 電話リンク */
	// let ua = navigator.userAgent;
	// if (ua.indexOf("iPhone") < 0 && ua.indexOf("Android") < 0) {
	// 	jQuery('a[href^="tel:"]')
	// 		.css("cursor", "default")
	// 		.on("click", function(e) {
	// 			e.preventDefault();
	// 		});
	// }

});
