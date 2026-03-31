<?php snippet('head') ?>

  <!-- Skip-to-content accessibility link -->
  <a href="#main-content" class="skip-link">Vai al contenuto</a>

  <?php snippet('header') ?>

  <main id="main-content">

    <!-- ========== SPLIT-SCREEN HERO ========== -->
    <section class="sv-hero">
      <div class="sv-hero__text">
        <div class="sv-hero__text-inner">
          <ol class="breadcrumb breadcrumb--dark" aria-label="Breadcrumb">
            <li class="breadcrumb__item"><a href="<?= $site->url() ?>">Home</a></li>
            <li class="breadcrumb__separator" aria-hidden="true">/</li>
            <li class="breadcrumb__item"><a href="<?= $page->parent()->url() ?>"><?= $page->parent()->title() ?></a></li>
            <li class="breadcrumb__separator" aria-hidden="true">/</li>
            <li class="breadcrumb__item breadcrumb__item--active" aria-current="page"><?= $page->title() ?></li>
          </ol>
          <h1 class="sv-hero__title"><?= $page->hero_title()->or($page->title()) ?></h1>
          <?php if ($page->hero_subtitle()->isNotEmpty()): ?>
          <p class="sv-hero__subtitle"><?= $page->hero_subtitle() ?></p>
          <?php endif ?>
          <a href="<?= url('contatti') ?>" class="btn btn--accent">Prenota Consulenza</a>
        </div>
      </div>
      <div class="sv-hero__image">
        <?php $heroUrl = $page->hero_image_url()->isNotEmpty() ? $page->hero_image_url()->value() : 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1920&q=80' ?>
        <img src="<?= esc($heroUrl) ?>" alt="" width="960" height="800" loading="eager">
      </div>
    </section>

    <!-- ========== PANORAMICA — editorial centered column ========== -->
    <?php if ($page->panoramica_body()->isNotEmpty()): ?>
    <section class="section" id="panoramica">
      <div class="sv-editorial">
        <p class="subtitle">Panoramica</p>
        <div class="sv-editorial__body">
          <?= $page->panoramica_body()->kirbytext() ?>
        </div>
      </div>
    </section>
    <?php endif ?>

    <!-- ========== COSA INCLUDE — alternating rows ========== -->
    <?php if ($page->includes()->isNotEmpty()): ?>
    <section class="section section--grey" id="cosa-include">
      <div class="container">
        <div class="sv-section-header">
          <p class="subtitle">Cosa Include</p>
          <h2>I servizi che offriamo</h2>
        </div>
        <div class="sv-includes">
          <?php foreach ($page->includes()->toStructure() as $i => $item): ?>
          <div class="sv-includes__row<?php e($i % 2 !== 0, ' sv-includes__row--reverse') ?>">
            <div class="sv-includes__icon-wrap">
              <div class="sv-includes__icon">
                <i data-lucide="<?= $item->icon()->isNotEmpty() ? $item->icon() : 'check-circle' ?>"></i>
              </div>
            </div>
            <div class="sv-includes__content">
              <h3><?= $item->title() ?></h3>
              <?php if ($item->description()->isNotEmpty()): ?>
              <p><?= $item->description() ?></p>
              <?php endif ?>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    </section>
    <?php endif ?>

    <!-- ========== IL PROCESSO — horizontal timeline on dark bg ========== -->
    <?php if ($page->process_steps()->isNotEmpty()): ?>
    <section class="section section--dark" id="il-processo">
      <div class="container">
        <div class="sv-section-header sv-section-header--light">
          <p class="subtitle">Come Funziona</p>
          <h2 class="text-white">Il Nostro Processo</h2>
        </div>
        <div class="sv-timeline">
          <div class="sv-timeline__line" aria-hidden="true"></div>
          <?php foreach ($page->process_steps()->toStructure() as $step): ?>
          <div class="sv-timeline__step">
            <div class="sv-timeline__number"><?= $step->step() ?></div>
            <h3 class="sv-timeline__title"><?= $step->title() ?></h3>
            <?php if ($step->description()->isNotEmpty()): ?>
            <p class="sv-timeline__desc"><?= $step->description() ?></p>
            <?php endif ?>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    </section>
    <?php endif ?>

    <!-- ========== STATS BAND ========== -->
    <section class="sv-stats">
      <div class="container sv-stats__inner">
        <div class="sv-stats__item">
          <strong data-count="15">0</strong><span>+</span>
          <p>Anni Esperienza</p>
        </div>
        <div class="sv-stats__item">
          <strong data-count="500">0</strong><span>+</span>
          <p>Casi Trattati</p>
        </div>
        <div class="sv-stats__item">
          <strong>Este (PD)</strong>
          <p>Sede dello Studio</p>
        </div>
      </div>
    </section>

    <!-- ========== FAQ — clean accordion ========== -->
    <?php if ($page->faq()->isNotEmpty()): ?>
    <section class="section" id="faq">
      <div class="sv-editorial">
        <p class="subtitle">FAQ</p>
        <h2>Domande Frequenti</h2>
        <div class="sv-accordion" data-accordion="faq">
          <?php foreach ($page->faq()->toStructure() as $item): ?>
          <div class="sv-accordion__item" data-accordion-item>
            <button class="sv-accordion__btn" aria-expanded="false">
              <span><?= $item->question() ?></span>
              <i data-lucide="chevron-down" class="sv-accordion__chevron"></i>
            </button>
            <div class="sv-accordion__panel" aria-hidden="true">
              <div class="sv-accordion__panel-inner">
                <p><?= $item->answer() ?></p>
              </div>
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

  <!-- ========== STICKY CONTACT BAR ========== -->
  <div class="sv-sticky-bar" id="sv-sticky-bar">
    <div class="container sv-sticky-bar__inner">
      <span class="sv-sticky-bar__name">Avv. Sebastiano Zanin</span>
      <div class="sv-sticky-bar__actions">
        <a href="tel:+39<?= Str::replace($site->phone(), ['.', ' '], '') ?>" class="sv-sticky-bar__phone">
          <i data-lucide="phone"></i> <?= $site->phone() ?>
        </a>
        <a href="<?= url('contatti') ?>" class="btn btn--accent btn--sm">Contattaci</a>
      </div>
    </div>
  </div>

  <?php snippet('footer') ?>

<?php snippet('scripts') ?>
