# Technology Stack

**Project:** Avvocato Zanin — Professional Italian Lawyer Website
**Researched:** 2026-03-28
**Overall confidence:** HIGH (reference project verified, all versions confirmed from official sources)

---

## Context

This stack is not greenfield speculation. The reference project (`studioatheste`) runs Kirby 5 in production with an identical hosting environment (Apache, PHP 8.2+). Every technology listed here is either already proven in that codebase or verified against official current documentation. The deviations from the reference project are intentional and legal-domain-specific.

---

## Recommended Stack

### Core CMS

| Technology | Version | Purpose | Why |
|------------|---------|---------|-----|
| Kirby CMS | ^5.2 (latest: 5.3.3, 2026-03-26) | Flat-file CMS, content management | Identical to studioatheste — zero learning curve, battle-tested on same Apache host. File-based storage means no DB to maintain; PHP 8.2+ aligns with existing hosting. |
| PHP | 8.2–8.4 | Runtime | Required by Kirby 5. Host already provides 8.2. |

**Confidence:** HIGH — Confirmed at https://github.com/getkirby/kirby/releases (v5.3.3 is current stable as of 2026-03-26).

### SEO Plugin

| Technology | Version | Purpose | Why |
|------------|---------|---------|-----|
| tobimori/kirby-seo | ^1.1 (latest: 1.1.2, 2026-03-21) | Meta tags, OG, JSON-LD, sitemap, robots.txt | **Already in use in studioatheste** (`composer.json` confirms `"tobimori/kirby-seo": "^1.1"`). Provides: meta cascade (page overrides site defaults), Panel UI with social preview, Schema.org JSON-LD via fluent PHP classes, automatic sitemap.xml, robots.txt generation from page status. Supports Kirby 5. |

**Confidence:** HIGH — Version confirmed at Packagist/Kirby plugin directory. Verified in reference project composer.json.

**Critical note on JSON-LD for legal:** kirby-seo provides the JSON-LD infrastructure (fluent Schema.org classes), but **LegalService schema must be authored manually** in templates/snippets — the plugin does not auto-detect legal service pages. See Architecture section on schema implementation below.

**Do not use:** `fabianmichael/kirby-meta` (v2.0.0, released 2026-03-13) is newer but requires migration from the reference project and is in beta. `chrfickinger/kirby-jsonld` is lower-level and requires manual wiring that kirby-seo already handles.

### Animation & Interaction

| Technology | Version | Purpose | Why |
|------------|---------|---------|-----|
| GSAP | 3.12.5 (CDN via cdnjs) | Scroll animations, entrance effects, counters | Already pinned in studioatheste at 3.12.5 on cdnjs. Current npm version is 3.14.2 but upgrading mid-project adds risk; 3.12.5 is stable and fully functional. All ScrollTrigger APIs are stable across 3.x. |
| GSAP ScrollTrigger | 3.12.5 (bundled with GSAP) | Scroll-driven animations | Same CDN bundle as GSAP. Required for section reveals, parallax hero, and staggered service card entrances. |
| Lenis | 1.3.17 (CDN via unpkg) | Smooth momentum scrolling | Already pinned in studioatheste at 1.3.17. Current npm version is 1.3.21. Pinned version is stable; bump to 1.3.21 is low-risk but unnecessary. Package renamed from `@studio-freight/lenis` to `lenis` — use the new name if installing via npm. |

**Confidence:** HIGH — Versions confirmed from reference project `scripts.php` and npm registry.

**Important:** Load order is critical. GSAP → ScrollTrigger → Lenis must load in this sequence. All via CDN to avoid a build step (consistent with reference project).

### Icons

| Technology | Version | Purpose | Why |
|------------|---------|---------|-----|
| Lucide | latest (CDN via unpkg) | UI icons (navigation, service icons, contact) | Used in studioatheste via `unpkg.com/lucide@latest`. Current npm version 1.7.0. The `@latest` tag is acceptable here because Lucide uses semantic versioning and icon additions are never breaking. |

**Confidence:** HIGH — Confirmed from reference project `scripts.php` and npm registry.

### Typography (Google Fonts)

