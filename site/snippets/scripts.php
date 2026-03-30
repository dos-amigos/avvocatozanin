  <!-- CDN scripts — EXACT ORDER is critical (per D-14) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
  <script src="https://unpkg.com/lenis@1.3.17/dist/lenis.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- Local JS files -->
  <?= js('assets/js/scroll.js') ?>
  <?= js('assets/js/animations.js?v=' . filemtime(kirby()->root() . '/assets/js/animations.js')) ?>
  <?= js('assets/js/components/scroll-top.js') ?>
  <?= js('assets/js/navigation.js') ?>
  <?= js('assets/js/main.js') ?>

  <!-- Page-specific JS (conditional by template) -->
  <?php
  $pageJs = [
    'contatti' => ['assets/js/pages/contatti.js'],
    'home'     => ['assets/js/pages/home.js'],
  ];
  $template = $page->intendedTemplate()->name();
  if (isset($pageJs[$template])):
    foreach ($pageJs[$template] as $jsFile):
  ?>
  <?= js($jsFile) ?>
  <?php
    endforeach;
  endif;
  ?>

</body>
</html>
