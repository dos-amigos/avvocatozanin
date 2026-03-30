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
        <li class="has-sub">
          <a href="<?= url('servizi') ?>"<?php e(Str::startsWith($uri, 'servizi'), ' class="active"') ?>>Servizi</a>
          <ul class="submenu">
            <li><a href="<?= url('servizi/diritto-di-famiglia') ?>">Diritto di Famiglia</a></li>
            <li><a href="<?= url('servizi/diritto-immobiliare') ?>">Diritto Immobiliare</a></li>
            <li><a href="<?= url('servizi/risarcimento-danni') ?>">Risarcimento Danni</a></li>
            <li><a href="<?= url('servizi/recupero-crediti') ?>">Recupero Crediti</a></li>
          </ul>
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
