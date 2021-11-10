<?php get_header(); ?>

<div class="p-sub-mv">
  <div class="p-sub-mv__wrapper">
    <h2 class="p-sub-mv__title">お問い合わせ</h2>
  </div>
  <picture class="p-sub-mv__img">
    <source srcset="<?php echo get_template_directory_uri() ?>/assets/img/common/contact-mv-pc.jpg" media="(min-width: 768px)"/>
    <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/contact-mv-sp.jpg" alt="キーボード入力している写真">
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

<?php if (have_posts()): while (have_posts()): the_post();
  the_content();
endwhile; endif; ?>

<?php get_footer(); ?>