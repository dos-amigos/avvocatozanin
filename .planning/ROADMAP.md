# Roadmap: Avvocato Sebastiano Zanin

## Overview

Four phases that build the site layer by layer. Phase 1 establishes the Kirby infrastructure and navigation shell that every other template depends on. Phase 2 builds the primary conversion path — homepage and all four service pages, the main SEO surface. Phase 3 completes the trust and contact pages that turn search-driven visitors into clients. Phase 4 finalizes SEO schema, legal compliance, and performance before the site goes public. Nothing ships until Phase 4 passes its gate.

## Phases

**Phase Numbering:**
- Integer phases (1, 2, 3): Planned milestone work
- Decimal phases (2.1, 2.2): Urgent insertions (marked with INSERTED)

Decimal phases appear between their surrounding integers in numeric order.

- [ ] **Phase 1: Foundation** - Kirby setup, design tokens, animations, navigation shell
- [ ] **Phase 2: Core Pages** - Homepage, four service pages, hero media
- [ ] **Phase 3: Supporting Pages** - Chi Sono, Come Lavoro, Contatti, performance layer
- [ ] **Phase 4: SEO, Compliance & Launch** - Full schema, GDPR compliance, performance audit

## Phase Details

### Phase 1: Foundation
**Goal**: The project skeleton is running locally — Kirby installed, design tokens applied, GSAP/Lenis initialized, and the full header/footer navigation shell renders correctly on all screen sizes
**Depends on**: Nothing (first phase)
**Requirements**: FOUND-01, FOUND-02, FOUND-03, FOUND-04, FOUND-05, NAV-01, NAV-02, NAV-03, NAV-04, NAV-05, NAV-06
**Success Criteria** (what must be TRUE):
  1. Kirby CMS runs locally with composer dependencies installed and no errors
  2. The navy/gold color palette and Cormorant Garamond/Plus Jakarta Sans typography render correctly in the browser
  3. GSAP ScrollTrigger and Lenis smooth scroll initialize without errors, and motion stops when prefers-reduced-motion is set
  4. The sticky header transitions from transparent to solid on scroll, shows the clickable phone number, and the mega-dropdown for services opens on desktop
  5. The mobile full-screen menu overlay opens and closes with animation; skip-to-content and scroll-to-top are present
**Plans:** 2/5 plans executed

Plans:
- [x] 01-01-PLAN.md — Kirby 5 project scaffolding: composer.json, config.php, content seed files
- [x] 01-02-PLAN.md — CSS architecture: navy/gold design tokens, all CSS layers (parallel with 01-01)
- [ ] 01-03-PLAN.md — Head/scripts snippets + JS modules (scroll.js, animations.js, main.js)
- [ ] 01-04-PLAN.md — Navigation shell: header.php, footer.php, navigation.js (parallel with 01-03)
- [ ] 01-05-PLAN.md — Homepage template wiring + human visual verification checkpoint

**UI hint**: yes

### Phase 2: Core Pages
**Goal**: A visitor arriving at the site can read the homepage, browse the services listing, and read all four detailed service pages with professional hero imagery and full animated sections
**Depends on**: Phase 1
**Requirements**: HOME-01, HOME-02, HOME-03, HOME-04, HOME-05, HOME-06, SERV-01, SERV-02, SERV-03, SERV-04, SERV-05, SERV-06, SERV-07, SERV-08, PERF-04
**Success Criteria** (what must be TRUE):
  1. The homepage hero section displays a professional image/video with the SEO headline "Avvocato Civilista a Este" and a visible CTA
  2. All homepage sections render — intro with parallax, stats counter, four-service grid, and CTA banner — with staggered scroll animations
  3. The /servizi page shows a grid of four service cards linking to individual service pages
  4. Each of the four service pages (famiglia, immobiliare, danni, crediti) displays complete SEO content, a FAQ accordion, and a process steps section
  5. All hero images are sourced from Unsplash/Pexels with legal/justice themes (no gavels or American courtroom symbols)
**Plans**: TBD
**UI hint**: yes

### Phase 3: Supporting Pages
**Goal**: A visitor who wants to learn about the lawyer or contact the studio can do so — Chi Sono, Come Lavoro, and Contatti are complete, the contact form sends messages, and image performance is optimized
**Depends on**: Phase 2
**Requirements**: TRUST-01, TRUST-02, TRUST-03, TRUST-04, CONT-01, CONT-02, CONT-03, CONT-04, CONT-05, PERF-01, PERF-02, PERF-03
**Success Criteria** (what must be TRUE):
  1. The Chi Sono page shows Avv. Zanin's biography, the Ordine degli Avvocati di Padova registration reference, and an explicit jurisdiction statement naming Tribunale di Este and Tribunale di Padova
  2. The Come Lavoro page shows a step-by-step legal process (consulenza → mandato → causa → risultato)
  3. The Contatti page form submits successfully, honeypot spam protection is active, Google Maps embeds the correct address, and the PEC address and clickable phone number are visible
  4. Page cache is active for all pages except /contatti; all images use lazy loading; thumbnail presets are configured for hero, card, and thumb sizes
**Plans**: TBD
**UI hint**: yes

### Phase 4: SEO, Compliance & Launch
**Goal**: The site is legally compliant, fully indexed, and ready for public launch — all schema is valid, GDPR requirements are met, and Core Web Vitals pass on mobile
**Depends on**: Phase 3
**Requirements**: SEO-01, SEO-02, SEO-03, SEO-04, SEO-05, SEO-06, SEO-07, SEO-08, SEO-09, LEGAL-01, LEGAL-02, LEGAL-03, LEGAL-04
**Success Criteria** (what must be TRUE):
  1. Every page has a unique, optimized meta title and description; Open Graph tags are present and populated with real content
  2. LegalService + Person JSON-LD validates in Google Rich Results Test with the correct NAP string; FAQPage schema is present on each service page; BreadcrumbList schema on all internal pages
  3. /sitemap.xml returns a valid XML sitemap; canonical tags and SEO-friendly URLs (/servizi/diritto-di-famiglia etc.) are in place; alt tags are present on all images
  4. Privacy Policy and Cookie Policy pages exist; the cookie consent banner shows Rifiuta and Accetta buttons with equal visual prominence; the contact form includes a mandatory GDPR consent checkbox
  5. All content has been reviewed against Art. 35 Codice Deontologico Forense (no outcome promises, no testimonials, no laudatory superlatives); Lighthouse mobile score is acceptable with LCP < 2.5s
**Plans**: TBD

## Progress

**Execution Order:**
Phases execute in numeric order: 1 → 2 → 3 → 4

| Phase | Plans Complete | Status | Completed |
|-------|----------------|--------|-----------|
| 1. Foundation | 2/5 | In Progress|  |
| 2. Core Pages | 0/TBD | Not started | - |
| 3. Supporting Pages | 0/TBD | Not started | - |
| 4. SEO, Compliance & Launch | 0/TBD | Not started | - |
