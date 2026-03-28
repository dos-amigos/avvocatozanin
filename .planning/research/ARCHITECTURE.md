# Architecture Patterns

**Domain:** Professional civil lawyer website (avvocato civilista)
**Project:** Avvocato Sebastiano Zanin — Este (PD)
**Reference project:** studioatheste (same Kirby CMS stack, adapted from accounting firm)
**Researched:** 2026-03-28

---

## Recommended Architecture

Kirby CMS file-based structure maps content folders directly to URLs. Every folder under `content/` becomes a URL segment. The architecture is a two-level tree: top-level pages (flat nav) + one level of children for servizi. This mirrors studioatheste exactly.

### Content Hierarchy Map

```
content/
├── home/                          → /
├── chi-sono/                      → /chi-sono
├── servizi/                       → /servizi
│   ├── 1_diritto-di-famiglia/     → /servizi/diritto-di-famiglia
│   ├── 2_diritto-immobiliare/     → /servizi/diritto-immobiliare
│   ├── 3_risarcimento-danni/      → /servizi/risarcimento-danni
│   └── 4_recupero-crediti/        → /servizi/recupero-crediti
├── come-lavoro/                   → /come-lavoro
├── contatti/                      → /contatti
└── news/                          → /news
    ├── 1_articolo-x/              → /news/[slug]
    └── 2_articolo-y/              → /news/[slug]
```

Note on naming: "chi-sono" (singular) is correct for a solo practitioner. studioatheste uses "chi-siamo" because it is a firm of three. "Come-lavoro" (singular) replaces "come-lavoriamo" for the same reason.

---

## Component Boundaries

### Page Inventory

| Page | Template | URL | Purpose | SEO Target |
|------|----------|-----|---------|-----------|
| Home | `home.php` | `/` | First impression, service overview, CTA | "avvocato civilista Este", "studio legale Este" |
| Chi Sono | `chi-sono.php` | `/chi-sono` | Credibility, biography, bar registration | "avvocato Zanin", "avvocato Este Sebastiano Zanin" |
| Servizi (listing) | `servizi.php` | `/servizi` | Practice area hub — links to all 4 detail pages | "servizi legali Este", "avvocato civile Padova" |
| Diritto di Famiglia | `servizio.php` | `/servizi/diritto-di-famiglia` | Divorce, separation, child custody | "avvocato divorzista Este", "separazione coniugale Padova" |
| Diritto Immobiliare | `servizio.php` | `/servizi/diritto-immobiliare` | Property disputes, contracts, leases | "avvocato immobiliare Este", "controversie condominiali" |
| Risarcimento Danni | `servizio.php` | `/servizi/risarcimento-danni` | Personal injury, road accidents, malpractice | "risarcimento danni Este", "avvocato sinistri Padova" |
| Recupero Crediti | `servizio.php` | `/servizi/recupero-crediti` | Debt collection, injunctions, enforcement | "recupero crediti Este", "decreto ingiuntivo Padova" |
| Come Lavoro | `come-lavoro.php` | `/come-lavoro` | Process, methodology, client journey | "consulenza legale Este", trust signal |
| Contatti | `contatti.php` | `/contatti` | Contact form, map, phone, address | "contatti studio legale Este" |
| News (listing) | `news.php` | `/news` | Legal articles, SEO long-tail content | Topical authority, long-tail keywords |
| Articolo | `articolo.php` | `/news/[slug]` | Individual article | Long-tail query per topic |

### Pages Explicitly NOT in v1

| Page | Reason |
|------|--------|
| /area-riservata | Out of scope (PROJECT.md) |
| /prenotazioni | Out of scope (PROJECT.md) |
| /en/ (multilingual) | Out of scope (PROJECT.md) |
| /privacy-policy, /cookie-policy | Simple static pages — add as unlisted Kirby pages, no nav entry |

---

## URL Structure for SEO

### Rationale for URL Choices

**`/servizi/[area]/` over `/[area]/`**

Grouping service detail pages under `/servizi/` signals topical cluster structure to Google. It makes the sitemap hierarchy obvious, enables breadcrumb schema (Home > Servizi > Diritto di Famiglia), and matches the reference project exactly. URLs remain short (max 4 segments including domain).

**`/chi-sono` over `/avvocato` or `/profilo`**

"Chi Sono" is the established pattern for Italian solo-practitioner sites. It ranks for branded searches and humanizes the page.

**`/come-lavoro` over `/metodo` or `/approccio`**

Direct, conversational. Matches the question a potential client asks: "come lavori?". studioatheste uses `/come-lavoriamo` — adapt to singular.

**`/news` over `/blog` or `/articoli`**

Neutral term. Avoids expectation of frequent publishing that a solo practitioner cannot sustain. Can be renamed to `/blog` later without structural change.

### Breadcrumb Schema Target

```
Home → Servizi → Diritto di Famiglia
```

Implement `BreadcrumbList` JSON-LD on all servizio pages. This drives "rich snippet" breadcrumbs in Google SERPs.

