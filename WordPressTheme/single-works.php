<?php get_header(); ?>

<p class="p-test">制作実績の投稿詳細ページ</p>

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

      <?php 
        // var_dump($post->ID); 
        // var_dump(have_rows('images',$post->ID));
      ?>

      <?php 
        $group = get_field('images');
        echo('<pre>');
            var_dump($group);
        echo('<pre>');
        exit;
      ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>

        <header class="article_header">
          <!-- 記事のタイトル表示 -->
          <h2 class="article_title"><?php the_title(); ?></h2>
          <div class="article_meta">

          <!-- カテゴリー表示 -->
          <?php
          $terms = get_the_terms($post->ID,'works_category');
          foreach( $terms as $term ) {
          echo '<a href="'.get_term_link($term->slug,'works_category').'">'.$term->name.'</a>';
          }
          ?>
          <!-- 記事の投稿時刻を表示 -->
          <time class="news_time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日'); ?></time>
          </div>
        </header>

        
        <div class="article_body">
          <!-- アイキャッチ画像表示 -->
          <?php the_post_thumbnail('thumbnail'); ?>

          <?php if (have_rows('images')) : ?>
          <?php
          //グループのデータを取得
          $group = get_field('images');
          
          echo('<pre>');
              var_dump($group);
          echo('<pre>');
          exit;

          ?>
          <?php endif; ?>

          <!-- カスタムフィールド表示 -->
          <?php if(get_field('point1-title')): ?>
          <div class="p-single__box01 p-box01">
            <span class="p-box01__title"><?php the_field('point1-title'); ?></span>
            <p class="p-box01__text"><?php the_field('point1-text'); ?></p>
          </div>
          <?php endif; ?>
          <?php if(get_field('point2-title')): ?>
          <div class="p-single__box01 p-box01">
            <span class="p-box01__title"><?php the_field('point2-title'); ?></span>
            <p class="p-box01__text"><?php the_field('point2-text'); ?></p>
          </div>
          <?php endif; ?>
          <?php if(get_field('point3-title')): ?>
          <div class="p-single__box01 p-box01">
            <span class="p-box01__title"><?php the_field('point3-title'); ?></span>
            <p class="p-box01__text"><?php the_field('point3-text'); ?></p>
          </div>
          <?php endif; ?>

        </div>

        <div class="postLinks">
          <!-- 前後のページへのリンクを表示する（パラメーターは表示したい文字） -->
          <div class="postLink postLink-prev"><?php previous_post_link('%link', 'PREV'); ?></div>
          <!-- 一覧へ -->
          <a href="/works/">一覧</a>
          <!-- 前後のページへのリンクを表示する（パラメーターは表示したい文字） -->
          <div class="postLink postLink-next"><?php previous_post_link('%link', 'NEXT'); ?></div>
        </div>

      </article>
    <?php endwhile; ?>
  <?php endif; ?>


  
    <!-- ****************関連記事**************** -->
    
    <?php // 現在表示されている投稿と同じタームに分類された投稿を取得
      $taxonomy_slug = 'works_category'; // タクソノミーのスラッグを指定
      $post_type_slug = 'works'; // 投稿タイプのスラッグを指定
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
            <?php
            $terms = get_the_terms($post->ID,'works_category');
            foreach( $terms as $term ) {
            echo $term->name;
            }
            ?>
            <!-- 記事の投稿時刻を表示 -->
            <time class="news_time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日'); ?></time>
          </div>
          <!-- 記事の抜粋を表示、５５文字まで！！ -->
          <?php if(get_field('point1-title')): ?>
          <?php
            $text = mb_substr(get_field('point1-text'),0,55,'utf-8'); 
            echo $text.'...';
          ?>
          <?php endif; ?>
        </div>
      </div>
    <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>

</div>

<?php get_footer(); ?>