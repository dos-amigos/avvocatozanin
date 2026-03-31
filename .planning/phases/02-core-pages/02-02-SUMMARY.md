---
phase: 02-core-pages
plan: 02
subsystem: ui
tags: [kirby, php, gsap, scrolltrigger, lucide, css-layers, accordion, timeline]

# Dependency graph
requires:
  - phase: 01-foundation
    provides: head.php with pageCss map (servizi + servizio pre-registered), scripts.php with $pageJs pattern, variables.css design tokens, header/footer snippets

provides:
  - site/templates/servizi.php: dynamic service listing page with children()->listed() card grid
  - site/templates/servizio.php: service detail template with hero, sidebar scroll-spy, panoramica, cosa-include, process timeline, FAQ accordion, CTA
  - site/blueprints/pages/servizi.yml: Panel blueprint for listing page fields
  - site/blueprints/pages/servizio.yml: tabbed Panel blueprint (hero, contenuto, card, cta, seo) with structure fields
  - assets/css/pages/servizi.css: page-hero, breadcrumb, services-grid, service-card styles
  - assets/css/pages/servizio.css: service-navigator grid, sidebar sticky, accordion, process timeline, all tokens mapped
  - assets/js/pages/servizio.js: scroll-spy, process timeline GSAP, FAQ accordion with ARIA, section fade-ins, reduced-motion guard
  - content/servizi/servizi.txt: Italian copy seed for listing page

affects: [02-03-content-seeding, seo-optimization, servizi-child-pages]

# Tech tracking
tech-stack:
  added: []
  patterns:
    - "Page-hero pattern: .page-hero with absolute bg img, overlay div, content container — used on both servizi and servizio pages"
    - "Breadcrumb pattern: ol.breadcrumb with __item, __separator, __item--active — aria-label Breadcrumb"
    - "Sidebar scroll-spy: ScrollTrigger per section, is-active class on matching sidebar link"
    - "FAQ accordion: data-accordion group, data-accordion-item items, GSAP height animation, aria-expanded toggle, reduced-motion fallback via style.height"
    - "Process timeline: absolute-positioned track + animated progress bar, per-step ScrollTrigger for is-active marker state"
    - "Unsplash URL in hero_image_url field — no file picker, panel editable URL"

key-files:
  created:
    - site/templates/servizi.php
    - site/templates/servizio.php
    - site/blueprints/pages/servizi.yml
    - site/blueprints/pages/servizio.yml
    - assets/css/pages/servizi.css
    - assets/css/pages/servizio.css
    - assets/js/pages/servizio.js
    - content/servizi/servizi.txt
  modified:
    - site/snippets/scripts.php

key-decisions:
  - "sidebar nav links are conditionally rendered based on isNotEmpty() — only shows links for sections that have content"
  - "page-hero styles duplicated in both servizi.css and servizio.css (acceptable — they load on different pages, no shared CSS file needed for 2 selectors)"
  - "Avv. Sebastiano Zanin hardcoded in sidebar contact card — no content field needed, single referent"
  - "hero_image_url field is type:url in blueprint — per-service Unsplash URL editable in Panel"
  - "Process timeline steps start at opacity:0/transform:translateY(24px) in CSS, animated to final state by GSAP; reduced-motion overrides to opacity:1/transform:none in CSS"

patterns-established:
  - "page-hero: 50vh min-height, absolute bg img, overlay, content z-index 2, breadcrumb + h1 + subtitle"
  - "section-header: centered, max-width 680px, eyebrow (gold, uppercase, 12px) + title (heading font) + description"
  - "service-card: white bg, border + radius, hover translateY(-4px) + shadow-md + secondary border"
  - "accordion: CSS height:0 + overflow:hidden, GSAP animate to panelInner.offsetHeight; aria-expanded + aria-hidden toggles"

requirements-completed: [SERV-01, SERV-02, SERV-07, SERV-08, PERF-04]

# Metrics
duration: 20min
completed: 2026-03-31
---

