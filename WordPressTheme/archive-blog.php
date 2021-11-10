<?php get_header(); ?>

<div class="p-sub-mv">
  <div class="p-sub-mv__wrapper">
    <h2 class="p-sub-mv__title">制作実績</h2>
  </div>
  <picture class="p-sub-mv__img">
    <source srcset="<?php echo get_template_directory_uri() ?>/assets/img/common/blog-mv-pc.jpg" media="(min-width: 768px)" />
    <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/blog-mv-sp.jpg" alt="ノートと万年筆の写真">
  </picture>
</div>

<div class="p-breadcrumb l-breadcrumb">
  <div class="l-inner">
    <?php if (function_exists('bcn_display')) {
      bcn_display();
    } ?>
  </div>
</div>

<section class="p-sub-blog l-sub-blog">
  <div class="l-inner">
    <div class="p-sub-blog__category p-category">
      <span class="p-category__link p-category__link--current">ALL</span>
      <?php
      $terms = get_terms('blog_category');
      foreach ($terms as $term) {
        echo '<a class="p-category__link" href="' . get_term_link($term->slug, 'blog_category') . '">' . $term->name . '</a>';
      }
      ?>
    </div>
    <div class="p-sub-blog__cards p-cards">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <a class="p-cards__card p-card" href="<?php the_permalink(); ?>">
            <div class="p-card__img">
              <?php the_post_thumbnail('full'); ?>
            </div>
            <div class="p-card__title"><?php the_title(); ?></div>
            <div class="p-card__box">
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