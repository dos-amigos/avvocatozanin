<?php snippet('head') ?>

  <!-- Skip-to-content accessibility link -->
  <a href="#main-content" class="skip-link">Vai al contenuto</a>

  <?php snippet('header') ?>

  <main id="main-content">

    <!-- ========== PAGE HERO ========== -->
    <section class="page-hero">
      <?php if ($page->hero_image_url()->isNotEmpty()): ?>
      <img
        src="<?= esc($page->hero_image_url()->value()) ?>"
        alt=""
        class="page-hero__bg"
        width="1920"
        height="800"
        loading="eager"
      >
      <?php endif ?>
      <div class="page-hero__overlay"></div>
      <div class="container page-hero__body">
        <ol class="breadcrumb breadcrumb--dark" aria-label="Breadcrumb">
          <li class="breadcrumb__item"><a href="<?= $site->url() ?>">Home</a></li>
          <li class="breadcrumb__separator" aria-hidden="true">/</li>
          <li class="breadcrumb__item breadcrumb__item--active" aria-current="page">
            <?= esc($page->hero_title()->or($page->title())->value()) ?>
          </li>
        </ol>
        <h1 class="page-hero__title"><?= esc($page->hero_title()->or($page->title())->value()) ?></h1>
        <?php if ($page->hero_subtitle()->isNotEmpty()): ?>
        <p class="page-hero__subtitle"><?= esc($page->hero_subtitle()->value()) ?></p>
        <?php endif ?>
      </div>
    </section>

    <!-- ========== CONTACT GRID ========== -->
    <section class="section">
      <div class="container">
        <div class="contatti-grid">

          <!-- LEFT: Contact info + map -->
          <div class="contatti-info">
            <?php if ($page->info_title()->isNotEmpty()): ?>
            <h2 class="contatti-info__title"><?= esc($page->info_title()->value()) ?></h2>
            <?php endif ?>

            <ul class="contatti-info__list" aria-label="Recapiti dello studio">

              <!-- Address -->
              <li class="contatti-info__item">
                <div class="contatti-info__icon" aria-hidden="true">
                  <i data-lucide="map-pin"></i>
                </div>
                <div class="contatti-info__text">
                  <strong>Indirizzo</strong>
                  <?= esc($site->address()->value()) ?><br>
                  <?= esc($site->city()->value()) ?>
                </div>
              </li>

              <!-- Phone (CONT-04) -->
              <li class="contatti-info__item">
                <div class="contatti-info__icon" aria-hidden="true">
                  <i data-lucide="phone"></i>
                </div>
                <div class="contatti-info__text">
                  <strong>Telefono</strong>
                  <a href="tel:+39<?= Str::replace($site->phone(), ['.', ' '], '') ?>"><?= esc($site->phone()->value()) ?></a>
                </div>
              </li>

              <!-- Fax -->
              <?php if ($site->fax()->isNotEmpty()): ?>
              <li class="contatti-info__item">
                <div class="contatti-info__icon" aria-hidden="true">
                  <i data-lucide="printer"></i>
                </div>
                <div class="contatti-info__text">
                  <strong>Fax</strong>
                  <?= esc($site->fax()->value()) ?>
                </div>
              </li>
              <?php endif ?>

              <!-- Email -->
              <li class="contatti-info__item">
                <div class="contatti-info__icon" aria-hidden="true">
                  <i data-lucide="mail"></i>
                </div>
                <div class="contatti-info__text">
                  <strong>Email</strong>
                  <a href="mailto:<?= esc($site->email()->value()) ?>"><?= esc($site->email()->value()) ?></a>
                </div>
              </li>

              <!-- PEC (CONT-05) -->
              <?php if ($site->pec()->isNotEmpty()): ?>
              <li class="contatti-info__item">
                <div class="contatti-info__icon" aria-hidden="true">
                  <i data-lucide="mail-check"></i>
                </div>
                <div class="contatti-info__text">
                  <strong>PEC</strong>
                  <?= esc($site->pec()->value()) ?>
                </div>
              </li>
              <?php endif ?>

              <!-- Hours -->
              <?php if ($page->orari_feriali()->isNotEmpty()): ?>
              <li class="contatti-info__item">
                <div class="contatti-info__icon" aria-hidden="true">
                  <i data-lucide="clock"></i>
                </div>
                <div class="contatti-info__text">
                  <strong>Orari di Studio</strong>
                  <?= esc($page->orari_feriali()->value()) ?>
                  <?php if ($page->orari_sabato()->isNotEmpty()): ?>
                  <br><?= esc($page->orari_sabato()->value()) ?>
                  <?php endif ?>
                </div>
              </li>
              <?php endif ?>

            </ul>

            <!-- Google Maps embed (CONT-03) -->
            <?php if ($page->map_embed_url()->isNotEmpty()): ?>
            <div class="contatti-map">
              <iframe
                src="<?= esc($page->map_embed_url()->value()) ?>"
                title="Posizione Studio Legale Zanin su Google Maps"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                aria-label="Mappa della posizione dello studio"
              ></iframe>
            </div>
            <?php endif ?>
          </div>

          <!-- RIGHT: Contact form -->
          <div class="contatti-form-wrap">
            <?php if ($page->form_title()->isNotEmpty()): ?>
            <h2 class="contatti-form-wrap__title"><?= esc($page->form_title()->value()) ?></h2>
            <?php endif ?>
            <?php if ($page->form_subtitle()->isNotEmpty()): ?>
            <p class="contatti-form-wrap__subtitle"><?= esc($page->form_subtitle()->value()) ?></p>
            <?php endif ?>

            <!-- Alert: validation errors -->
            <?php if ($alert): ?>
            <div class="contatti-form__alert" role="alert" aria-live="assertive">
              <ul>
                <?php foreach ((array) $alert as $message): ?>
                <li><?= esc($message) ?></li>
                <?php endforeach ?>
              </ul>
            </div>
            <?php endif ?>

            <!-- Success state -->
            <?php if ($success): ?>
            <div class="contatti-form__success" role="status" aria-live="polite">
              <div class="contatti-form__success-icon" aria-hidden="true">
                <i data-lucide="check-circle"></i>
              </div>
              <h3><?= esc($page->success_title()->or('Messaggio Inviato!')->value()) ?></h3>
              <p><?= esc($page->success_text()->or('Grazie per averci contattato. Ti risponderemo il prima possibile.')->value()) ?></p>
            </div>
            <?php else: ?>

            <!-- Contact form (CONT-01) -->
            <form
              class="contatti-form"
              id="contatti-form"
              method="post"
              action="<?= $page->url() ?>"
              novalidate
            >

              <!-- Honeypot (CONT-02) — invisible to users, filled by bots -->
              <div class="contatti-form__honeypot" aria-hidden="true">
                <label for="website">Non compilare questo campo</label>
                <input
                  type="url"
                  id="website"
                  name="website"
                  tabindex="-1"
                  autocomplete="off"
                >
              </div>

              <!-- Hidden submit flag -->
              <input type="hidden" name="submit" value="1">

              <!-- Name field -->
              <div class="contatti-form__field">
                <input
                  type="text"
                  id="cf-name"
                  name="name"
                  class="contatti-form__input"
                  placeholder=" "
                  value="<?= esc($data['name'] ?? '') ?>"
                  required
                  autocomplete="name"
                  aria-required="true"
                  aria-describedby="cf-name-error"
                >
                <label for="cf-name" class="contatti-form__label">Nome e Cognome *</label>
                <span class="contatti-form__error" id="cf-name-error" aria-live="polite"></span>
              </div>

              <!-- Email field -->
              <div class="contatti-form__field">
                <input
                  type="email"
                  id="cf-email"
                  name="email"
                  class="contatti-form__input"
                  placeholder=" "
                  value="<?= esc($data['email'] ?? '') ?>"
                  required
                  autocomplete="email"
                  aria-required="true"
                  aria-describedby="cf-email-error"
                >
                <label for="cf-email" class="contatti-form__label">Indirizzo Email *</label>
                <span class="contatti-form__error" id="cf-email-error" aria-live="polite"></span>
              </div>

              <!-- Phone field (optional) -->
              <div class="contatti-form__field">
                <input
                  type="tel"
                  id="cf-phone"
                  name="phone"
                  class="contatti-form__input"
                  placeholder=" "
                  value="<?= esc($data['phone'] ?? '') ?>"
                  autocomplete="tel"
                  aria-describedby="cf-phone-error"
                >
                <label for="cf-phone" class="contatti-form__label">Telefono (opzionale)</label>
                <span class="contatti-form__error" id="cf-phone-error" aria-live="polite"></span>
              </div>

              <!-- Subject field -->
              <div class="contatti-form__field">
                <input
                  type="text"
                  id="cf-subject"
                  name="subject"
                  class="contatti-form__input"
                  placeholder=" "
                  value="<?= esc($data['subject'] ?? '') ?>"
                  required
                  aria-required="true"
                  aria-describedby="cf-subject-error"
                >
                <label for="cf-subject" class="contatti-form__label">Oggetto *</label>
                <span class="contatti-form__error" id="cf-subject-error" aria-live="polite"></span>
              </div>

              <!-- Message field -->
              <div class="contatti-form__field">
                <textarea
                  id="cf-text"
                  name="text"
                  class="contatti-form__input contatti-form__input--textarea"
                  placeholder=" "
                  required
                  aria-required="true"
                  aria-describedby="cf-text-error"
                ><?= esc($data['text'] ?? '') ?></textarea>
                <label for="cf-text" class="contatti-form__label">Messaggio *</label>
                <span class="contatti-form__error" id="cf-text-error" aria-live="polite"></span>
              </div>

              <!-- GDPR consent checkbox -->
              <div class="contatti-form__checkbox">
                <input
                  type="checkbox"
                  id="cf-privacy"
                  name="privacy"
                  class="contatti-form__check"
                  required
                  aria-required="true"
                  aria-describedby="cf-privacy-error"
                >
                <label for="cf-privacy" class="contatti-form__checkbox-label">
                  Ho letto e accetto la
                  <a href="<?= url('privacy-policy') ?>">Privacy Policy</a>
                  e acconsento al trattamento dei miei dati personali ai sensi del GDPR. *
                </label>
              </div>
              <span class="contatti-form__error contatti-form__error--privacy" id="cf-privacy-error" aria-live="polite"></span>

              <!-- Submit -->
              <button type="submit" class="btn btn--accent btn--lg contatti-form__submit">
                <i data-lucide="send" aria-hidden="true"></i>
                Invia Messaggio
              </button>

            </form>
            <?php endif ?>
          </div>

        </div>
      </div>
    </section>

    <!-- ========== CTA SECTION ========== -->
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
        <h2 class="text-white"><?= esc($page->cta_title()->or('Preferisci Chiamare?')->value()) ?></h2>
        <?php if ($page->cta_description()->isNotEmpty()): ?>
        <p><?= esc($page->cta_description()->value()) ?></p>
        <?php endif ?>
        <a
          href="tel:+39<?= Str::replace($site->phone(), ['.', ' '], '') ?>"
          class="btn btn--accent btn--lg"
        >
          <i data-lucide="phone" aria-hidden="true"></i>
          <?= esc($page->cta_button_text()->or('Chiama Ora')->value()) ?>
        </a>
      </div>
    </section>

  </main>

  <?php snippet('footer') ?>

<?php snippet('scripts') ?>
