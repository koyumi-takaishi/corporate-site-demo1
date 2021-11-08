<?php get_header(); ?>

<div class="p-404 l-404">
  <div class="l-inner">
    <p class="p-404__title">404 Not Found</p>
    <p class="p-404__text">お探しのページは<br class="u-hidden-pc">見つかりませんでした</p>
    <a href="<?php esc_url(home_url()); ?>" class="p-404__button c-button-main">TOPへ</a>
  </div>
</div>

<?php get_footer(); ?>