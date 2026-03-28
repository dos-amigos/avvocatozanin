# Phase 1: Foundation - Context

**Gathered:** 2026-03-28
**Status:** Ready for planning

<domain>
## Phase Boundary

Kirby CMS project skeleton running locally — installed via Composer, design tokens applied (navy + gold palette, Cormorant Garamond + Plus Jakarta Sans), GSAP ScrollTrigger + Lenis smooth scroll initialized with prefers-reduced-motion support, and full navigation shell (sticky header with topbar, mega-dropdown, mobile menu, footer) rendering correctly on all screen sizes. Includes loading screen on first visit.

</domain>

<decisions>
## Implementation Decisions

### Color Palette
- **D-01:** Primary palette is navy #1a2744 + gold #b8960c. Navy for backgrounds, text, header. Gold for accents, CTAs, hover states.
- **D-02:** Adapt studioatheste's full variable system (grays, shadows, spacing, transitions) — only swap primary/accent colors.

### Header Structure
- **D-03:** Topbar + Header layout (same pattern as studioatheste). Topbar shows phone, email, social links — desktop only (≥1280px), hidden on mobile.
- **D-04:** Header: logo left, nav center, CTA button right. Sticky, transparent→solid on scroll. Phone number clickable (tel: link).
- **D-05:** Mega-dropdown for Servizi: 4-column grid with icons and brief descriptions for each practice area.

### Footer Structure
- **D-06:** 3 colonne compatte: Col1 (logo + descrizione studio + social icons), Col2 (link navigazione: Chi Sono, Servizi, Come Lavoro, Contatti, Privacy, Cookie), Col3 (contatti completi: indirizzo, telefono, fax, PEC con icone Lucide).
- **D-07:** Bottom bar: copyright © 2026, P.IVA placeholder, icone social (LinkedIn, Facebook).

### Logo & Branding
- **D-08:** Logo dal sito esistente: `assets/img/logo-studio-legale-zanin.png` (500x141, PNG trasparente). "Studio Legale Zanin" con bilancia stilizzata.
- **D-09:** Preparare versione bianca del logo per header su sfondo scuro (invertire colori o usare CSS filter).

### Loading Screen
- **D-10:** Loading screen animata con logo al centro, appare solo alla prima visita (session-stored via sessionStorage). Stessa logica di studioatheste.

### Navigation
- **D-11:** Menu items: Chi Sono, Servizi (mega-dropdown), Come Lavoro, Contatti.
- **D-12:** Mobile menu: overlay full-screen con animazione staggered dei link (come studioatheste).
- **D-13:** Skip-to-content link per accessibilità + scroll-to-top button.

### Animation System
- **D-14:** GSAP 3.12.5 + ScrollTrigger via CDN, Lenis 1.3.17 per smooth scroll — identico a studioatheste.
- **D-15:** Rispettare prefers-reduced-motion: disabilitare tutte le animazioni GSAP e smooth scroll quando attivo.
- **D-16:** Lucide icons per tutte le icone UI.

### Claude's Discretion
- CSS architecture specifics (layer ordering, file organization) — follow studioatheste's proven pattern
- Exact animation timing/easing — match studioatheste's quality level
- Kirby config setup details (cache, thumbnails, routes)

</decisions>

<canonical_refs>
## Canonical References

**Downstream agents MUST read these before planning or implementing.**

### Reference Project (READ-ONLY — do not modify)
- `C:\Users\boxwe\Documents\GitHub\studioatheste\assets\css\variables.css` — Design tokens to adapt (swap colors only)
- `C:\Users\boxwe\Documents\GitHub\studioatheste\assets\css\main.css` — CSS layer architecture to replicate
- `C:\Users\boxwe\Documents\GitHub\studioatheste\site\snippets\head.php` — Meta tag structure, font loading, CSS loading pattern
- `C:\Users\boxwe\Documents\GitHub\studioatheste\site\snippets\header.php` — Full header with topbar, mega-dropdown, mobile menu
- `C:\Users\boxwe\Documents\GitHub\studioatheste\site\snippets\footer.php` — Footer structure (adapt to 3 columns)
- `C:\Users\boxwe\Documents\GitHub\studioatheste\site\snippets\scripts.php` — CDN script loading order (critical)
- `C:\Users\boxwe\Documents\GitHub\studioatheste\assets\js\scroll.js` — Lenis + ScrollTrigger integration
- `C:\Users\boxwe\Documents\GitHub\studioatheste\assets\js\animations.js` — GSAP animation patterns
- `C:\Users\boxwe\Documents\GitHub\studioatheste\assets\js\navigation.js` — Header behavior, mega-dropdown, mobile menu
- `C:\Users\boxwe\Documents\GitHub\studioatheste\assets\js\main.js` — Lucide init, loading screen
- `C:\Users\boxwe\Documents\GitHub\studioatheste\assets\css\reset.css` — Josh Comeau reset
- `C:\Users\boxwe\Documents\GitHub\studioatheste\site\config\config.php` — Kirby config, cache, routes, sitemap
- `C:\Users\boxwe\Documents\GitHub\studioatheste\composer.json` — PHP dependencies

### Project Research
- `.planning/research/STACK.md` — Technology stack decisions, schema.org structure, color palette rationale
- `.planning/research/ARCHITECTURE.md` — Site structure, URL hierarchy, build order
- `.planning/research/PITFALLS.md` — Domain-specific risks (Art. 35, GDPR, accessibility)

### Frontend Quality
- impeccable.style — User has this tool installed in Claude for frontend quality improvement. Consider using its commands during implementation.

</canonical_refs>

<code_context>
## Existing Code Insights

### Reusable Assets (from studioatheste — copy and adapt)
- **CSS architecture:** Full layer system (reset → base → components → layout → utilities), design tokens, fluid typography
- **JS modules:** scroll.js (Lenis+GSAP sync), animations.js (ScrollTrigger patterns), navigation.js (header behavior)
- **Snippets:** head.php, header.php, footer.php, scripts.php — proven structure
- **Config:** config.php with cache, thumbnail presets, sitemap route

### Established Patterns
- CSS Cascade Layers (@layer) for predictable styling
- CDN-first script loading (GSAP → ScrollTrigger → Lenis → Lucide → local JS)
- Session-based loading screen (sessionStorage)
- Semantic HTML with ARIA attributes throughout

### Integration Points
- composer.json bootstraps the entire project (Kirby 5 + plugins)
- index.php + .htaccess are the entry point
- site/blueprints/ define the Panel CMS interface
- content/ holds all page data as .txt files

</code_context>

<specifics>
## Specific Ideas

- Logo dal sito esistente avvocatozanin.it — già scaricato in `assets/img/logo-studio-legale-zanin.png`
- Dati contatto reali: Via G.B. Brunelli 12, 35042 Este (PD) — Tel/Fax: 0429.1960202
- Footer 3 colonne (non 4 come studioatheste) — più compatto per studio singolo
- Topbar + header pattern identico a studioatheste
- Mega-dropdown con i 4 servizi (non 6 come studioatheste)

</specifics>

<deferred>
## Deferred Ideas

None — discussion stayed within phase scope

</deferred>

---

*Phase: 01-foundation*
*Context gathered: 2026-03-28*
