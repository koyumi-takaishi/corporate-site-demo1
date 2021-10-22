<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Noto+Serif+JP:wght@400;700&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <!-- 各ページリンク -->
  <?php
  $home = esc_url( home_url( '/' ) );
  $content = esc_url( home_url( '/content/' ) );
  $news = esc_url( home_url( '/news/' ) );
  $works = esc_url( home_url( '/works/' ) );
  $overview = esc_url( home_url( '/overview/' ) );
  $blog = esc_url( home_url( '/blog/' ) );
  $contact = esc_url( home_url( '/contact/' ) );
  ?>

  <header class="p-header l-header js-header-color-change">
    <h1 class="p-header__logo">
      <a href="<?php echo $home; ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/logo.svg" alt="企業ロゴ"></a>
    </h1>
    <div class="p-header__hamburger c-hamburger js-hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <nav class="p-header__nav p-drawer l-drawer js-drawer">
      <ul class="p-drawer__items">
        <li class="p-drawer__item">
          <a href="<?php echo $home; ?>">トップ</a>
        </li>
        <li class="p-drawer__item">
          <a href="<?php echo $news; ?>">お知らせ</a>
        </li>
        <li class="p-drawer__item">
          <a href="<?php echo $content; ?>">事業内容</a>
        </li>
        <li class="p-drawer__item">
          <a href="<?php echo $works; ?>">制作実績</a>
        </li>
        <li class="p-drawer__item">
          <a href="<?php echo $overview; ?>">企業概要</a>
        </li>
        <li class="p-drawer__item">
          <a href="<?php echo $blog; ?>">ブログ</a>
        </li>
        <li class="p-drawer__item p-drawer__item--contact">
          <a href="<?php echo $contact; ?>">お問い合わせ</a>
        </li>
      </ul>
    </nav>
  </header>