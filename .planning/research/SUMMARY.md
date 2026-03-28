# Project Research Summary

**Project:** Avvocato Zanin — Professional Italian Lawyer Website
**Domain:** Solo civil-law practitioner website (avvocato civilista), Este (PD), Italy
**Researched:** 2026-03-28
**Confidence:** HIGH (stack verified against reference project; features and pitfalls grounded in Italian legal domain sources)

## Executive Summary

This is a premium professional services website for a solo Italian civil lawyer, not a generic brochure site. The defining constraints are Italian-specific: deontological rules (Codice Deontologico Forense Art. 35) prohibit outcome guarantees, testimonials, and comparative claims; GDPR as enforced by the Italian Garante requires stricter cookie consent than pan-European practice; and Schema.org `Attorney` type is deprecated — `LegalService` is the correct structured data type. Build this as a local SEO asset first, a brand statement second.

The recommended approach is a direct port of the studioatheste reference project (same host, same Kirby 5 stack) with two domains of adaptation: (1) solo-practitioner content structure (chi-sono singular, no team grid, personal brand emphasis) and (2) legal-domain-specific features (LegalService JSON-LD, FAQPage schema per service, geo-targeted keywords, deontology-compliant copy). The stack is not speculative — every technology is already running in production on the same Apache/PHP 8.2 host. The creative risks are execution risks, not technology risks.

The top three risks are: (1) copy that inadvertently violates Art. 35 (guaranteed suspension-level offense), (2) Core Web Vitals failures caused by GSAP/Lenis animations applied naively to the hero LCP element, and (3) schema markup that is missing, wrong-typed, or has NAP inconsistencies between the website, schema JSON-LD, and Google Business Profile. All three are preventable with explicit review steps built into the development phases.

---

## Key Findings

### Recommended Stack

The stack is a near-exact copy of studioatheste with three additions specific to the legal domain. Kirby 5 (v5.3.3, flat-file CMS) runs without a database on the existing Apache/PHP 8.2 host. CDN-loaded GSAP 3.12.5 + Lenis 1.3.17 deliver scroll animations without a build step. The `tobimori/kirby-seo` plugin (already in the reference project) provides the SEO infrastructure; `LegalService` JSON-LD must be authored manually as a snippet since no plugin auto-detects legal schema types. The one new dependency is `mzur/kirby-uniform` for contact form spam protection (honeypot + honeytime guards, no CAPTCHA, no GDPR trigger).

Design tokens diverge intentionally: the reference project's blue/red accounting palette is replaced with navy/antique gold (`#1a2744` / `#b8960c`), the canonical "authority + premium" combination confirmed by a 10,000-site law firm color study.

**Core technologies:**
- **Kirby CMS ^5.2** — flat-file CMS, no DB, Apache-native — zero setup delta from studioatheste
- **tobimori/kirby-seo ^1.1** — meta cascade, OG tags, JSON-LD hooks, sitemap — already proven in reference project
- **mzur/kirby-uniform ^5.6** — form handling with honeypot/honeytime spam protection — no CAPTCHA GDPR risk
- **GSAP 3.12.5 + ScrollTrigger** — scroll animations — CDN, same version as studioatheste
- **Lenis 1.3.17** — smooth scroll — CDN, same version as studioatheste
- **Cormorant Garamond + Plus Jakarta Sans** — display/body typography pair — confirmed against 42,966-site lawyer font study
- **LegalService JSON-LD snippet** — manually authored in `snippets/schema-legal-service.php` — no plugin handles this automatically

**Do not use:** `Attorney` schema type (deprecated, no Google rich results); reCAPTCHA (GDPR/consent complexity); Tailwind CSS (no build step needed); `fabianmichael/kirby-meta` v2.0.0 (beta, migration cost).

### Expected Features

The feature set divides cleanly into table stakes (credibility and conversion infrastructure) and differentiators (local SEO and legal domain authority). All anti-features (client portal, appointment booking, testimonials, pricing tables) are blocked by deontology or scope.

**Must have (table stakes):**
- Homepage with hero, services overview, and dual CTA (phone + contact form)
- 4 dedicated service pages (diritto di famiglia, immobiliare, risarcimento danni, recupero crediti)
- Chi Sono page with Ordine degli Avvocati registration number and jurisdiction statement
- Contatti page with form, phone, PEC address, Google Maps embed
- Privacy Policy page (GDPR Art. 13 mandatory before any contact form is live)
- Cookie consent banner with equal-prominence Rifiuta/Accetta (Italian Garante requirement)
- Mobile-responsive design (70%+ of Italian legal searches are on smartphone)
- Phone number in sticky header (clickable tel: link)

