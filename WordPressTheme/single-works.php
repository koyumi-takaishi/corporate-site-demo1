<?php get_header(); ?>

<div class="p-breadcrumb l-breadcrumb l-breadcrumb--single">
  <div class="l-inner">
    <?php if (function_exists('bcn_display')) {
      bcn_display();
    } ?>
  </div>
</div>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <article class="p-single l-single">
      <div class="p-single__inner">
        <h2 class="p-single__title"><?php the_title(); ?></h2>
        <div class="p-single__meta">
          <time class="p-single__time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日'); ?></time>
          <?php
          $terms = get_the_terms($post->ID, 'works_category');
          foreach ($terms as $term) {
            echo '<a class="p-single__category" href="' . get_term_link($term->slug, 'works_category') . '">' . $term->name . '</a>';
          }
          ?>
        </div>
      </div>
      <div class="p-gallery l-gallery">
        <div class="p-gallery__inner">
          <div class="swiper p-gallery__slider">
            <div class="swiper-wrapper">
              <?php if (have_rows('images')) :  ?>
                <?php while (have_rows('images')) : the_row(); ?>
                  <?php
                  $i = 1;
                  $max = 8;
                  while ($i <= $max) {
                    $name = 'image' . $i;
                    $image = get_sub_field($name);
                    if ($image) {
                      echo '<div class="swiper-slide"><img src="' . $image['url'] . '" alt="'. $image['title'] .'"></div>';
                    }
                    $i++;
                  }
                  ?>
                <?php endwhile; ?>
              <?php endif; ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
          <div class="swiper p-gallery__thumbs">
            <div class="swiper-wrapper">
              <?php if (have_rows('images')) :  ?>
                <?php while (have_rows('images')) : the_row(); ?>
                  <?php
                  $i = 1;
                  $max = 8;
                  while ($i <= $max) {
                    $name = 'image' . $i;
                    $image = get_sub_field($name);
                    if ($image) {
                      echo '<div class="swiper-slide"><img src="' . $image['url'] . '" alt="'. $image['title'] .'"></div>';
                    }
                    $i++;
                  }
                  ?>
                <?php endwhile; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="p-single__inner">
        <?php if (get_field('point1-title')) : ?>
          <div class="p-single__field p-field">
            <span class="p-field__title"><?php the_field('point1-title'); ?></span>
            <p class="p-field__text"><?php the_field('point1-text'); ?></p>
          </div>
        <?php endif; ?>
        <?php if (get_field('point2-title')) : ?>
          <div class="p-single__field p-field">
            <span class="p-field__title"><?php the_field('point2-title'); ?></span>
            <p class="p-field__text"><?php the_field('point2-text'); ?></p>
          </div>
        <?php endif; ?>
        <?php if (get_field('point3-title')) : ?>
          <div class="p-single__field p-field">
            <span class="p-field__title"><?php the_field('point3-title'); ?></span>
            <p class="p-field__text"><?php the_field('point3-text'); ?></p>
          </div>
        <?php endif; ?>

        <div class="p-post-links l-post-links">
          <div class="p-post-links__post-link"><?php previous_post_link('%link', 'PREV'); ?></div>
          <a class="p-post-links__archive-link" href="<?php echo esc_url(home_url('/works/')); ?>">一覧</a>
          <div class="p-post-links__post-link"><?php previous_post_link('%link', 'NEXT'); ?></div>
        </div>
      </div>
    </article>
  <?php endwhile; ?>
<?php endif; ?>


<section class="p-related-article l-related-article">
  <div class="l-inner">
    <h2 class="p-related-article__title">関連記事</h2>

    <?php
    $taxonomy_slug = 'works_category';
    $post_type_slug = 'works';
    $post_terms = wp_get_object_terms($post->ID, $taxonomy_slug);
    if ($post_terms && !is_wp_error($post_terms)) {
      $terms_slug = array();
      foreach ($post_terms as $value) {
        $terms_slug[] = $value->slug;
      }
    }
    $args = array(
      'post_type' => $post_type_slug,
      'posts_per_page' => 4,
      'orderby' =>  'DESC',
      'post__not_in' => array($post->ID),
      'tax_query' => array(
        array(
          'taxonomy' => $taxonomy_slug,
          'field' => 'slug',
          'terms' => $terms_slug
        )
      )
    );
    $the_query = new WP_Query($args); ?>

    <div class="p-related-article__cards p-cards">
      <?php if ($the_query->have_posts()) : ?>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
          <a class="p-cards__card--related p-card" href="<?php the_permalink(); ?>">
            <div class="p-card__img p-card__img--related">
              <?php the_post_thumbnail('full',array('alt' => the_title_attribute('echo=0'))); ?>
            </div>
            <div class="p-card__title"><?php the_title(); ?></div>
            <div class="p-card__box">
              <p class="p-card__excerpt">
                <?php if (get_field('point1-title')) : ?>
                  <?php
                  $text = mb_substr(get_field('point1-text'), 0, 24, 'utf-8');
                  echo $text . '...';
                  ?>
                <?php endif; ?>
              </p>
              <div class="p-card__meta">
                <span class="p-card__category">
                  <?php
                  $terms = get_the_terms($post->ID, 'works_category');
                  foreach ($terms as $term) {
                    echo $term->name;
                  }
                  ?>
                </span>
                <time datetime="<?php the_time('c'); ?>" class="p-card__date"><?php the_time('Y.m.d'); ?></time>
              </div>
            </div>
          </a>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>