---

## Data Flow

```
Kirby Panel (CMS) → content/*.txt files → PHP templates → HTML response
                                            ↑
                                     site/blueprints/*.yml  (defines fields)
                                     site/templates/*.php   (renders fields)
                                     site/snippets/*.php    (shared partials)
```

There is no database. No API. All data flows from flat `.txt` files in the `content/` directory, read by Kirby's PHP core at request time. Caching is at the HTTP level (`.htaccess` + Kirby's page cache).

### Key Data Sources Per Page

| Template | Primary Data Source | Shared Snippets |
|----------|---------------------|-----------------|
| home.php | `content/home/home.txt` | header, footer, hero, stats, services-grid, cta |
| chi-sono.php | `content/chi-sono/chi-sono.txt` | header, footer, hero, bio, values |
| servizi.php | `content/servizi/servizi.txt` + children collection | header, footer, hero, service-cards |
| servizio.php | `content/servizi/[area]/servizio.txt` | header, footer, hero, panoramica, includes, process, faq, cta |
| come-lavoro.php | `content/come-lavoro/come-lavoro.txt` | header, footer, hero, steps |
| contatti.php | `content/contatti/contatti.txt` | header, footer, hero, form, map |
| news.php | `content/news/` children collection | header, footer, article-grid |
| articolo.php | `content/news/[n]_[slug]/articolo.txt` | header, footer, article-body |

---

## Individual Page Anatomy

### Home (/)

Sections in render order:

1. **Hero** — Full-screen video/image, eyebrow "Avvocato Civilista — Este (PD)", headline, two CTAs (Servizi, Contatti)
2. **Intro** — 2-3 paragraph mission statement, pull-quote
3. **Stats** — 3 counters (e.g. "20+ anni di esperienza", "500+ clienti assistiti", "4 aree di diritto")
4. **Services Grid** — 4 cards linking to service detail pages
5. **CTA Banner** — "Prima consulenza gratuita" with phone number and contact link
6. **News Preview** — Latest 3 articles (if news section has content)

### Servizio (/servizi/[area])

Sections in render order — identical structure for all 4, populated from content fields:

1. **Hero** — Area-specific image, title, subtitle, 3 badge stats
2. **Panoramica** — 2-3 paragraph introduction to the legal area, positioned split with image
3. **Cosa Include** — 6-item icon grid detailing what the service covers
4. **Il Processo** — 5-step numbered timeline (client journey: first call → case evaluation → strategy → execution → resolution)
5. **FAQ** — 5 questions with accordion, renders `FAQPage` JSON-LD schema
6. **Callout / Contatori** — 3 statistics reinforcing credibility
7. **Servizi Correlati** — Links to 2-3 related practice areas
8. **CTA** — "Prenota una consulenza gratuita"

This exact structure is already proven in studioatheste's `servizio.php` template. Reuse directly.

### Chi Sono (/chi-sono)

1. **Hero** — Professional headshot or office photo
2. **Biografia** — Narrative bio (bar admission, specializations, philosophy)
3. **Valori** — 4-card icon grid (e.g. Professionalità, Riservatezza, Tempestività, Vicinanza)
4. **Iscrizione Ordine** — Formal credentials block (Ordine Avvocati di Padova, number, year)
5. **CTA** — Contatti link

Note: Solo practitioner — no team grid needed. This differentiates from studioatheste which has a multi-person team section.

### Come Lavoro (/come-lavoro)

1. **Hero**
2. **Introduzione** — Philosophy paragraph
3. **Fasi** — 5-step process from initial contact to case resolution
4. **Garanzie** — What the client can count on (transparency, timelines, communication)
5. **CTA**

### Contatti (/contatti)

1. **Hero**
2. **Dove Trovarci** — Address, phone, fax, map embed
3. **Form di Contatto** — Name, email, phone, legal area (select), message, anti-spam
4. **Orari** — Office hours
5. **CTA** — Direct phone number button

Contact details (from PROJECT.md):
- Address: Via G.B. Brunelli 12, 35042 Este (PD)
- Tel/Fax: 0429.1960202

---

## Structured Data (Schema.org)

### Global (all pages via site snippet)

```json
{
  "@type": "LegalService",
  "name": "Avvocato Sebastiano Zanin",
  "address": { "@type": "PostalAddress", "streetAddress": "Via G.B. Brunelli 12", "addressLocality": "Este", "postalCode": "35042", "addressRegion": "PD" },
  "telephone": "+390429196020",
  "url": "https://avvocatozanin.it",
  "geo": { "@type": "GeoCoordinates", "latitude": "45.2268", "longitude": "11.6569" }
}
```

### Servizio pages

- `FAQPage` JSON-LD generated from FAQ structure field
- `BreadcrumbList` from page URL path

### Articolo pages

- `Article` JSON-LD with datePublished, author, headline

---

## Kirby Blueprint Structure

Mirrors studioatheste exactly. Key blueprints needed:

