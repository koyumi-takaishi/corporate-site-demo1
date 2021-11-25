<?php
$home = esc_url( home_url( '/' ) );
$content = esc_url( home_url( '/content/' ) );
$news = esc_url( home_url( '/news/' ) );
$works = esc_url( home_url( '/works/' ) );
$overview = esc_url( home_url( '/overview/' ) );
$blog = esc_url( home_url( '/blog/' ) );
$contact = esc_url( home_url( '/contact/' ) );
?>

<?php if( !(is_page('contact') || is_page('thanks')) || is_404() ): ?>
  <section class="p-contact l-contact">
    <div class="l-inner">
      <div class="p-contact__title p-section-title">
        <h2 class="p-section-title__main">お問い合わせ</h2>
        <span class="p-section-title__sub">Contact</span>
      </div>
      <p class="p-contact__text">テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
      <div class="p-contact__button">
        <a class="c-button-main" href="<?php echo $contact; ?>">お問い合わせへ</a>
      </div>
    </div>
  </section>
<?php endif; ?>

<footer class="p-footer l-footer">
  <div class="p-footer__wrapper">  
    <h1 class="p-footer__logo">
      <a href="<?php echo $home; ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/logo.svg" alt="企業ロゴ"></a>
    </h1>
    <nav class="p-footer__nav p-footer-nav">
      <ul class="p-footer-nav__items">
        <li class="p-footer-nav__item p-footer-nav__item--top">
          <a href="<?php echo $home; ?>">トップ</a>
        </li>
        <li class="p-footer-nav__item">
          <a href="<?php echo $news; ?>">お知らせ</a>
        </li>
        <li class="p-footer-nav__item">
          <a href="<?php echo $content; ?>">事業内容</a>
        </li>
        <li class="p-footer-nav__item">
          <a href="<?php echo $works; ?>">制作実績</a>
        </li>
        <li class="p-footer-nav__item">
          <a href="<?php echo $overview; ?>">企業概要</a>
        </li>
        <li class="p-footer-nav__item">
          <a href="<?php echo $blog; ?>">ブログ</a>
        </li>
        <li class="p-footer-nav__item">
          <a href="<?php echo $contact; ?>">お問い合わせ</a>
        </li>
      </ul>
    </nav>
  </div>
  <div class="p-footer__copyright">&copy; 2021 CodeUps Inc.</div>
  <button class="c-page-top-button js-page-top-button">
    <span class="c-page-top-button__img">
    </span>
  </button>
</footer>

<?php wp_footer(); ?>
</body>
</html>