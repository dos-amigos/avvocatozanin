---
phase: 01-foundation
plan: 03
subsystem: ui
tags: [head-snippet, scripts-snippet, gsap, lenis, scrolltrigger, lucide, google-fonts, smooth-scroll, animations]
dependency_graph:
  requires:
    - phase: 01-foundation-01
      provides: Kirby project structure, content/site.txt
    - phase: 01-foundation-02
      provides: CSS architecture, main.css, design tokens
  provides:
    - HTML head snippet with meta tags, Google Fonts, Lenis CSS, page-specific CSS loading
    - Scripts footer snippet with CDN load order and page-specific JS loading
    - Lenis + ScrollTrigger scroll infrastructure (window.lenis global)
    - GSAP animations scaffold with prefers-reduced-motion guard and splitWords helper
    - Main entry point with Lucide init and loading screen logic
    - Scroll-to-top button component
  affects: [01-foundation-04, 01-foundation-05, 02-content, 03-features]
tech_stack:
  added: []
  patterns: [CDN-load-order-GSAP-Lenis-Lucide, Lenis-ScrollTrigger-sync, prefers-reduced-motion-guard, sessionStorage-loading-screen, filemtime-cache-busting]
key_files:
  created:
    - site/snippets/head.php
    - site/snippets/scripts.php
    - assets/js/scroll.js
    - assets/js/animations.js
    - assets/js/main.js
    - assets/js/components/scroll-top.js
  modified: []
key_decisions:
  - "Removed Libre Baskerville from Google Fonts URL — only Cormorant Garamond + Plus Jakarta Sans per project spec"
  - "scroll.js copied verbatim from studioatheste — initialization order is critical and proven"
  - "animations.js stripped to scaffold (reduced-motion guard + splitWords helper only) — page-specific animations deferred to Phase 2+"
  - "scroll-top.js copied verbatim from studioatheste — Lenis scrollTo integration proven"
patterns-established:
  - "CDN load order: GSAP -> ScrollTrigger -> Lenis -> Lucide -> local JS (scroll -> animations -> scroll-top -> navigation -> main)"
  - "Cache-busting: filemtime() appended to animations.js URL for browser cache invalidation"
  - "prefers-reduced-motion: all GSAP animations must early-return when user prefers reduced motion"
  - "window.lenis: global Lenis instance consumed by navigation.js and scroll-top.js"
  - "window.splitWords: global text-splitting helper for stagger animations in page-specific JS"
requirements-completed: [FOUND-03, FOUND-05]
duration: 2min
completed: 2026-03-30
---

# Phase 01 Plan 03: Head/Scripts Snippets & JS Modules Summary

**HTML head with Google Fonts and meta tags, scripts footer with GSAP/Lenis/Lucide CDN chain, and JS modules for smooth scroll, animation scaffold, loading screen, and scroll-to-top**

## Performance

- **Duration:** 2 min
- **Started:** 2026-03-30T09:27:46Z
- **Completed:** 2026-03-30T09:29:50Z
- **Tasks:** 2/2
- **Files created:** 6

## Accomplishments

- head.php outputs complete HTML head with meta tag fallback chain, OG tags, Google Fonts (Cormorant Garamond + Plus Jakarta Sans), Lenis CSS, main.css, and conditional page-specific CSS
- scripts.php loads CDNs in exact order (GSAP -> ScrollTrigger -> Lenis -> Lucide) then local JS with filemtime cache-busting on animations.js
- scroll.js initializes Lenis with lerp:0.1, syncs with ScrollTrigger, exports window.lenis for navigation and scroll-top consumption
- animations.js provides prefers-reduced-motion guard and splitWords helper as scaffold for Phase 2+ page animations
- main.js initializes Lucide icons and handles loading screen visibility via sessionStorage
- scroll-top.js shows button after 500px scroll, scrolls to top via Lenis with 1.2s duration

## Task Commits

| Task | Name | Commit | Files |
|------|------|--------|-------|
| 1 | Create head.php and scripts.php snippets | 6c2a797 | site/snippets/head.php, site/snippets/scripts.php |
| 2 | Create JS modules — scroll, animations, main, scroll-top | 72fdd12 | assets/js/scroll.js, assets/js/animations.js, assets/js/main.js, assets/js/components/scroll-top.js |

## Files Created/Modified

- `site/snippets/head.php` — HTML head: charset, viewport, meta title fallback, OG tags, favicon, Google Fonts, Lenis CSS, main.css, page-specific CSS map
- `site/snippets/scripts.php` — CDN load chain + local JS + page-specific JS map, closes body/html
- `assets/js/scroll.js` — Lenis + ScrollTrigger integration, window.lenis export (verbatim from reference)
- `assets/js/animations.js` — IIFE with reduced-motion guard, splitWords helper, Phase 2+ placeholder
- `assets/js/main.js` — DOMContentLoaded: Lucide init, loading screen sessionStorage logic
- `assets/js/components/scroll-top.js` — ScrollTrigger show/hide at 500px, Lenis scrollTo (verbatim from reference)

## Decisions Made

- Removed Libre Baskerville from Google Fonts URL (studioatheste uses 3 fonts; this project only needs Cormorant Garamond + Plus Jakarta Sans)
- scroll.js and scroll-top.js copied verbatim from studioatheste — proven initialization order and Lenis integration
- animations.js stripped to scaffold only — page-specific animations (parallax, counters, card reveals) will be added in Phase 2/3 page JS files
- Loading screen logic placed in main.js (not animations.js) to separate concerns

## Deviations from Plan

None - plan executed exactly as written.

## Issues Encountered

None

## Known Stubs

- `assets/js/animations.js` — contains only reduced-motion guard and splitWords helper; page-specific animations added in Phase 2+
- Page-specific CSS files referenced in head.php $pageCss map do not exist yet — conditional loading prevents errors
- Page-specific JS files referenced in scripts.php $pageJs map do not exist yet — conditional loading prevents errors

These stubs are intentional per plan design. The conditional `isset()` checks prevent any file-not-found errors.

## User Setup Required

None - no external service configuration required.

## Next Phase Readiness

- head.php and scripts.php ready for inclusion in all templates via snippet('head') and snippet('scripts')
- window.lenis available for navigation.js (Plan 04) and any future scroll-dependent JS
- window.splitWords exported for Phase 2+ page animation modules
- CDN load order established as pattern for any future script additions

## Self-Check: PASSED

All 6 files verified present. Both task commits (6c2a797, 72fdd12) verified in git log.
