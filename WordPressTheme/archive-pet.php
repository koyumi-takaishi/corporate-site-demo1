<?php get_header(); ?>

<div class="p-sub-mv">
  <div class="p-sub-mv__wrapper">
    <h2 class="p-sub-mv__title">ペット</h2>
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

  <!-- フォームパーツ -->
<form action="<?=esc_url(home_url('/pet/'))?>">

キーワード検索<br>
<input type="text" name="foo" value="<?=esc_html(get_query_var('foo'))?>" placeholder="キーワードを入力">

<br><br>ペットの種類（カスタムタクソノミー）<br>
<label><input type="radio" name="pet_breed" value="犬"<?=get_query_var('pet_breed')==='犬'?' checked':''?>>犬</label>
<label><input type="radio" name="pet_breed" value="猫"<?=get_query_var('pet_breed')==='猫'?' checked':''?>>猫</label>
<label><input type="radio" name="pet_breed" value="その他"<?=get_query_var('pet_breed')==='その他'?' checked':''?>>その他</label>

<br><br>性別（カスタムフィールドのタイプ：ラジオボタン）<br>
<select name="pet-gender">
  <option value="">選択してください</option>
  <option value="男の子"<?=get_query_var('pet-gender')==='男の子'?' selected':''?>>男の子</option>
  <option value="女の子"<?=get_query_var('pet-gender')==='女の子'?' selected':''?>>女の子</option>
  <option value="その他"<?=get_query_var('pet-gender')==='その他'?' selected':''?>>その他</option>
</select>

<br><br>価格（カスタムフィールドのタイプ：数値）<br>
<select name="pet-price">
  <option value="">選択してください</option>
  <option value="100000"<?=get_query_var('pet-price')==='100000'?' selected':''?>>100000円以下</option>
  <option value="200000"<?=get_query_var('pet-price')==='200000'?' selected':''?>>200000円以下</option>
  <option value="その他"<?=get_query_var('pet-price')==='その他'?' selected':''?>>その他</option>
</select>

<br><br>店舗（カスタムフィールドのタイプ：ラジオボタン）<br>
<select name="pet-shop">
  <option value="">選択してください</option>
  <option value="北海道○○店"<?=get_query_var('pet-shop')==='北海道○○店'?' selected':''?>>北海道○○店</option>
  <option value="東京△△店"<?=get_query_var('pet-shop')==='東京△△店'?' selected':''?>>東京△△店</option>
  <option value="愛知××店"<?=get_query_var('pet-shop')==='愛知××店'?' selected':''?>>愛知××店</option>
  <option value="大阪○○店"<?=get_query_var('pet-shop')==='大阪○○店'?' selected':''?>>大阪○○店</option>
  <option value="福岡△△店"<?=get_query_var('pet-shop')==='福岡△△店'?' selected':''?>>福岡△△店</option>
</select>

<br><br>毛色（カスタムフィールドのタイプ：ラジオボタン）<br>
<label><input type="radio" name="pet-color" value="ホワイト系"<?=get_query_var('pet-color')==='ホワイト系'?' checked':''?>>ホワイト系</label>
<label><input type="radio" name="pet-color" value="クリーム系"<?=get_query_var('pet-color')==='クリーム系'?' checked':''?>>クリーム系</label>
<label><input type="radio" name="pet-color" value="グレー系"<?=get_query_var('pet-color')==='グレー系'?' checked':''?>>グレー系</label>
<label><input type="radio" name="pet-color" value="ブラウン系"<?=get_query_var('pet-color')==='ブラウン系'?' checked':''?>>ブラウン系</label>
<label><input type="radio" name="pet-color" value="キャリコ系"<?=get_query_var('pet-color')==='キャリコ系'?' checked':''?>>キャリコ系</label>
<label><input type="radio" name="pet-color" value="その他"<?=get_query_var('pet-color')==='その他'?' checked':''?>>その他</label>

<br><br>その他（カスタムフィールドのタイプ：チェックボックス）<br>
<label><input type="checkbox" name="pet-other[]" value="セール中"<?=get_query_var('pet-other')==='セール中'?' checked':''?>>セール中</label>
<label><input type="checkbox" name="pet-other[]" value="ワクチン接種済み"<?=get_query_var('pet-other')==='ワクチン接種済み'?' checked':''?>>ワクチン接種済み</label>
<label><input type="checkbox" name="pet-other[]" value="トリミング済み"<?=get_query_var('pet-other')==='トリミング済み'?' checked':''?>>トリミング済み</label>
<label><input type="checkbox" name="pet-other[]" value="セット料金あり"<?=get_query_var('pet-other')==='セット料金あり'?' checked':''?>>セット料金あり</label>

<?php wp_nonce_field('my-archive-nonce', 'nonce'); ?>
<br><br><button type="submit" style="color:red;">検索する</button>

</form>

    <div class="p-sub-blog__cards p-cards">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
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
      <?php else : ?>
        投稿がありません
      <?php endif; ?>
    </div>
  </div>

  <div class="p-pagenavi l-pagenavi">
  <?php wp_pagenavi(); ?>
  </div>
</section>

<?php get_footer(); ?>