<?php $uri = $page->uri(); ?>

<a href="#main-content" class="skip-link">Vai al contenuto principale</a>

<header class="header transparent" id="header">
  <div class="container header__inner">
    <a href="<?= $site->url() ?>" class="header__logo">
      <img src="<?= url('assets/img/logo-zanin.png') ?>" alt="Studio Legale Zanin" class="header__logo-img">
    </a>

    <nav class="header__nav" id="desktop-nav">
      <ul>
        <li><a href="<?= url('chi-sono') ?>"<?php e($uri === 'chi-sono', ' class="active"') ?>>Chi Sono</a></li>
        <li class="has-mega">
          <a href="<?= url('servizi') ?>"<?php e(Str::startsWith($uri, 'servizi'), ' class="active"') ?>>Servizi</a>
          <div class="megamenu">
            <div class="container megamenu__inner">
              <div class="megamenu__grid">
                <a href="<?= url('servizi/diritto-di-famiglia') ?>" class="megamenu__item">
                  <div class="megamenu__icon"><i data-lucide="users"></i></div>
                  <div class="megamenu__text">
                    <span class="megamenu__label">Diritto di Famiglia</span>
                    <span class="megamenu__desc">Separazioni, divorzi, affidamento, successioni</span>
                  </div>
                </a>
                <a href="<?= url('servizi/diritto-immobiliare') ?>" class="megamenu__item">
                  <div class="megamenu__icon"><i data-lucide="home"></i></div>
                  <div class="megamenu__text">
                    <span class="megamenu__label">Diritto Immobiliare</span>
                    <span class="megamenu__desc">Compravendite, locazioni, condominio, usucapione</span>
                  </div>
                </a>
                <a href="<?= url('servizi/risarcimento-danni') ?>" class="megamenu__item">
                  <div class="megamenu__icon"><i data-lucide="shield"></i></div>
                  <div class="megamenu__text">
                    <span class="megamenu__label">Risarcimento Danni</span>
                    <span class="megamenu__desc">Incidenti, responsabilita civile, danni patrimoniali</span>
                  </div>
                </a>
                <a href="<?= url('servizi/recupero-crediti') ?>" class="megamenu__item">
                  <div class="megamenu__icon"><i data-lucide="file-text"></i></div>
                  <div class="megamenu__text">
                    <span class="megamenu__label">Recupero Crediti</span>
                    <span class="megamenu__desc">Decreti ingiuntivi, esecuzioni, procedure</span>
                  </div>
                </a>
              </div>
              <div class="megamenu__footer">
                <a href="<?= url('servizi') ?>">Tutti i Servizi <i data-lucide="arrow-right"></i></a>
              </div>
            </div>
          </div>
        </li>
        <li><a href="<?= url('come-lavoro') ?>"<?php e($uri === 'come-lavoro', ' class="active"') ?>>Come Lavoro</a></li>
      </ul>
    </nav>

    <div class="header__actions">
      <a href="tel:+39<?= Str::replace($site->phone(), ['.', ' '], '') ?>" class="header__phone">
        <i data-lucide="phone"></i> <?= $site->phone() ?>
      </a>
      <a href="<?= url('contatti') ?>" class="header__cta">Contattami</a>
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
