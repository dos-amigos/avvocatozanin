<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sito in Manutenzione — Studio Legale Zanin</title>
  <meta name="robots" content="noindex, nofollow">
  <link rel="icon" type="image/png" href="<?= url('assets/img/favicon.png') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Manrope', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
      color: #fff;
    }

    /* Background */
    .maintenance-bg {
      position: fixed;
      inset: 0;
      background: url('https://images.pexels.com/photos/5668473/pexels-photo-5668473.jpeg?auto=compress&cs=tinysrgb&w=1920') center/cover no-repeat;
      filter: blur(8px) brightness(0.35);
      transform: scale(1.05);
      z-index: 0;
    }

    .maintenance {
      position: relative;
      z-index: 1;
      text-align: center;
      padding: 48px 24px;
      max-width: 540px;
      width: 100%;
    }

    /* Logo */
    .maintenance__logo {
      margin-bottom: 48px;
    }
    .maintenance__logo img {
      height: 80px;
      width: auto;
      filter: brightness(0) invert(1);
    }

    /* Title */
    .maintenance__title {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(28px, 5vw, 42px);
      font-weight: 400;
      letter-spacing: 0.02em;
      margin-bottom: 16px;
      line-height: 1.2;
    }

    .maintenance__subtitle {
      font-size: 16px;
      color: rgba(255,255,255,0.7);
      margin-bottom: 48px;
      line-height: 1.6;
    }

    /* Contacts */
    .maintenance__contacts {
      display: flex;
      flex-direction: column;
      gap: 12px;
      margin-bottom: 48px;
    }

    .maintenance__contact {
      font-size: 15px;
      color: rgba(255,255,255,0.85);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .maintenance__contact a {
      color: #c29b59;
      text-decoration: none;
    }
    .maintenance__contact a:hover {
      text-decoration: underline;
    }

    .maintenance__divider {
      width: 60px;
      height: 1px;
      background: rgba(255,255,255,0.2);
      margin: 0 auto 48px;
    }

    /* Access toggle */
    .maintenance__access {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 16px;
    }

    .maintenance__toggle {
      background: none;
      border: 1px solid rgba(255,255,255,0.3);
      color: rgba(255,255,255,0.6);
      padding: 10px 28px;
      font-size: 13px;
      font-family: 'Manrope', sans-serif;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      cursor: pointer;
      border-radius: 4px;
      transition: all 0.25s ease;
    }
    .maintenance__toggle:hover {
      border-color: rgba(255,255,255,0.6);
      color: #fff;
    }

    .maintenance__form {
      display: none;
      gap: 12px;
      align-items: center;
      justify-content: center;
    }
    .maintenance__form.is-visible {
      display: flex;
    }

    .maintenance__input {
      padding: 10px 16px;
      border: 1px solid rgba(255,255,255,0.3);
      background: rgba(255,255,255,0.1);
      color: #fff;
      font-size: 14px;
      font-family: 'Manrope', sans-serif;
      border-radius: 4px;
      outline: none;
      width: 200px;
      backdrop-filter: blur(4px);
    }
    .maintenance__input::placeholder {
      color: rgba(255,255,255,0.4);
    }
    .maintenance__input:focus {
      border-color: #c29b59;
    }

    .maintenance__submit {
      padding: 10px 24px;
      background: #c29b59;
      color: #fff;
      border: none;
      font-size: 14px;
      font-family: 'Manrope', sans-serif;
      font-weight: 600;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.25s ease;
    }
    .maintenance__submit:hover {
      background: #a8833e;
    }

    .maintenance__error {
      color: #e74c3c;
      font-size: 13px;
      display: none;
    }
    .maintenance__error.is-visible {
      display: block;
    }
  </style>
</head>
<body>

  <div class="maintenance-bg" aria-hidden="true"></div>

  <div class="maintenance">
    <div class="maintenance__logo">
      <img src="<?= url('assets/img/logo-zanin.png') ?>" alt="Studio Legale Zanin">
    </div>

    <h1 class="maintenance__title">Sito in Manutenzione</h1>
    <p class="maintenance__subtitle">Stiamo lavorando per offrirti una migliore esperienza. Torneremo presto online.</p>

    <div class="maintenance__contacts">
      <div class="maintenance__contact">
        <span>Tel:</span>
        <a href="tel:+390429196020">0429.1960202</a>
      </div>
      <div class="maintenance__contact">
        <span>Email:</span>
        <a href="mailto:<?= esc($site->email()) ?>"><?= $site->email() ?></a>
      </div>
      <?php if ($site->pec()->isNotEmpty()): ?>
      <div class="maintenance__contact">
        <span>PEC:</span>
        <a href="mailto:<?= esc($site->pec()) ?>"><?= $site->pec() ?></a>
      </div>
      <?php endif ?>
      <div class="maintenance__contact">
        <span>Studio:</span>
        <span><?= $site->address() ?>, <?= $site->city() ?></span>
      </div>
    </div>

    <div class="maintenance__divider"></div>

    <div class="maintenance__access">
      <button class="maintenance__toggle" id="accessToggle">Accedi</button>
      <form class="maintenance__form" id="accessForm" method="post" action="<?= url('maintenance-login') ?>">
        <input
          type="password"
          name="maintenance_password"
          class="maintenance__input"
          placeholder="Password"
          autocomplete="off"
        >
        <button type="submit" class="maintenance__submit">Entra</button>
      </form>
      <?php if (get('auth') === 'failed'): ?>
      <p class="maintenance__error is-visible">Password non corretta.</p>
      <?php else: ?>
      <p class="maintenance__error" id="accessError">Password non corretta.</p>
      <?php endif ?>
    </div>
  </div>

  <script>
    document.getElementById('accessToggle').addEventListener('click', function() {
      this.style.display = 'none';
      document.getElementById('accessForm').classList.add('is-visible');
      document.querySelector('.maintenance__input').focus();
    });
  </script>

</body>
</html>
