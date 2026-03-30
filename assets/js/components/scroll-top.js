/* ==========================================================================
   Scroll-to-Top Button
   Shows after 500px scroll, smoothly scrolls to top on click via Lenis.
   ========================================================================== */

(function() {
  var scrollTopBtn = document.querySelector('.scroll-top');

  if (!scrollTopBtn) return;

  // Show/hide button based on scroll position (500px threshold)
  ScrollTrigger.create({
    start: 500,
    onUpdate: function(self) {
      if (self.progress > 0) {
        gsap.to(scrollTopBtn, { opacity: 1, pointerEvents: 'auto', duration: 0.3 });
      }
    },
    onLeaveBack: function() {
      gsap.to(scrollTopBtn, { opacity: 0, pointerEvents: 'none', duration: 0.3 });
    }
  });

  // Smooth scroll to top on click
  scrollTopBtn.addEventListener('click', function() {
    window.lenis.scrollTo(0, { duration: 1.2 });
  });
})();
