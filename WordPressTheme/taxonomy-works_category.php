<?php get_header(); ?>

<p class="p-test">制作実績のカテゴリーアーカイブ</p>

<div class="p-test-content">

<div class="p-topics__items p-topics__items--wide">

<div class="l-breadcrumb">
  <?php if(function_exists('bcn_display'))
{
    bcn_display();
}?>
</div>

<a href="/works/">ALL</a>

<?php
$cat = get_queried_object();
$cat_slug = $cat->slug;
?>

<?php
$terms = get_terms('works_category');
foreach ( $terms as $term ): ?>
<a href="<?php echo get_term_link($term->slug,'works_category'); ?>" class="<?php if( $cat_slug === $term->slug ) { echo "c-blog-btn--current";} ?>"><?php echo $term->name; ?></a>
<?php endforeach; ?>

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