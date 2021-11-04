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
            <!-- メイン -->
            <div class="swiper-wrapper">
              <!-- カスタムフィールドのグループ内のサブフィールドの画像出力 -->
              <?php if (have_rows('images')) :  ?>
                <?php while (have_rows('images')) : the_row(); ?>
                  <?php
                  $i = 1;
                  $max = 8; //画像の最大枚数
                  while ($i <= $max) { //iが9以下の場合ループする
                    $name = 'image' . $i; //image1〜image9で繰り返していく
                    $image = get_sub_field($name); //サブフィールドの情報取得
                    if ($image) {
                      echo '<div class="swiper-slide"><img src="' . $image['url'] . '"></div>';
                    } //imgタグに画像URL入れて表示
                    $i++; //iに1足す
                  }
                  ?>
                <?php endwhile; ?>
              <?php endif; ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
          <!-- サムネイル -->
          <div class="swiper p-gallery__thumbs">
            <div class="swiper-wrapper">
              <!-- カスタムフィールドのグループ内のサブフィールドの画像出力 -->
              <?php if (have_rows('images')) :  ?>
                <?php while (have_rows('images')) : the_row(); ?>
                  <?php
                  $i = 1;
                  $max = 8; //画像の最大枚数
                  while ($i <= $max) { //iが9以下の場合ループする
                    $name = 'image' . $i; //image1〜image9で繰り返していく
                    $image = get_sub_field($name); //サブフィールドの情報取得
                    if ($image) {
                      echo '<div class="swiper-slide"><img src="' . $image['url'] . '"></div>';
                    } //imgタグに画像URL入れて表示
                    $i++; //iに1足す
                  }
                  ?>
                <?php endwhile; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="p-single__inner">
        <!-- カスタムフィールド表示 -->
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
          <!-- 前後のページへのリンクを表示する（パラメーターは表示したい文字） -->
          <div class="p-post-links__post-link"><?php previous_post_link('%link', 'PREV'); ?></div>
          <!-- 一覧へ -->
          <a class="p-post-links__archive-link" href="<?php echo esc_url(home_url('/works/')); ?>">一覧</a>
          <!-- 前後のページへのリンクを表示する（パラメーターは表示したい文字） -->
          <div class="p-post-links__post-link"><?php previous_post_link('%link', 'NEXT'); ?></div>
        </div>
      </div>
    </article>
  <?php endwhile; ?>
<?php endif; ?>


<section class="p-related-article l-related-article">
  <div class="l-inner">
    <h2 class="p-related-article__title">関連記事</h2>

    <!-- 関連記事 設定 -->
    <?php // 現在表示されている投稿と同じタームに分類された投稿を取得
    $taxonomy_slug = 'works_category'; // タクソノミーのスラッグを指定
    $post_type_slug = 'works'; // 投稿タイプのスラッグを指定
    $post_terms = wp_get_object_terms($post->ID, $taxonomy_slug); // タクソノミーの指定
    if ($post_terms && !is_wp_error($post_terms)) { // 値があるときに作動
      $terms_slug = array(); // 配列のセット
      foreach ($post_terms as $value) { // 配列の作成
        $terms_slug[] = $value->slug; // タームのスラッグを配列に追加
      }
    }
    $args = array(
      'post_type' => $post_type_slug, // 投稿タイプを指定
      'posts_per_page' => 4, // 表示件数を指定
      'orderby' =>  'DESC', // ランダムに投稿を取得
      'post__not_in' => array($post->ID), // 現在の投稿を除外
      'tax_query' => array( // タクソノミーパラメーターを使用
        array(
          'taxonomy' => $taxonomy_slug, // タームを取得タクソノミーを指定
          'field' => 'slug', // スラッグに一致するタームを返す
          'terms' => $terms_slug // タームの配列を指定
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
              <!-- 記事の抜粋を表示、５５文字まで！！ -->
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