| Font | Weights | Role | Why |
|------|---------|------|-----|
| Cormorant Garamond | 300, 400, 500, 600, 700 (+ italic 400, 600) | Display / headings | Identical to studioatheste. High-contrast classical serif — conveys gravitas, tradition, and authority. The dominant choice for Italian professional service websites. Garamond heritage signals established expertise. |
| Plus Jakarta Sans | 200–800 (variable, + italic) | Body / UI text | Identical to studioatheste. Modern geometric sans — excellent screen legibility at all sizes, pairs naturally with Cormorant Garamond. Provides the contrast between editorial headlines and readable body copy. |

**Confidence:** HIGH — Confirmed from reference project `head.php`. Typography data validated against analysis of 42,966 lawyer websites (ilovewp.com study).

**Font loading pattern:** Preconnect to `fonts.googleapis.com` and `fonts.gstatic.com` before the font link tag. Use `display=swap` to prevent FOIT. These are already in the reference project's `head.php`.

**Do not use:** Open Sans, Roboto, or Lato — these are statistically the most common fonts on lawyer sites (ilovewp.com), which means they signal generic rather than premium. Cormorant Garamond differentiates while still being appropriate for legal context.

### Contact Form

| Technology | Version | Purpose | Why |
|------------|---------|---------|-----|
| mzur/kirby-uniform | ^5.6 (v5.6.2 confirmed Kirby 5 compatible) | Form handling with spam protection | The de-facto standard for Kirby form handling. Provides: honeypot guard (default, zero UX friction), honeytime guard (rejects forms submitted too fast), email action. No CAPTCHA service dependency. |

**Confidence:** MEDIUM — Kirby 5 compatibility confirmed from release notes mentioning "Kirby 5 in tests" for v5.6.x. Packagist install: `composer require mzur/kirby-uniform`.

**Do not use:** Form Block Suite (`microman/kirby-form-block-suite`) — block-based forms add panel complexity; this site has one contact form and templates are handwritten. Plain Kirby form handling without Uniform is acceptable for a single form but lacks the honeytime guard.

### CSS Architecture

| Approach | Purpose | Why |
|----------|---------|-----|
| CSS Layers (`@layer`) | Cascade management | Already in use in studioatheste. Prevents specificity wars when combining reset, base, components, and utilities. |
| CSS Custom Properties (design tokens) | Consistent values | Reference project uses `variables.css` with all colors, typography, spacing, shadows, and transitions as custom properties on `:root`. Copy and adapt the token set with legal-domain colors. |
| No build step | Direct CSS authoring | Consistent with reference project. No Tailwind, no PostCSS, no bundler. PHP template includes CSS files directly via Kirby's `css()` helper. |

**Confidence:** HIGH — Architecture verified in reference project source.

### Image Handling

| Feature | Implementation | Why |
|---------|---------------|-----|
| WebP conversion | Kirby native `->thumb(['format' => 'webp'])` | Kirby 5 supports WebP (and AVIF) natively via the `thumbs` config. No plugin required. 50% smaller files vs JPEG at equivalent quality. |
| Thumbnail presets | `config.php` `thumbs.presets` key | Define reusable hero, card, and OG image presets once; apply by name in templates. |
| Lazy loading | HTML `loading="lazy"` on `<img>` (except hero/LCP) | Native browser lazy loading. **Do not apply to the hero image** — the LCP element must load eagerly. 16% of sites make this mistake per 2025 Web Almanac. |
| Responsive images | Kirby `->srcset()` with WebP | Generate multiple widths for art direction. Serve smaller images to mobile viewports. |

**Confidence:** HIGH — Confirmed from Kirby official documentation at getkirby.com/docs/guide/files/resize-images-on-the-fly.

### Caching

| Feature | Implementation | Why |
|---------|---------------|-----|
| Kirby page cache | `'cache.pages' => true` in `config.php` | Static HTML cache served by PHP. Effective for pages with no session/auth dependency (all pages on this site). |
| Asset cache-busting | `?v=` + `filemtime()` on JS files | Already used in studioatheste for `animations.js`. Invalidates browser cache when file changes without renaming files. |

**Confidence:** HIGH — Pattern confirmed from reference project `scripts.php`.

---

## Schema.org Implementation (Legal-Specific)

