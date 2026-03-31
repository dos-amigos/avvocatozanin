<!-- GSD:project-start source:PROJECT.md -->
## Project

**Avvocato Sebastiano Zanin**

Sito web professionale per l'Avvocato Sebastiano Zanin, civilista con studio a Este (PD). Il sito presenta i servizi legali offerti (diritto di famiglia, immobiliare, risarcimento danni, recupero crediti), costruito con Kirby CMS, ottimizzato SEO per posizionamento locale e nazionale sulle keyword del diritto civile.

**Core Value:** Un potenziale cliente che cerca un avvocato civilista a Este/Padova deve trovare il sito, capire immediatamente i servizi offerti e poter contattare lo studio con facilità.

### Constraints

- **Tech stack**: Kirby CMS 5.x (PHP 8.2+) — coerenza con progetto esistente
- **Hosting**: Apache con .htaccess, PHP 8.2-8.4
- **Design**: Deve trasmettere autorevolezza e professionalità legale
- **SEO**: Ogni pagina servizio deve avere meta title, description, OG tags, alt tags ottimizzati
- **Performance**: Core Web Vitals ottimali (lazy load, cache, image optimization)
- **Accessibilità**: ARIA labels, semantic HTML, keyboard navigation
<!-- GSD:project-end -->

<!-- GSD:stack-start source:research/STACK.md -->
## Technology Stack

## Context
## Recommended Stack
### Core CMS
| Technology | Version | Purpose | Why |
|------------|---------|---------|-----|
| Kirby CMS | ^5.2 (latest: 5.3.3, 2026-03-26) | Flat-file CMS, content management | Identical to studioatheste — zero learning curve, battle-tested on same Apache host. File-based storage means no DB to maintain; PHP 8.2+ aligns with existing hosting. |
| PHP | 8.2–8.4 | Runtime | Required by Kirby 5. Host already provides 8.2. |
### SEO Plugin
| Technology | Version | Purpose | Why |
|------------|---------|---------|-----|
| tobimori/kirby-seo | ^1.1 (latest: 1.1.2, 2026-03-21) | Meta tags, OG, JSON-LD, sitemap, robots.txt | **Already in use in studioatheste** (`composer.json` confirms `"tobimori/kirby-seo": "^1.1"`). Provides: meta cascade (page overrides site defaults), Panel UI with social preview, Schema.org JSON-LD via fluent PHP classes, automatic sitemap.xml, robots.txt generation from page status. Supports Kirby 5. |
### Animation & Interaction
| Technology | Version | Purpose | Why |
|------------|---------|---------|-----|
| GSAP | 3.12.5 (CDN via cdnjs) | Scroll animations, entrance effects, counters | Already pinned in studioatheste at 3.12.5 on cdnjs. Current npm version is 3.14.2 but upgrading mid-project adds risk; 3.12.5 is stable and fully functional. All ScrollTrigger APIs are stable across 3.x. |
| GSAP ScrollTrigger | 3.12.5 (bundled with GSAP) | Scroll-driven animations | Same CDN bundle as GSAP. Required for section reveals, parallax hero, and staggered service card entrances. |
| Lenis | 1.3.17 (CDN via unpkg) | Smooth momentum scrolling | Already pinned in studioatheste at 1.3.17. Current npm version is 1.3.21. Pinned version is stable; bump to 1.3.21 is low-risk but unnecessary. Package renamed from `@studio-freight/lenis` to `lenis` — use the new name if installing via npm. |
### Icons
| Technology | Version | Purpose | Why |
|------------|---------|---------|-----|
| Lucide | latest (CDN via unpkg) | UI icons (navigation, service icons, contact) | Used in studioatheste via `unpkg.com/lucide@latest`. Current npm version 1.7.0. The `@latest` tag is acceptable here because Lucide uses semantic versioning and icon additions are never breaking. |
### Typography (Google Fonts)
| Font | Weights | Role | Why |
|------|---------|------|-----|
| Cormorant Garamond | 300, 400, 500, 600, 700 (+ italic 400, 600) | Display / headings | Identical to studioatheste. High-contrast classical serif — conveys gravitas, tradition, and authority. The dominant choice for Italian professional service websites. Garamond heritage signals established expertise. |
| Plus Jakarta Sans | 200–800 (variable, + italic) | Body / UI text | Identical to studioatheste. Modern geometric sans — excellent screen legibility at all sizes, pairs naturally with Cormorant Garamond. Provides the contrast between editorial headlines and readable body copy. |
### Contact Form
| Technology | Version | Purpose | Why |
|------------|---------|---------|-----|
| mzur/kirby-uniform | ^5.6 (v5.6.2 confirmed Kirby 5 compatible) | Form handling with spam protection | The de-facto standard for Kirby form handling. Provides: honeypot guard (default, zero UX friction), honeytime guard (rejects forms submitted too fast), email action. No CAPTCHA service dependency. |
### CSS Architecture
| Approach | Purpose | Why |
|----------|---------|-----|
| CSS Layers (`@layer`) | Cascade management | Already in use in studioatheste. Prevents specificity wars when combining reset, base, components, and utilities. |
| CSS Custom Properties (design tokens) | Consistent values | Reference project uses `variables.css` with all colors, typography, spacing, shadows, and transitions as custom properties on `:root`. Copy and adapt the token set with legal-domain colors. |
| No build step | Direct CSS authoring | Consistent with reference project. No Tailwind, no PostCSS, no bundler. PHP template includes CSS files directly via Kirby's `css()` helper. |
### Image Handling
| Feature | Implementation | Why |
|---------|---------------|-----|
| WebP conversion | Kirby native `->thumb(['format' => 'webp'])` | Kirby 5 supports WebP (and AVIF) natively via the `thumbs` config. No plugin required. 50% smaller files vs JPEG at equivalent quality. |
| Thumbnail presets | `config.php` `thumbs.presets` key | Define reusable hero, card, and OG image presets once; apply by name in templates. |
| Lazy loading | HTML `loading="lazy"` on `<img>` (except hero/LCP) | Native browser lazy loading. **Do not apply to the hero image** — the LCP element must load eagerly. 16% of sites make this mistake per 2025 Web Almanac. |
| Responsive images | Kirby `->srcset()` with WebP | Generate multiple widths for art direction. Serve smaller images to mobile viewports. |
### Caching
| Feature | Implementation | Why |
|---------|---------------|-----|
| Kirby page cache | `'cache.pages' => true` in `config.php` | Static HTML cache served by PHP. Effective for pages with no session/auth dependency (all pages on this site). |
| Asset cache-busting | `?v=` + `filemtime()` on JS files | Already used in studioatheste for `animations.js`. Invalidates browser cache when file changes without renaming files. |
## Schema.org Implementation (Legal-Specific)
### Required Schema Types (per page)
| Page | Schema Types | Priority |
|------|-------------|----------|
| Home / Studio | `LegalService` + `Organization` + `Person` | CRITICAL |
| Service pages (4x) | `LegalService` (service-specific) + `BreadcrumbList` | HIGH |
| Contact | `LegalService` (with geo) + `BreadcrumbList` | HIGH |
| Chi Sono | `Person` (attorney profile) + `BreadcrumbList` | HIGH |
| All pages | `BreadcrumbList` | MEDIUM |
### Why NOT `Attorney` schema
### LegalService JSON-LD: Minimum Viable Structure
## Design Tokens: Legal Domain Adaptation
### Recommended Color Palette
## Hosting & Deployment
| Concern | Approach | Why |
|---------|---------|-----|
| Apache .htaccess | Use Kirby's default `.htaccess` | Kirby ships a production-ready `.htaccess` with security headers, GZIP, and routing rules. Copy from reference project. |
| PHP | 8.2–8.4 | Host confirmed. Kirby 5 requires 8.2+. |
| HTTPS | Required | TLS is table stakes. Affects Core Web Vitals score and schema validation. |
| No CDN/build pipeline | Direct file serving | Consistent with reference project. Appropriate for a low-traffic professional site. |
## Composer Installation
# Install Kirby 5 + SEO plugin (identical to studioatheste)
# Add contact form handling
## CDN Resources (in load order)
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
<!-- GSD:stack-end -->

