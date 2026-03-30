<?php snippet('head') ?>
<?php snippet('header') ?>

<main id="main-content">
  <div class="section">
    <div class="container">
      <?= $page->text()->kirbytext() ?>
    </div>
  </div>
</main>

<?php snippet('footer') ?>
<?php snippet('scripts') ?>
