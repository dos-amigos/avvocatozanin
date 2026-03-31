# Phase 3: Supporting Pages - Research

**Researched:** 2026-03-31
**Domain:** Kirby CMS 5 page templates, mzur/kirby-uniform contact forms, Kirby page cache, WebP thumbnail presets
**Confidence:** HIGH — all findings verified against the installed codebase and proven reference project (studioatheste)

---

<phase_requirements>
## Phase Requirements

| ID | Description | Research Support |
|----|-------------|------------------|
| TRUST-01 | Chi Sono page con bio professionale, esperienza, valori, giurisdizione | New template `chi-sono.php` + blueprint + content file |
| TRUST-02 | Come Lavoro page con processo legale (consulenza → mandato → causa → risultato) | New template `come-lavoro.php` + blueprint + content file |
| TRUST-03 | Iscrizione Ordine Avvocati di Padova visibile (footer + chi-sono) | Footer already has the string; chi-sono content field + hardcoded display in template |
| TRUST-04 | Giurisdizione esplicita: "Opero presso il Tribunale di Este e Padova" | Chi-sono content field + rendered in template bio section |
| CONT-01 | Contatti page con form (nome, email, telefono, oggetto, messaggio, consenso GDPR) | `contatti.php` controller + template — pattern copied from studioatheste |
| CONT-02 | Protezione spam con honeypot | `kirby-uniform` v5.7.0 already installed — use `honeypot_field()` helper OR manual hidden field (studioatheste pattern) |
| CONT-03 | Google Maps embed per Via G.B. Brunelli 12, Este | `<iframe>` embed URL stored in page blueprint as `map_embed_url` field |
| CONT-04 | Numero telefono clickabile nel header e nella pagina contatti | Header already done (Phase 1); contatti template needs `<a href="tel:...">` — same `Str::replace` pattern already in use in footer/header |
| CONT-05 | Indirizzo PEC visibile nella pagina contatti | `$site->pec()` already defined in `site.txt`; render in contatti template alongside address block |
| PERF-01 | Lazy loading su tutte le immagini | HTML `loading="lazy"` on all `<img>` except LCP hero; audit existing templates |
| PERF-02 | Thumbnail presets per ottimizzazione immagini | `config.php` already has 4 presets (default/card/hero/thumb); apply `->thumb('card')` in templates that use dynamic images |
| PERF-03 | Page caching attivo (esclusa pagina contatti) | `config.php` `cache.pages.active` currently `false` — change to `true` + add `ignore` array for `/contatti` |
</phase_requirements>

---

## Summary

Phase 3 builds three new page templates (chi-sono, come-lavoro, contatti) and activates the performance layer (cache + lazy loading + thumb presets). The hard technical problem is the contact form: kirby-uniform v5.7.0 is already installed in `site/plugins/kirby-uniform`, but no controller or template for `contatti` exists yet in this project. The reference project studioatheste provides a working, battle-tested implementation of the same form-handling pattern (Kirby native controller + `$kirby->email()` + manual honeypot) which can be adapted directly. The non-form pages (chi-sono, come-lavoro) follow the same template/blueprint/content pattern already established for servizio pages: create a PHP template, a YAML blueprint, and a flat-file content file.

Performance requirements are largely already configured. `config.php` already defines the four thumb presets (default/card/hero/thumb) — they just need to be applied in templates. Page caching is configured but disabled (`'active' => false`) — enabling it requires adding one line plus a cache-ignore rule for /contatti. Lazy loading is a per-image HTML attribute audit.

The key divergence from studioatheste is the contact form approach: studioatheste uses Kirby's native `$kirby->email()` directly (no Uniform API calls), while the installed Uniform plugin provides a higher-level API. Both approaches are valid. Given studioatheste's proven implementation in the same PHP/Apache environment, the native Kirby email approach (replicating the controller pattern verbatim) is lower-risk. Uniform's `honeypot_field()` helper can still be used for the spam field, or the manual hidden field approach from studioatheste works equally well.

**Primary recommendation:** Copy studioatheste's contatti controller pattern for the form handler (native `$kirby->email()`), build chi-sono and come-lavoro as content-driven templates following the servizio.php pattern, and enable page caching with a contatti exclusion.

---

## Standard Stack

