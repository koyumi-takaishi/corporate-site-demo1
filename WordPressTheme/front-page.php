<?php get_header(); ?>

<?php
$home = esc_url(home_url('/'));
$content = esc_url(home_url('/content/'));
$philosophy1 = esc_url(home_url('/content#philosophy1'));
$philosophy2 = esc_url(home_url('/content#philosophy2'));
$philosophy3 = esc_url(home_url('/content#philosophy3'));
$news = esc_url(home_url('/news/'));
$works = esc_url(home_url('/works/'));
$overview = esc_url(home_url('/overview/'));
$blog = esc_url(home_url('/blog/'));
$contact = esc_url(home_url('/contact/'));
?>

<div class="p-mv l-mv js-mv">
  <div class="p-mv__wrapper">
    <div class="p-mv__title">
      <div class="p-mv__main-title">メインタイトルが入ります</div>
      <div class="p-mv__sub-title">サブタイトルが入ります</div>
    </div>
  </div>
  <div class="swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="slide-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/mv-img1.jpg" alt="ビルに青空が映っている写真">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="slide-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/mv-img2.jpg" alt="４つのビルの中心で空を見上げている写真">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="slide-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/mv-img3.jpg" alt="高層ビルが並んでいる空撮写真">
        </div>
      </div>
    </div>
  </div>
</div>

<section class="p-news l-news">
  <div class="p-news__inner">
    <?php
    $news_query = new WP_Query(
      array(
        'post_type'      => 'post',
        'posts_per_page' => 1,
      )
    );
    ?>
    <?php if ($news_query->have_posts()) : ?>
      <?php while ($news_query->have_posts()) : ?>
        <?php $news_query->the_post(); ?>
        <div class="p-news__info p-news-info">
          <div class="p-news-info__box">
            <time class="p-news-info__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
            <?php $category = get_the_category(); ?>
            <span class="p-news-info__category"><?php echo $category[0]->cat_name; ?></span>
          </div>
          <a class="p-news-info__title" href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    <a class="p-news__button" href="<?php echo $news; ?>">すべて見る</a>
  </div>
</section>

<section class="p-content l-content">
  <div class="p-content__title p-section-title">
    <h2 class="p-section-title__main">事業内容</h2>
    <span class="p-section-title__sub p-section-title__sub--content">Content</span>
  </div>
  <div class="p-content__wrapper">
    <a class="p-content__link p-content__link--1" href="<?php echo $content; ?>"><span>経営理念ページへ</span></a>
    <a class="p-content__link p-content__link--2" href="<?php echo $philosophy1; ?>">理念1へ</a>
    <a class="p-content__link p-content__link--3" href="<?php echo $philosophy2; ?>">理念2へ</a>
    <a class="p-content__link p-content__link--4" href="<?php echo $philosophy3; ?>">理念3へ</a>
  </div>
</section>

<section class="p-works l-works">
  <div class="l-inner">
    <div class="p-works__title p-section-title">
      <h2 class="p-section-title__main">制作実績</h2>
      <span class="p-section-title__sub">Works</span>
    </div>
  </div>
  <div class="p-works__wrapper">
    <div class="p-works__inner">
      <div class="p-works__slide p-works-slide">
        <div class="swiper">
          <div class="swiper-wrapper">
            <?php
            $works_query = new WP_Query(
              array(
                'post_type'      => 'works',
                'posts_per_page' => 3,
              )
            );
            ?>
            <?php if ($works_query->have_posts()) : ?>
              <?php while ($works_query->have_posts()) : ?>
                <div class="swiper-slide">
                  <div class="slide-img">
                    <?php $works_query->the_post(); ?>
                    <?php the_post_thumbnail('full'); ?>
                  </div>
                </div>
              <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
          </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
      </div>
      <div class="p-works__content p-works-content">
        <h3 class="p-works-content__title">メインタイトルが入ります。</h3>
        <p class="p-works-content__text">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
        <a class="c-button-main p-works-content__button" href="<?php echo $works; ?>">詳しく見る</a>
      </div>
    </div>
  </div>
</section>

<section class="p-overview l-works">
  <div class="l-inner">
    <div class="p-overview__title p-section-title">
      <h2 class="p-section-title__main">企業概要</h2>
      <span class="p-section-title__sub">Overview</span>
    </div>
  </div>
  <div class="p-overview__wrapper">
    <div class="p-overview__inner">
      <div class="p-overview__img">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/overview-img.jpg" alt="高層ビルが並んでいる空撮写真">
      </div>
      <div class="p-overview__content p-overview-content">
        <h3 class="p-overview-content__title">メインタイトルが入ります。</h3>
        <p class="p-overview-content__text">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
        <a class="c-button-main p-overview-content__button" href="<?php echo $overview; ?>">詳しく見る</a>
      </div>
    </div>
  </div>
</section>

<section class="p-blog l-blog">
  <div class="l-inner">
    <div class="p-blog__title p-section-title">
      <h2 class="p-section-title__main">ブログ</h2>
      <span class="p-section-title__sub">Blog</span>
    </div>
    <div class="p-blog__cards p-cards">
      <?php
      $works_query = new WP_Query(
        array(
          'post_type'      => 'blog',
          'posts_per_page' => 3,
        )
      );
      ?>
      <?php if ($works_query->have_posts()) : ?>
        <?php while ($works_query->have_posts()) : ?>
          <?php $works_query->the_post(); ?>
          <a class="p-cards__card p-card" href="<?php the_permalink(); ?>">
            <div class="p-card__img">
              <?php the_post_thumbnail('full'); ?>
            </div>
            <div class="p-card__title"><?php the_title(); ?></div>
            <div class="p-card__box">
              <!-- 記事の抜粋を表示、５５文字まで！！ -->
              <p class="p-card__excerpt"><?php echo get_the_excerpt() ?></p>
              <div class="p-card__meta">
                <span class="p-card__category"><?php
                $terms = get_the_terms($post->ID, 'blog_category');
                foreach ($terms as $term) {
                  echo $term->name;
                }
                ?></span>
                <time datetime="<?php the_time('c'); ?>" class="p-card__date"><?php the_time('Y.m.d'); ?></time>
              </div>
            </div>
          </a>
        <?php endwhile; ?>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>
    </div>
    <a class="c-button-main p-blog__button" href="<?php echo $blog; ?>">詳しく見る</a>
  </div>
</section>

<section class="p-contact l-contact">
  <div class="l-inner">
    <div class="p-contact__title p-section-title">
      <h2 class="p-section-title__main">お問い合わせ</h2>
      <span class="p-section-title__sub">Contact</span>
    </div>
    <p class="p-contact__text">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
    <a class="c-button-main p-contact__button" href="<?php echo $blog; ?>">お問い合わせへ</a>
  </div>
</section>


<?php get_footer(); ?>