| Blueprint file | Template | Notes |
|----------------|----------|-------|
| `home.yml` | `home.php` | Copy + adapt from studioatheste, remove team fields |
| `chi-sono.yml` | `chi-sono.php` | New — single person bio, values, credentials |
| `servizi.yml` | `servizi.php` | Copy from studioatheste |
| `servizio.yml` | `servizio.php` | Copy from studioatheste — already has FAQ, process, includes tabs |
| `come-lavoro.yml` | `come-lavoro.php` | Adapt from `come-lavoriamo.yml` in studioatheste |
| `contatti.yml` | `contatti.php` | Copy from studioatheste |
| `news.yml` | `news.php` | Copy from studioatheste |
| `articolo.yml` | `articolo.php` | Copy from studioatheste |
| `tabs/seo.yml` | shared tab | Copy from studioatheste — meta title, description, OG image |

The `servizio.yml` blueprint from studioatheste already includes all necessary tabs: Hero, Contenuto (panoramica + includes + process_steps + faq), Dati (callout_counters + referent + related_services), Card, CTA, SEO. This can be reused as-is.

---

## Navigation Structure

### Primary Nav (header)

```
Chi Sono  |  Servizi  |  Come Lavoro  |  Contatti
```

"Servizi" is a dropdown on desktop revealing the 4 practice areas. On mobile it expands to show sub-items.

### Footer Nav

```
Col 1: Studio           Col 2: Servizi              Col 3: Contatti
  Chi Sono                Diritto di Famiglia          Via G.B. Brunelli 12
  Come Lavoro             Diritto Immobiliare          35042 Este (PD)
  News                    Risarcimento Danni           Tel: 0429.1960202
  Contatti                Recupero Crediti             [Form button]
```

### Breadcrumbs

Render on all non-home pages. Required for SEO rich snippets on servizio pages.

---

## Build Order (Phase Dependencies)

The architecture creates a clear dependency graph. Build order flows from foundation to content:

```
Layer 1: Infrastructure
  → Kirby install, composer, directory structure
  → CSS layers, custom properties, typography tokens
  → GSAP + Lenis setup

Layer 2: Shared Components (snippets)
  → header.php (nav with dropdown)
  → footer.php
  → hero.php (reusable across all pages)
  → cta.php (reusable CTA banner)
  → form.php (contact form)

Layer 3: Core Pages (templates)
  → home.php + blueprint + content
  → servizi.php + blueprint + content
  → servizio.php + blueprint + content (×4 pages)

Layer 4: Secondary Pages
  → chi-sono.php + blueprint + content
  → come-lavoro.php + blueprint + content
  → contatti.php + blueprint + content

Layer 5: Content & SEO
  → All .txt content files populated
  → Meta/OG tags per page
  → JSON-LD schema snippets
  → XML sitemap (Kirby plugin)
  → robots.txt

Layer 6: News (optional in v1)
  → news.php + articolo.php + blueprint
  → First few seed articles
```

### Critical Path

Home → Servizi listing → Servizio (any one) is the minimum viable visitor journey. These three templates must ship together. The contact form and chi-sono page must also be functional before launch (they are conversion-critical).

---

## Scalability Considerations

| Concern | Now (v1) | Later |
|---------|----------|-------|
| Service pages | 4 static pages | Add 5th service: new content folder, no template change |
| News volume | <20 articles | Kirby handles hundreds flat; add year subfolders only if >500 |
| Team | Solo practitioner | If associates join, add Team structure field to chi-sono.yml |
| Languages | Italian only | Kirby multilingual is a config flag; URL structure remains compatible |
| Booking | None | Add Calendly embed or separate plugin; no structural change needed |

---

## Sources

- [Site Architecture for Legal SEO](https://www.legalbrandmarketing.com/site-architecture-for-legal-seo-structure/) — URL hierarchy, practice area clusters
- [Law Firm SEO and URL Structures](https://custom.legal/knowledge/law-firm-seo-and-url-structures/) — URL keyword placement data
- [Schema Markup for Law Firms](https://bsmlegalmarketing.com/marketing-for-law-firms/local-seo-for-lawyers/schema-markup/) — LegalService + FAQPage schema
- [SEO for Lawyers 2026 Complete Guide](https://www.promodo.com/blog/seo-for-lawyers-and-attorneys) — Current best practices
- [Law Firm SEO Guide 2026: AI and Local Search](https://branlp.com/the-complete-guide-to-law-firm-seo-2026-dominating-the-era-of-ai-and-hyper-local-search/) — AI search and schema
- [Sito Web Studio Legale (Italian guide)](https://www.thomasdimartino.it/sito-web-studio-legale/) — Italian-specific structure, deontology, solo vs firm naming
- [LegalService Schema — Schema.org](https://schema.org/LegalService) — Official schema type
- [Kirby CMS Content Guide](https://getkirby.com/docs/guide/content) — File-based URL and folder structure
- studioatheste reference project — Confirmed field structure, blueprint tabs, template inventory
