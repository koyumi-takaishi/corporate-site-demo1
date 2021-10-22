<?php get_header(); ?>

<p class="p-test">ブログのカテゴリーアーカイブ</p>

<div class="p-test-content">

<div class="p-topics__items p-topics__items--wide">

<div class="l-breadcrumb">
  <?php if(function_exists('bcn_display'))
{
    bcn_display();
}?>
</div>

<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">ALL</a>

<?php
$cat = get_queried_object();
$cat_slug = $cat->slug;
?>

<?php
$terms = get_terms('blog_category');
foreach ( $terms as $term ): ?>
<a href="<?php echo get_term_link($term->slug,'blog_category'); ?>" class="<?php if( $cat_slug === $term->slug ) { echo "c-blog-btn--current";} ?>"><?php echo $term->name; ?></a>
<?php endforeach; ?>

  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <div class="p-test-content">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
        <time datetime="<?php the_time('c'); ?>" class="p-topic-info__date"><?php the_time('Y.m.d'); ?></time>
        <?php
        $terms = get_the_terms($post->ID,'blog_category');
        foreach( $terms as $term ) {
        echo $term->name;
        }
        ?>
        <a href="<?php the_permalink(); ?>" class="p-topic-info__text"> <?php the_title(); ?></a>
        <!-- 記事の抜粋を表示、５５文字まで！！ -->
        <?php the_excerpt(); ?>

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