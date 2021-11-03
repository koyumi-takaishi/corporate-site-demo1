// ローディング判定
jQuery(function ($) {
	jQuery(window).on("load", function() {
		jQuery("body").attr("data-loading", "true");
	});

	// 初期値iosスクロール禁止
	var move = function( event ){
		event.preventDefault();
	}

	// front-pageのSwiper
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
	new Swiper('.swiper-1', swipeOption);

	// single-worksのスライダー
	//メイン
	var slider = new Swiper ('.gallery-slider', {
		slidesPerView: 1,
		centeredSlides: true,
		loop: true,
		loopedSlides: 6, //スライドの枚数と同じ値を指定
		navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
		},
	});
	//サムネイル
	var thumbs = new Swiper ('.gallery-thumbs', {
		slidesPerView: 'auto',
		spaceBetween: 10,
		centeredSlides: true,
		loop: true,
		slideToClickedSlide: true,
	});
	//4系～
	//メインとサムネイルを紐づける
	slider.controller.control = thumbs;
	thumbs.controller.control = slider;

	// メインビュー過ぎたらヘッダーの色変わる
  $(function () {
    //変数fvHeightを定義
    var fvHeight = $(".p-mv").innerHeight();
		var fvHeightSub = $(".p-sub-mv").innerHeight();
    var headerHeight = $(".p-header").innerHeight();
    var changePoint = fvHeight - headerHeight;
		var changePointSub = fvHeightSub - headerHeight;
    /*** ヘッダーの色変更 ***/
  
    $(window).scroll(function () {
      //スクロール量とfvの高さを比較
      if ($(window).scrollTop() > changePoint || $(window).scrollTop() > changePointSub ) {
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

	// ページトップボタンのスムーススクロール
	$('.js-page-top-button').click(function () {
		$('body,html').animate({
				scrollTop: 0//ページトップまでスクロール
		}, 500);//ページトップスクロールの速さ。数字が大きいほど遅くなる
		return false;//リンク自体の無効化
	});

	// メインビュー過ぎたらページトップボタン表示
	$(function () {
    //変数fvHeightを定義
    var fvHeight = $(".p-mv").innerHeight();
    var fvHeightSub = $(".p-sub-mv").innerHeight();
		$(".js-page-top-button").hide();
    $(window).scroll(function () {
      //スクロール量とfvの高さを比較
      if ($(window).scrollTop() > fvHeight || $(window).scrollTop() > fvHeightSub) {
        //条件を満たした場合：表示
        $(".js-page-top-button").fadeIn();
      } else {
        //条件を満たさない場合：非表示
        $(".js-page-top-button").fadeOut();
      }
    });
  });

	/* スムーススクロール */
	// jQuery('a[href^="#"]').click(function() {
	// 	let header = jQuery(".js-header").height();
	// 	let speed = 300;
	// 	let id = jQuery(this).attr("href");
	// 	let target = jQuery("#" == id ? "html" : id);
	// 	let position = jQuery(target).offset().top - header;
	// 	if ("fixed" !== jQuery("#header").css("position")) {
	// 		position = jQuery(target).offset().top;
	// 	}
	// 	if (0 > position) {
	// 		position = 0;
	// 	}
	// 	jQuery("html, body").animate(
	// 		{
	// 			scrollTop: position
	// 		},
	// 		speed
	// 	);
	// 	return false;
	// });

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
