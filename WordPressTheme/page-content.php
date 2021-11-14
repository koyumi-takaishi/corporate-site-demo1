<?php get_header(); ?>

<div class="p-sub-mv">
  <div class="p-sub-mv__wrapper">
    <h2 class="p-sub-mv__title">事業内容</h2>
  </div>
  <picture class="p-sub-mv__img">
    <source srcset="<?php echo get_template_directory_uri() ?>/assets/img/common/content-mv-pc.jpg" media="(min-width: 768px)" />
    <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/content-mv-sp.jpg" alt="電球を両手で持っている写真">
  </picture>
</div>

<div class="p-breadcrumb l-breadcrumb">
  <div class="l-inner">
    <?php if (function_exists('bcn_display')) {
      bcn_display();
    } ?>
  </div>
</div>

<section class="p-sub-content l-sub-content">
  <div class="l-inner">
    <div class="p-sub-content__main">
      <h3 class="c-content-title c-content-title--center">企業理念</h3>
      <p class="p-sub-content__text c-content-text c-content-text--center">説明が入ります。説明が入ります。説明が入ります。説明が入ります。<br>説明が入ります。説明が入ります。説明が入ります。説明が入ります。</p>
    </div>
    <div class="p-sub-content__detail p-sub-content-detail">
      <div class="p-sub-content-detail__wrapper" id="philosophy1">
        <div class="p-sub-content-detail__img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/content-detail-img1.jpg" alt="テーブルで3人がパソコンを開いて話している写真">
        </div>
        <div class="p-sub-content-detail__body">
          <h3 class="c-content-title">企業理念1</h3>
          <p class="p-sub-content-detail__text c-content-text">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
        </div>
      </div>
      <div class="p-sub-content-detail__wrapper" id="philosophy2">
        <div class="p-sub-content-detail__img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/content-detail-img2.jpg" alt="パソコン画面にグラフが表示されている写真">
        </div>
        <div class="p-sub-content-detail__body">
          <h3 class="c-content-title">企業理念2</h3>
          <p class="p-sub-content-detail__text c-content-text">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
        </div>
      </div>
      <div class="p-sub-content-detail__wrapper" id="philosophy3">
        <div class="p-sub-content-detail__img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/content-detail-img3.jpg" alt="女性がスマホをタップしている写真">
        </div>
        <div class="p-sub-content-detail__body">
          <h3 class="c-content-title">企業理念3</h3>
          <p class="p-sub-content-detail__text c-content-text">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
        </div>
      </div>
    </div>
  </div>
</section>


<?php get_footer(); ?>