This is the highest-impact SEO differentiator for a lawyer site. It requires manual implementation — no plugin handles LegalService schema automatically.

### Required Schema Types (per page)

| Page | Schema Types | Priority |
|------|-------------|----------|
| Home / Studio | `LegalService` + `Organization` + `Person` | CRITICAL |
| Service pages (4x) | `LegalService` (service-specific) + `BreadcrumbList` | HIGH |
| Contact | `LegalService` (with geo) + `BreadcrumbList` | HIGH |
| Chi Sono | `Person` (attorney profile) + `BreadcrumbList` | HIGH |
| All pages | `BreadcrumbList` | MEDIUM |

### Why NOT `Attorney` schema

`Attorney` is a deprecated Schema.org subtype. Google has confirmed it does not produce rich results. Use `LegalService` (subtype of `LocalBusiness`) + `Person` instead. This is the 2025 consensus across all legal SEO sources.

### LegalService JSON-LD: Minimum Viable Structure

```json
{
  "@context": "https://schema.org",
  "@type": "LegalService",
  "name": "Studio Legale Avvocato Sebastiano Zanin",
  "description": "Studio legale civilista a Este (PD) specializzato in diritto di famiglia, immobiliare, risarcimento danni e recupero crediti.",
  "url": "https://avvocatozanin.it",
  "telephone": "+390429196202",
  "faxNumber": "+390429196020",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Via G.B. Brunelli 12",
    "addressLocality": "Este",
    "addressRegion": "PD",
    "postalCode": "35042",
    "addressCountry": "IT"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 45.2316,
    "longitude": 11.6569
  },
  "areaServed": [
    {"@type": "City", "name": "Este"},
    {"@type": "City", "name": "Padova"}
  ],
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "Servizi legali",
    "itemListElement": [
      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Diritto di famiglia"}},
      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Diritto immobiliare"}},
      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Risarcimento danni"}},
      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Recupero crediti"}}
    ]
  },
  "founder": {
    "@type": "Person",
    "name": "Sebastiano Zanin",
    "jobTitle": "Avvocato"
  },
  "sameAs": [
    "https://avvocatozanin.it"
  ]
}
```

This snippet goes in a `site/snippets/schema-legal-service.php` included in the `<head>` via kirby-seo's JSON-LD hook or directly in `head.php`.

---

## Design Tokens: Legal Domain Adaptation

The reference project uses a blue + red palette (accounting firm). For a lawyer site, adapt to navy + gold — this is the canonical "authority + premium" palette for Italian legal professionals.

### Recommended Color Palette

```css
:root {
  /* Primary: Deep Navy — authority, trust, stability */
  --color-primary:       #1a2744;   /* deep navy */
  --color-primary-light: #263561;
  --color-primary-dark:  #0f1829;

  /* Accent: Antique Gold — prestige, tradition */
  --color-accent:        #b8960c;   /* antique gold */
  --color-accent-light:  #d4ad0f;
  --color-accent-dark:   #8a6f09;

  /* Neutrals: warm off-white to dark charcoal */
  --color-white:         #ffffff;
  --color-cream:         #f9f7f4;   /* warm background, not clinical white */
  --color-gray-50:       #f5f3ef;
  /* ... rest of scale identical to reference project */
}
```

**Rationale:** Data from MeanPug's study of 10,000 law firm websites confirms blue dominates. Navy + gold specifically signals high-end, civil law practice — appropriate for a single-practitioner studio in Veneto. The warm off-white (`#f9f7f4`) prevents the sterile corporate look.

---

## Hosting & Deployment

| Concern | Approach | Why |
|---------|---------|-----|
| Apache .htaccess | Use Kirby's default `.htaccess` | Kirby ships a production-ready `.htaccess` with security headers, GZIP, and routing rules. Copy from reference project. |
| PHP | 8.2–8.4 | Host confirmed. Kirby 5 requires 8.2+. |
| HTTPS | Required | TLS is table stakes. Affects Core Web Vitals score and schema validation. |
| No CDN/build pipeline | Direct file serving | Consistent with reference project. Appropriate for a low-traffic professional site. |

---

## Composer Installation

