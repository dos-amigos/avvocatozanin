# Phase 2: Core Pages - Research

**Researched:** 2026-03-30
**Domain:** Homepage animations, service listing/detail pages, Kirby CMS templates, GSAP ScrollTrigger
**Confidence:** HIGH

## Summary

Phase 2 builds on a fully functional Phase 1 foundation. The homepage template already exists with all sections rendered (hero, value cards, about split, contact bar, practice areas, stats counters, process steps, CTA). The primary work is: (1) adding GSAP scroll animations to the existing homepage sections, (2) creating the /servizi listing page, (3) creating the servizio detail template with FAQ accordion, process steps, and sidebar navigator, (4) seeding content for all four legal services, and (5) sourcing appropriate Unsplash hero images.

The reference project (studioatheste) provides battle-tested patterns for every component needed: service listing template, service detail template with sidebar scroll-spy, FAQ accordion, process timeline, and all corresponding blueprints and animations. These patterns should be adapted for the legal domain, not reinvented.

**Primary recommendation:** Copy and adapt studioatheste's servizi.php, servizio.php, servizio.yml, and servizio.js patterns. Simplify where the legal site has fewer needs (4 services vs 6, no partners section, single referent always Avv. Zanin). Write homepage animations in assets/js/pages/home.js following the same GSAP patterns from studioatheste's animations.js.

<phase_requirements>
## Phase Requirements

| ID | Description | Research Support |
|----|-------------|------------------|
| HOME-01 | Hero section with professional image, headline SEO "Avvocato Civilista a Este", CTA | Hero template already exists in home.php. Needs: GSAP entrance animation (word-by-word title, staggered buttons). Hero image currently Unsplash inline URL -- keep as-is per PERF-04 |
| HOME-02 | Intro section with parallax effect and studio presentation | About-split section exists. Needs: GSAP parallax on about-split__img (scale 1.15, yPercent scrub) and clip-path reveal, matching studioatheste intro parallax pattern |
| HOME-03 | Stats counter section (anni esperienza, cause gestite, clienti assistiti, aree di pratica) | Stats section exists with data-count attributes. Needs: countUp animation in home.js triggered by ScrollTrigger (pattern from studioatheste section 6b) |
| HOME-04 | Services overview grid (4 cards with icons) | Practice areas section with 4 cards exists. Needs: stagger reveal animation (opacity 0, scale 0.95, stagger 0.08) and optional 3D tilt |
| HOME-05 | CTA section with background parallax and call-to-action | CTA section exists. Needs: background image parallax (scale 1.15, yPercent scrub) and content fade-up |
| HOME-06 | Full page animations (staggered reveals, word-by-word title, fade-up sections) | Master animation file. home.js orchestrates all homepage-specific ScrollTrigger animations. splitWords already exported globally from animations.js |
| SERV-01 | Servizi listing page with grid of 4 service cards | New template servizi.php + blueprint servizi.yml + content/servizi/servizi.txt. Adapt from studioatheste servizi.php, simplified (no pilastri, no partners) |
| SERV-02 | Servizio detail template with hero, sidebar navigator, rich content sections | New template servizio.php + blueprint servizio.yml. Direct adaptation from studioatheste servizio.php with legal-domain fields |
| SERV-03 | Diritto di Famiglia page -- SEO content | Content file content/servizi/1_diritto-di-famiglia/servizio.txt with full Italian SEO copy |
| SERV-04 | Diritto Immobiliare page -- SEO content | Content file content/servizi/2_diritto-immobiliare/servizio.txt |
| SERV-05 | Risarcimento Danni page -- SEO content | Content file content/servizi/3_risarcimento-danni/servizio.txt |
| SERV-06 | Recupero Crediti page -- SEO content | Content file content/servizi/4_recupero-crediti/servizio.txt |
| SERV-07 | FAQ accordion section per ogni servizio (4-6 domande con FAQPage schema) | FAQ accordion component from studioatheste servizio.js. GSAP-animated open/close. FAQPage schema deferred to Phase 4 (SEO-04) |
| SERV-08 | Process steps section per ogni servizio | Process timeline component from studioatheste servizio.js with scroll-driven progress bar |
| PERF-04 | Immagini hero professionali da Unsplash/Pexels (temi: giustizia, studio legale, consulenza) | Inline Unsplash URLs in templates. NO gavels/American courtroom symbols per Out of Scope. Use: Italian architecture, documents/contracts, handshakes, office settings |
</phase_requirements>