# Phase 02 Plan 02: Service Templates Summary

**Kirby servizi listing + servizio detail templates with CSS design-token mapping, GSAP scroll-spy sidebar, process timeline, and FAQ accordion with reduced-motion fallback**

## Performance

- **Duration:** ~20 min
- **Started:** 2026-03-31T13:10:00Z
- **Completed:** 2026-03-31T13:30:00Z
- **Tasks:** 3
- **Files modified:** 9 (8 created, 1 modified)

## Accomplishments

- /servizi listing renders child service pages dynamically via `$page->children()->listed()` as a 2-column card grid with Lucide icons, titles, descriptions, and arrow chevrons
- /servizi/* detail pages have a sidebar scroll-spy navigator, panoramica body text, cosa-include grid, scroll-driven process timeline with animated progress bar, and FAQ accordion
- All JS functional under `prefers-reduced-motion` — accordion uses direct height toggle instead of GSAP, scroll/animation features skipped gracefully
- scripts.php now conditionally loads servizio.js only on servizio template pages

## Task Commits

1. **Task 1: Servizi listing page** - `b948394` (feat)
2. **Task 2: Servizio detail template, blueprint, CSS** - `1004b73` (feat)
3. **Task 3: servizio.js + scripts.php registration** - `b081d93` (feat)

## Files Created/Modified

- `site/templates/servizi.php` - Listing template: page hero, breadcrumb, dynamic card grid, CTA
- `site/blueprints/pages/servizi.yml` - Panel blueprint for hero/servizi/CTA/SEO fields
- `assets/css/pages/servizi.css` - page-hero, breadcrumb, section-header, services-grid, service-card
- `content/servizi/servizi.txt` - Italian copy seed for listing page
- `site/templates/servizio.php` - Detail template: hero, sidebar nav + contact card, panoramica, cosa-include, process timeline, FAQ accordion, CTA
- `site/blueprints/pages/servizio.yml` - Tabbed blueprint (hero, contenuto, card, cta, seo) with structure fields for includes/process_steps/faq
- `assets/css/pages/servizio.css` - service-navigator grid, sticky sidebar, accordion (height:0/overflow:hidden), process timeline, prefers-reduced-motion overrides
- `assets/js/pages/servizio.js` - IIFE with reducedMotion guard; scroll-spy, timeline GSAP, FAQ accordion with ARIA, section fade-ins
- `site/snippets/scripts.php` - Added 'servizio' entry to $pageJs map

## Decisions Made

- page-hero styles duplicated in both servizi.css and servizio.css — they load on separate pages so no shared file needed; acceptable duplication for 2 selectors
- Sidebar nav links rendered conditionally based on `isNotEmpty()` — only links for sections with actual content appear
- `hero_image_url` field is type:url in the blueprint, making it editable per-service in the Panel
- "Avv. Sebastiano Zanin" and "Avvocato Civilista" hardcoded in sidebar — single referent, no content field needed
- Process timeline steps use CSS `opacity: 0; transform: translateY(24px)` initial state; GSAP animates to final state; prefers-reduced-motion CSS override sets `opacity: 1; transform: none`

## Deviations from Plan

None - plan executed exactly as written.

## Issues Encountered

None.

## Known Stubs

- `content/servizi/servizi.txt` — `Meta-title` and `Meta-description` fields are empty. Intentional — will be populated in Plan 03 (content seeding) alongside the four child service pages.

## User Setup Required

None - no external service configuration required.

## Next Phase Readiness

- Service template layer complete — ready for Plan 03 (content seeding: 4 child service pages with actual Italian copy)
- Sidebar scroll-spy nav conditionally renders links; child service pages need `includes`, `process_steps`, and `faq` fields populated for those nav links to appear
- Blueprint structure fields (includes, process_steps, faq) are YAML structure fields — Plan 03 must provide content in Kirby structure YAML format

---
*Phase: 02-core-pages*
*Completed: 2026-03-31*
