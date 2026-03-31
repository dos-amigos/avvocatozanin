<?php snippet('head') ?>

  <!-- Skip-to-content accessibility link -->
  <a href="#main-content" class="skip-link">Vai al contenuto</a>

  <?php snippet('header') ?>

  <main id="main-content">

    <!-- ========== PAGE HERO ========== -->
    <section class="page-hero">
      <div class="page-hero__bg">
        <?php $heroUrl = $page->hero_image_url()->isNotEmpty() ? $page->hero_image_url()->value() : 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1920&q=80' ?>
        <img
          src="<?= esc($heroUrl) ?>"
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
          <li class="breadcrumb__item"><a href="<?= $page->parent()->url() ?>"><?= $page->parent()->title() ?></a></li>
          <li class="breadcrumb__separator" aria-hidden="true">/</li>
          <li class="breadcrumb__item breadcrumb__item--active" aria-current="page"><?= $page->title() ?></li>
        </ol>
        <h1 class="page-hero__title"><?= $page->hero_title()->or($page->title()) ?></h1>
        <?php if ($page->hero_subtitle()->isNotEmpty()): ?>
        <p class="page-hero__subtitle"><?= $page->hero_subtitle() ?></p>
        <?php endif ?>
      </div>
    </section>

    <!-- ========== SIDEBAR + MAIN CONTENT GRID ========== -->
    <section class="section">
      <div class="container">
        <div class="service-navigator">

          <!-- Main Content -->
          <div class="service-navigator__main">

            <!-- A. Panoramica -->
            <div id="panoramica" class="service-section">
              <h2 class="service-section__title">Panoramica</h2>
              <?php if ($page->panoramica_body()->isNotEmpty()): ?>
              <div class="service-section__body">
                <?= $page->panoramica_body()->kirbytext() ?>
              </div>
              <?php endif ?>
            </div>

            <!-- B. Cosa include -->
            <?php if ($page->includes()->isNotEmpty()): ?>
            <div id="cosa-include" class="service-section">
              <h2 class="service-section__title">Cosa include il servizio</h2>
              <div class="service-includes">
                <?php foreach ($page->includes()->toStructure() as $item): ?>
                <div class="service-includes__item">
                  <div class="service-includes__icon">
                    <i data-lucide="<?= $item->icon()->isNotEmpty() ? $item->icon() : 'check-circle' ?>"></i>
                  </div>
                  <h3 class="service-includes__title"><?= $item->title() ?></h3>
                  <?php if ($item->description()->isNotEmpty()): ?>
                  <p class="service-includes__desc"><?= $item->description() ?></p>
                  <?php endif ?>
                </div>
                <?php endforeach ?>
              </div>
            </div>
            <?php endif ?>

            <!-- C. Il Processo — Scroll-driven Timeline -->
            <?php if ($page->process_steps()->isNotEmpty()): ?>
            <div id="il-processo" class="service-section">
              <h2 class="service-section__title">Il nostro processo</h2>
              <div class="process-timeline">
                <div class="process-timeline__track" aria-hidden="true">
                  <div class="process-timeline__progress"></div>
                </div>
                <?php foreach ($page->process_steps()->toStructure() as $step): ?>
                <div class="process-timeline__step">
                  <div class="process-timeline__marker">
                    <span class="process-timeline__number"><?= $step->step() ?></span>
                  </div>
                  <div class="process-timeline__content">
                    <h3 class="process-timeline__title"><?= $step->title() ?></h3>
                    <?php if ($step->description()->isNotEmpty()): ?>
                    <p class="process-timeline__desc"><?= $step->description() ?></p>
                    <?php endif ?>
                  </div>
                </div>
                <?php endforeach ?>
              </div>
            </div>
            <?php endif ?>

            <!-- D. FAQ -->
            <?php if ($page->faq()->isNotEmpty()): ?>
            <div id="faq" class="service-section">
              <h2 class="service-section__title">Domande frequenti</h2>
              <div class="service-accordion" data-accordion="faq">
                <?php foreach ($page->faq()->toStructure() as $item): ?>
                <div class="service-accordion__item" data-accordion-item>
                  <button class="service-accordion__btn" aria-expanded="false">
                    <span class="service-accordion__btn-content">
                      <span class="service-accordion__btn-text"><?= $item->question() ?></span>
                    </span>
                    <i data-lucide="chevron-down" class="service-accordion__chevron"></i>
                  </button>
                  <div class="service-accordion__panel" aria-hidden="true">
                    <div class="service-accordion__panel-inner">
                      <p><?= $item->answer() ?></p>
                    </div>
                  </div>
                </div>
                <?php endforeach ?>
              </div>
            </div>
            <?php endif ?>

          </div>

          <!-- Sidebar -->
          <aside class="service-sidebar">
            <!-- Scroll-spy Navigation -->
            <nav class="service-sidebar__nav" aria-label="Navigazione sezioni">
              <ul class="service-sidebar__list">
                <li><a href="#panoramica" class="service-sidebar__link is-active">Panoramica</a></li>
                <?php if ($page->includes()->isNotEmpty()): ?>
                <li><a href="#cosa-include" class="service-sidebar__link">Cosa include</a></li>
                <?php endif ?>
                <?php if ($page->process_steps()->isNotEmpty()): ?>
                <li><a href="#il-processo" class="service-sidebar__link">Il Processo</a></li>
                <?php endif ?>
                <?php if ($page->faq()->isNotEmpty()): ?>
                <li><a href="#faq" class="service-sidebar__link">FAQ</a></li>
                <?php endif ?>
              </ul>
            </nav>
            <!-- Contact Card -->
            <div class="service-sidebar__contact">
              <h3 class="service-sidebar__contact-title">Il vostro referente</h3>
              <p class="service-sidebar__contact-name">Avv. Sebastiano Zanin</p>
              <p class="service-sidebar__contact-role">Avvocato Civilista</p>
              <div class="service-sidebar__contact-info">
                <?php if ($site->phone()->isNotEmpty()): ?>
                <a href="tel:<?= Str::replace($site->phone(), ' ', '') ?>" class="service-sidebar__contact-item">
                  <i data-lucide="phone" class="service-sidebar__contact-icon"></i>
                  <span><?= $site->phone() ?></span>
                </a>
                <?php endif ?>
                <?php if ($site->email()->isNotEmpty()): ?>
                <a href="mailto:<?= $site->email() ?>" class="service-sidebar__contact-item">
                  <i data-lucide="mail" class="service-sidebar__contact-icon"></i>
                  <span><?= $site->email() ?></span>
                </a>
                <?php endif ?>
              </div>
              <a href="<?= url('contatti') ?>" class="btn btn--primary service-sidebar__cta">Contattaci</a>
            </div>
          </aside>

        </div>
      </div>
    </section>

    <!-- ========== CTA FINALE ========== -->
    <?php if ($page->cta_title()->isNotEmpty()): ?>
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