## Project Constraints (from CLAUDE.md)

- **Tech stack**: Kirby CMS 5.x (PHP 8.2+) -- no build step, no bundler
- **Design**: Must convey authority and legal professionalism
- **SEO**: Every service page must have meta title, description, OG tags, alt tags (full SEO implementation in Phase 4, but fields must exist in blueprints now)
- **Performance**: Core Web Vitals optimal -- lazy load all images except hero/LCP
- **Accessibility**: ARIA labels, semantic HTML, keyboard navigation
- **Fonts**: Jost (headings) + Manrope (body) -- NOT Cormorant Garamond (design was rebuilt)
- **Colors**: Navy #1a2744 + Gold #b8960c (Regalis-inspired)
- **CSS**: @layer system, variables.css custom properties, no build step
- **JS**: GSAP 3.12.5 CDN, Lenis 1.3.17 CDN, Lucide @latest CDN
- **Images**: No gavels, no American courtroom symbols, no balance scales
- **Content**: Conform to Art. 35 Codice Deontologico Forense (no testimonials, no outcome promises)
- **Schema**: LegalService (not Attorney -- deprecated) -- implementation deferred to Phase 4

## Architecture Patterns

### File Structure for Phase 2

```
site/
  templates/
    servizi.php          # NEW: service listing page
    servizio.php         # NEW: service detail page
  blueprints/
    pages/
      home.yml           # UPDATE: add hero_eyebrow field
      servizi.yml        # NEW: listing page blueprint
      servizio.yml       # NEW: service detail blueprint
content/
  servizi/
    servizi.txt                          # NEW: listing page content
    1_diritto-di-famiglia/
      servizio.txt                       # NEW: service content
    2_diritto-immobiliare/
      servizio.txt                       # NEW: service content
    3_risarcimento-danni/
      servizio.txt                       # NEW: service content
    4_recupero-crediti/
      servizio.txt                       # NEW: service content
assets/
  css/
    pages/
      servizi.css        # NEW: listing page styles
      servizio.css       # NEW: service detail styles
  js/
    pages/
      home.js            # NEW: homepage GSAP animations
      servizio.js        # NEW: service page accordion, scroll-spy, timeline
```

### Pattern 1: Kirby Content Structure (Numbered Folders)

**What:** Service child pages use numbered prefix folders for ordering (1_diritto-di-famiglia, 2_diritto-immobiliare, etc.)
**When to use:** Always for ordered child pages in Kirby
**Why:** Kirby uses folder number prefix for sort order. The `servizio` template name matches the content file name `servizio.txt`.

```
content/servizi/1_diritto-di-famiglia/servizio.txt
```

The number prefix controls listing order. The folder slug after `_` becomes the URL slug.
URL result: `/servizi/diritto-di-famiglia`

### Pattern 2: Blueprint Structure Fields

**What:** Kirby YAML blueprints with tabs for content organization
**When to use:** For every page type that has Panel-editable content

The servizio.yml blueprint should have these tabs (adapted from reference):
- **hero**: hero_title, hero_subtitle (text fields -- no video/image file picker since we use Unsplash URLs inline)
- **contenuto**: panoramica_body (textarea/markdown), includes (structure), process_steps (structure), faq (structure)
- **card**: icon, card_title, card_description (for listing page display)
- **cta**: cta_title, cta_description, cta_button_text, cta_button_url
- **seo**: meta_title, meta_description (for Phase 4 population)

Key simplification vs reference: No hero_video/hero_image file pickers (using inline Unsplash URLs). No referent fields (always Avv. Zanin). No related_services structure (only 4 services, cross-linking is implicit).

### Pattern 3: Page-Specific CSS/JS Loading

**What:** head.php already has conditional CSS loading; scripts.php has conditional JS loading
**When to use:** Every new template must be registered in both maps

head.php already has `servizi` and `servizio` in the `$pageCss` map.
scripts.php needs `servizio` added to the `$pageJs` map (for accordion/scroll-spy JS).

