/* ==========================================================================
   Scroll Infrastructure — Lenis + GSAP ScrollTrigger Integration
   CRITICAL: Initialization order MUST NOT be changed.
   Order: registerPlugin -> Lenis -> lenis.on('scroll') -> ticker.add -> lagSmoothing
   ========================================================================== */

// 1. Register ScrollTrigger plugin with GSAP
gsap.registerPlugin(ScrollTrigger);

// 2. Initialize Lenis smooth scroll
var lenis = new Lenis({
  lerp: 0.1,           // Interpolation factor (0.1 = smooth, 1 = instant)
  smoothWheel: true,    // Enable smooth wheel scrolling
  anchors: true         // Smooth scroll for anchor links
});

// 3. Sync Lenis scroll position with ScrollTrigger
lenis.on('scroll', ScrollTrigger.update);

// 4. Add Lenis to GSAP's ticker (RAF loop)
gsap.ticker.add(function(time) {
  lenis.raf(time * 1000); // GSAP passes seconds, Lenis expects milliseconds
});

// 5. Disable GSAP lag smoothing (prevents jank with Lenis)
gsap.ticker.lagSmoothing(0);

// Export lenis globally for other scripts
window.lenis = lenis;