**Should have (competitive differentiators):**
- Schema.org LegalService + Person JSON-LD on all pages (20-30% CTR uplift in local results)
- Per-service-page keyword targeting with geo modifiers ("avvocato divorzista Este")
- FAQPage schema on each service page (featured snippet positioning)
- BreadcrumbList schema on all non-home pages
- Open Graph + Twitter Card meta on all pages (WhatsApp/LinkedIn share quality)
- Explicit jurisdiction statement referencing Tribunale di Este and Tribunale di Padova
- PEC address visible on Contatti page (mandatory professional obligation)
- GSAP scroll animations + Lenis smooth scroll (premium brand signal)

**Defer to v2+:**
- Blog/news section (requires content strategy commitment; empty blog hurts SEO)
- Google Business Profile optimization (off-site, manual, parallel track to dev)
- Advanced animation polish beyond base studioatheste patterns
- Client-facing document exchange or booking system

### Architecture Approach

The site is a shallow two-level content tree in Kirby: top-level pages (home, chi-sono, servizi, come-lavoro, contatti, news) plus one level of children under `/servizi/` for the four practice area pages. This mirrors studioatheste exactly, enabling direct blueprint and template reuse. Every template renders from flat `.txt` files in the `content/` directory — no database, no API, no build pipeline. All shared layout elements (header with dropdown nav, footer, hero, CTA banner, contact form) are Kirby snippets. The four service detail pages share a single `servizio.php` template and `servizio.yml` blueprint, which already exists in studioatheste and handles all required sections (hero, panoramica, cosa-include, processo, FAQ accordion, correlati, CTA).

**Major components:**
1. **`site/snippets/header.php`** — sticky navigation with dropdown Servizi menu, tel: link, mobile hamburger
2. **`site/snippets/footer.php`** — three-column footer (Studio / Servizi / Contatti), Ordine registration, P.IVA, privacy link
3. **`site/snippets/schema-legal-service.php`** — global LegalService JSON-LD injected in `<head>` on every page
4. **`site/templates/servizio.php` + `site/blueprints/servizio.yml`** — reused for all 4 practice area pages; contains FAQ accordion + FAQPage schema generation
5. **`site/snippets/form.php`** — kirby-uniform powered contact form with privacy consent checkbox (GDPR) and honeypot
6. **CSS layers architecture** — `@layer reset, base, components, utilities` in `variables.css` + per-component files, no build step
7. **Kirby page cache** — `'cache.pages' => true` for all pages except `/contatti` (excluded to preserve form CSRF tokens)

### Critical Pitfalls

1. **Art. 35 Codice Deontologico Forense violations** — All copy must be reviewed against the prohibition list (no outcome promises, no testimonials, no comparative claims, no laudatory superlatives) before publication. Violations carry 1-3 year bar suspension. Build a copy review checklist into the content phase.

2. **GSAP/Lenis destroying Core Web Vitals** — Never set the hero image/text to `opacity: 0` for scroll-in reveals (LCP penalty). Always initialize Lenis and ScrollTrigger with a `prefers-reduced-motion` check. Exclude `will-change: transform` from elements outside the animation active window. Measure on real mid-range Android hardware before launch.

3. **Wrong or missing LegalService schema** — Use `@type: ["LegalService", "LocalBusiness"]`, not plain `LocalBusiness` or deprecated `Attorney`. Establish one master NAP string ("Via G.B. Brunelli 12, 35042 Este (PD)") and use it character-for-character in the footer HTML, JSON-LD, and Google Business Profile. Validate with Google Rich Results Test before launch.

4. **Kirby staticache breaking the contact form** — If Kirby's staticache plugin is enabled for performance, the `/contatti` page must be added to the ignore list in `config.php`. Static HTML snapshots bypass PHP execution entirely, silently breaking CSRF tokens and email sending.

5. **GDPR/Garante non-compliant cookie consent** — Italian Garante requirements go beyond standard GDPR: "Rifiuta tutto" must be visually equivalent to "Accetta tutto"; analytics must be blocked until consent is granted; the contact form must have a mandatory privacy consent checkbox with a link to `/privacy`. Use iubenda or Cookiebot (established in Italy) rather than a custom banner.

---

## Implications for Roadmap

Based on research, the architecture creates a clear 5-phase build order driven by content dependencies and legal compliance requirements.

### Phase 1: Infrastructure and Base Template
**Rationale:** All pages share the same header, footer, CSS token system, and animation initialization. Nothing else can be built until this layer exists. Copying and adapting from studioatheste makes this fast.
**Delivers:** Kirby installation, composer dependencies, CSS design tokens (navy/gold palette), CDN resource load order, header/footer snippets, GSAP + Lenis setup with `prefers-reduced-motion` guard, global LegalService JSON-LD snippet, Apache `.htaccess`.
**Addresses:** Table-stakes mobile responsiveness, animation performance baseline.
**Avoids:** CDN load order pitfall (GSAP → ScrollTrigger → Lenis → Lucide must be sequential); LCP animation pitfall (establish the pattern from day one).

