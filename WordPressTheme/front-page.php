<?php get_header(); ?>

<?php
$home = esc_url( home_url( '/' ) );
$content = esc_url( home_url( '/content/' ) );
$philosophy1 = esc_url( home_url( '/content#philosophy1' ) );
$philosophy2 = esc_url( home_url( '/content#philosophy2' ) );
$philosophy3 = esc_url( home_url( '/content#philosophy3' ) );
$news = esc_url( home_url( '/news/' ) );
$works = esc_url( home_url( '/works/' ) );
$overview = esc_url( home_url( '/overview/' ) );
$blog = esc_url( home_url( '/blog/' ) );
$contact = esc_url( home_url( '/contact/' ) );
?>

<div class="p-mv l-mv js-mv">
  <div class="swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="slide-img">
          <img src="https://picsum.photos/id/1041/1200/640" alt="img1">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="slide-img">
          <img src="https://picsum.photos/id/1016/1200/640" alt="img2">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="slide-img">
          <img src="https://picsum.photos/id/1056/1200/640" alt="img3">
        </div>
      </div>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
  </div>
</div>

<!-- 最新のニュース1件 -->
<div class="p-test-content">
<p class="p-test">ニュース</p>
  <div class="p-topics__items">
    <?php
    $news_query = new WP_Query(
      array(
        'post_type'      => 'post',
        'posts_per_page' => 1,
        )
      );
    ?>
    <?php if ( $news_query->have_posts() ) : ?>
    <?php while ( $news_query->have_posts() ) : ?>
    <?php $news_query->the_post(); ?>
    
    <div class="p-topics__item p-topic-info">
      <time datetime="<?php the_time( 'c' );?>" class="p-topic-info__date"><?php the_time('Y.m.d'); ?></time>
      <?php $category = get_the_category(); ?>
      <span><?php echo $category[0]->cat_name; ?></span>
      <a href="<?php the_permalink();?>" class="p-topic-info__text"> <?php the_title(); ?></a>
      <a href="<?php echo $news; ?>">すべて見る</a>
    </div>
    
    <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
  </div>
</div>

<!-- 事業内容 -->
<div class="p-test-content">
  <p class="p-test">事業内容</p>
  <a href="<?php echo $content; ?>">経営理念ページへ</a>
  <a href="<?php echo $philosophy1; ?>">理念1へ</a>
  <a href="<?php echo $philosophy2; ?>">理念2へ</a>
  <a href="<?php echo $philosophy3; ?>">理念3へ</a>
</div>

<!-- 制作実績 -->
<div class="p-test-content">
  <p class="p-test">制作実績</p>
  <div class="p-topics__items">
    <?php
    $works_query = new WP_Query(
      array(
        'post_type'      => 'works',
        'posts_per_page' => 3,
        )
      );
    ?>
    <?php if ( $works_query->have_posts() ) : ?>
    <?php while ( $works_query->have_posts() ) : ?>
    <?php $works_query->the_post(); ?>

      <?php the_post_thumbnail('thumbnail'); ?>
    
    <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <a href="<?php echo $works; ?>">詳しく見る</a>
  </div>
</div>

<!-- 企業概要 -->
<div class="p-test-content">
  <p class="p-test">企業概要</p>
  <a href="<?php echo $overview; ?>">詳しく見る</a>
</div>

<!-- 制作実績 -->
<div class="p-test-content">
  <p class="p-test">ブログ</p>
  <div class="p-topics__items">
    <?php
    $works_query = new WP_Query(
      array(
        'post_type'      => 'blog',
        'posts_per_page' => 3,
        )
      );
    ?>
    <?php if ( $works_query->have_posts() ) : ?>
    <?php while ( $works_query->have_posts() ) : ?>
    <?php $works_query->the_post(); ?>

    <div>
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
      <time datetime="<?php the_time('c'); ?>" class="p-topic-info__date"><?php the_time('Y.m.d'); ?></time>
      <?php
        $terms = get_the_terms($post->ID,'blog_category');
        foreach( $terms as $term ) {
          echo $term->name;
        }
        ?>
        <a href="<?php the_permalink(); ?>" class="p-topic-info__text"> <?php the_title(); ?></a>
        <!-- 記事の抜粋を表示、５５文字まで！！ -->
        <?php the_excerpt(); ?>
    </div>
    
    <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <a href="<?php echo $blog; ?>">詳しく見る</a>
  </div>
</div>

<div class="p-test-content">
  <p class="p-test">お問い合わせ</p>
  <a href="<?php echo $contact; ?>">お問い合わせへ</a>
</div>



<?php get_footer(); ?>