/* ==========================================================================
   Scroll Animations — Premium Motion System
   GSAP ScrollTrigger-powered animations for a WOW effect.
   Requires: gsap, ScrollTrigger, scroll.js (loaded before this file)
   ========================================================================== */

(function() {
  'use strict';

  // Respect user's reduced motion preference (per D-15)
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  /* Helper: split text into word spans for stagger animation */
  function splitWords(el) {
    // Split innerHTML by <br> to preserve line breaks
    var parts = el.innerHTML.split(/<br\s*\/?>/gi);
    var result = parts.map(function(part) {
      var text = part.replace(/&nbsp;/g, ' ').replace(/<[^>]+>/g, '').trim();
      if (!text) return '';
      return text.split(/\s+/).map(function(w) {
        return '<span class="split-word-wrap"><span class="split-word">' + w + '</span></span>';
      }).join(' ');
    }).join('<br>');
    el.innerHTML = result;
    return el.querySelectorAll('.split-word');
  }

  // Export for use in page-specific JS modules
  window.splitWords = splitWords;

  /* Page-specific animations added in Phase 2+ */

})();