```php
// In scripts.php $pageJs array, add:
'servizio' => ['assets/js/pages/servizio.js'],
```

### Pattern 4: Homepage Animation Architecture (home.js)

**What:** A self-contained IIFE loaded only on the homepage, using GSAP + ScrollTrigger
**When to use:** Homepage-specific animations that don't apply to other pages

The file should contain:
1. Hero entrance timeline (word-by-word title via splitWords, staggered subtitle/buttons/keywords)
2. Value cards stagger reveal
3. About-split parallax (image) + clip-path reveal
4. Glass-box counter animation (data-count countUp)
5. Contact bar fade-in
6. Practice cards stagger + optional 3D tilt
7. Stats section countUp (data-count elements)
8. Process steps stagger reveal
9. CTA parallax background + content fade-up

All animations use `once: true` or `toggleActions: 'play none none none'` (fire once, no reverse).

### Pattern 5: FAQ Accordion Component

**What:** GSAP-animated accordion with exclusive open (only one item open at a time)
**When to use:** Service detail pages, FAQ section

Key implementation details from studioatheste servizio.js:
- Data attributes: `data-accordion` on container, `data-accordion-item` on each item
- ARIA: `aria-expanded` on button, `aria-hidden` on panel
- Animation: `gsap.to(panel, { height: panelInner.offsetHeight, duration: 0.4, ease: 'power2.inOut' })`
- Close: `gsap.to(panel, { height: 0, ... })`
- Panel starts with `height: 0; overflow: hidden` in CSS
- Uses inner wrapper `.service-accordion__panel-inner` for accurate height measurement

### Pattern 6: Service Sidebar Scroll-Spy

**What:** Sticky sidebar with scroll-spy that highlights the current section
**When to use:** Service detail pages

Implementation from studioatheste:
- ScrollTrigger.create per section with `start: 'top 40%'`, `end: 'bottom 40%'`
- `onToggle` callback adds/removes `is-active` class on sidebar links
- Sidebar uses `position: sticky; top: calc(var(--header-height, 80px) + 24px)`
- Smooth scroll on sidebar link click with header offset compensation
- Sidebar hidden on mobile (below 991px), content goes full-width

### Anti-Patterns to Avoid

- **Hardcoding content in templates:** All text must come from Kirby content fields (servizio.txt), not PHP template hardcoding. Exception: structural labels like "Domande frequenti" section headings can be hardcoded since they're the same across all services.
- **Using loading="lazy" on hero images:** The LCP element must load eagerly. Only the hero image gets `loading="eager"`.
- **Animating elements before they exist in the DOM:** All GSAP animations must use `gsap.utils.toArray()` or null checks before animating.
- **Forgetting prefers-reduced-motion:** The scaffold in animations.js already exits early. Page-specific JS (home.js, servizio.js) should also check, OR rely on the global check in animations.js. Since page-specific files load independently, they MUST include their own reduced-motion guard.
- **Creating structure fields without defaults:** Kirby structure fields with `toStructure()` return an empty collection if no content exists -- templates must handle the empty case with `isNotEmpty()` checks.

## Don't Hand-Roll

| Problem | Don't Build | Use Instead | Why |
|---------|-------------|-------------|-----|
| Accordion animation | CSS-only max-height transitions | GSAP height animation with inner wrapper | CSS max-height requires arbitrary large value, causes delay. GSAP measures real height via inner wrapper for pixel-perfect animation |
| Counter animation | setInterval counter | GSAP countUp with ScrollTrigger | GSAP handles easing, performance, and scroll-trigger lifecycle automatically |
| Scroll-spy | Intersection Observer manual implementation | ScrollTrigger.create with onToggle | ScrollTrigger already synced with Lenis; manual IntersectionObserver would fight with smooth scroll |
| Parallax effects | CSS scroll-driven animations | GSAP scrub ScrollTrigger | Browser support for CSS scroll-driven animations is incomplete; GSAP scrub is proven in this stack |
| Content seeding | Manual file creation | Kirby flat-file .txt format | Must match Kirby's exact field separator format (----) |

## Common Pitfalls

### Pitfall 1: Accordion Height Calculation

