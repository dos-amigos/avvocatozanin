<?php snippet('head') ?>

  <!-- Skip-to-content accessibility link -->
  <a href="#main-content" class="skip-link">Vai al contenuto principale</a>

  <!-- Loading Screen (first-visit only — controlled by main.js) -->
  <div class="loading-screen" id="loading-screen" aria-hidden="true">
    <div class="loading-screen__inner">
      <img
        src="<?= url('assets/img/logo-studio-legale-zanin.png') ?>"
        alt="Studio Legale Zanin"
        class="loading-screen__logo"
        width="200"
        height="56"
      >
    </div>
  </div>

  <?php snippet('header') ?>

  <main id="main-content">

    <!-- Hero placeholder — Phase 2 builds the full hero -->
    <section class="home-hero-placeholder">
      <div>
        <p style="font-family: var(--font-body); font-size: var(--fs-small); letter-spacing: 0.1em; text-transform: uppercase; opacity: 0.6; margin-bottom: var(--space-4);">
          <?= esc($page->hero_eyebrow()) ?>
        </p>
        <h1 style="font-family: var(--font-display); font-size: var(--fs-hero); color: var(--color-white); margin-bottom: var(--space-5);">
          <?= $page->hero_title() ?>
        </h1>
        <p style="font-size: var(--fs-body); opacity: 0.8; max-width: 40ch; margin-inline: auto;">
          <?= esc($page->hero_subtitle()) ?>
        </p>
      </div>
    </section>

  </main>

  <?php snippet('footer') ?>

<?php snippet('scripts') ?>
