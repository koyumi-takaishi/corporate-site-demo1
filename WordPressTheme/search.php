<?php get_header(); ?>

<div class="p-sub-mv">
  <div class="p-sub-mv__wrapper">
    <h2 class="p-sub-mv__title">検索結果</h2>
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

<h2><?php the_search_query(); ?>の検索結果 : <?php echo $wp_query->found_posts; ?>件</h2>

<div class="p-sub-blog__cards p-cards">
<!-- 投稿情報 loop -->
<?php if(have_posts()) : ?>
    <?php while(have_posts()):the_post() ?> 
    <a class="p-cards__card p-card" href="<?php the_permalink(); ?>">
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
<?php else: ?>
    <div class="post">
        <p>申し訳ございません。<br />該当する記事がございません。</p>
    </div>
<?php endif; ?>
</div>

</div>

<div class="p-pagenavi l-pagenavi">
  <?php wp_pagenavi(); ?>
  </div>
</section>

<?php get_footer(); ?>