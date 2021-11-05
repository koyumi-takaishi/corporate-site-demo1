<?php get_header(); ?>

<div class="p-sub-mv">
  <div class="p-sub-mv__wrapper">
    <h2 class="p-sub-mv__title">企業概要</h2>
  </div>
  <picture class="p-sub-mv__img">
    <source srcset="<?php echo get_template_directory_uri() ?>/assets/img/common/overview-mv-pc.jpg" media="(min-width: 768px)"/>
    <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/overview-mv-sp.jpg" alt="オフィスの写真">
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

<section class="p-sub-overview l-sub-overview">
  <div class="l-inner">
    <div class="p-sub-overview__info p-overview-info">
      <div class="p-overview-info__wrapper">
        <div class="p-overview-info__title">会社名</div>
        <div class="p-overview-info__text">株式会社CodeUps</div>
      </div>
      <div class="p-overview-info__wrapper">
        <div class="p-overview-info__title">設立</div>
        <div class="p-overview-info__text">テキストが入ります。</div>
      </div>
      <div class="p-overview-info__wrapper">
        <div class="p-overview-info__title">資本金</div>
        <div class="p-overview-info__text">テキストが入ります。</div>
      </div>
      <div class="p-overview-info__wrapper">
        <div class="p-overview-info__title">売上高</div>
        <div class="p-overview-info__text">テキストが入ります。</div>
      </div>
      <div class="p-overview-info__wrapper">
        <div class="p-overview-info__title">代表者</div>
        <div class="p-overview-info__text">テキストが入ります。</div>
      </div>
      <div class="p-overview-info__wrapper">
        <div class="p-overview-info__title">従業員数</div>
        <div class="p-overview-info__text">テキストが入ります。</div>
      </div>
      <div class="p-overview-info__wrapper">
        <div class="p-overview-info__title">事業内容</div>
        <div class="p-overview-info__text">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</div>
      </div>
      <div class="p-overview-info__wrapper">
        <div class="p-overview-info__title">所在地</div>
        <div class="p-overview-info__text">東京駅</div>
      </div>
    </div>
    <div class="p-sub-overview__map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.8280303808788!2d139.76493611525882!3d35.68123618019432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188bfbd89f700b%3A0x277c49ba34ed38!2z5p2x5Lqs6aeF!5e0!3m2!1sja!2sjp!4v1636122919710!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>
</section>

<?php get_footer(); ?>