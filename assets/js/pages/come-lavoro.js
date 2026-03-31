/* ==========================================================================
   Come Lavoro — Timeline GSAP Animations
   ========================================================================== */

(function () {
  'use strict';

  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  gsap.registerPlugin(ScrollTrigger);

  /* Timeline steps — stagger in from left */
  var steps = gsap.utils.toArray('.cl-timeline__step');
  if (steps.length) {
    gsap.set(steps, { opacity: 0, x: -40 });
    gsap.to(steps, {
      opacity: 1,
      x: 0,
      duration: 0.7,
      stagger: 0.15,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: '.cl-timeline',
        start: 'top 80%',
        once: true
      }
    });
  }

  /* Vertical line grows from top to bottom */
  var line = document.querySelector('.cl-timeline::before');
  var timeline = document.querySelector('.cl-timeline');
  if (timeline) {
    gsap.fromTo(timeline,
      { '--line-scale': 0 },
      {
        '--line-scale': 1,
        duration: 1.2,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: '.cl-timeline',
          start: 'top 80%',
          once: true
        }
      }
    );
  }

  /* Editorial intro fade up */
  var editorial = document.querySelector('.cl-editorial');
  if (editorial) {
    gsap.from(editorial, {
      opacity: 0,
      y: 30,
      duration: 0.8,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: editorial,
        start: 'top 85%',
        once: true
      }
    });
  }
})();
