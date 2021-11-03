<?php get_header(); ?>

<div class="p-sub-mv">
  <div class="p-sub-mv__wrapper">
    <h2 class="p-sub-mv__title">制作実績</h2>
  </div>
  <picture class="p-sub-mv__img">
    <source srcset="<?php echo get_template_directory_uri() ?>/assets/img/common/works-mv-pc.jpg" media="(min-width: 768px)" />
    <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/works-mv-sp.jpg" alt="デスクトップPCの画面">
  </picture>
</div>

<div class="p-breadcrumb l-breadcrumb">
  <div class="l-inner">
    <?php if (function_exists('bcn_display')) {
      bcn_display();
    } ?>
  </div>
</div>

<section class="p-sub-works l-sub-works">
  <div class="l-inner">
    <div class="p-sub-works__category p-category">
      <span class="p-category__link p-category__link--current">ALL</span>
      <?php
      $terms = get_terms('works_category');
      foreach ($terms as $term) {
        echo '<a class="p-category__link" href="' . get_term_link($term->slug, 'works_category') . '">' . $term->name . '</a>';
      }
      ?>
    </div>
  </div>
  <div class="p-sub-works__inner">
    <div class="p-sub-works__cards p-works-cards">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <a class="p-works-cards__card p-works-card" href="<?php the_permalink(); ?>">
            <div class="p-works-card__img">
              <?php the_post_thumbnail('full'); ?>
            </div>
            <span class="p-works-card__category"><?php
            $terms = get_the_terms($post->ID, 'works_category');
            foreach ($terms as $term) {
              echo $term->name;
            }
            ?></span>
            <h3 class="p-works-card__title">
              <?php the_title(); ?>
            </h3>
          </a>
        <?php endwhile; ?>
      <?php else : ?>
        投稿がありません
      <?php endif; ?>
    </div>
  </div>

  <div class="p-pagenavi l-pagenavi">
  <?php wp_pagenavi(); ?>
  </div>
</section>

<?php get_footer(); ?>