### Phase 2: Core Content Pages (Service Architecture)
**Rationale:** The three templates that form the minimum viable visitor journey — Home, Servizi listing, Servizio detail — must ship together. They represent the primary conversion path and the primary SEO surface area. Service pages are the largest build unit and have the most blueprint complexity.
**Delivers:** `home.php` + blueprint + placeholder content; `servizi.php` + blueprint; `servizio.php` + blueprint (reused ×4); all four service content folders with complete structured `.txt` content; FAQPage JSON-LD per service; BreadcrumbList schema.
**Uses:** Reused studioatheste `servizio.yml` blueprint (hero, panoramica, cosa-include, processo, FAQ, correlati, CTA tabs).
**Implements:** `/servizi/[area]/` URL cluster structure for topical authority.
**Avoids:** Generic keyword targeting — every service page H1 and meta title must include "Este" or "Padova" qualifier from the start.

### Phase 3: Trust and Conversion Pages
**Rationale:** Chi Sono and Come Lavoro are trust-building pages that convert visitors who found the site via service pages. Contatti is the conversion endpoint. These depend on knowing the final site structure (to link correctly) but are simpler than the service template.
**Delivers:** `chi-sono.php` with biography, Ordine registration block, values grid (no team section — solo practitioner); `come-lavoro.php` with 5-step process; `contatti.php` with kirby-uniform form (privacy checkbox, honeypot), Google Maps embed, PEC address display, office hours.
**Avoids:** Missing PEC address (professional obligation); contact form without privacy consent checkbox (GDPR Art. 13 violation); staticache breaking the form (exclude `/contatti` in `config.php`).

### Phase 4: Legal Compliance and SEO Finalization
**Rationale:** Privacy Policy and cookie consent must exist before any contact form is publicly accessible. Schema validation, sitemap, and robots.txt must be complete before first indexing. OG tags require final content to be meaningful.
**Delivers:** Privacy Policy page (Italian, with data controller identity, retention periods, rights); Cookie consent banner (Garante-compliant, equal-prominence reject/accept, consent-gated analytics); canonical tags on all pages; XML sitemap (dynamic via kirby-seo plugin); robots.txt; Open Graph + Twitter Card meta on all pages; complete JSON-LD validation via Google Rich Results Test.
**Avoids:** Garante fine exposure; schema markup errors blocking rich results; launch without GDPR compliance (illegal for an Italian lawyer whose credibility depends on legal propriety).

### Phase 5: Performance Audit and Launch Preparation
**Rationale:** Core Web Vitals failures are a ranking penalty, and they are caused by the animation layer — which means they cannot be caught until the full site is built. This is a validation phase, not a build phase.
**Delivers:** Lighthouse audit on real mobile hardware; CLS < 0.1, LCP < 2.5s, INP < 200ms confirmed; Kirby page cache enabled (with `/contatti` excluded); image srcset/WebP presets confirmed; hero image `loading="eager"`, all others `loading="lazy"`; copy reviewed against Art. 35 prohibition list; NAP string verified identical across footer, schema JSON-LD, and Google Business Profile; Google Business Profile claimed and populated; sitemap submitted to Google Search Console.
**Avoids:** Post-launch discovery of CWV failures, deontology violations, or NAP inconsistencies.

### Phase 6: News Section (Optional v1 / Defer to v2)
**Rationale:** The news/blog section is architecturally simple (copy from studioatheste) but strategically risky if published empty or without a content plan. Include the templates and blueprints to make it easy to activate, but do not populate or link from nav until at least 3 seed articles exist.
**Delivers:** `news.php` listing template + `articolo.php` detail template + blueprints; unlisted in nav until content is ready.
**Avoids:** Empty blog hurting SEO credibility; premature commitment to publishing cadence.

### Phase Ordering Rationale

- Phase 1 before everything: shared snippets and CSS tokens are referenced by every subsequent template.
- Phase 2 before Phase 3: service pages are the primary SEO surface and must exist before trust pages link to them correctly.
- Phase 3 before Phase 4: the privacy policy must reference which third-party scripts are present, so their implementation must precede compliance documentation.
- Phase 4 before Phase 5: cannot audit compliance until all legal pages exist.
- Phase 5 is a gate, not a build phase: nothing ships publicly until it passes.

### Research Flags

Phases likely needing deeper research during planning:
- **Phase 4 (GDPR compliance):** Italian Garante cookie consent requirements are evolving (2025 double opt-in decision). The specific CMP implementation (iubenda vs Cookiebot vs custom) needs a decision and pricing check.
- **Phase 2 (Content):** Exact keyword targets for each service page should be validated with Google Keyword Planner or Search Console data for the Este/Padova area before H1 and meta title are finalized. The research provides direction but not confirmed search volumes.

