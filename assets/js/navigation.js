(function() {
  'use strict';

  var header = document.getElementById('header');
  var burger = document.getElementById('burger');
  var overlay = document.getElementById('mobile-overlay');
  if (!header) return;

  // Scroll — transparent to solid
  ScrollTrigger.create({
    start: 80,
    onEnter: function() { header.classList.add('scrolled'); header.classList.remove('transparent'); },
    onLeaveBack: function() { header.classList.remove('scrolled'); header.classList.add('transparent'); }
  });

  // Mobile menu
  var open = false;
  if (burger && overlay) {
    burger.addEventListener('click', function() {
      open = !open;
      burger.setAttribute('aria-expanded', open);
      overlay.setAttribute('aria-hidden', !open);
      if (window.lenis) open ? window.lenis.stop() : window.lenis.start();
    });
    overlay.querySelectorAll('a').forEach(function(a) {
      a.addEventListener('click', function() {
        open = false;
        burger.setAttribute('aria-expanded', false);
        overlay.setAttribute('aria-hidden', true);
        if (window.lenis) window.lenis.start();
      });
    });
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && open) {
      open = false;
      burger.setAttribute('aria-expanded', false);
      overlay.setAttribute('aria-hidden', true);
      if (window.lenis) window.lenis.start();
      burger.focus();
    }
  });
})();
