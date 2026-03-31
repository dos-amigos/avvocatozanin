<?php $uri = $page->uri(); ?>

<a href="#main-content" class="skip-link">Vai al contenuto principale</a>

<header class="header transparent" id="header">
  <div class="container header__inner">
    <a href="<?= $site->url() ?>" class="header__logo">
      <strong>Zanin</strong><span>Studio Legale</span>
    </a>

    <nav class="header__nav" id="desktop-nav">
      <ul>
        <li><a href="<?= url('chi-sono') ?>"<?php e($uri === 'chi-sono', ' class="active"') ?>>Chi Sono</a></li>
        <li class="has-mega">
          <a href="<?= url('servizi') ?>"<?php e(Str::startsWith($uri, 'servizi'), ' class="active"') ?>>Servizi</a>
          <div class="megamenu">
            <div class="megamenu__grid">
              <a href="<?= url('servizi/diritto-di-famiglia') ?>" class="megamenu__item">
                <div class="megamenu__img">
                  <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?w=200&h=200&fit=crop&q=80" alt="Diritto di Famiglia" loading="lazy">
                </div>
                <span class="megamenu__label">Diritto di Famiglia</span>
              </a>
              <a href="<?= url('servizi/diritto-immobiliare') ?>" class="megamenu__item">
                <div class="megamenu__img">
                  <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=200&h=200&fit=crop&q=80" alt="Diritto Immobiliare" loading="lazy">
                </div>
                <span class="megamenu__label">Diritto Immobiliare</span>
              </a>
              <a href="<?= url('servizi/risarcimento-danni') ?>" class="megamenu__item">
                <div class="megamenu__img">
                  <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=200&h=200&fit=crop&q=80" alt="Risarcimento Danni" loading="lazy">
                </div>
                <span class="megamenu__label">Risarcimento Danni</span>
              </a>
              <a href="<?= url('servizi/recupero-crediti') ?>" class="megamenu__item">
                <div class="megamenu__img">
                  <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=200&h=200&fit=crop&q=80" alt="Recupero Crediti" loading="lazy">
                </div>
                <span class="megamenu__label">Recupero Crediti</span>
              </a>
            </div>
            <div class="megamenu__footer">
              <a href="<?= url('servizi') ?>">Tutti i Servizi <i data-lucide="arrow-right"></i></a>
            </div>
          </div>
        </li>
        <li><a href="<?= url('come-lavoro') ?>"<?php e($uri === 'come-lavoro', ' class="active"') ?>>Come Lavoro</a></li>
        <li><a href="<?= url('contatti') ?>"<?php e($uri === 'contatti', ' class="active"') ?>>Contatti</a></li>
      </ul>
    </nav>

    <div class="header__actions">
      <a href="tel:+39<?= Str::replace($site->phone(), ['.', ' '], '') ?>" class="header__phone">
        <i data-lucide="phone"></i> <?= $site->phone() ?>
      </a>
      <a href="<?= url('contatti') ?>" class="header__cta">Consulenza Gratuita</a>
    </div>

    <button class="burger" id="burger" aria-label="Menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<!-- Mobile menu -->
<div class="mobile-overlay" id="mobile-overlay" aria-hidden="true">
  <nav>
    <a href="<?= url('chi-sono') ?>">Chi Sono</a>
    <a href="<?= url('servizi') ?>">Servizi</a>
    <a href="<?= url('come-lavoro') ?>">Come Lavoro</a>
    <a href="<?= url('contatti') ?>">Contatti</a>
  </nav>
  <div class="mobile-overlay__bottom">
    <a href="tel:+39<?= Str::replace($site->phone(), ['.', ' '], '') ?>"><?= $site->phone() ?></a>
    <a href="mailto:<?= $site->email() ?>"><?= $site->email() ?></a>
    <a href="<?= url('contatti') ?>" class="mobile-overlay__cta">Consulenza Gratuita</a>
  </div>
</div>
