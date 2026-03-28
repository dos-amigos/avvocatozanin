# Requirements: Avvocato Sebastiano Zanin

**Defined:** 2026-03-28
**Core Value:** Un potenziale cliente che cerca un avvocato civilista a Este/Padova deve trovare il sito, capire immediatamente i servizi offerti e poter contattare lo studio con facilità.

## v1 Requirements

Requirements for initial release. Each maps to roadmap phases.

### Foundation

- [ ] **FOUND-01**: Kirby CMS 5.x project setup with composer, config, and environment files
- [ ] **FOUND-02**: CSS architecture with design tokens (navy #1a2744 + gold #b8960c palette, Cormorant Garamond + Plus Jakarta Sans)
- [ ] **FOUND-03**: GSAP ScrollTrigger + Lenis smooth scroll with prefers-reduced-motion support
- [ ] **FOUND-04**: Responsive mobile-first layout with breakpoints (375px, 768px, 1280px, 1440px)
- [ ] **FOUND-05**: Shared snippets: header (sticky, transparent→solid), footer (4 colonne), head (meta), scripts

### Homepage

- [ ] **HOME-01**: Hero section with professional video/image, headline SEO "Avvocato Civilista a Este", CTA
- [ ] **HOME-02**: Intro section with parallax effect and studio presentation
- [ ] **HOME-03**: Stats counter section (anni esperienza, cause gestite, clienti assistiti, aree di pratica)
- [ ] **HOME-04**: Services overview grid (4 cards con icone per le aree di pratica)
- [ ] **HOME-05**: CTA section with background parallax and call-to-action per consulenza
- [ ] **HOME-06**: Full page animations (staggered reveals, word-by-word title, fade-up sections)

### Services

- [ ] **SERV-01**: Servizi listing page with grid of 4 service cards
- [ ] **SERV-02**: Servizio detail template with hero, sidebar navigator, rich content sections
- [ ] **SERV-03**: Diritto di Famiglia page — contenuto SEO per divorzi, separazioni, affidamento, successioni
- [ ] **SERV-04**: Diritto Immobiliare page — contenuto SEO per compravendite, locazioni, condominio, usucapione
- [ ] **SERV-05**: Risarcimento Danni page — contenuto SEO per incidenti, responsabilità civile, danni
- [ ] **SERV-06**: Recupero Crediti page — contenuto SEO per decreti ingiuntivi, esecuzioni, procedure
- [ ] **SERV-07**: FAQ accordion section per ogni servizio (4-6 domande con FAQPage schema)
- [ ] **SERV-08**: Process steps section per ogni servizio (come si svolge il percorso legale)

### Trust & About

- [ ] **TRUST-01**: Chi Sono page con bio professionale, esperienza, valori, giurisdizione
- [ ] **TRUST-02**: Come Lavoro page con processo legale (consulenza → mandato → causa → risultato)
- [ ] **TRUST-03**: Iscrizione Ordine Avvocati di Padova visibile (footer + chi-sono)
- [ ] **TRUST-04**: Giurisdizione esplicita: "Opero presso il Tribunale di Este e Padova"

### Contact

- [ ] **CONT-01**: Contatti page con form (nome, email, telefono, oggetto, messaggio, consenso GDPR)
- [ ] **CONT-02**: Protezione spam con honeypot
- [ ] **CONT-03**: Google Maps embed per Via G.B. Brunelli 12, Este
- [ ] **CONT-04**: Numero telefono clickabile nel header e nella pagina contatti
- [ ] **CONT-05**: Indirizzo PEC visibile nella pagina contatti

### SEO & Schema

- [ ] **SEO-01**: Meta title e description ottimizzati per ogni pagina (fallback chain)
- [ ] **SEO-02**: Open Graph tags (og:title, og:description, og:image, og:url) su tutte le pagine
- [ ] **SEO-03**: Schema.org LegalService + Person JSON-LD nel head (con address, geo, areaServed)
- [ ] **SEO-04**: FAQPage JSON-LD su ogni pagina servizio
- [ ] **SEO-05**: BreadcrumbList schema su tutte le pagine interne
- [ ] **SEO-06**: XML sitemap dinamico su /sitemap.xml
- [ ] **SEO-07**: Alt tags ottimizzati per tutte le immagini
- [ ] **SEO-08**: URL SEO-friendly: /servizi/diritto-di-famiglia, /servizi/diritto-immobiliare, etc.
- [ ] **SEO-09**: Canonical tags su tutte le pagine

### Legal Compliance

- [ ] **LEGAL-01**: Privacy Policy page conforme GDPR
- [ ] **LEGAL-02**: Cookie Policy page
- [ ] **LEGAL-03**: Cookie consent banner Garante-compliant (bottone Rifiuta con pari prominenza)
- [ ] **LEGAL-04**: Contenuti conformi Art. 35 Codice Deontologico Forense (no testimonianze, no promesse risultati)

### Performance

- [ ] **PERF-01**: Lazy loading su tutte le immagini
- [ ] **PERF-02**: Thumbnail presets per ottimizzazione immagini (default, card, hero, thumb)
- [ ] **PERF-03**: Page caching attivo (esclusa pagina contatti)
- [ ] **PERF-04**: Immagini hero professionali da Unsplash/Pexels (temi: giustizia, studio legale, consulenza legale)

### Navigation

- [ ] **NAV-01**: Header sticky con logo, nav links, telefono (trasparente→solid su scroll)
- [ ] **NAV-02**: Mega-dropdown per servizi nel menu desktop
- [ ] **NAV-03**: Mobile menu full-screen overlay con animazioni
- [ ] **NAV-04**: Breadcrumb navigation semantica su pagine interne
- [ ] **NAV-05**: Scroll-to-top button
- [ ] **NAV-06**: Skip-to-content link per accessibilità

## v2 Requirements

Deferred to future release. Tracked but not in current roadmap.

### News/Blog

- **NEWS-01**: News listing page con article cards
- **NEWS-02**: Articolo detail page con rich content
- **NEWS-03**: Feed RSS per aggiornamenti legali

### Enhanced Trust

- **ETRUST-01**: Sezione partner/collaborazioni
- **ETRUST-02**: Certificazioni e formazione continua timeline

### Analytics

- **ANALY-01**: Google Analytics 4 integrato (con consenso cookie)
- **ANALY-02**: Google Search Console setup
- **ANALY-03**: Google Business Profile ottimizzato

## Out of Scope

| Feature | Reason |
|---------|--------|
| Area riservata clienti | Complessità enterprise, non necessaria per studio singolo |
| Booking online appuntamenti | Integrazione esterna, clienti legali italiani chiamano |
| Live chat / chatbot | GDPR complesso, regole deontologiche, costo continuo |
| Testimonianze clienti con nomi | Vietato da Art. 35 Codice Deontologico Forense |
| Promesse di risultati | Vietato da Codice Deontologico Forense |
| Calcolatore tariffe | Svilisce il servizio, crea aspettative irrealistiche |
| Multilingua | Target interamente italiano, mercato locale |
| E-commerce / pagamenti online | Non appropriato per servizi legali |
| Social media feed embed | Peso JS, privacy, contenuto potenzialmente stale |
| Gavels/bilance della giustizia nelle immagini | Simboli americani, non italiani |

## Traceability

| Requirement | Phase | Status |
|-------------|-------|--------|
| FOUND-01 | Phase 1 | Pending |
| FOUND-02 | Phase 1 | Pending |
| FOUND-03 | Phase 1 | Pending |
| FOUND-04 | Phase 1 | Pending |
| FOUND-05 | Phase 1 | Pending |
| NAV-01 | Phase 1 | Pending |
| NAV-02 | Phase 1 | Pending |
| NAV-03 | Phase 1 | Pending |
| NAV-04 | Phase 1 | Pending |
| NAV-05 | Phase 1 | Pending |
| NAV-06 | Phase 1 | Pending |
| HOME-01 | Phase 2 | Pending |
| HOME-02 | Phase 2 | Pending |
| HOME-03 | Phase 2 | Pending |
| HOME-04 | Phase 2 | Pending |
| HOME-05 | Phase 2 | Pending |
| HOME-06 | Phase 2 | Pending |
| SERV-01 | Phase 2 | Pending |
| SERV-02 | Phase 2 | Pending |
| SERV-03 | Phase 2 | Pending |
| SERV-04 | Phase 2 | Pending |
| SERV-05 | Phase 2 | Pending |
| SERV-06 | Phase 2 | Pending |
| SERV-07 | Phase 2 | Pending |
| SERV-08 | Phase 2 | Pending |
| PERF-04 | Phase 2 | Pending |
| TRUST-01 | Phase 3 | Pending |
| TRUST-02 | Phase 3 | Pending |
| TRUST-03 | Phase 3 | Pending |
| TRUST-04 | Phase 3 | Pending |
| CONT-01 | Phase 3 | Pending |
| CONT-02 | Phase 3 | Pending |
| CONT-03 | Phase 3 | Pending |
| CONT-04 | Phase 3 | Pending |
| CONT-05 | Phase 3 | Pending |
| PERF-01 | Phase 3 | Pending |
| PERF-02 | Phase 3 | Pending |
| PERF-03 | Phase 3 | Pending |
| SEO-01 | Phase 4 | Pending |
| SEO-02 | Phase 4 | Pending |
| SEO-03 | Phase 4 | Pending |
| SEO-04 | Phase 4 | Pending |
| SEO-05 | Phase 4 | Pending |
| SEO-06 | Phase 4 | Pending |
| SEO-07 | Phase 4 | Pending |
| SEO-08 | Phase 4 | Pending |
| SEO-09 | Phase 4 | Pending |
| LEGAL-01 | Phase 4 | Pending |
| LEGAL-02 | Phase 4 | Pending |
| LEGAL-03 | Phase 4 | Pending |
| LEGAL-04 | Phase 4 | Pending |

**Coverage:**
- v1 requirements: 51 total
- Mapped to phases: 51
- Unmapped: 0

---
*Requirements defined: 2026-03-28*
*Last updated: 2026-03-28 — traceability updated after roadmap creation*