### Core (all already installed/configured)
| Library | Version | Purpose | Why Standard |
|---------|---------|---------|--------------|
| Kirby CMS | 5.3.3 | CMS platform, controllers, email, cache | Project platform — no alternative |
| mzur/kirby-uniform | 5.7.0 | Installed at `site/plugins/kirby-uniform` | Already in composer.json, provides honeypot_field() helper and Form API |
| PHP mailer | bundled with Kirby | Email delivery via `$kirby->email()` | Kirby 5 bundles PHPMailer; no separate install |
| GSAP 3.12.5 | CDN | Scroll animations for new page sections | Already loaded globally in scripts.php |
| Lucide @latest | CDN | Icons in contact info list, timeline markers | Already loaded globally in scripts.php |

### No New Dependencies Needed
All required libraries are already installed. Phase 3 is entirely template/CSS/content work on an existing foundation.

---

## Architecture Patterns

### Recommended Project Structure (additions only)
```
site/
├── controllers/
│   └── contatti.php          # NEW — form handling (POST, validation, email)
├── templates/
│   ├── chi-sono.php          # NEW — bio, ordine, giurisdizione
│   ├── come-lavoro.php       # NEW — process steps timeline
│   └── contatti.php          # NEW — form + map + contact info
├── blueprints/pages/
│   ├── chi-sono.yml          # NEW
│   ├── come-lavoro.yml       # NEW
│   └── contatti.yml          # NEW
├── templates/emails/
│   ├── contact.php           # NEW — plain text email
│   └── contact.html.php      # NEW — HTML email
content/
├── chi-sono/
│   └── chi-sono.txt          # NEW — seeded content
├── come-lavoro/
│   └── come-lavoro.txt       # NEW — seeded content
└── contatti/
    └── contatti.txt          # NEW — seeded content
assets/css/pages/
├── chi-sono.css              # NEW — already referenced in head.php
├── come-lavoro.css           # NEW — already referenced in head.php
└── contatti.css              # NEW — already referenced in head.php (and scripts.php)
assets/js/pages/
└── contatti.js               # NEW — already referenced in scripts.php
```

**Key insight:** `head.php` and `scripts.php` already reference `chi-sono.css`, `come-lavoro.css`, `contatti.css`, and `assets/js/pages/contatti.js`. The wiring is done — only the files themselves are missing.

### Pattern 1: Kirby Controller for Form Handling (native approach)
**What:** A PHP file at `site/controllers/contatti.php` that processes POST data, runs validation, sends email, and passes `$alert`, `$data`, `$success` to the template.
**When to use:** Any Kirby page that handles form submission.
**Source:** `studioatheste/site/controllers/contatti.php` — verified working on the same Apache/PHP 8.2 host.

```php
// site/controllers/contatti.php
<?php

return function ($kirby, $page, $site) {

    $alert   = null;
    $data    = [];
    $success = false;

    if ($kirby->request()->is('POST') && get('submit')) {

        // Honeypot: bots fill this hidden URL field
        if (get('website') !== null && get('website') !== '') {
            go($page->url());
        }

        $data = [
            'name'    => get('name'),
            'email'   => get('email'),
            'phone'   => get('phone'),
            'subject' => get('subject'),
            'text'    => get('text'),
        ];

        $rules = [
            'name'    => ['required', 'minLength' => 2],
            'email'   => ['required', 'email'],
            'subject' => ['required', 'minLength' => 2],
            'text'    => ['required', 'minLength' => 10, 'maxLength' => 5000],
        ];

        $messages = [
            'name'    => 'Inserisci il tuo nome e cognome.',
            'email'   => 'Inserisci un indirizzo email valido.',
            'subject' => "Inserisci l'oggetto del messaggio.",
            'text'    => 'Inserisci il tuo messaggio (min 10 caratteri).',
        ];

        $invalid = invalid($data, $rules, $messages);

        if ($invalid) {
            $alert = $invalid;
        } else {
            try {
                $kirby->email([
                    'template' => 'contact',
                    'from'     => 'noreply@avvocatozanin.it',
                    'replyTo'  => $data['email'],
                    'to'       => $site->email()->value(),
                    'subject'  => 'Contatto dal sito: ' . esc($data['subject']),
                    'data'     => [
                        'name'    => esc($data['name']),
                        'email'   => esc($data['email']),
                        'phone'   => esc($data['phone']),
                        'subject' => esc($data['subject']),
                        'text'    => esc($data['text']),
                    ],
                ]);
                $success = true;
                $data    = [];
            } catch (Exception $error) {
                $alert['error'] = option('debug')
                    ? $error->getMessage()
                    : "Si e verificato un errore durante l'invio. Riprova piu tardi o contattaci telefonicamente.";
            }
        }
    }

    return compact('alert', 'data', 'success');
};
```

