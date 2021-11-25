<?php
/**
 * Functions
 */

/**
 * WordPress標準機能
 *
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support
 */
function my_setup() {
	add_theme_support( 'post-thumbnails' ); /* アイキャッチ */
	add_theme_support( 'automatic-feed-links' ); /* RSSフィード */
	add_theme_support( 'title-tag' ); /* タイトルタグ自動生成 */
	add_theme_support(
		'html5',
		array( /* HTML5のタグで出力 */
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
}
add_action( 'after_setup_theme', 'my_setup' );


/**
 * 
 * 投稿タイプごとに異なるアーカイブの表示件数を指定
 * 
 */
function change_posts_per_page($query) {
  if ( is_admin() || ! $query->is_main_query() )
  return;
  if ( $query->is_post_type_archive('blog') ) {
    $query->set( 'posts_per_page', '9' );
  }
  if ( $query->is_post_type_archive('works') ) {
    $query->set( 'posts_per_page', '6' );
  }
  if ( $query->is_post_type_archive('pet') ) {
    $query->set( 'posts_per_page', '9' );
  }
	if ( $query->is_tax('pet_breed') ) { 	
		$query->set( 'posts_per_page', '9' );
	}
	if ( $query->is_tax('blog_category') ) { 	
		$query->set( 'posts_per_page', '9' );
	}
	if ( $query->is_tax('works_category') ) { 	
		$query->set( 'posts_per_page', '6' );
	}
}
add_action( 'pre_get_posts', 'change_posts_per_page' );


/**
 * CSSとJavaScriptの読み込み
 *
 * @codex https://wpdocs.osdn.jp/%E3%83%8A%E3%83%93%E3%82%B2%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC
 */
function my_script_init() {
	wp_enqueue_style( 'my', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.1', 'all' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '7.0.9', 'all' );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '7.0.9', true );
	wp_enqueue_script( 'my', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ), '1.0.1', true );
}
add_action('wp_enqueue_scripts', 'my_script_init');


/**
 * お問い合わせ送信後、サンクスページに遷移
 */
add_action( 'wp_footer', 'add_thanks_page' );
function add_thanks_page() { ?>
<script>
document.addEventListener('wpcf7mailsent', function(event) {
  location = '<?php echo esc_url(home_url('/thanks/')); ?>'; /* 遷移先のURL */
}, false);
</script>
<?php }


/**
 * メニューの登録
 *
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_nav_menus
 */
// function my_menu_init() {
// 	register_nav_menus(
// 		array(
// 			'global'  => 'ヘッダーメニュー',
// 			'utility' => 'ユーティリティメニュー',
// 			'drawer'  => 'ドロワーメニュー',
// 		)
// 	);
// }
// add_action( 'init', 'my_menu_init' );
/**
 * メニューの登録
 *
 * 参考：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_nav_menus
 */


/**
 * ウィジェットの登録
 *
 * @codex http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_sidebar
 */
// function my_widget_init() {
// 	register_sidebar(
// 		array(
// 			'name'          => 'サイドバー',
// 			'id'            => 'sidebar',
// 			'before_widget' => '<div id="%1$s" class="p-widget %2$s">',
// 			'after_widget'  => '</div>',
// 			'before_title'  => '<div class="p-widget__title">',
// 			'after_title'   => '</div>',
// 		)
// 	);
// }
// add_action( 'widgets_init', 'my_widget_init' );



/**
 * アーカイブタイトル書き換え
 *
 * @param string $title 書き換え前のタイトル.
 * @return string $title 書き換え後のタイトル.
 */
function my_archive_title( $title ) {

	if ( is_home() ) { /* ホームの場合 */
		$title = 'ブログ';
	} elseif ( is_category() ) { /* カテゴリーアーカイブの場合 */
		$title = '' . single_cat_title( '', false ) . '';
	} elseif ( is_tag() ) { /* タグアーカイブの場合 */
		$title = '' . single_tag_title( '', false ) . '';
	} elseif ( is_post_type_archive() ) { /* 投稿タイプのアーカイブの場合 */
		$title = '' . post_type_archive_title( '', false ) . '';
	} elseif ( is_tax() ) { /* タームアーカイブの場合 */
		$title = '' . single_term_title( '', false );
	} elseif ( is_search() ) { /* 検索結果アーカイブの場合 */
		$title = '「' . esc_html( get_query_var( 's' ) ) . '」の検索結果';
	} elseif ( is_author() ) { /* 作者アーカイブの場合 */
		$title = '' . get_the_author() . '';
	} elseif ( is_date() ) { /* 日付アーカイブの場合 */
		$title = '';
		if ( get_query_var( 'year' ) ) {
			$title .= get_query_var( 'year' ) . '年';
		}
		if ( get_query_var( 'monthnum' ) ) {
			$title .= get_query_var( 'monthnum' ) . '月';
		}
		if ( get_query_var( 'day' ) ) {
			$title .= get_query_var( 'day' ) . '日';
		}
	}
	return $title;
};
add_filter( 'get_the_archive_title', 'my_archive_title' );


/**
 * 抜粋文の文字数の変更
 *
 * @param int $length 変更前の文字数.
 * @return int $length 変更後の文字数.
 */
function my_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'my_excerpt_length', 999 );


/**
 * 抜粋文の省略記法の変更
 *
 * @param string $more 変更前の省略記法.
 * @return string $more 変更後の省略記法.
 */
function my_excerpt_more( $more ) {
	return '...';

}
add_filter( 'excerpt_more', 'my_excerpt_more' );


/**
 * the_excerpt()に付与されるpタグを削除
 */
remove_filter('the_excerpt', 'wpautop');



////////////////////////////////
// getの値を追加
////////////////////////////////

function add_query_vars_filter( $vars ){
  $vars[] = "foo";
  $vars[] = "pet_breed";
  $vars[] = "pet-gender";
  $vars[] = "pet-shop";
  $vars[] = "pet-color";
  $vars[] = "pet-other";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

////////////////////////////////
// アーカイブページにクエリを追加
////////////////////////////////
add_action( 'pre_get_posts', 'add_archive_custom_query' ); // pre_get_postsにフック
// フック時に使う関数
function add_archive_custom_query( $query ) {
	
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive('pet') ) {
		
    // nonce検証
    $nonce = $_REQUEST['nonce'];
    if(!wp_verify_nonce($nonce, 'my-archive-nonce')) {
      // die();
    }

    // GETの引数を取得
    $get_foo = get_query_var('foo');
    $get_breed = get_query_var('pet_breed');
    $get_gender = get_query_var('pet-gender');
    $get_shop = get_query_var('pet-shop');
    $get_color = get_query_var('pet-color');
    $get_other = get_query_var('pet-other');
    
    // 全文検索
    if(!empty($get_foo)) {
      $query->set('s', $get_foo);
    }

    // meta_query を追加
    $meta_query = array(
      'relation' => 'AND'
    );

		
		// ペットの種類：ラジオボタン
    if(!empty($get_breed)) {
      array_push($meta_query, array(
        'key' => 'pet_breed',
        'value' => $get_breed,
        'compare' => '='
      ));
    }

    // 性別：セレクトボックス
    if(!empty($get_gender)) {
      array_push($meta_query, array(
        'key' => 'pet-gender', // metaキー
        'value' => $get_gender, // 検索値
        'compare' => '=' // 一致
      ));
    }

    // 店舗：セレクトボックス
    if(!empty($get_shop)) {
      array_push($meta_query, array(
        'key' => 'pet-shop', // metaキー
        'value' => $get_shop, // 検索値
        'compare' => '=' // 一致
      ));
    }

    // 毛色：ラジオボタン
    if(!empty($get_color)) {
      array_push($meta_query, array(
        'key' => 'pet-color',
        'value' => $get_color,
        'compare' => '='
      ));
    }

    // その他：チェックボックス
    if(!empty($get_other)) {
      array_push($meta_query, array(
      'key' => 'pet-other',
      'value' => $get_other,
      'compare' => 'LIKE' // チェックボックスの場合はLIKE検索になるので注意
      ));
    }

    $query->set('meta_query', $meta_query);

    // 検索やmeta_query以外にも、authorやカスタム投稿タイプ、カテゴリー、タクソノミーなど
    // WP_Queryの各種パラメーターが使えます
    // その他のクエリパラメータは以下参照下さい
    // http://notnil-creative.com/blog/archives/1288

  }
}