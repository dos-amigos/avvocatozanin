<?php snippet('head') ?>

  <!-- Skip-to-content accessibility link -->
  <a href="#main-content" class="skip-link">Vai al contenuto</a>

  <?php snippet('header') ?>

  <main id="main-content">

    <!-- ========== PAGE HERO ========== -->
    <section class="page-hero">
      <div class="page-hero__bg">
        <img
          src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1920&q=80"
          alt=""
          width="1920"
          height="800"
          loading="eager"
        >
        <div class="page-hero__overlay"></div>
      </div>
      <div class="container page-hero__content">
        <ol class="breadcrumb" aria-label="Breadcrumb">
          <li class="breadcrumb__item"><a href="<?= $site->url() ?>">Home</a></li>
          <li class="breadcrumb__separator" aria-hidden="true">/</li>
          <li class="breadcrumb__item breadcrumb__item--active" aria-current="page"><?= $page->hero_title()->or($page->title()) ?></li>
        </ol>
        <h1 class="page-hero__title"><?= $page->hero_title()->or($page->title()) ?></h1>
        <?php if ($page->hero_subtitle()->isNotEmpty()): ?>
        <p class="page-hero__subtitle"><?= $page->hero_subtitle() ?></p>
        <?php endif ?>
      </div>
    </section>

    <!-- ========== SERVIZI ========== -->
    <section class="section" id="lista-servizi">
      <div class="container">
        <div class="section-header">
          <?php if ($page->servizi_eyebrow()->isNotEmpty()): ?>
          <p class="section-header__eyebrow"><?= $page->servizi_eyebrow() ?></p>
          <?php endif ?>
          <?php if ($page->servizi_title()->isNotEmpty()): ?>
          <h2 class="section-header__title"><?= $page->servizi_title() ?></h2>
          <?php endif ?>
          <?php if ($page->servizi_description()->isNotEmpty()): ?>
          <p class="section-header__description"><?= $page->servizi_description() ?></p>
          <?php endif ?>
        </div>
        <div class="services-grid">
          <?php foreach ($page->children()->listed() as $servizio): ?>
          <a href="<?= $servizio->url() ?>" class="service-card">
            <div class="service-card__icon">
              <i data-lucide="<?= $servizio->icon() ?>"></i>
            </div>
            <h3 class="service-card__title"><?= $servizio->card_title()->or($servizio->title()) ?></h3>
            <?php if ($servizio->card_description()->isNotEmpty()): ?>
            <p class="service-card__description"><?= $servizio->card_description() ?></p>
            <?php endif ?>
            <span class="service-card__arrow">
              <i data-lucide="arrow-right"></i>
            </span>
          </a>
          <?php endforeach ?>
        </div>
      </div>
    </section>

    <!-- ========== CTA FINALE ========== -->
    <section class="cta-section">
      <img
        src="https://images.unsplash.com/photo-1505664194779-8beaceb93744?w=1920&q=80"
        alt=""
        class="cta-section__bg"
        width="1920"
        height="800"
        loading="lazy"
      >
      <div class="cta-section__overlay"></div>
      <div class="container cta-section__body">
        <?php if ($page->cta_title()->isNotEmpty()): ?>
        <h2 class="text-white"><?= $page->cta_title() ?></h2>
        <?php endif ?>
        <?php if ($page->cta_description()->isNotEmpty()): ?>
        <p><?= $page->cta_description() ?></p>
        <?php endif ?>
        <?php if ($page->cta_button_text()->isNotEmpty()): ?>
        <a href="<?= url($page->cta_button_url()) ?>" class="btn btn--accent btn--lg"><?= $page->cta_button_text() ?></a>
        <?php endif ?>
      </div>
    </section>

  </main>

  <?php snippet('footer') ?>

<?php snippet('scripts') ?>