### Pattern 2: Honeypot Field (manual hidden field)
**What:** A hidden `<input type="url" name="website">` with CSS positioning off-screen. Bots fill it; humans don't. Controller checks `get('website') !== ''` and redirects if filled.
**Why this over kirby-uniform's `honeypot_field()`:** Studioatheste uses this approach successfully. It does not require Uniform's session-based flow, and avoids the CSRF token requirement that Uniform adds by default.

```html
<!-- In template — honeypot field -->
<div class="contatti-form__honeypot" aria-hidden="true">
  <input type="url" id="website" name="website" tabindex="-1" autocomplete="off">
</div>
<input type="hidden" name="submit" value="1">
```

```css
/* In contatti.css */
.contatti-form__honeypot {
  position: absolute;
  left: -9999px;
  opacity: 0;
  pointer-events: none;
}
```

### Pattern 3: Page Cache Configuration
**What:** Enable Kirby's static HTML page cache for all pages, with an explicit ignore list for /contatti (form page must be dynamic).
**Source:** Kirby 5 docs — `cache.pages` config key.

```php
// site/config/config.php — update existing cache section
'cache' => [
    'pages' => [
        'active' => true,
        'ignore' => function ($page) {
            return $page->id() === 'contatti';
        },
    ],
],
```

**Critical:** `'active' => false` is currently set in `config.php` (dev mode). Change to `true`. The `ignore` callback is the Kirby 5 way to exclude specific pages. Disabling cache on the form page is mandatory — a cached response would serve a stale form state (including success/error messages) to the next visitor.

### Pattern 4: Thumbnail Presets (already configured)
The four presets are already defined in `config.php`:
```php
'thumbs' => [
    'presets' => [
        'default' => ['width' => 1024, 'quality' => 80],
        'card'    => ['width' => 600,  'quality' => 80],
        'hero'    => ['width' => 1920, 'quality' => 80],
        'thumb'   => ['width' => 400,  'quality' => 80],
    ],
],
```

Usage in templates (apply by name):
```php
// Hero image — eager load, no lazy
<?= $image->thumb('hero')->html(['alt' => esc($alt), 'loading' => 'eager']) ?>

// Card image — lazy load
<?= $image->thumb('card')->html(['alt' => esc($alt), 'loading' => 'lazy']) ?>
```

For Phase 3 pages, images are primarily Unsplash URLs (not Kirby-managed files), so presets apply only if/when real uploaded photos are used. The chi-sono page will have a portrait photo field — if uploaded to Kirby, use `->thumb('card')`. If Unsplash URL, render directly with explicit dimensions.

### Pattern 5: Lazy Loading Audit
**What:** Ensure `loading="lazy"` is on all `<img>` tags except the LCP (hero) image.
**In existing templates:** servizio.php already has `loading="eager"` on the hero video poster and `loading="lazy"` on the CTA background image. Home hero: check that no `<img>` in the above-fold hero has `loading="lazy"`.
**New pages:** Chi Sono portrait photo = `loading="lazy"` (below fold). All Come Lavoro images = `loading="lazy"`. Contatti Map iframe = `loading="lazy"` (already standard for Maps iframes).

### Pattern 6: Chi Sono Template Structure
Two core sections required by TRUST-01, TRUST-03, TRUST-04:
1. **Bio section** — portrait photo + professional bio text
2. **Ordine + Giurisdizione block** — explicit registration badge ("Iscritto all'Ordine degli Avvocati di Padova") and jurisdiction statement ("Opero presso il Tribunale di Este e il Tribunale di Padova")

The Ordine mention is already in the footer subfooter (hardcoded: "Ordine Avvocati Padova"). Chi Sono should repeat it prominently with a dedicated UI element (badge/card).

