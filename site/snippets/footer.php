  <footer class="footer" role="contentinfo">
    <div class="container">
      <div class="footer__grid">
        <!-- Column 1: Logo + Description + Social -->
        <div class="footer__column footer__column--about">
          <a href="<?= $site->url() ?>" class="footer__logo" aria-label="Studio Legale Zanin — Home">
            <img src="<?= url('assets/img/logo-studio-legale-zanin.png') ?>" alt="Studio Legale Zanin" class="footer__logo-img" width="160" height="45">
          </a>
          <p class="footer__description">
            <?= $site->site_description() ?>
          </p>
          <div class="footer__social">
            <a href="<?= $site->linkedin()->or('#') ?>" class="footer__social-link" aria-label="LinkedIn">
              <i data-lucide="linkedin"></i>
            </a>
            <a href="<?= $site->facebook()->or('#') ?>" class="footer__social-link" aria-label="Facebook">
              <i data-lucide="facebook"></i>
            </a>
          </div>
        </div>

        <!-- Column 2: Navigazione -->
        <div class="footer__column">
          <h3 class="footer__heading">Navigazione</h3>
          <ul class="footer__links">
            <li><a href="<?= url('chi-sono') ?>" class="footer__link">Chi Sono</a></li>
            <li><a href="<?= url('servizi') ?>" class="footer__link">Servizi</a></li>
            <li><a href="<?= url('come-lavoro') ?>" class="footer__link">Come Lavoro</a></li>
            <li><a href="<?= url('contatti') ?>" class="footer__link">Contatti</a></li>
            <li><a href="<?= url('privacy-policy') ?>" class="footer__link">Privacy Policy</a></li>
            <li><a href="<?= url('cookie-policy') ?>" class="footer__link">Cookie Policy</a></li>
          </ul>
        </div>

        <!-- Column 3: Contatti -->
        <div class="footer__column footer__column--contact">
          <h3 class="footer__heading">Contatti</h3>
          <ul class="footer__contact-list">
            <li class="footer__contact-item">
              <i data-lucide="map-pin" class="footer__contact-icon"></i>
              <span><?= $site->address() ?><br><?= $site->city() ?></span>
            </li>
            <li class="footer__contact-item">
              <i data-lucide="phone" class="footer__contact-icon"></i>
              <a href="tel:+39<?= Str::replace($site->phone(), ['.', ' '], '') ?>" class="footer__link"><?= $site->phone() ?></a>
            </li>
            <li class="footer__contact-item">
              <i data-lucide="printer" class="footer__contact-icon"></i>
              <span>Fax: <?= $site->fax() ?></span>
            </li>
            <li class="footer__contact-item">
              <i data-lucide="mail" class="footer__contact-icon"></i>
              <a href="mailto:<?= $site->email() ?>" class="footer__link"><?= $site->email() ?></a>
            </li>
            <li class="footer__contact-item">
              <i data-lucide="mail-check" class="footer__contact-icon"></i>
              <span>PEC: <?= $site->pec() ?></span>
            </li>
            <li class="footer__contact-item">
              <i data-lucide="award" class="footer__contact-icon"></i>
              <span>Iscritto all'Ordine degli Avvocati di Padova</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="footer__bottom">
        <p class="footer__copyright">
          &copy; <?= date('Y') ?> Avv. Sebastiano Zanin &mdash; P.IVA <?= $site->piva() ?>
        </p>
        <div class="footer__social">
          <a href="<?= $site->linkedin()->or('#') ?>" class="footer__social-link" aria-label="LinkedIn">
            <i data-lucide="linkedin"></i>
          </a>
          <a href="<?= $site->facebook()->or('#') ?>" class="footer__social-link" aria-label="Facebook">
            <i data-lucide="facebook"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll-to-top button -->
  <button class="scroll-top" aria-label="Torna in cima"><i data-lucide="arrow-up"></i></button>
