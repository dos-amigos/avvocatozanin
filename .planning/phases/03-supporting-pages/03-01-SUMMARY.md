---
phase: 03-supporting-pages
plan: "01"
subsystem: trust-pages
tags: [kirby, php, css, content, chi-sono, come-lavoro, trust]
dependency_graph:
  requires: [02-core-pages]
  provides: [chi-sono-page, come-lavoro-page]
  affects: [footer-links, sitemap, seo-structure]
tech_stack:
  added: []
  patterns: [page-hero-overlay, vertical-timeline, two-column-bio, values-grid, css-layers]
key_files:
  created:
    - site/blueprints/pages/chi-sono.yml
    - site/templates/chi-sono.php
    - content/chi-sono/chi-sono.txt
    - assets/css/pages/chi-sono.css
    - site/blueprints/pages/come-lavoro.yml
    - site/templates/come-lavoro.php
    - content/come-lavoro/come-lavoro.txt
    - assets/css/pages/come-lavoro.css
  modified: []
decisions:
  - "page-hero uses CSS custom property --hero-bg for inline background to avoid PHP echo in style attribute without escaping issues"
  - "portrait_url field added to chi-sono blueprint as separate from hero_image_url for bio column"
  - "breadcrumb--dark styles duplicated in chi-sono.css and come-lavoro.css (same Phase 2 decision: page-specific CSS loaded separately)"
  - "cl-timeline uses absolute-positioned ::before line with padding-left on container for clean vertical alignment"
metrics:
  duration: 4 minutes
  completed: "2026-03-31"
  tasks_completed: 2
  files_created: 8
  files_modified: 0
key_decisions:
  - "page-hero CSS custom property approach for background image"
  - "Breadcrumb dark styles per-page (established Phase 2 pattern)"
  - "portrait_url as separate blueprint field from hero_image_url"
---

# Phase 3 Plan 01: Chi Sono + Come Lavoro Trust Pages Summary

**One-liner:** Two trust pages (Chi Sono, Come Lavoro) with Kirby blueprints, PHP templates, Italian content, and CSS — Chi Sono shows attorney bio + Ordine Avvocati credentials + values grid; Come Lavoro shows 4-step vertical timeline methodology.

## Tasks Completed

| Task | Name | Commit | Files |
|------|------|--------|-------|
| 1 | Chi Sono — blueprint, template, content, CSS | 01d7f8b | site/templates/chi-sono.php, site/blueprints/pages/chi-sono.yml, content/chi-sono/chi-sono.txt, assets/css/pages/chi-sono.css |
| 2 | Come Lavoro — blueprint, template, content, CSS | 5cb64ac | site/templates/come-lavoro.php, site/blueprints/pages/come-lavoro.yml, content/come-lavoro/come-lavoro.txt, assets/css/pages/come-lavoro.css |

## What Was Built

### Chi Sono (`/chi-sono`)

- **Blueprint:** Tabbed (hero / contenuto / cta / seo). Fields: `hero_title`, `hero_subtitle`, `hero_image_url`, `bio_body`, `portrait_url`, `valori_title`, `valori` (structure), `ordine_numero`, `giurisdizione`, CTA fields, `meta_title`, `meta_description`.
- **Template:** Page hero (overlay with CSS custom property), two-column bio layout, credentials block with `award` + `map-pin` Lucide icons, values 3-column grid, CTA section.
- **Trust signals:** Hardcoded "Iscritto all'Ordine degli Avvocati di Padova" (TRUST-03) and "Tribunale di Este e il Tribunale di Padova" (TRUST-04) — always visible even if content fields are empty.
- **Content:** 4-paragraph Italian biography. Professional tone, no outcome promises, no testimonials (deontologically compliant). 4 values with Lucide icons (scale, eye, ear, target).
- **CSS:** `.page-hero`, `.cs-bio` (2-col grid → stacked), `.cs-credentials` (flex column, icon circle), `.cs-values__grid` (3→2→1 col responsive).

### Come Lavoro (`/come-lavoro`)

- **Blueprint:** Tabbed (hero / contenuto / seo). Fields: `hero_title`, `hero_subtitle`, `hero_image_url`, `intro_body`, `process_steps` (structure with step/title/description), CTA fields, `meta_title`, `meta_description`.
- **Template:** Page hero, editorial intro column, vertical timeline iterating `process_steps()->toStructure()`, CTA section.
- **Timeline:** Vertical connector via `::before` pseudo-element on `.cl-timeline`. Numbered markers (navy circles). Responsive: marker position adjusts at mobile.
- **Content:** 3-paragraph methodology intro + 4 steps: Consulenza Iniziale (01), Conferimento Mandato (02), Gestione della Causa (03), Raggiungimento del Risultato (04) — satisfies TRUST-02.
- **CSS:** `.cl-timeline`, `.cl-timeline__step`, `.cl-timeline__marker`, `.cl-timeline__number`, `.cl-timeline__content`.

## Requirements Satisfied

| Req ID | Description | Satisfied By |
|--------|-------------|--------------|
| TRUST-01 | Trust pages exist with professional content | Both pages created with seeded Italian content |
| TRUST-02 | Come Lavoro shows 4-step legal process | Vertical timeline with Consulenza/Mandato/Causa/Risultato |
| TRUST-03 | Iscritto all'Ordine degli Avvocati di Padova | Hardcoded in credentials section of chi-sono.php |
| TRUST-04 | Tribunale di Este e il Tribunale di Padova | Hardcoded in credentials section of chi-sono.php |

## Deviations from Plan

### Auto-applied decisions

**1. [Plan adaptation] CSS custom property for hero background image**
- **Found during:** Task 1
- **Issue:** Inline `style="background-image: url(...)"` would require careful PHP escaping; using a CSS custom property `--hero-bg` is cleaner and matches how the value flows into the template.
- **Fix:** Used `style="--hero-bg: url('...');"` with `esc()` on the URL, then `background-image: var(--hero-bg)` in CSS.
- **Files modified:** site/templates/chi-sono.php, site/templates/come-lavoro.php, assets/css/pages/chi-sono.css, assets/css/pages/come-lavoro.css

**2. [Plan adaptation] portrait_url separate field added**
- **Found during:** Task 1
- **Issue:** Plan mentioned a possible second field for portrait image in the bio column. Added `portrait_url` to blueprint with fallback to `hero_image_url` in template for flexibility.
- **Files modified:** site/blueprints/pages/chi-sono.yml, site/templates/chi-sono.php

Otherwise: plan executed as specified.

## Known Stubs

- `ordine_numero` field value is `(da confermare)` — placeholder pending client confirmation. The template renders it but displays `(n. iscrizione)` fallback if empty. Not a blocker for page function.
- `portrait_url` uses an Unsplash male portrait placeholder — to be replaced with real headshot when client provides one.

## Self-Check: PASSED

Files exist:
- site/templates/chi-sono.php: FOUND
- site/templates/come-lavoro.php: FOUND
- site/blueprints/pages/chi-sono.yml: FOUND
- site/blueprints/pages/come-lavoro.yml: FOUND
- content/chi-sono/chi-sono.txt: FOUND
- content/come-lavoro/come-lavoro.txt: FOUND
- assets/css/pages/chi-sono.css: FOUND
- assets/css/pages/come-lavoro.css: FOUND

Commits exist:
- 01d7f8b (Task 1): FOUND
- 5cb64ac (Task 2): FOUND
