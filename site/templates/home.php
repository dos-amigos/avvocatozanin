<?php snippet('head') ?>
<?php snippet('header') ?>

<main id="main-content">

  <!-- ===== HERO — full viewport, bg image, content bottom-left, gradient edge ===== -->
  <section class="hero">
    <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1920&q=80" alt="" class="hero__bg" loading="eager">
    <div class="hero__overlay"></div>
    <div class="hero__gradient"></div>
    <div class="container hero__body">
      <p class="subtitle"><?= esc($page->hero_eyebrow()) ?></p>
      <h1 class="hero__title"><?= $page->hero_title() ?></h1>
      <p class="hero__desc"><?= esc($page->hero_subtitle()) ?></p>
      <div class="hero__buttons">
        <a href="<?= url('contatti') ?>" class="btn btn--accent">Consulenza Gratuita</a>
        <a href="#servizi" class="btn btn--outline">I Nostri Servizi</a>
      </div>
      <div class="hero__keywords">
        <span>Diritto di Famiglia</span>
        <span class="dot"></span>
        <span>Diritto Immobiliare</span>
        <span class="dot"></span>
        <span>Risarcimento Danni</span>
        <span class="dot"></span>
        <span>Recupero Crediti</span>
      </div>
    </div>
  </section>

  <!-- ===== 3 VALUE CARDS ===== -->
  <section class="section">
    <div class="container">
      <div class="values-grid">
        <div class="value-card">
          <div class="value-card__icon"><i data-lucide="scale"></i></div>
          <h3>Esperienza Legale</h3>
          <p>Oltre 15 anni di pratica forense nel diritto civile presso i Tribunali di Este e Padova.</p>
        </div>
        <div class="value-card">
          <div class="value-card__icon"><i data-lucide="handshake"></i></div>
          <h3>Approccio Personale</h3>
          <p>Ogni cliente riceve attenzione dedicata e soluzioni su misura per le proprie esigenze legali.</p>
        </div>
        <div class="value-card">
          <div class="value-card__icon"><i data-lucide="trophy"></i></div>
          <h3>Risultati Concreti</h3>
          <p>Track record comprovato di successi nelle controversie civili e nella tutela dei diritti.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== ABOUT — split: image + glass stats | text ===== -->
  <section class="section section--light">
    <div class="container">
      <div class="about-split">
        <div class="about-split__media">
          <img src="https://images.unsplash.com/photo-1521791055366-0d553872125f?w=800&q=80" alt="Studio Legale" class="about-split__img" loading="lazy">
          <div class="glass-box">
            <div class="glass-box__stat">
              <strong data-count="15">0</strong><span>+</span>
              <small>Anni Esperienza</small>
            </div>
            <div class="glass-box__divider"></div>
            <div class="glass-box__stat">
              <strong data-count="500">0</strong><span>+</span>
              <small>Cause Gestite</small>
            </div>
          </div>
        </div>
        <div class="about-split__text">
          <p class="subtitle">Lo Studio</p>
          <h2>Tutela Legale Affidabile e Professionale</h2>
          <p>L'Avv. Sebastiano Zanin esercita la professione forense con studio a Este, offrendo assistenza legale qualificata in ambito civile con particolare attenzione al rapporto personale con ogni cliente.</p>
          <p>Iscritto all'Ordine degli Avvocati di Padova, garantisce competenza, riservatezza e impegno costante nella risoluzione delle controversie legali.</p>
          <a href="<?= url('chi-sono') ?>" class="btn btn--primary">Scopri di Più</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== PRACTICE AREAS — dark bg, split: intro left | 2x2 grid right ===== -->
  <section class="section section--dark" id="servizi">
    <div class="container">
      <div class="practices-split">
        <div class="practices-split__intro">
          <p class="subtitle subtitle--on-dark">Aree di Pratica</p>
          <h2 class="text-white">Assistenza Legale Completa in Ambito Civile</h2>
          <p class="text-white-50">Offriamo supporto professionale in tutte le principali aree del diritto civile, dalla famiglia al recupero crediti.</p>
          <a href="<?= url('servizi') ?>" class="btn btn--accent">Tutti i Servizi</a>
        </div>
        <div class="practices-split__grid">
          <a href="<?= url('servizi/diritto-di-famiglia') ?>" class="practice-card">
            <i data-lucide="users"></i>
            <h4>Diritto di Famiglia</h4>
            <p>Separazioni, divorzi, affidamento figli, successioni e tutela dei diritti familiari.</p>
          </a>
          <a href="<?= url('servizi/diritto-immobiliare') ?>" class="practice-card">
            <i data-lucide="home"></i>
            <h4>Diritto Immobiliare</h4>
            <p>Compravendite, locazioni, condominio, usucapione e controversie immobiliari.</p>
          </a>
          <a href="<?= url('servizi/risarcimento-danni') ?>" class="practice-card">
            <i data-lucide="shield"></i>
            <h4>Risarcimento Danni</h4>
            <p>Incidenti stradali, responsabilità civile, danni patrimoniali e non patrimoniali.</p>
          </a>
          <a href="<?= url('servizi/recupero-crediti') ?>" class="practice-card">
            <i data-lucide="file-text"></i>
            <h4>Recupero Crediti</h4>
            <p>Decreti ingiuntivi, esecuzioni forzate, recupero giudiziale e stragiudiziale.</p>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== STATS COUNTERS ===== -->
  <section class="stats-section">
    <img src="https://images.unsplash.com/photo-1479142506502-19b3a3b7ff33?w=1920&q=80" alt="" class="stats-section__bg" loading="lazy">
    <div class="stats-section__overlay"></div>
    <div class="container stats-section__inner">
      <div class="stat">
        <strong data-count="500">0</strong><span>+</span>
        <p>Consulenze Clienti</p>
      </div>
      <div class="stat">
        <strong data-count="95">0</strong><span>%</span>
        <p>Clienti Soddisfatti</p>
      </div>
      <div class="stat">
        <strong data-count="4">0</strong>
        <p>Specializzazioni</p>
      </div>
      <div class="stat">
        <strong data-count="15">0</strong><span>+</span>
        <p>Anni di Attività</p>
      </div>
    </div>
  </section>

  <!-- ===== WORK PROCESS — 3 steps ===== -->
  <section class="section">
    <div class="container">
      <div class="process-header">
        <p class="subtitle">Come Lavoriamo</p>
        <h2>Il Nostro Processo</h2>
      </div>
      <div class="process-grid">
        <div class="process-step">
          <div class="process-step__num">01</div>
          <h4>Analisi del Caso</h4>
          <p>Ascoltiamo le vostre esigenze e analizziamo la documentazione per comprendere la situazione legale.</p>
        </div>
        <div class="process-step">
          <div class="process-step__num">02</div>
          <h4>Strategia Legale</h4>
          <p>Definiamo la strategia più efficace, valutando tempi, costi e probabilità di successo.</p>
        </div>
        <div class="process-step">
          <div class="process-step__num">03</div>
          <h4>Risoluzione</h4>
          <p>Agiamo con determinazione per ottenere il miglior risultato, in sede giudiziale o stragiudiziale.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== CTA ===== -->
  <section class="cta-section">
    <img src="https://images.unsplash.com/photo-1505664194779-8beaceb93744?w=1920&q=80" alt="" class="cta-section__bg" loading="lazy">
    <div class="cta-section__overlay"></div>
    <div class="container cta-section__body">
      <h2 class="text-white">Hai Bisogno di Assistenza Legale?</h2>
      <p>Prenota una prima consulenza gratuita per valutare insieme il tuo caso.</p>
      <a href="<?= url('contatti') ?>" class="btn btn--accent btn--lg">Contattaci Ora</a>
    </div>
  </section>

  <!-- ===== CONTACT BAR — above footer ===== -->
  <section class="contact-bar">
    <div class="container">
      <div class="contact-bar__grid">
        <div class="contact-bar__item">
          <i data-lucide="phone"></i>
          <div><strong>Telefono</strong><a href="tel:+39<?= Str::replace($site->phone(), ['.', ' '], '') ?>"><?= $site->phone() ?></a></div>
        </div>
        <div class="contact-bar__item">
          <i data-lucide="map-pin"></i>
          <div><strong>Studio</strong><span><?= $site->address() ?>, <?= $site->city() ?></span></div>
        </div>
        <div class="contact-bar__item">
          <i data-lucide="mail"></i>
          <div><strong>Email</strong><a href="mailto:<?= $site->email() ?>"><?= $site->email() ?></a></div>
        </div>
      </div>
    </div>
  </section>

</main>

<?php snippet('footer') ?>
<?php snippet('scripts') ?>
