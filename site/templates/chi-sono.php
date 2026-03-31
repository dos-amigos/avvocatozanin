<?php snippet('head') ?>

  <!-- Skip-to-content accessibility link -->
  <a href="#main-content" class="skip-link">Vai al contenuto</a>

  <?php snippet('header') ?>

  <main id="main-content">

    <!-- ========== PAGE HERO ========== -->
    <?php
    $heroImg = $page->hero_image_url()->isNotEmpty()
      ? $page->hero_image_url()->value()
      : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=1920&q=80';
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

    <!-- ========== BIO ========== -->
    <section class="section" id="biografia">
      <div class="container">
        <div class="cs-bio">
          <div class="cs-bio__image">
            <?php
            $portraitUrl = $page->portrait_url()->isNotEmpty()
              ? $page->portrait_url()->value()
              : $heroImg;
            ?>
            <img
              src="<?= esc($portraitUrl) ?>"
              alt="Avv. Sebastiano Zanin, avvocato civilista a Este (PD)"
              width="600"
              height="700"
              loading="lazy"
            >
          </div>
          <div class="cs-bio__text">
            <?php if ($page->bio_body()->isNotEmpty()): ?>
              <?= $page->bio_body()->kirbytext() ?>
            <?php endif ?>
          </div>
        </div>
      </div>
    </section>

    <!-- ========== CREDENZIALI ========== -->
    <section class="section section--grey" id="credenziali">
      <div class="container">
        <div class="sv-section-header">
          <p class="subtitle">Credenziali</p>
          <h2>Abilitazione e Giurisdizione</h2>
        </div>
        <div class="cs-credentials">
          <div class="cs-credentials__item">
            <div class="cs-credentials__icon">
              <i data-lucide="award" aria-hidden="true"></i>
            </div>
            <div class="cs-credentials__body">
              <h3>Iscritto all'Ordine degli Avvocati di Padova</h3>
              <p><?= $page->ordine_numero()->or('(n. iscrizione)') ?></p>
            </div>
          </div>
          <div class="cs-credentials__item">
            <div class="cs-credentials__icon">
              <i data-lucide="map-pin" aria-hidden="true"></i>
            </div>
            <div class="cs-credentials__body">
              <h3>Giurisdizione</h3>
              <?php if ($page->giurisdizione()->isNotEmpty()): ?>
              <p><?= $page->giurisdizione() ?></p>
              <?php else: ?>
              <p>Opero presso il Tribunale di Este e il Tribunale di Padova, assistendo clienti in tutto il Veneto nelle materie del diritto civile.</p>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========== VALORI ========== -->
    <?php if ($page->valori()->isNotEmpty()): ?>
    <section class="section" id="valori">
      <div class="container">
        <div class="sv-section-header">
          <p class="subtitle">Valori</p>
          <h2><?= $page->valori_title()->or('I Miei Valori') ?></h2>
        </div>
        <div class="cs-values__grid">
          <?php foreach ($page->valori()->toStructure() as $valore): ?>
          <div class="cs-values__card">
            <div class="cs-values__icon">
              <i data-lucide="<?= $valore->icon()->isNotEmpty() ? $valore->icon() : 'star' ?>" aria-hidden="true"></i>
            </div>
            <h3><?= $valore->title() ?></h3>
            <?php if ($valore->description()->isNotEmpty()): ?>
            <p><?= $valore->description() ?></p>
            <?php endif ?>
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