### Pattern 7: Come Lavoro Template Structure
TRUST-02 requires a 4-step process: consulenza → mandato → causa → risultato.
The vertical timeline pattern from studioatheste's `come-lavoriamo.php` is the right reference. The servizio horizontal timeline (`sv-timeline`) exists but is horizontal; a vertical alternating layout works better for a standalone process page.

### Anti-Patterns to Avoid
- **Caching the form page:** Page cache must be disabled for /contatti. A cached success state would show "message sent" to every visitor after one submission.
- **`loading="lazy"` on the hero/LCP element:** Do not add lazy loading to any image in the first viewport. Applies to chi-sono page hero portrait if it's above the fold.
- **Using kirby-uniform's full Form API with CSRF:** The installed Uniform v5.7.0 adds a CSRF token requirement by default. Using the manual controller + `$kirby->email()` pattern (as in studioatheste) avoids this complexity. If Uniform's Form class is used, CSRF field must be included in the template with `<?= csrf_field() ?>`.
- **Hardcoding the PEC address:** PEC is already in `site.txt` as `$site->pec()`. Always read from site field, never hardcode.
- **Leaving debug mode enabled in production:** `config.php` has `'debug' => true`. This must be changed to `false` before launch (Phase 4 concern, but worth flagging now).

---

## Don't Hand-Roll

| Problem | Don't Build | Use Instead | Why |
|---------|-------------|-------------|-----|
| Form spam protection | Custom CAPTCHA, IP blocking | Honeypot hidden field (manual, proven in studioatheste) | Zero UX friction, no external API, GDPR-clean |
| Form validation | Custom regex validation | Kirby's native `invalid()` helper | Already available in Kirby 5, handles required/email/minLength/maxLength |
| Email sending | PHPMailer instantiation | `$kirby->email(['template' => ...])` | Kirby 5 wraps PHPMailer; template-based approach separates email markup from controller logic |
| Image resizing | GD functions, ImageMagick calls | `$image->thumb('preset-name')` | Kirby thumbs API with configured presets — already set up in config.php |
| Page cache exclusion | Separate `.htaccess` rules | Kirby `cache.pages.ignore` callback | Native Kirby mechanism, works with PHP cache layer correctly |
| Responsive images | Custom `srcset` strings | Kirby `->srcset()` with preset widths | If Kirby-managed images are uploaded, use the built-in srcset API |

---

## Common Pitfalls

### Pitfall 1: Form Page Cached After First Submission
**What goes wrong:** Kirby serves the cached HTML (which shows "Messaggio inviato!") to every subsequent visitor.
**Why it happens:** Page cache is enabled globally but /contatti is not excluded.
**How to avoid:** Use the `ignore` callback in `cache.pages` config. Verify by submitting the form, then loading /contatti in a new incognito window — you should see the empty form, not a success state.
**Warning signs:** Success message visible to a fresh visitor who never submitted.

### Pitfall 2: Honeypot Field Visible to Screen Readers
**What goes wrong:** Screen reader announces the hidden field; keyboard users can Tab into it.
**Why it happens:** `position: absolute; left: -9999px` hides it visually but not from AT without `aria-hidden="true"` on the wrapper.
**How to avoid:** Wrap the honeypot input in `<div aria-hidden="true">` and add `tabindex="-1"` to the input itself (studioatheste pattern already does this).

### Pitfall 3: Email Template Encoding Issues
**What goes wrong:** Accented characters (è, à, ò) appear as `?` or `&#232;` in received emails.
**Why it happens:** Missing `charset="UTF-8"` in `config.php` email settings, or non-UTF-8 template file saved.
**How to avoid:** Ensure template files are saved as UTF-8. Kirby's email implementation sets UTF-8 by default, but verify the plain-text template uses `nl2br()` for line breaks in the HTML version.

### Pitfall 4: Google Maps Embed URL Requires Consent (GDPR)
**What goes wrong:** Embedding a standard Google Maps `<iframe>` loads Google tracking scripts before user consent.
**Why it happens:** Google Maps embed sets third-party cookies.
**How to avoid:** For Phase 3, embed the map normally but document in the Phase 4 GDPR work that the map iframe must be blocked by the cookie consent mechanism (or replaced with a static map image + link). Phase 3 priority is functional delivery; Phase 4 handles compliance.
**Practical for Phase 3:** Use the standard Maps embed URL (stored in the `map_embed_url` content field). Add `loading="lazy"` to the iframe.

