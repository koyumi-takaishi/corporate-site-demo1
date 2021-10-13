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
            <!-- 記事が属するカテゴリーを表示 -->
            <?php $category = get_the_category(); ?>
            <span><?php echo $category[0]->cat_name; ?></span>
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
          <!-- ニュース一覧へ -->
          <a href="/news/">一覧</a>
          <!-- 前後のページへのリンクを表示する（パラメーターは表示したい文字） -->
          <div class="postLink postLink-next"><?php previous_post_link('%link', 'NEXT'); ?></div>
        </div>

      </article>
    <?php endwhile; ?>
  <?php endif; ?>


  <!-- ****************関連記事**************** -->
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
        </div>
    <?php endwhile;
    endif; ?>
    <?php wp_reset_postdata(); ?>


  </div>

</div>
<?php get_footer(); ?>