**What goes wrong:** Panel opens to wrong height, or height is 0.
**Why it happens:** Measuring `.offsetHeight` on a hidden element returns 0.
**How to avoid:** Use a `.panel-inner` wrapper inside the panel. The panel gets `height: 0; overflow: hidden`, but the inner wrapper always has its natural height. Measure `panelInner.offsetHeight` when opening.
**Warning signs:** Accordion opens but appears empty, or snaps to full height without animation.

### Pitfall 2: ScrollTrigger + Lenis Sync After Dynamic Content

**What goes wrong:** ScrollTrigger positions are wrong after DOM changes.
**Why it happens:** Lenis changes scroll behavior; ScrollTrigger caches positions on page load.
**How to avoid:** Call `ScrollTrigger.refresh()` at the end of animation setup and after any content that changes page height (e.g., accordion opening).
**Warning signs:** Animations fire too early or too late, sidebar scroll-spy highlights wrong section.

### Pitfall 3: Kirby Content File Field Format

**What goes wrong:** Fields don't appear in the Panel or template.
**Why it happens:** Kirby .txt files use a specific format: `Field-name: value` with `----` separators. Structure fields use YAML-like indented format.
**How to avoid:** Follow the exact format from studioatheste's servizio.txt. Use `----` (four hyphens) as separator. Structure fields use `-` prefix for list items.
**Warning signs:** `$page->fieldname()` returns empty or the raw YAML text.

### Pitfall 4: Split-word Animation Breaking HTML Entities

**What goes wrong:** `splitWords()` function breaks on content with HTML entities or special characters.
**Why it happens:** The regex strips HTML tags, which can mangle encoded characters.
**How to avoid:** Only use splitWords on elements with plain text content (hero titles). Never on elements with links or rich HTML. The function already handles `<br>` tags correctly.
**Warning signs:** Mangled text, missing characters, broken layout after animation.

### Pitfall 5: Missing CSS for New Templates

**What goes wrong:** New pages render unstyled.
**Why it happens:** head.php's `$pageCss` map must include the template name, and the CSS file must exist.
**How to avoid:** (1) Create the CSS file first, even if minimal. (2) Verify the template name in the map matches `$page->intendedTemplate()->name()`.
**Warning signs:** Page loads but looks like unstyled HTML.

### Pitfall 6: Stats Counter data-count Selector Mismatch

**What goes wrong:** Counter animation doesn't fire on the homepage.
**Why it happens:** The reference project uses `.stats__number[data-count]` but the current homepage uses `strong[data-count]` inside `.stat` and `.glass-box__stat`.
**How to avoid:** In home.js, target the actual selectors: `.stat strong[data-count]` and `.glass-box__stat strong[data-count]`.
**Warning signs:** Numbers stay at "0" and never animate.

## Code Examples

### Homepage Hero Entrance Animation (home.js)

```javascript
// Source: Adapted from studioatheste animations.js section 2
(function() {
  'use strict';
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  // 1. Hero entrance
  var heroBody = document.querySelector('.hero__body');
  if (heroBody) {
    var tl = gsap.timeline({ delay: 0.3 });
    var subtitle = heroBody.querySelector('.subtitle');
    var title = heroBody.querySelector('.hero__title');
    var desc = heroBody.querySelector('.hero__desc');
    var buttons = heroBody.querySelector('.hero__buttons');
    var keywords = heroBody.querySelector('.hero__keywords');

    if (subtitle) tl.from(subtitle, { opacity: 0, y: 30, duration: 0.8, ease: 'power3.out' });
    if (title && window.splitWords) {
      var words = window.splitWords(title);
      tl.from(words, { yPercent: 120, opacity: 0, duration: 0.7, stagger: 0.05, ease: 'power3.out' }, '-=0.5');
    }
    if (desc) tl.from(desc, { opacity: 0, y: 30, duration: 0.8, ease: 'power3.out' }, '-=0.5');
    if (buttons) tl.from(buttons, { opacity: 0, y: 20, duration: 0.6, ease: 'power3.out' }, '-=0.3');
    if (keywords) tl.from(keywords, { opacity: 0, duration: 0.8 }, '-=0.2');
  }
})();
```