### Pitfall 5: Missing `site/controllers/` Directory
**What goes wrong:** The form POST is never processed; the template renders but `$alert`, `$data`, `$success` are undefined, causing PHP errors.
**Why it happens:** avvocatozanin does not yet have a `site/controllers/` directory (confirmed by inspection — only studioatheste has one).
**How to avoid:** Create `site/controllers/` directory before adding `contatti.php`. Kirby auto-discovers controllers in this directory.

### Pitfall 6: Content Page Directories Not Numbered/Listed
**What goes wrong:** New pages (`chi-sono`, `come-lavoro`, `contatti`) appear as unlisted/invisible in the Panel and sitemap.
**Why it happens:** Kirby flat-file content uses numeric prefixes (`1_chi-sono/`) for listed pages. Without the prefix, a page is unlisted.
**How to avoid:** Create content directories with the numeric prefix: `content/1_chi-sono/`, `content/1_come-lavoro/`, `content/1_contatti/`. Verify with `$page->isListed()` or check Panel visibility.

---

## Code Examples

### Email Template — Plain Text
```php
// site/templates/emails/contact.php
Nuovo messaggio dal sito web Studio Legale Zanin
=================================================

Nome: <?= $name ?>

Email: <?= $email ?>

Telefono: <?= $phone ?: 'Non indicato' ?>

Oggetto: <?= $subject ?>

Messaggio:
<?= $text ?>

----
Inviato tramite il modulo di contatto su avvocatozanin.it
```

### Page Cache Configuration
```php
// site/config/config.php — updated cache section
'cache' => [
    'pages' => [
        'active' => true,
        'ignore' => function ($page) {
            return $page->id() === 'contatti';
        },
    ],
],
```

### Chi Sono — Ordine + Giurisdizione Block (HTML pattern)
```php
<!-- In chi-sono.php template -->
<div class="cs-credentials">
  <div class="cs-credentials__item">
    <i data-lucide="award"></i>
    <div>
      <strong>Iscritto all'Ordine degli Avvocati di Padova</strong>
      <span>N. iscrizione: <?= $page->ordine_numero()->or('(n. iscrizione)') ?></span>
    </div>
  </div>
  <div class="cs-credentials__item">
    <i data-lucide="map-pin"></i>
    <div>
      <strong>Giurisdizione</strong>
      <span>Opero presso il Tribunale di Este e il Tribunale di Padova</span>
    </div>
  </div>
</div>
```

### Contatti Template — Phone + PEC Block
```php
<!-- Clickable phone (CONT-04) -->
<li class="contatti-info__item">
  <div class="contatti-info__icon"><i data-lucide="phone"></i></div>
  <div class="contatti-info__text">
    <strong>Telefono</strong>
    <a href="tel:+39<?= Str::replace($site->phone(), ['.', ' '], '') ?>"><?= $site->phone() ?></a>
  </div>
</li>

<!-- PEC address (CONT-05) -->
<li class="contatti-info__item">
  <div class="contatti-info__icon"><i data-lucide="mail-check"></i></div>
  <div class="contatti-info__text">
    <strong>PEC</strong>
    <span><?= $site->pec() ?></span>
  </div>
</li>
```

### Lazy Loading — Standard Application
```php
// All non-LCP images in Phase 3 templates:
<img src="<?= esc($url) ?>" alt="<?= esc($alt) ?>" width="800" height="600" loading="lazy">

// Maps iframe (CONT-03):
<iframe
  src="<?= $page->map_embed_url() ?>"
  width="600" height="300"
  style="border:0;"
  allowfullscreen=""
  loading="lazy"
  referrerpolicy="no-referrer-when-downgrade"
  title="Posizione Studio Legale Zanin su Google Maps">
</iframe>
```

---

## Runtime State Inventory

Step 2.5 SKIPPED — Phase 3 is new template/content creation, not a rename/refactor/migration. No existing runtime state is being renamed or replaced.

---

## Environment Availability

| Dependency | Required By | Available | Version | Fallback |
|------------|------------|-----------|---------|----------|
| PHP 8.2+ | Kirby CMS, email() | Yes | 8.2.12 | — |
| Kirby CMS 5 | All templates | Yes | 5.x (installed) | — |
| mzur/kirby-uniform | Honeypot helpers (optional) | Yes | 5.7.0 | Manual honeypot (studioatheste pattern) |
| Composer | Dependency mgmt | Yes | 2.4.4 | — |
| SMTP / PHP mail() | Contact form email delivery | Unknown | — | Debug mode catches errors; test locally |
| Google Maps Embed | CONT-03 | External dependency | — | Static address text if Maps API changes |

