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
          $terms = get_the_terms($post->ID,'pet_breed');
          foreach( $terms as $term ) {
          echo '<a class="p-single__category p-single__category--blog" href="'.get_term_link($term->slug,'pet_breed').'">'.$term->name.'</a>';
          }
          ?>
        </div>
        <div class="p-single__thumbnail">
          <?php the_post_thumbnail('full',array('alt' => the_title_attribute('echo=0'))); ?>
        </div>
        <div class="p-single__content p-single-content">
          <?php the_content(); ?>
        </div>
        <?php if (get_field('pet-gender')) : ?>
          <div class="p-single__field p-field">
            <span class="p-field__title">性別</span>
            <p class="p-field__text"><?php the_field('pet-gender'); ?></p>
          </div>
        <?php endif; ?>
        <?php if (get_field('pet-color')) : ?>
          <div class="p-single__field p-field">
            <span class="p-field__title">毛色</span>
            <p class="p-field__text"><?php the_field('pet-color'); ?></p>
          </div>
        <?php endif; ?>
        <?php if (get_field('pet-shop')) : ?>
          <div class="p-single__field p-field">
            <span class="p-field__title">店舗</span>
            <p class="p-field__text"><?php the_field('pet-shop'); ?></p>
          </div>
        <?php endif; ?>
        <?php if (get_field('pet-price')) : ?>
          <div class="p-single__field p-field">
            <span class="p-field__title">価格</span>
            <p class="p-field__text"><?php the_field('pet-price'); ?></p>
          </div>
        <?php endif; ?>
        <?php if (get_field('pet-other')) : ?>
          <div class="p-single__field p-field">
            <span class="p-field__title">その他情報</span>
            <p class="p-field__text"><?php the_field('pet-other'); ?></p>
          </div>
        <?php endif; ?>
        <?php if (get_field('pet-comment')) : ?>
          <div class="p-single__field p-field">
            <span class="p-field__title">スタッフからのコメント</span>
            <p class="p-field__text"><?php the_field('pet-comment'); ?></p>
          </div>
        <?php endif; ?>
      </div>
      
      <div class="p-single__inner">
        <div class="p-post-links l-post-links">
          <div class="p-post-links__post-link"><?php previous_post_link('%link', 'PREV'); ?></div>
          <a class="p-post-links__archive-link" href="<?php echo esc_url( home_url( '/pet/' ) ); ?>">一覧</a>
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
    $taxonomy_slug = 'pet_breed';
    $post_type_slug = 'pet';
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
          <div class="p-card__img">
              <?php the_post_thumbnail('full',array('alt' => the_title_attribute('echo=0'))); ?>
            </div>
            <div class="p-card__title"><?php the_title(); ?></div>
            <?php if (get_field('pet-price')) : ?>
              <?php 
                $price = get_field('pet-price');
              ?>
              <p class="p-card__price"><?php echo number_format($price) ?>円</p>
            <?php endif; ?>
            <div class="p-card__box">
              <div class="p-card__pet-meta">
                <span class="p-card__pet-info p-card__pet-info--breed"><?php
                $terms = get_the_terms($post->ID, 'pet_breed');
                foreach ($terms as $term) {
                  echo $term->name;
                }
                ?></span>
                <?php if (get_field('pet-gender')) : ?>
                  <span class="p-card__pet-info p-card__pet-info--gender"><?php the_field('pet-gender'); ?></span>
                <?php endif; ?>
                <?php if (get_field('pet-color')) : ?>
                  <span class="p-card__pet-info p-card__pet-info--color"><?php the_field('pet-color'); ?></span>
                <?php endif; ?>
                <?php if (get_field('pet-shop')) : ?>
                  <span class="p-card__pet-info p-card__pet-info--shop"><?php the_field('pet-shop'); ?></span>
                <?php endif; ?>
                <?php if (get_field('pet-other')) : ?>
                  <?php
                  $others = get_field('pet-other');
                  if ($others): 
                  ?>
                    <?php
                    foreach ($others as $other) : ?>
                      <span class="p-card__pet-info p-card__pet-info--other"><?php echo $other; ?></span>
                    <?php endforeach; ?>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </a>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>