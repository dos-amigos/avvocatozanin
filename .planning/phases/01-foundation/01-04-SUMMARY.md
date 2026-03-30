---
phase: 01-foundation
plan: 04
subsystem: navigation
tags: [header, footer, breadcrumb, mega-dropdown, mobile-menu, navigation, accessibility]
dependency_graph:
  requires:
    - phase: 01-foundation-01
      provides: Kirby project structure, content/site.txt field names
    - phase: 01-foundation-02
      provides: CSS variables, layout layer, component CSS (breadcrumb.css)
  provides:
    - Complete navigation shell (header + footer + breadcrumb)
    - Sticky header with transparent-to-solid transition
    - Servizi mega-dropdown with 4 legal service items
    - Mobile full-screen overlay menu with GSAP stagger
    - 3-column footer with contact data, PEC, Ordine reference
    - Semantic breadcrumb with schema.org BreadcrumbList JSON-LD
  affects: [all-page-templates, 02-content, 03-features]
tech_stack:
  added: []
  patterns: [mega-dropdown, focus-trap, scroll-lock-lenis, GSAP-stagger-animation, schema.org-BreadcrumbList]
key_files:
  created:
    - site/snippets/header.php
    - site/snippets/footer.php
    - site/snippets/breadcrumb.php
    - assets/js/navigation.js
  modified:
    - assets/css/layout/header.css
    - assets/css/layout/footer.css
decisions:
  - "Gold accent on CTA hover in scrolled state (--color-accent) instead of dark gray"
  - "2-column mega-dropdown grid for 4 items (not 3-column from reference)"
  - "No Instagram social icon per D-07 decision (LinkedIn + Facebook only)"
  - "Mobile menu has 5 items: Chi Sono, Servizi, Come Lavoro, Contatti, Contattaci CTA"
metrics:
  duration_minutes: 5
  tasks_completed: 3
  files_created: 4
  files_modified: 2
  completed_date: "2026-03-30"
---

# Phase 01 Plan 04: Navigation Shell Summary

Complete header/footer/breadcrumb navigation shell with 4-item Servizi mega-dropdown, navy mobile overlay with GSAP stagger, 3-column footer with PEC and Ordine reference, and semantic breadcrumb with BreadcrumbList JSON-LD.

## Performance

- **Duration:** 5 min
- **Started:** 2026-03-30T09:20:10Z
- **Completed:** 2026-03-30T09:25:02Z
- **Tasks:** 3/3

## Task Commits

| Task | Name | Commit | Files |
|------|------|--------|-------|
| 1 | Create header.php and footer.php snippets | fd8a37a | site/snippets/header.php, site/snippets/footer.php |
| 2 | Create navigation.js and fill header.css / footer.css | 60e2a88 | assets/js/navigation.js, assets/css/layout/header.css, assets/css/layout/footer.css |
| 3 | Create breadcrumb.php snippet (NAV-04) | c26974c | site/snippets/breadcrumb.php |

## Accomplishments

- **Header.php:** Topbar (desktop 1280px+) with phone tel: link and email, sticky header with transparent-to-solid transition, 4-item Servizi mega-dropdown (2-col grid), mobile hamburger with full-screen overlay, skip-to-content accessibility link
- **Footer.php:** 3-column grid (about+social, navigation links, contact details with Lucide icons), PEC field, Ordine degli Avvocati di Padova reference, scroll-to-top button, copyright with P.IVA
- **Breadcrumb.php:** Semantic nav>ol markup, aria-current="page" on active item, isHomePage() guard, BreadcrumbList JSON-LD for SEO, dynamic ancestor traversal via $page->parents()->flip()
- **Navigation.js:** Sticky header show/hide on scroll direction, transparent-to-solid at 50px, topbar show/hide at 150px threshold, mega-dropdown open/close with GSAP stagger, mobile menu with Lenis scroll lock, keyboard Escape handling, focus trap for mobile menu
- **Header CSS:** Full topbar, header, navigation, CTA, mega-dropdown (with 2-col variant), hamburger morph-to-X, mobile overlay styles — all in @layer layout
- **Footer CSS:** 3-column grid with tablet 1+2 and mobile stack breakpoints, gold contact icons (--color-accent), no newsletter styles

## Decisions Made

- Gold accent color on CTA hover in scrolled state for brand consistency
- 2-column mega-dropdown grid (max-width: 600px on desktop) since Zanin has only 4 service items vs reference's 6
- Instagram social icon removed per D-07 decision — only LinkedIn and Facebook
- Mobile menu lists 5 items without Home link per D-11 navigation structure

## Deviations from Plan

None - plan executed exactly as written.

## Known Stubs

- `content/site.txt` LinkedIn field: empty — social link will point to `#` until populated
- `content/site.txt` Facebook field: empty — social link will point to `#` until populated
- `content/site.txt` Piva field: `(placeholder)` — footer copyright shows placeholder P.IVA

These stubs are pre-existing from Plan 01 content seed and do not block navigation shell functionality.

## Self-Check: PASSED