### CountUp Animation Pattern

```javascript
// Source: Adapted from studioatheste animations.js section 6b
function initCounters(selector) {
  gsap.utils.toArray(selector).forEach(function(el) {
    var target = parseInt(el.getAttribute('data-count'));
    if (!target) return;

    var suffix = el.nextElementSibling ? el.nextElementSibling.textContent : '';

    ScrollTrigger.create({
      trigger: el,
      start: 'top 85%',
      once: true,
      onEnter: function() {
        gsap.to({ val: 0 }, {
          val: target,
          duration: 2,
          ease: 'power2.out',
          onUpdate: function() {
            el.textContent = Math.round(this.targets()[0].val);
          }
        });
      }
    });
  });
}
```

### Kirby Service Content File Format

```
Title: Diritto di Famiglia

----

Hero-title: Diritto di Famiglia

----

Hero-subtitle: Assistenza legale per separazioni, divorzi, affidamento figli e successioni

----

Panoramica-body:

Il diritto di famiglia regola i rapporti ...

----

Process-steps:

-
  step: "01"
  title: Consulenza Iniziale
  description: "Analizziamo la vostra situazione familiare..."
-
  step: "02"
  title: Strategia Legale
  description: "Definiamo il percorso migliore..."

----

Faq:

-
  question: "Quanto dura una causa di divorzio?"
  answer: "I tempi variano..."
-
  question: "Come funziona l'affidamento condiviso?"
  answer: "L'affidamento condiviso..."

----
```

### Servizi Listing Template Pattern

```php
<!-- Source: Adapted from studioatheste servizi.php -->
<section class="section" id="lista-servizi">
  <div class="container">
    <div class="section-header">
      <p class="subtitle"><?= $page->servizi_eyebrow() ?></p>
      <h2><?= $page->servizi_title() ?></h2>
    </div>
    <div class="services-grid">
      <?php foreach ($page->children()->listed() as $servizio): ?>
      <a href="<?= $servizio->url() ?>" class="service-card">
        <div class="service-card__icon">
          <i data-lucide="<?= $servizio->icon() ?>"></i>
        </div>
        <h3><?= $servizio->card_title()->or($servizio->title()) ?></h3>
        <p><?= $servizio->card_description() ?></p>
        <span class="service-card__arrow"><i data-lucide="arrow-right"></i></span>
      </a>
      <?php endforeach ?>
    </div>
  </div>
</section>
```

Note: The listing page can use `$page->children()->listed()` to dynamically iterate child service pages instead of a manual structure field. This is simpler and automatically picks up new services.

## Unsplash Image Strategy (PERF-04)

### Appropriate Themes for Italian Law Firm

| Page | Theme | Avoid | Example Search Terms |
|------|-------|-------|---------------------|
| Homepage hero | Italian architecture, palazzo di giustizia, professional office | Gavels, American courtrooms, Lady Justice statues | "italian courthouse architecture", "professional office desk documents" |
| About split | Professional environment, bookshelves, documents | Stock photos with American-style law firms | "lawyer office books italy", "professional document signing" |
| Stats background | Abstract professional, city skyline | American imagery | "business abstract dark professional" |
| CTA background | Consultation, handshake, office | American courtroom imagery | "business consultation meeting" |
| Servizi listing hero | Legal documents, Italian court | Gavels | "legal documents professional" |
| Diritto di Famiglia | Family, home, documents | Sad/dramatic imagery | "family consultation documents" |
| Diritto Immobiliare | Buildings, property, keys | American houses | "italian architecture property real estate" |
| Risarcimento Danni | Protection, shield concept, documents | Injury/accident photos (too graphic) | "legal protection professional" |
| Recupero Crediti | Finance, contracts, business | Aggressive debt imagery | "business contract finance documents" |

**Implementation:** Use Unsplash URLs inline in templates with `?w=1920&q=80` for hero (eager) and `?w=800&q=80` for smaller images (lazy). This matches the current homepage pattern.

## SEO Content Guidelines for Service Pages

Each service page needs Italian SEO content that is:

