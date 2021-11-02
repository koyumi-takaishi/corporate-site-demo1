<?php get_header(); ?>

<div class="p-sub-mv">
  <div class="p-sub-mv__wrapper">
    <h2 class="p-sub-mv__title">お知らせ</h2>
  </div>
  <picture class="p-sub-mv__img">
    <source srcset="<?php echo get_template_directory_uri() ?>/assets/img/common/news-mv-pc.jpg" media="(min-width: 768px)"/>
    <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/news-mv-sp.jpg" alt="高層ビルから外を眺めている3人の写真">
  </picture>
</div>

<div class="p-breadcrumb l-breadcrumb">
  <div class="l-inner">
    <?php if(function_exists('bcn_display'))
    {
      bcn_display();
    }?>
  </div>
</div>

<section class="p-sub-news p-news l-sub-news">
  <div class="p-sub-news__inner">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <div class="p-news__info p-news-info">
          <div class="p-news-info__box">
            <time class="p-news-info__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
            <?php $category = get_the_category(); ?>
            <span class="p-news-info__category"><?php echo $category[0]->cat_name; ?></span>
          </div>
          <a class="p-news-info__title" href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
        </div>
      <?php endwhile; ?>
      <?php else : ?>
        投稿がありません
    <?php endif; ?>
  </div>
  <div class="p-pagenavi l-pagenavi">
    <?php wp_pagenavi(); ?>
  </div>
</section>


<?php get_footer(); ?>