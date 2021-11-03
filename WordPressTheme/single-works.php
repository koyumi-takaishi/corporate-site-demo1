<?php get_header(); ?>

<div class="p-breadcrumb l-breadcrumb">
  <div class="l-inner">
    <?php if(function_exists('bcn_display'))
    {
      bcn_display();
    }?>
  </div>
</div>

<article class="p-single l-single">
  <div class="p-single__inner">

    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <h2 class="p-single__title"><?php the_title(); ?></h2>
      <div class="p-single__meta">
        <time class="p-single__time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日'); ?></time>
        <?php
        $terms = get_the_terms($post->ID,'works_category');
        foreach( $terms as $term ) {
          echo '<a class="p-single__category" href="'.get_term_link($term->slug,'works_category').'">'.$term->name.'</a>';
        }
        ?>
      </div>

      <div class="gallery">                
        <div class="swiper gallery-slider">
            <!-- メイン -->
            <div class="swiper-wrapper">
              <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/mv-img1.jpg" alt=""></div>
              <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/mv-img2.jpg" alt=""></div>
              <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/mv-img3.jpg" alt=""></div>
              <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/content-img1.jpg" alt=""></div>
              <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/content-img3.jpg" alt=""></div>
              <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/content-img2.jpg" alt=""></div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <!-- サムネイル -->
        <div class="swiper gallery-thumbs">
          <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/mv-img1.jpg" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/mv-img2.jpg" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/mv-img3.jpg" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/content-img1.jpg" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/content-img3.jpg" alt=""></div>
            <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/content-img2.jpg" alt=""></div>
          </div>
        </div>
      </div>
      

      
      <div class="article_body">

        <!-- カスタムフィールドのグループ内のサブフィールドの画像出力 -->
        <?php if( have_rows('images') ):  ?>
          <?php while( have_rows('images') ): the_row(); ?>
            <?php 
              $i = 1;
              $max = 9; //画像の最大枚数
              while($i<=$max){ //iが9以下の場合ループする
                $name = 'image'.$i; //image1〜image9で繰り返していく
                $image = get_sub_field($name); //サブフィールドの情報取得
                if($image){echo '<img src="'.$image['url'].'">';} //imgタグに画像URL入れて表示
                $i++; //iに1足す
              }
            ?>
          <?php endwhile; ?>
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
        <a href="<?php echo esc_url( home_url( '/works/' ) ); ?>">一覧</a>
        <!-- 前後のページへのリンクを表示する（パラメーターは表示したい文字） -->
        <div class="postLink postLink-next"><?php previous_post_link('%link', 'NEXT'); ?></div>
      </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</article>


  
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