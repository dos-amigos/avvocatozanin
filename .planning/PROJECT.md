# Avvocato Sebastiano Zanin

## What This Is

Sito web professionale per l'Avvocato Sebastiano Zanin, civilista con studio a Este (PD). Il sito presenta i servizi legali offerti (diritto di famiglia, immobiliare, risarcimento danni, recupero crediti), costruito con Kirby CMS, ottimizzato SEO per posizionamento locale e nazionale sulle keyword del diritto civile.

## Core Value

Un potenziale cliente che cerca un avvocato civilista a Este/Padova deve trovare il sito, capire immediatamente i servizi offerti e poter contattare lo studio con facilità.

## Requirements

### Validated

(None yet — ship to validate)

### Active

- [ ] Sito Kirby CMS con struttura completa (home, chi-sono, servizi, contatti, news)
- [ ] 4 pagine servizio dettagliate ottimizzate SEO (famiglia, immobiliare, danni, crediti)
- [ ] Design moderno, elegante e professionale con animazioni premium (GSAP, Lenis)
- [ ] Full SEO: meta tags, Open Graph, alt tags, sitemap XML, structured data
- [ ] Contenuti professionali scritti in ottica SEO con keyword research
- [ ] Hero sections con foto/video professionali da Unsplash/Pexels
- [ ] Form di contatto funzionante con protezione spam
- [ ] Responsive design mobile-first
- [ ] Performance ottimizzata (lazy loading, cache, thumbnail presets)

### Out of Scope

- Blog/News avanzato con categorie e tag — troppo complesso per v1, si aggiunge dopo
- Area riservata clienti — funzionalità enterprise, non necessaria ora
- Booking online appuntamenti — integrazione esterna, fase successiva
- Multilingua — il target è italiano

## Context

- **Progetto di riferimento:** studioatheste (C:\Users\boxwe\Documents\GitHub\studioatheste) — stesso stack Kirby CMS, stessa struttura, adattare per ambito legale
- **Stack collaudato:** Kirby 5, GSAP + ScrollTrigger, Lenis smooth scroll, Lucide icons, Google Fonts, CSS Layers
- **Target SEO locale:** "avvocato Este", "avvocato civilista Padova", "studio legale Este", "avvocato divorzista Este"
- **Media:** foto e video professionali da Unsplash e Pexels (temi: giustizia, studio legale, consulenza)
- **Contenuti:** ispirati da siti di avvocati reali, riscritti completamente in ottica SEO
- **Contatti:** dati placeholder realistici, il cliente li sostituirà

## Constraints

- **Tech stack**: Kirby CMS 5.x (PHP 8.2+) — coerenza con progetto esistente
- **Hosting**: Apache con .htaccess, PHP 8.2-8.4
- **Design**: Deve trasmettere autorevolezza e professionalità legale
- **SEO**: Ogni pagina servizio deve avere meta title, description, OG tags, alt tags ottimizzati
- **Performance**: Core Web Vitals ottimali (lazy load, cache, image optimization)
- **Accessibilità**: ARIA labels, semantic HTML, keyboard navigation

## Key Decisions

| Decision | Rationale | Outcome |
|----------|-----------|---------|
| Kirby CMS come piattaforma | Coerenza con studioatheste, file-based CMS semplice e performante | — Pending |
| GSAP + Lenis per animazioni | Stack premium collaudato nel progetto di riferimento | — Pending |
| 4 servizi principali per v1 | Copertura completa diritto civile, espandibile in futuro | — Pending |
| Foto/video da stock (Unsplash/Pexels) | Qualità professionale, zero costi, sostituibili con foto reali | — Pending |
| Dati contatto placeholder | Il cliente fornirà i dati reali, non blocca lo sviluppo | — Pending |

## Evolution

This document evolves at phase transitions and milestone boundaries.

**After each phase transition** (via `/gsd:transition`):
1. Requirements invalidated? → Move to Out of Scope with reason
2. Requirements validated? → Move to Validated with phase reference
3. New requirements emerged? → Add to Active
4. Decisions to log? → Add to Key Decisions
5. "What This Is" still accurate? → Update if drifted

**After each milestone** (via `/gsd:complete-milestone`):
1. Full review of all sections
2. Core Value check — still the right priority?
3. Audit Out of Scope — reasons still valid?
4. Update Context with current state

---
*Last updated: 2026-03-28 after initialization*
