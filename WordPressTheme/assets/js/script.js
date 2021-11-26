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
	new Swiper('.swiper-front', swipeOption);

	// single-worksのスライダー
	//メイン
	var slider = new Swiper ('.p-gallery__slider', {
		slidesPerView: 1,
		centeredSlides: true,
		loop: true,
		loopedSlides: 8, //スライドの枚数と同じ値を指定
		navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
		},
	});
	//サムネイル
	var thumbs = new Swiper ('.p-gallery__thumbs', {
		slidesPerView: 'auto',
		spaceBetween: 24,
		centeredSlides: true,
		loop: true,
		slideToClickedSlide: true,
		breakpoints: {
			// when window width is >= 768px
			768: {
				centeredSlides: false,
				spaceBetween: 8,
			}
		}
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

	// 別ページへのアンカーリンクがヘッダーの高さ分ずれる時の対処
	$(window).on('load', function() {
		let headerHeight = $('.js-header').outerHeight();
		let urlHash = location.hash;
		if (urlHash) {
			let position = $(urlHash).offset().top - headerHeight;
			$('html, body').animate({ scrollTop: position }, 0);
		}
	});

	// ラジオボタン2回クリックしたらチェック外れる
	$(function(){
		//インプット要素を取得する
		var inputs = $('input');
		//読み込み時に「:checked」の疑似クラスを持っているinputの値を取得する
		var checked = inputs.filter(':checked').val();
		//インプット要素がクリックされたら
		inputs.on('click', function(){
			//クリックされたinputとcheckedを比較
			if($(this).val() === checked) {
					//inputの「:checked」をfalse
					$(this).prop('checked', false);
					//checkedを初期化
					checked = '';
			} else {
					//inputの「:checked」をtrue
					$(this).prop('checked', true);
					//inputの値をcheckedに代入
					checked = $(this).val();
			}
		});
	});

});
