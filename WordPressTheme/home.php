<?php get_header(); ?>

<p class="p-test">ニュースアーカイブ</p>

<div class="p-topics__items p-topics__items--wide">

<div class="l-breadcrumb">
  <?php if(function_exists('bcn_display'))
{
    bcn_display();
}?>
</div>

  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <div class="p-topics__item p-topic-info">
        <time datetime="<?php the_time('c'); ?>" class="p-topic-info__date"><?php the_time('Y.m.d'); ?></time>
        <?php $category = get_the_category(); ?>
        <span><?php echo $category[0]->cat_name; ?></span>
        <a href="<?php the_permalink(); ?>" class="p-topic-info__text"> <?php the_title(); ?></a>
      </div>
    <?php endwhile; ?>
  <?php else : ?>
    投稿がありません
  <?php endif; ?>

</div>

<div class="l-pagenavi">
  <?php wp_pagenavi(); ?>
</div>

<?php get_footer(); ?>