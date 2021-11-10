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
          <?php if (is_singular('blog')): ?>
            <?php
            $terms = get_the_terms($post->ID,'blog_category');
            foreach( $terms as $term ) {
            echo '<a class="p-single__category" href="'.get_term_link($term->slug,'blog_category').'">'.$term->name.'</a>';
            }
            ?>
          <?php else: ?>
            <?php $category = get_the_category(); ?>
            <span class="p-single__category"><?php echo $category[0]->cat_name; ?></span>
          <?php endif; ?>
        </div>
        <div class="p-single__thumbnail">
          <?php the_post_thumbnail('full'); ?>
        </div>
        <div class="p-single__content p-single-content">
          <?php the_content(); ?>
        </div>
      </div>
      
      <div class="p-single__inner">
        <div class="p-post-links l-post-links">
          <div class="p-post-links__post-link"><?php previous_post_link('%link', 'PREV'); ?></div>
          <?php if (is_singular('blog')): ?>
            <a class="p-post-links__archive-link" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">一覧</a>
          <?php else: ?>
            <a class="p-post-links__archive-link" href="<?php echo esc_url( home_url( '/news/' ) ); ?>">一覧</a>
          <?php endif; ?>
          <div class="p-post-links__post-link"><?php previous_post_link('%link', 'NEXT'); ?></div>
        </div>
      </div>
    </article>
  <?php endwhile; ?>
<?php endif; ?>


<section class="p-related-article l-related-article">
  <div class="l-inner">
    <h2 class="p-related-article__title">関連記事</h2>

    <?php if (is_singular('blog')): ?>
      <?php
      $taxonomy_slug = 'blog_category';
      $post_type_slug = 'blog';
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
                <?php the_post_thumbnail('full'); ?>
              </div>
              <div class="p-card__title"><?php the_title(); ?></div>
              <div class="p-card__box">
                <p class="p-card__excerpt">
                  <?php the_excerpt(); ?>
                </p>
                <div class="p-card__meta">
                  <span class="p-card__category">
                    <?php
                    $terms = get_the_terms($post->ID, 'blog_category');
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
    <?php else: ?>
      <?php
      $categories = get_the_category($post->ID);

      $category_ID = array();

      foreach ($categories as $category) :
        array_push($category_ID, $category->cat_ID);
      endforeach;

      $args = array(
        'post__not_in' => array($post->ID),
        'posts_per_page' => 4,
        'category__in' => $category_ID,
        'orderby' => 'DESC',
      );
      $query = new WP_Query($args); ?>
      <div class="p-related-article__cards p-cards">
        <?php if ($query->have_posts()) :
          while ($query->have_posts()) :
            $query->the_post();
        ?>
          <a class="p-cards__card--related p-card" href="<?php the_permalink(); ?>">
            <div class="p-card__img p-card__img--related">
              <?php the_post_thumbnail('full'); ?>
            </div>
            <div class="p-card__title"><?php the_title(); ?></div>
            <div class="p-card__box">
              <p class="p-card__excerpt">
                <?php the_excerpt(); ?>
              </p>
              <div class="p-card__meta">
                <?php $category = get_the_category(); ?>
                <span class="p-card__category"><?php echo $category[0]->cat_name; ?></span>
                <time datetime="<?php the_time('c'); ?>" class="p-card__date"><?php the_time('Y.m.d'); ?></time>
              </div>
            </div>
          </a>
        <?php endwhile;
        endif; ?>
      </div>
    <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>