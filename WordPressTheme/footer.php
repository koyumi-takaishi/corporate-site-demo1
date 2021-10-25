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

<footer class="p-footer l-footer">
  <h1 class="p-footer__logo">
    <a href="<?php echo $home; ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/common/logo.svg" alt="企業ロゴ"></a>
  </h1>
  <nav class="p-footer__nav p-drawer l-drawer js-drawer">
    <ul class="p-drawer__items">
      <li class="p-drawer__item p-drawer__item--top">
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
</footer>
<?php wp_footer(); ?>
</body>
</html>