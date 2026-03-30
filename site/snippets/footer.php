
<footer class="footer">
  <div class="container">
    <div class="footer__grid">
      <div class="footer__col footer__col--brand">
        <a href="<?= $site->url() ?>" class="footer__logo"><strong>Regalis</strong><span>Studio Legale</span></a>
        <p><?= $site->site_description() ?></p>
        <div class="footer__social">
          <a href="<?= $site->linkedin()->or('#') ?>" aria-label="LinkedIn"><i data-lucide="linkedin"></i></a>
          <a href="<?= $site->facebook()->or('#') ?>" aria-label="Facebook"><i data-lucide="facebook"></i></a>
        </div>
      </div>
      <div class="footer__col">
        <h5>Aree di Pratica</h5>
        <ul>
          <li><a href="<?= url('servizi/diritto-di-famiglia') ?>">Diritto di Famiglia</a></li>
          <li><a href="<?= url('servizi/diritto-immobiliare') ?>">Diritto Immobiliare</a></li>
          <li><a href="<?= url('servizi/risarcimento-danni') ?>">Risarcimento Danni</a></li>
          <li><a href="<?= url('servizi/recupero-crediti') ?>">Recupero Crediti</a></li>
        </ul>
      </div>
      <div class="footer__col">
        <h5>Link Utili</h5>
        <ul>
          <li><a href="<?= url('chi-sono') ?>">Chi Sono</a></li>
          <li><a href="<?= url('come-lavoro') ?>">Come Lavoro</a></li>
          <li><a href="<?= url('contatti') ?>">Contatti</a></li>
          <li><a href="<?= url('privacy-policy') ?>">Privacy Policy</a></li>
        </ul>
      </div>
      <div class="footer__col">
        <h5>Contatti</h5>
        <div class="footer__contact">
          <i data-lucide="map-pin"></i>
          <span><?= $site->address() ?><br><?= $site->city() ?></span>
        </div>
        <div class="footer__contact">
          <i data-lucide="phone"></i>
          <a href="tel:+39<?= Str::replace($site->phone(), ['.', ' '], '') ?>"><?= $site->phone() ?></a>
        </div>
        <div class="footer__contact">
          <i data-lucide="mail"></i>
          <a href="mailto:<?= $site->email() ?>"><?= $site->email() ?></a>
        </div>
        <div class="footer__contact">
          <i data-lucide="mail-check"></i>
          <span>PEC: <?= $site->pec() ?></span>
        </div>
      </div>
    </div>
  </div>
  <div class="subfooter">
    <div class="container subfooter__inner">
      <p>&copy; <?= date('Y') ?> Avv. Sebastiano Zanin &mdash; P.IVA <?= $site->piva() ?> &mdash; Ordine Avvocati Padova</p>
      <div>
        <a href="<?= url('privacy-policy') ?>">Privacy</a>
        <a href="<?= url('cookie-policy') ?>">Cookie</a>
      </div>
    </div>
  </div>
</footer>

<button class="scroll-top" id="scrolltop" aria-label="Torna in cima"><i data-lucide="arrow-up"></i></button>
