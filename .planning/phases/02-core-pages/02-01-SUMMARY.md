---
phase: 02-core-pages
plan: 01
subsystem: ui
tags: [gsap, scrolltrigger, animations, homepage, kirby-blueprint]

# Dependency graph
requires:
  - phase: 01-foundation
    provides: animations.js with window.splitWords, scripts.php with home.js conditional include, homepage.css with all CSS selectors
provides:
  - "assets/js/pages/home.js — 9-block GSAP ScrollTrigger animation system for homepage"
  - "hero_eyebrow field in home.yml blueprint"
  - "overflow: hidden on .about-split__media for parallax containment"
affects: [03-seo, 04-launch]

# Tech tracking
tech-stack:
  added: []
  patterns:
    - "Page-specific JS loaded conditionally via scripts.php $pageJs map"
    - "IIFE with prefers-reduced-motion guard at top of every animation file"
    - "initCounters() utility: ScrollTrigger.create onEnter + gsap.to tween pattern for data-count elements"
    - "Null check every DOM target before animating (if (!el) return)"
    - "scrub: true for parallax, once: true for entrance animations"

key-files:
  created:
    - assets/js/pages/home.js
  modified:
    - site/blueprints/pages/home.yml
    - assets/css/pages/homepage.css

key-decisions:
  - "initCounters() defined once, called twice (glass-box and stats-section) to avoid duplication"
  - "overflow: hidden + border-radius added to .about-split__media in CSS (not JS) for clean containment of parallax scale"
  - "will-change: transform set via gsap.set() on all 3 parallax targets for GPU compositing"

patterns-established:
  - "Pattern: page-specific animation IIFE in assets/js/pages/{template}.js, loaded by scripts.php"
  - "Pattern: ScrollTrigger.refresh() at end of every page animation file"

requirements-completed: [HOME-01, HOME-02, HOME-03, HOME-04, HOME-05, HOME-06]

# Metrics
duration: 10min
completed: 2026-03-31
---

# Phase 02 Plan 01: Homepage Animations Summary

**GSAP ScrollTrigger animations for all 9 homepage sections — hero word-split entrance, 3 stagger reveals, 3 parallax scrubs, 2 counter sets, and prefers-reduced-motion guard**

## Performance

- **Duration:** ~10 min
- **Started:** 2026-03-31T13:10:00Z
- **Completed:** 2026-03-31T13:20:00Z
- **Tasks:** 2
- **Files modified:** 3

## Accomplishments

- Created `assets/js/pages/home.js` (288 lines) with 9 animation blocks covering every homepage section
- Hero title uses `window.splitWords()` for premium word-by-word reveal with yPercent clip effect
- `initCounters()` utility animates `data-count` elements — used for glass-box stats (15+, 500+) and stats section (500+, 95%, 4, 15+)
- Three parallax scrub effects on about-split image, CTA background, and stats background
- `hero_eyebrow` field added to `home.yml` blueprint — content file already had the value, now Panel-editable
- `overflow: hidden` added to `.about-split__media` to properly contain the scale-based parallax

## Task Commits

1. **Task 1: Add hero_eyebrow to home.yml blueprint** - `a8772e4` (feat)
2. **Task 2: Create homepage GSAP animations (home.js)** - `3816e88` (feat)

## Files Created/Modified

- `assets/js/pages/home.js` — 9-block GSAP ScrollTrigger animation system, 288 lines
- `site/blueprints/pages/home.yml` — Added hero_eyebrow text field
- `assets/css/pages/homepage.css` — Added overflow: hidden + border-radius to .about-split__media

## Decisions Made

- `initCounters()` is defined once and called twice (glass-box counters and stats-section counters) — avoids code duplication while serving both counter locations on the page
- CSS fix (overflow: hidden on .about-split__media) applied to homepage.css rather than inline JS — cleaner separation of concerns and permanent fix vs runtime style injection
- `will-change: transform` applied via `gsap.set()` on all 3 parallax targets (about-split__img, cta-section__bg, stats-section__bg) to enable GPU layer compositing

## Deviations from Plan

### Auto-fixed Issues

**1. [Rule 2 - Missing Critical] Added overflow: hidden to .about-split__media**
- **Found during:** Task 2 (home.js creation)
- **Issue:** Plan noted `.about-split__media` lacked `overflow: hidden` — the parallax scale transform on `.about-split__img` would bleed outside the container boundary
- **Fix:** Added `overflow: hidden; border-radius: var(--radius)` to `.about-split__media` rule in homepage.css
- **Files modified:** assets/css/pages/homepage.css
- **Verification:** CSS rule confirmed present; parallax scale contained
- **Committed in:** 3816e88 (Task 2 commit)

---

**Total deviations:** 1 auto-fixed (Rule 2 - missing critical for correct visual output)
**Impact on plan:** Single CSS addition required for parallax correctness. No scope creep.

## Issues Encountered

None — plan executed cleanly. All 6 verification checks pass.

## Known Stubs

None — home.js is fully wired to real DOM elements defined in home.php. Counters read from real `data-count` attributes. No placeholder or mock data.

## Next Phase Readiness

- Homepage is now a fully animated premium experience with all sections covered
- Pattern established for page-specific JS animation files — reuse for chi-sono.js, servizi.js, contatti.js in subsequent plans
- `initCounters()` pattern available for other pages that need numeric counter animations
- No blockers for Phase 02 Plan 02

---
*Phase: 02-core-pages*
*Completed: 2026-03-31*
