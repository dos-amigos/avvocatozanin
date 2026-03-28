<?php snippet('head') ?>

  <!-- Skip-to-content accessibility link -->
  <a href="#main-content" class="skip-link">Vai al contenuto</a>

  <?php snippet('header', ['noHero' => true]) ?>

  <main id="main-content">
    <div class="container" style="padding: 8rem 1rem 4rem;">
      <h1><?= $page->title() ?></h1>
      <?= $page->text()->kirbytext() ?>
    </div>
  </main>

  <?php snippet('footer') ?>

<?php snippet('scripts') ?>