```bash
# Install Kirby 5 + SEO plugin (identical to studioatheste)
composer require getkirby/cms:^5.2
composer require tobimori/kirby-seo:^1.1

# Add contact form handling
composer require mzur/kirby-uniform
```

## CDN Resources (in load order)

```html
<!-- Fonts: preconnect first -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

<!-- Lenis CSS -->
<link rel="stylesheet" href="https://unpkg.com/lenis@1.3.17/dist/lenis.css">

<!-- JS — EXACT ORDER: GSAP → ScrollTrigger → Lenis → Lucide -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/lenis@1.3.17/dist/lenis.min.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
```

---

## Alternatives Considered

| Category | Recommended | Rejected Alternative | Reason Rejected |
|----------|-------------|---------------------|-----------------|
| SEO plugin | tobimori/kirby-seo 1.1.2 | fabianmichael/kirby-meta 2.0.0 | Meta is in beta, requires migration from reference. kirby-seo is already proven in studioatheste. |
| SEO plugin | tobimori/kirby-seo | chrfickinger/kirby-jsonld | Lower-level, only handles JSON-LD; kirby-seo handles the full stack. |
| Schema type | LegalService + Person | Attorney | Attorney is deprecated by Schema.org; no rich results from Google. |
| Form spam | Uniform honeypot + honeytime | reCAPTCHA | CAPTCHA adds friction, has privacy implications (GDPR), and requires Google API key. Honeypot is invisible to users. |
| Fonts | Cormorant Garamond + Plus Jakarta Sans | Open Sans / Roboto | Market data shows Open Sans/Roboto are the default for 19-17% of all lawyer sites — they signal generic. CG differentiates while remaining authoritative. |
| CSS framework | Vanilla CSS with layers | Tailwind CSS | No build step needed; reference project proves vanilla CSS is sufficient; purge/JIT setup adds complexity for a static marketing site. |
| JS bundler | No bundler (CDN + local files) | Vite/webpack | Overkill for this use case. Reference project proves CDN approach works. No node_modules to maintain on Apache host. |
| Image formats | WebP via Kirby native | Separate WebP plugin (felixhaeberle/kirby3-webp) | Kirby 5 handles WebP natively in the thumb() API. The plugin is for Kirby 3 and unnecessary. |

---

## Sources

- Kirby 5 releases: https://github.com/getkirby/kirby/releases (v5.3.3, 2026-03-26)
- tobimori/kirby-seo: https://packagist.org/packages/tobimori/kirby-seo (v1.1.2)
- fabianmichael/kirby-meta: https://packagist.org/packages/fabianmichael/kirby-meta (v2.0.0)
- mzur/kirby-uniform: https://github.com/mzur/kirby-uniform (v5.6.2, Kirby 5 compatible)
- Schema.org LegalService: https://schema.org/LegalService
- Schema.org Attorney (deprecated): https://schema.org/Attorney
- Schema markup for law firms: https://bsmlegalmarketing.com/marketing-for-law-firms/local-seo-for-lawyers/schema-markup/
- LegalService implementation 2025: https://relixir.ai/blog/implementing-legalservice-schema-markup-2025-estate-planning-dui-defense-tutorial
- Law firm color study (10,000 sites): https://www.meanpug.com/a-definitive-study-on-law-firm-website-color-choices-2025/
- Most-used Google Fonts on lawyer sites (42,966 sites): https://www.ilovewp.com/resources/wordpress-for-lawyers/most-used-google-fonts-on-lawyer-websites/
- Best fonts for law firms 2025: https://pointclick.io/the-best-fonts-for-law-firm-websites-in-2025/
- Kirby image thumbnails (WebP/AVIF): https://getkirby.com/docs/guide/files/resize-images-on-the-fly
- Core Web Vitals for law firms: https://www.legalbrandmarketing.com/core-web-vitals-for-law-firms-essential-metrics/
- GSAP npm: https://www.npmjs.com/package/gsap (v3.14.2 current; 3.12.5 pinned in reference)
- Lenis npm: https://www.npmjs.com/package/lenis (v1.3.21 current; 1.3.17 pinned in reference)
- Lucide npm: https://www.npmjs.com/package/lucide (v1.7.0 current)
- Reference project: C:\Users\boxwe\Documents\GitHub\studioatheste (direct inspection)