<!-- GSD:conventions-start source:CONVENTIONS.md -->
## Conventions

### REGOLA TASSATIVA: .claude/ va SEMPRE tracked in git
La directory `.claude/` e tutti i file `.md` al suo interno (memory, settings, config) DEVONO essere committati e pushati nella repo. Si lavora da diversi PC e tutti gli agenti devono avere accesso ai file di memoria e configurazione. MAI aggiungere `.claude/` al `.gitignore`.

### CSS: flex + container = width: 100%
Ogni elemento con classe `.container` che è figlio diretto di un `display: flex` DEVE avere `width: 100%`. Senza, il container non si estende e il contenuto appare centrato invece che allineato.

### CSS: testo sempre bandiera sinistra
Il testo dei paragrafi è SEMPRE `text-align: left`. I blocchi possono essere centrati con `margin-inline: auto`, ma il testo interno resta a sinistra. Mai `text-align: center` su body text.

### CSS: fix su TUTTE le pagine contemporaneamente
Quando si corregge un pattern CSS condiviso (es. `.page-hero__content`), fare grep su TUTTI i file CSS e applicare la fix ovunque in un solo commit. Mai fixare una pagina alla volta.

### Commit: frequenti e descrittivi
Ogni modifica significativa va committata subito con messaggio dettagliato in italiano. Non accumulare modifiche.
<!-- GSD:conventions-end -->

<!-- GSD:architecture-start source:ARCHITECTURE.md -->
## Architecture

Architecture not yet mapped. Follow existing patterns found in the codebase.
<!-- GSD:architecture-end -->

<!-- GSD:workflow-start source:GSD defaults -->
## GSD Workflow Enforcement

Before using Edit, Write, or other file-changing tools, start work through a GSD command so planning artifacts and execution context stay in sync.

Use these entry points:
- `/gsd:quick` for small fixes, doc updates, and ad-hoc tasks
- `/gsd:debug` for investigation and bug fixing
- `/gsd:execute-phase` for planned phase work

Do not make direct repo edits outside a GSD workflow unless the user explicitly asks to bypass it.
<!-- GSD:workflow-end -->



<!-- GSD:profile-start -->
## Developer Profile

> Profile not yet configured. Run `/gsd:profile-user` to generate your developer profile.
> This section is managed by `generate-claude-profile` -- do not edit manually.
<!-- GSD:profile-end -->
