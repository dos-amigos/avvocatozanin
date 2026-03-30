<?php
$isServizi = Str::startsWith($page->uri(), 'servizi');
$isComeLavoro = $page->uri() === 'come-lavoro';
?>

<a href="#main-content" class="skip-link">Vai al contenuto principale</a>

  <div class="topbar">
    <div class="container topbar__container">
      <div class="topbar__contact">
        <a href="tel:+39<?= Str::replace($site->phone(), ['.', ' '], '') ?>" class="topbar__contact-item">
          <i data-lucide="phone" class="topbar__icon"></i>
          <span><?= $site->phone() ?></span>
        </a>
        <a href="mailto:<?= $site->email() ?>" class="topbar__contact-item">
          <i data-lucide="mail" class="topbar__icon"></i>
          <span><?= $site->email() ?></span>
        </a>
      </div>
      <div class="topbar__social">
        <a href="<?= $site->linkedin()->or('#') ?>" class="topbar__social-link" aria-label="LinkedIn">
          <i data-lucide="linkedin" class="topbar__social-icon"></i>
        </a>
        <a href="<?= $site->facebook()->or('#') ?>" class="topbar__social-link" aria-label="Facebook">
          <i data-lucide="facebook" class="topbar__social-icon"></i>
        </a>
      </div>
    </div>
  </div>

  <!-- Header -->
  <header class="header<?php e(isset($noHero) && $noHero, ' header--scrolled') ?>" role="banner"<?php e(isset($noHero) && $noHero, ' data-no-hero') ?>>
    <div class="container header__container">
      <!-- Logo -->
      <a href="<?= $site->url() ?>" class="header__logo" aria-label="Studio Legale Zanin — Home">
        <img src="<?= url('assets/img/logo-studio-legale-zanin.png') ?>" alt="Studio Legale Zanin" class="header__logo-img" width="180" height="50">
      </a>

      <!-- Desktop Navigation -->
      <nav class="header__nav" role="navigation" aria-label="Menu principale">
        <ul class="header__menu">
          <li class="header__menu-item">
            <a href="<?= url('chi-sono') ?>" class="header__link<?php e($page->uri() === 'chi-sono', ' header__link--active') ?>">Chi Sono</a>
          </li>
          <li class="header__menu-item header__menu-item--has-dropdown">
            <button class="header__link header__link--dropdown<?php e($isServizi, ' header__link--active') ?>" aria-expanded="false" aria-controls="mega-dropdown-servizi">
              Servizi
              <i data-lucide="chevron-down" class="header__dropdown-icon"></i>
            </button>
            <!-- Mega Dropdown -->
            <div class="mega-dropdown" id="mega-dropdown-servizi" aria-hidden="true">
              <div class="container mega-dropdown__container">
                <div class="mega-dropdown__grid mega-dropdown__grid--2col">
                  <a href="<?= url('servizi/diritto-di-famiglia') ?>" class="mega-dropdown__item">
                    <i data-lucide="users" class="mega-dropdown__icon"></i>
                    <div class="mega-dropdown__text">
                      <span class="mega-dropdown__title">Diritto di Famiglia</span>
                      <span class="mega-dropdown__description">Separazioni, divorzi, affidamento, successioni</span>
                    </div>
                  </a>
                  <a href="<?= url('servizi/diritto-immobiliare') ?>" class="mega-dropdown__item">
                    <i data-lucide="home" class="mega-dropdown__icon"></i>
                    <div class="mega-dropdown__text">
                      <span class="mega-dropdown__title">Diritto Immobiliare</span>
                      <span class="mega-dropdown__description">Compravendite, locazioni, condominio, usucapione</span>
                    </div>
                  </a>
                  <a href="<?= url('servizi/risarcimento-danni') ?>" class="mega-dropdown__item">
                    <i data-lucide="shield" class="mega-dropdown__icon"></i>
                    <div class="mega-dropdown__text">
                      <span class="mega-dropdown__title">Risarcimento Danni</span>
                      <span class="mega-dropdown__description">Incidenti, responsabilità civile, danni patrimoniali</span>
                    </div>
                  </a>
                  <a href="<?= url('servizi/recupero-crediti') ?>" class="mega-dropdown__item">
                    <i data-lucide="file-text" class="mega-dropdown__icon"></i>
                    <div class="mega-dropdown__text">
                      <span class="mega-dropdown__title">Recupero Crediti</span>
                      <span class="mega-dropdown__description">Decreti ingiuntivi, esecuzioni, recupero giudiziale</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </li>
          <li class="header__menu-item">
            <a href="<?= url('come-lavoro') ?>" class="header__link<?php e($isComeLavoro, ' header__link--active') ?>">Come Lavoro</a>
          </li>
          <li class="header__menu-item">
            <a href="<?= url('contatti') ?>" class="header__link<?php e($page->uri() === 'contatti', ' header__link--active') ?>">Contatti</a>
          </li>
        </ul>
      </nav>

      <!-- CTA Button -->
      <a href="<?= url('contatti') ?>" class="header__cta">Contattaci</a>

      <!-- Mobile Menu Toggle -->
      <button class="mobile-menu__toggle" aria-expanded="false" aria-controls="mobile-menu" aria-label="Menu">
        <span class="mobile-menu__bar"></span>
        <span class="mobile-menu__bar"></span>
        <span class="mobile-menu__bar"></span>
      </button>
    </div>
  </header>

  <!-- Mobile Menu Overlay -->
  <div class="mobile-menu" id="mobile-menu" aria-hidden="true">
    <nav class="mobile-menu__nav" aria-label="Menu mobile">
      <ul class="mobile-menu__list">
        <li class="mobile-menu__item"><a href="<?= url('chi-sono') ?>" class="mobile-menu__link">Chi Sono</a></li>
        <li class="mobile-menu__item"><a href="<?= url('servizi') ?>" class="mobile-menu__link">Servizi</a></li>
        <li class="mobile-menu__item"><a href="<?= url('come-lavoro') ?>" class="mobile-menu__link">Come Lavoro</a></li>
        <li class="mobile-menu__item"><a href="<?= url('contatti') ?>" class="mobile-menu__link">Contatti</a></li>
        <li class="mobile-menu__item"><a href="<?= url('contatti') ?>" class="mobile-menu__link mobile-menu__link--cta">Contattaci</a></li>
      </ul>
    </nav>
  </div>