1. **Naturally keyword-rich** without stuffing (target: keyword in H1, first paragraph, 2-3 subheadings)
2. **Geographically anchored** -- mention "Este", "Padova", "Tribunale di Este", "Tribunale di Padova"
3. **Deontologically compliant** -- Art. 35 Codice Deontologico Forense:
   - NO outcome promises ("vinciamo il 95% delle cause")
   - NO testimonials from clients
   - NO laudatory superlatives ("il migliore avvocato")
   - OK to state areas of practice, experience, approach
4. **FAQ questions** should be real questions people search for on Google Italy
5. **Process steps** should be 4-5 steps showing the legal journey

### Target Keywords per Service

| Service | Primary Keyword | Secondary Keywords |
|---------|----------------|-------------------|
| Diritto di Famiglia | avvocato divorzio Este | separazione consensuale Padova, affidamento figli, avvocato famiglia Este, successioni |
| Diritto Immobiliare | avvocato immobiliare Este | usucapione Padova, controversie condominiali, avvocato locazioni, compravendita immobiliare |
| Risarcimento Danni | avvocato risarcimento danni Padova | incidente stradale risarcimento, responsabilita civile, danni patrimoniali |
| Recupero Crediti | avvocato recupero crediti Este | decreto ingiuntivo, esecuzione forzata, recupero crediti stragiudiziale Padova |

## State of the Art

| Old Approach | Current Approach | When Changed | Impact |
|--------------|------------------|--------------|--------|
| CSS max-height accordion | GSAP height animation with inner wrapper | Already in reference | Pixel-perfect smooth animation |
| Intersection Observer scroll-spy | ScrollTrigger.create onToggle | Already in reference | Syncs perfectly with Lenis smooth scroll |
| Manual JSON-LD in templates | Deferred to Phase 4 via snippets | Phase 4 scope | Service pages need content fields now, schema markup later |

## Open Questions

1. **Hero image persistence strategy**
   - What we know: Currently using inline Unsplash URLs with query params. This works but images could be removed from Unsplash.
   - What's unclear: Whether to download images locally to assets/img/ or keep Unsplash URLs.
   - Recommendation: Keep Unsplash URLs for now (Phase 2 focus is templates/content). Phase 3's PERF-01/PERF-02 can address downloading and optimizing images locally.

2. **Servizi listing page structure: dynamic children vs. structure field**
   - What we know: studioatheste uses a structure field in servizi.txt for cards. But the lawyer site has exactly 4 services as child pages.
   - What's unclear: Whether to duplicate card info in the listing page's structure field or read it from children.
   - Recommendation: Use `$page->children()->listed()` with `card_title`, `card_description`, `icon` fields on each child service page. Simpler, no data duplication, auto-updates.

3. **Home blueprint completeness**
   - What we know: Current home.yml only has hero_title, hero_subtitle, meta_title, meta_description. No hero_eyebrow field.
   - What's unclear: Whether to add more fields to home.yml for content that's currently hardcoded.
   - Recommendation: Add hero_eyebrow to home.yml for consistency with content/home/home.txt which already has the field. Keep other homepage sections hardcoded for now (they're structural, not frequently edited).

## Sources

### Primary (HIGH confidence)
- studioatheste reference project -- direct inspection of templates, blueprints, JS, CSS, content files
- Current avvocatozanin codebase -- direct inspection of all Phase 1 outputs
- Kirby CMS flat-file content format -- verified against working content/home/home.txt

### Secondary (MEDIUM confidence)
- GSAP 3.12.5 ScrollTrigger API -- patterns verified against working studioatheste implementation
- Unsplash URL API -- verified against current homepage inline URLs

### Tertiary (LOW confidence)
- Italian legal SEO keywords -- based on general knowledge of Italian search behavior, not verified with keyword tools

## Metadata

**Confidence breakdown:**
- Standard stack: HIGH -- identical to Phase 1, all libraries already loaded
- Architecture: HIGH -- direct copy/adapt from working reference project
- Pitfalls: HIGH -- experienced firsthand in studioatheste development
- SEO content: MEDIUM -- keywords and deontological compliance are domain knowledge, not verified with SEO tools
- Unsplash images: MEDIUM -- appropriate themes identified but specific image selection requires visual review

**Research date:** 2026-03-30
**Valid until:** 2026-04-30 (stable -- no dependency changes expected)