Phases with standard patterns (skip research-phase):
- **Phase 1 (Infrastructure):** Identical to studioatheste. No unknowns.
- **Phase 3 (Contact form):** kirby-uniform is documented; honeypot pattern is standard.
- **Phase 5 (Performance audit):** Core Web Vitals targets and measurement tools are well-documented.
- **Phase 6 (News):** Direct template copy from studioatheste.

---

## Confidence Assessment

| Area | Confidence | Notes |
|------|------------|-------|
| Stack | HIGH | All versions confirmed against official sources and reference project. No speculation. |
| Features | MEDIUM-HIGH | Table stakes confirmed from multiple Italian law firm guides. Keyword volumes are directional, not validated against live data. |
| Architecture | HIGH | Content structure and blueprint design verified directly from studioatheste codebase. URL patterns confirmed from legal SEO research. |
| Pitfalls | HIGH (technical) / MEDIUM (legal) | GSAP/Kirby/schema pitfalls: high confidence from official sources. Art. 35 deontology: medium confidence — CNF source confirmed, but enforcement interpretation varies. GDPR/Garante: high confidence for cookie consent; double opt-in rule is a 2025 decision that may still be contested. |

**Overall confidence:** HIGH

### Gaps to Address

- **Avv. Zanin's actual content:** The research defines structure and field types, but service page body copy, biography text, FAQ content, and credentials (Ordine number, years called to bar) require input from the client. The `servizio.yml` blueprint is ready; the `.txt` content files are not.
- **Real photography:** The research strongly recommends a professional headshot of Avv. Zanin as the highest-value trust signal. Whether this asset exists or needs to be arranged is an open question.
- **Analytics decision:** Whether to use Google Analytics (with consent mode v2 complexity) or a privacy-first alternative (Fathom, Plausible) has not been decided. This decision must precede the Privacy Policy and cookie banner implementation.
- **PEC address:** The STACK.md references the fax/phone number but the PEC address for Avv. Zanin's studio is not confirmed in the research files. Required for the Contatti page and Privacy Policy.
- **kirby-uniform Kirby 5 compatibility:** MEDIUM confidence only — confirmed from release notes mentioning "Kirby 5 in tests" but not a hard confirmed-compatible release note. Needs a test install before committing to this dependency.

---

## Sources

### Primary (HIGH confidence)
- studioatheste reference project (direct codebase inspection) — template structure, blueprints, CDN versions, CSS architecture
- https://github.com/getkirby/kirby/releases — Kirby v5.3.3 (2026-03-26)
- https://packagist.org/packages/tobimori/kirby-seo — v1.1.2
- https://schema.org/LegalService — official schema type
- https://codicedeontologico-cnf.it/ — Art. 35 Codice Deontologico Forense (CNF, November 2025 update)
- https://www.iubenda.com/en/help/31246-italy-new-cookie-rules/ — Italian Garante cookie guidelines
- https://gsap.com/community/forums/topic/24495-gsap-and-google-core-web-vitals/ — official GSAP CWV guidance
- https://github.com/getkirby/staticache — Kirby staticache official docs
- https://getkirby.com/docs/guide/files/resize-images-on-the-fly — Kirby WebP/AVIF native support
- https://www.meanpug.com/a-definitive-study-on-law-firm-website-color-choices-2025/ — 10,000-site law firm color study
- https://www.ilovewp.com/resources/wordpress-for-lawyers/most-used-google-fonts-on-lawyer-websites/ — 42,966-site lawyer font study

### Secondary (MEDIUM confidence)
- https://seonardo.it/nicchie-seo/seo-altre-nicchie/seo-per-avvocati/ — SEO for Italian lawyers 2026
- https://www.thomasdimartino.it/sito-web-studio-legale/ — Italian law firm site structure guide
- https://bsmlegalmarketing.com/marketing-for-law-firms/local-seo-for-lawyers/schema-markup/ — LegalService schema for law firms
- https://privacymatters.dlapiper.com/2025/07/italy-marketing-privacy-consent-is-double-opt-in-now-mandatory/ — Italian double opt-in 2025
- https://www.legalbrandmarketing.com/site-architecture-for-legal-seo-structure/ — URL hierarchy for legal SEO
- https://natlawreview.com/article/10-costly-seo-mistakes-law-firms-must-avoid — law firm SEO mistakes
- https://packagist.org/packages/mzur/kirby-uniform — kirby-uniform Kirby 5 compatibility note
- https://gittings.com/the-best-performing-law-firm-websites-dont-use-stock-photos/ — stock photo trust impact

### Tertiary (LOW confidence / directional only)
- Competitor sites (avvocatobaraldo.it, avvocatozanetti.it) — structural reference only, not authoritative
- Local keyword volume estimates — directional; must be validated with Google Keyword Planner before content finalization

---
*Research completed: 2026-03-28*
*Ready for roadmap: yes*
