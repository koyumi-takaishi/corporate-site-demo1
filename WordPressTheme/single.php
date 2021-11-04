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
          <!-- カテゴリー表示（投稿タイプがブログだったらリンク表示、そうでなければテキストで） -->
          <?php if (is_singular('blog')): ?>
            <?php
            $terms = get_the_terms($post->ID,'blog_category');
            foreach( $terms as $term ) {
            echo '<a class="p-single__category" href="'.get_term_link($term->slug,'blog_category').'">'.$term->name.'</a>';
            }
            ?>
          <?php else: ?>
            <!-- 記事が属するカテゴリーを表示 -->
            <?php $category = get_the_category(); ?>
            <span class="p-single__category"><?php echo $category[0]->cat_name; ?></span>
          <?php endif; ?>
        </div>
        <!-- アイキャッチ画像表示 -->
        <?php the_post_thumbnail('full'); ?>
        <div class="content">
          <!-- 記事の本文を表示 -->
          <?php the_content(); ?>
        </div>
      </div>
      
      <div class="p-single__inner">
        <div class="p-post-links l-post-links">
          <!-- 前後のページへのリンクを表示する（パラメーターは表示したい文字） -->
          <div class="p-post-links__post-link"><?php previous_post_link('%link', 'PREV'); ?></div>
          <!-- 一覧へ -->
          <?php if (is_singular('blog')): ?>
            <a class="p-post-links__archive-link" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">一覧</a>
          <?php else: ?>
            <a class="p-post-links__archive-link" href="<?php echo esc_url( home_url( '/news/' ) ); ?>">一覧</a>
          <?php endif; ?>
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

    <?php if (is_singular('blog')): ?>
      <!-- 関連記事 設定 -->
      <?php // 現在表示されている投稿と同じタームに分類された投稿を取得
      $taxonomy_slug = 'blog_category'; // タクソノミーのスラッグを指定
      $post_type_slug = 'blog'; // 投稿タイプのスラッグを指定
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
      // 同じカテゴリから記事を10件呼び出す
      $categories = get_the_category($post->ID);

      $category_ID = array();

      foreach ($categories as $category) :
        array_push($category_ID, $category->cat_ID);
      endforeach;

      $args = array(
        // 今読んでいる記事を除く
        'post__not_in' => array($post->ID),
        'posts_per_page' => 4,
        'category__in' => $category_ID,
        // ランダムに記事を選ぶ
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
              <!-- 記事の抜粋を表示、５５文字まで！！ -->
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