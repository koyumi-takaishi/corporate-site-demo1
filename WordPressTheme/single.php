<?php get_header(); ?>

<p class="p-test">お知らせとブログの投稿詳細ページ</p>

<!-- ****************記事の中身**************** -->
<div class="p-test-content">
<div class="l-breadcrumb">
  <?php if(function_exists('bcn_display'))
{
    bcn_display();
}?>
</div>

  <!-- 記事が1件以上あるかどうか？ -->
  <?php if (have_posts()) : ?>
    <!-- 記事があればループする（ループ中の記事情報を取得） -->
    <!-- 個別記事ページのループは1回だけになる -->
    <?php while (have_posts()) : the_post(); ?>
      <!-- 現在の投稿のIDを表示、現在の投稿の種別に応じたクラス属性を表示 -->

      <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>

        <header class="article_header">
          <!-- 記事のタイトル表示 -->
          <h2 class="article_title"><?php the_title(); ?></h2>
          <div class="article_meta">

          <!-- カテゴリー表示（投稿タイプがブログだったらリンク表示、そうでなければテキストで） -->
          <?php if (is_singular('blog')): ?>
            <?php
            $terms = get_the_terms($post->ID,'blog_category');
            foreach( $terms as $term ) {
            echo '<a href="'.get_term_link($term->slug,'blog_category').'">'.$term->name.'</a>';
            }
            ?>
          <?php else: ?>
            <!-- 記事が属するカテゴリーを表示 -->
            <?php $category = get_the_category(); ?>
            <span><?php echo $category[0]->cat_name; ?></span>
          <?php endif; ?>
            <!-- 記事の投稿時刻を表示 -->
            <time class="news_time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日'); ?></time>
          </div>
        </header>

        
        <div class="article_body">
          <!-- アイキャッチ画像表示 -->
          <?php the_post_thumbnail('thumbnail'); ?>
          <div class="content">
            <!-- 記事の本文を表示 -->
            <?php the_content(); ?>
          </div>
        </div>

        <div class="postLinks">
          <!-- 前後のページへのリンクを表示する（パラメーターは表示したい文字） -->
          <div class="postLink postLink-prev"><?php previous_post_link('%link', 'PREV'); ?></div>
          <!-- 一覧へ -->
          <?php if (is_singular('blog')): ?>
            <a href="/blog/">一覧</a>
          <?php else: ?>
            <a href="/news/">一覧</a>
          <?php endif; ?>
          <!-- 前後のページへのリンクを表示する（パラメーターは表示したい文字） -->
          <div class="postLink postLink-next"><?php previous_post_link('%link', 'NEXT'); ?></div>
        </div>

      </article>
    <?php endwhile; ?>
  <?php endif; ?>


  
  <?php if (is_singular('blog')): ?>
    <!-- ****************関連記事（ブログ）**************** -->
    
    <?php // 現在表示されている投稿と同じタームに分類された投稿を取得
      $taxonomy_slug = 'blog_category'; // タクソノミーのスラッグを指定
      $post_type_slug = 'blog'; // 投稿タイプのスラッグを指定
      $post_terms = wp_get_object_terms($post->ID, $taxonomy_slug); // タクソノミーの指定
      if( $post_terms && !is_wp_error($post_terms)) { // 値があるときに作動
        $terms_slug = array(); // 配列のセット
        foreach( $post_terms as $value ){ // 配列の作成
          $terms_slug[] = $value->slug; // タームのスラッグを配列に追加
        }
      }
      $args = array(
        'post_type' => $post_type_slug, // 投稿タイプを指定
        'posts_per_page' => 4, // 表示件数を指定
        'orderby' =>  'DESC', // ランダムに投稿を取得
        'post__not_in' => array($post->ID), // 現在の投稿を除外
        'tax_query' => array( // タクソノミーパラメーターを使用
          array(
            'taxonomy' => $taxonomy_slug, // タームを取得タクソノミーを指定
            'field' => 'slug', // スラッグに一致するタームを返す
            'terms' => $terms_slug // タームの配列を指定
          )
        )
      );
      $the_query = new WP_Query($args); if($the_query->have_posts()):
    ?>
    <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
      <div class="p-test-content">
        <div class="post">
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
          <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="article_meta">
            <!-- 記事が属するカテゴリーを表示 -->
            <?php $category = get_the_category(); ?>
            <span><?php echo $category[0]->cat_name; ?></span>
            <!-- 記事の投稿時刻を表示 -->
            <time class="news_time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日'); ?></time>
          </div>
          <!-- 記事の抜粋を表示、５５文字まで！！ -->
          <?php the_excerpt(); ?>
        </div>
      </div>
    <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>

  <?php else: ?>

  <!-- ****************関連記事（ニュース）**************** -->
  <div class="p-test-content">

    <?php
    // 同じカテゴリから記事を10件呼び出す
    $categories = get_the_category($post->ID);

    $category_ID = array();

    foreach ($categories as $category) :
      array_push($category_ID, $category->cat_ID);
    endforeach;

    $args = array(
      // 今読んでいる記事を除く
      'post__not_in' => array($post->ID),
      'posts_per_page' => 4,
      'category__in' => $category_ID,
      // ランダムに記事を選ぶ
      'orderby' => 'DESC',
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) :
      while ($query->have_posts()) :
        $query->the_post();
    ?>
        <div class="post">
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
          <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="article_meta">
            <!-- 記事が属するカテゴリーを表示 -->
            <?php $category = get_the_category(); ?>
            <span><?php echo $category[0]->cat_name; ?></span>
            <!-- 記事の投稿時刻を表示 -->
            <time class="news_time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日'); ?></time>
          </div>
          <!-- 記事の抜粋を表示、５５文字まで！！ -->
          <?php the_excerpt(); ?>
        </div>
    <?php endwhile;
    endif; ?>
    <?php wp_reset_postdata(); ?>
  </div>

  <?php endif; ?>

</div>
<?php get_footer(); ?>