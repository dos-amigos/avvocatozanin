<?php snippet('head') ?>

  <!-- Skip-to-content accessibility link -->
  <a href="#main-content" class="skip-link">Vai al contenuto</a>

  <?php snippet('header') ?>

  <main id="main-content">

    <!-- ========== PAGE HERO ========== -->
    <?php
    $heroImg = $page->hero_image_url()->isNotEmpty()
      ? $page->hero_image_url()->value()
      : 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1920&q=80';
    ?>
    <section class="page-hero" style="--hero-bg: url('<?= esc($heroImg) ?>');">
      <div class="page-hero__overlay" aria-hidden="true"></div>
      <div class="page-hero__content container">
        <ol class="breadcrumb breadcrumb--dark" aria-label="Breadcrumb">
          <li class="breadcrumb__item"><a href="<?= $site->url() ?>">Home</a></li>
          <li class="breadcrumb__separator" aria-hidden="true">/</li>
          <li class="breadcrumb__item breadcrumb__item--active" aria-current="page"><?= $page->title() ?></li>
        </ol>
        <h1 class="page-hero__title"><?= $page->hero_title()->or($page->title()) ?></h1>
        <?php if ($page->hero_subtitle()->isNotEmpty()): ?>
        <p class="page-hero__subtitle"><?= $page->hero_subtitle() ?></p>
        <?php endif ?>
      </div>
    </section>

    <!-- ========== INTRO / METODOLOGIA ========== -->
    <?php if ($page->intro_body()->isNotEmpty()): ?>
    <section class="section" id="intro">
      <div class="container">
        <div class="cl-editorial">
          <p class="subtitle">Il Mio Metodo</p>
          <div class="cl-editorial__body">
            <?= $page->intro_body()->kirbytext() ?>
          </div>
        </div>
      </div>
    </section>
    <?php endif ?>

    <!-- ========== PROCESSO — vertical timeline ========== -->
    <?php if ($page->process_steps()->isNotEmpty()): ?>
    <section class="section section--grey" id="processo">
      <div class="container">
        <div class="cl-section-header">
          <p class="subtitle">Il Percorso Legale</p>
          <h2>Come Funziona</h2>
        </div>
        <div class="cl-timeline" role="list">
          <?php foreach ($page->process_steps()->toStructure() as $step): ?>
          <div class="cl-timeline__step" role="listitem">
            <div class="cl-timeline__marker" aria-hidden="true">
              <span class="cl-timeline__number"><?= $step->step() ?></span>
            </div>
            <div class="cl-timeline__content">
              <h3><?= $step->title() ?></h3>
              <?php if ($step->description()->isNotEmpty()): ?>
              <p><?= $step->description() ?></p>
              <?php endif ?>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    </section>
    <?php endif ?>

    <!-- ========== CTA FINALE ========== -->
    <?php if ($page->cta_title()->isNotEmpty()): ?>
    <section class="cta-section">
      <img src="https://images.unsplash.com/photo-1505664194779-8beaceb93744?w=1920&q=80" alt="" class="cta-section__bg" width="1920" height="800" loading="lazy">
      <div class="cta-section__overlay"></div>
      <div class="container cta-section__body">
        <h2 class="text-white"><?= $page->cta_title() ?></h2>
        <?php if ($page->cta_description()->isNotEmpty()): ?>
        <p><?= $page->cta_description() ?></p>
        <?php endif ?>
        <?php if ($page->cta_button_text()->isNotEmpty()): ?>
        <a href="<?= url($page->cta_button_url()) ?>" class="btn btn--accent btn--lg"><?= $page->cta_button_text() ?></a>
        <?php endif ?>
      </div>
    </section>
    <?php endif ?>

  </main>

  <?php snippet('footer') ?>

<?php snippet('scripts') ?>