**Missing dependencies with no fallback:**
- SMTP configuration — `$kirby->email()` requires either sendmail or SMTP credentials in `config.php`. This must be tested before Phase 3 sign-off. If no SMTP is configured, email silently fails (or throws an Exception caught by the controller's try/catch, showing the error alert).

**Missing dependencies with fallback:**
- Google Maps Embed URL — currently a placeholder field. Real embed URL must be generated from Google Maps for "Via G.B. Brunelli 12, 35042 Este PD". If not available, show address text with a "Apri in Google Maps" link as fallback.
- Avv. Zanin headshot — STATE.md flags this as a concern. A professional Unsplash image (lawyer portrait style) is the fallback. The chi-sono blueprint should support both a Kirby-uploaded file and a fallback Unsplash URL (same pattern as `hero_image_url` in servizio blueprint).

---

## Validation Architecture

Nyquist validation: no test framework is present in this project (pure Kirby CMS, no phpunit/jest configured for templates). Manual visual verification is the validation method for all Phase 3 requirements, consistent with Phase 2's `02-04-PLAN.md` visual verification checkpoint pattern.

**Phase gate:** Final plan in Phase 3 should be a visual verification checkpoint (same as `02-04-PLAN.md`) covering all 12 requirements.

| Req ID | Behavior | Test Type | Verification Method |
|--------|----------|-----------|---------------------|
| TRUST-01 | Chi Sono page renders bio + values | manual visual | Load `/chi-sono` in browser, check sections |
| TRUST-02 | Come Lavoro shows 4-step process | manual visual | Load `/come-lavoro`, count steps |
| TRUST-03 | Ordine Avvocati di Padova visible | manual visual | Chi Sono + footer subfooter |
| TRUST-04 | Tribunale di Este e Padova named | manual visual | Chi Sono credentials block |
| CONT-01 | Form fields render + submit | manual functional | Submit form with valid data |
| CONT-02 | Honeypot blocks bots | manual functional | Fill `website` field manually, confirm redirect |
| CONT-03 | Google Maps embeds correctly | manual visual | Map visible on /contatti |
| CONT-04 | Phone is clickable | manual functional | `<a href="tel:...">` present in DOM |
| CONT-05 | PEC visible on /contatti | manual visual | PEC string present in contact info block |
| PERF-01 | All non-hero images have loading="lazy" | DevTools inspect | Check img elements in DOM |
| PERF-02 | Thumb presets applied where applicable | manual / DevTools | Images load at correct widths |
| PERF-03 | Cache active, /contatti excluded | functional test | Load cached page, check /contatti is dynamic after submission |

---

## Project Constraints (from CLAUDE.md)

| Directive | Impact on Phase 3 |
|-----------|-------------------|
| Tech stack: Kirby CMS 5.x (PHP 8.2+) | All templates in PHP, flat-file content |
| No build step — vanilla CSS with @layer | Page CSS files use `@layer layout { ... }` pattern, no preprocessors |
| Design: authoritativeness, professionalism | Chi Sono must feel editorial; no casual copy |
| SEO: meta title/description on every page | Blueprints must include `meta_title`, `meta_description` fields (Phase 4 populates values, but fields must exist) |
| Performance: Core Web Vitals | Lazy loading mandatory on all below-fold images; hero LCP must load eagerly |
| Accessibility: ARIA labels, semantic HTML | Form labels must use `for`/`id` pairing; error states use `aria-live="polite"` |
| mzur/kirby-uniform: honeypot spam protection | Use manual honeypot (studioatheste) or Uniform's `honeypot_field()` — both satisfy CONT-02 |
| Hosting: Apache with .htaccess | No nginx-specific cache headers; Kirby PHP page cache is the correct mechanism |
| Art. 35 Codice Deontologico Forense | Chi Sono bio must NOT contain outcome promises, testimonials, or laudatory superlatives |
| PEC address: pec@avvocatozanin.it | Placeholder in site.txt — must be confirmed before launch but can proceed with placeholder |

---

## Open Questions

1. **SMTP configuration for email delivery**
   - What we know: `$kirby->email()` requires either PHP `mail()` (sendmail) or explicit SMTP credentials in config
   - What's unclear: Whether the Apache host has sendmail configured; whether SMTP credentials exist
   - Recommendation: Add a dev-only `try/catch` that surfaces the error in debug mode (already in the studioatheste pattern). Document in STATE.md that SMTP must be verified in staging before launch.

2. **Real Google Maps embed URL for Via G.B. Brunelli 12, Este**
   - What we know: The address is in site.txt; the blueprint field `map_embed_url` must be populated
   - What's unclear: Whether Avv. Zanin has a Google Business Profile with a verified pin
   - Recommendation: Seed the content file with a standard Maps embed URL for the address. The Panel field can be updated later. Standard embed URL pattern: `https://www.google.com/maps/embed?pb=...` — generate from maps.google.com.

3. **Avv. Zanin headshot availability**
   - What we know: STATE.md flags "Real headshot of Avv. Zanin may need to be arranged — stock photo is fallback only"
   - What's unclear: Whether a photo will be provided before Phase 3 completes
   - Recommendation: Chi Sono blueprint supports both a Kirby file upload field AND a fallback Unsplash URL field (same pattern as servizio `hero_image_url`). Template renders whichever is present.

4. **Come Lavoro: 4 hardcoded steps vs. content-editable structure**
   - What we know: TRUST-02 specifies exactly 4 steps (consulenza → mandato → causa → risultato)
   - What's unclear: Whether the client will ever need to edit step names/descriptions
   - Recommendation: Make steps content-editable via a `structure` field in the blueprint (same as `process_steps` in servizio). Seed with the 4 required steps. This gives Panel editability without extra dev cost.

---

## State of the Art

| Old Approach | Current Approach | When Changed | Impact |
|--------------|------------------|--------------|--------|
| kirby-uniform Form class + CSRF | Native `$kirby->email()` + manual honeypot | studioatheste reference (same host) | Simpler, no CSRF token sync issues |
| Manual WebP conversion plugin | Kirby 5 native `->thumb(['format' => 'webp'])` | Kirby 5 | No plugin needed; already configured |
| `active: false` page cache | `active: true` + ignore callback | Phase 3 activation | Requires changing one line in config.php |

---

## Sources

### Primary (HIGH confidence)
- Direct codebase inspection: `avvocatozanin/site/config/config.php` — page cache config, thumb presets
- Direct codebase inspection: `avvocatozanin/site/snippets/head.php` — CSS wiring for chi-sono, come-lavoro, contatti already present
- Direct codebase inspection: `avvocatozanin/site/snippets/scripts.php` — JS wiring for contatti already present
- Direct codebase inspection: `avvocatozanin/site/snippets/footer.php` — `$site->pec()`, `Str::replace()` phone pattern
- Direct codebase inspection: `avvocatozanin/site/plugins/kirby-uniform/` — v5.7.0 installed, README confirmed
- Direct reference inspection: `studioatheste/site/controllers/contatti.php` — working form controller pattern
- Direct reference inspection: `studioatheste/site/templates/contatti.php` — form HTML structure with honeypot
- Direct reference inspection: `studioatheste/site/templates/emails/contact.php` + `contact.html.php` — email templates
- Direct reference inspection: `studioatheste/site/templates/chi-siamo.php` — about page structure
- Direct reference inspection: `studioatheste/site/templates/come-lavoriamo.php` — process page timeline pattern

### Secondary (MEDIUM confidence)
- kirby-uniform README (in installed plugin): `honeypot_field()` and `csrf_field()` helpers documented
- Kirby 5 cache docs referenced in config.php comments — `cache.pages.ignore` callback is the official Kirby 5 pattern

### Tertiary (LOW confidence)
- None — all critical findings verified against installed code

---

## Metadata

**Confidence breakdown:**
- Standard stack: HIGH — all libraries already installed, versions confirmed
- Architecture: HIGH — patterns copied from proven studioatheste reference on same host
- Pitfalls: HIGH — verified against actual codebase state (missing controllers/ dir confirmed)
- Performance config: HIGH — config.php read directly, current state confirmed

**Research date:** 2026-03-31
**Valid until:** 2026-04-30 (stable Kirby 5, no fast-moving dependencies)
