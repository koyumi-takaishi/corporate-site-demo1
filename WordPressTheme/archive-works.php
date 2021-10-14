<?php get_header(); ?>

<p class="p-test">制作実績アーカイブ</p>

<div class="p-test-content">

<div class="p-topics__items p-topics__items--wide">

<div class="l-breadcrumb">
  <?php if(function_exists('bcn_display'))
{
    bcn_display();
}?>
</div>

<span class="c-blog-btn--current">ALL</span>

<?php
$terms = get_terms('works_category');
foreach ( $terms as $term ){
echo '<a href="'.get_term_link($term->slug,'works_category').'">'.$term->name.'</a>';
}
?>

  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <div class="p-test-content">
        <time datetime="<?php the_time('c'); ?>" class="p-topic-info__date"></time>
        <?php
        $terms = get_the_terms($post->ID,'works_category');
        foreach( $terms as $term ) {
        echo $term->name;
        }
        ?>
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

</div>

<?php get_footer(); ?>