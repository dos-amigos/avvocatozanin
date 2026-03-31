/* ==========================================================================
   Homepage Animations — GSAP ScrollTrigger
   Requires: gsap (global), ScrollTrigger (global), animations.js (window.splitWords)
   Loaded conditionally by scripts.php for the home template only.
   ========================================================================== */

(function () {
  'use strict';

  // Respect user's reduced motion preference
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  // Register ScrollTrigger plugin
  gsap.registerPlugin(ScrollTrigger);

  /* -------------------------------------------------------------------------
     COUNTER UTILITY
     Animates numeric elements from 0 to their data-count attribute value.
     Used by glass-box stats (section 3) and stats section (section 6).
     ----------------------------------------------------------------------- */
  function initCounters(selector) {
    var els = gsap.utils.toArray(selector);
    if (!els.length) return;
    els.forEach(function (el) {
      var target = parseInt(el.getAttribute('data-count'), 10);
      if (!target) return;
      ScrollTrigger.create({
        trigger: el,
        start: 'top 85%',
        once: true,
        onEnter: function () {
          gsap.to({ val: 0 }, {
            val: target,
            duration: 2,
            ease: 'power2.out',
            onUpdate: function () {
              el.textContent = Math.round(this.targets()[0].val);
            }
          });
        }
      });
    });
  }

  /* -------------------------------------------------------------------------
     1. HERO ENTRANCE (no ScrollTrigger — fires on load after short delay)
     Elements: .subtitle, .hero__title (word-split), .hero__desc,
               .hero__buttons, .hero__keywords
     ----------------------------------------------------------------------- */
  var heroBody = document.querySelector('.hero__body');
  if (heroBody) {
    var heroTl = gsap.timeline({ delay: 0.3 });

    var subtitle = heroBody.querySelector('.subtitle');
    if (subtitle) {
      heroTl.from(subtitle, { opacity: 0, y: 30, duration: 0.8, ease: 'power3.out' });
    }

    var heroTitle = heroBody.querySelector('.hero__title');
    if (heroTitle && window.splitWords) {
      var words = window.splitWords(heroTitle);
      heroTl.from(words, {
        yPercent: 120,
        opacity: 0,
        duration: 0.7,
        stagger: 0.05,
        ease: 'power3.out'
      }, '-=0.5');
    }

    var heroDesc = heroBody.querySelector('.hero__desc');
    if (heroDesc) {
      heroTl.from(heroDesc, { opacity: 0, y: 30, duration: 0.8, ease: 'power3.out' }, '-=0.5');
    }

    var heroButtons = heroBody.querySelector('.hero__buttons');
    if (heroButtons) {
      heroTl.from(heroButtons, { opacity: 0, y: 20, duration: 0.6, ease: 'power3.out' }, '-=0.3');
    }

    var heroKeywords = heroBody.querySelector('.hero__keywords');
    if (heroKeywords) {
      heroTl.from(heroKeywords, { opacity: 0, duration: 0.8 }, '-=0.2');
    }
  }

  /* -------------------------------------------------------------------------
     2. VALUE CARDS STAGGER
     Stagger-reveal 3 .value-card elements when .values-grid enters viewport.
     ----------------------------------------------------------------------- */
  var valueCards = gsap.utils.toArray('.value-card');
  if (valueCards.length) {
    gsap.from(valueCards, {
      opacity: 0,
      y: 40,
      scale: 0.95,
      duration: 0.8,
      stagger: 0.12,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: '.values-grid',
        start: 'top 80%',
        once: true
      }
    });
  }

  /* -------------------------------------------------------------------------
     3a. ABOUT-SPLIT IMAGE PARALLAX
     Scales and shifts .about-split__img on scroll for depth effect.
     Note: .about-split__media has overflow: hidden to contain scale.
     ----------------------------------------------------------------------- */
  var aboutImg = document.querySelector('.about-split__img');
  if (aboutImg) {
    gsap.set(aboutImg, { willChange: 'transform' });
    gsap.to(aboutImg, {
      scale: 1.15,
      yPercent: -8,
      ease: 'none',
      scrollTrigger: {
        trigger: '.about-split',
        start: 'top bottom',
        end: 'bottom top',
        scrub: true
      }
    });
  }

  /* -------------------------------------------------------------------------
     3b. ABOUT TEXT FADE-IN
     Fade + slide the about text column from the right.
     ----------------------------------------------------------------------- */
  var aboutText = document.querySelector('.about-split__text');
  if (aboutText) {
    gsap.from(aboutText, {
      opacity: 0,
      x: 40,
      duration: 0.8,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: '.about-split__text',
        start: 'top 80%',
        once: true
      }
    });
  }

  /* -------------------------------------------------------------------------
     3c. GLASS-BOX COUNTERS
     Animate the two glass-box stats (15+ years, 500+ cases) from 0.
     ----------------------------------------------------------------------- */
  initCounters('.glass-box__stat strong[data-count]');

  /* -------------------------------------------------------------------------
     4. CONTACT BAR ITEMS STAGGER
     Stagger-reveal 3 .contact-bar__item elements.
     ----------------------------------------------------------------------- */
  var contactItems = gsap.utils.toArray('.contact-bar__item');
  if (contactItems.length) {
    gsap.from(contactItems, {
      opacity: 0,
      y: 20,
      duration: 0.6,
      stagger: 0.1,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: '.contact-bar',
        start: 'top 85%',
        once: true
      }
    });
  }

  /* -------------------------------------------------------------------------
     5. PRACTICE CARDS STAGGER
     Stagger-reveal 4 .practice-card elements in the 2×2 grid.
     ----------------------------------------------------------------------- */
  var practiceCards = gsap.utils.toArray('.practice-card');
  if (practiceCards.length) {
    gsap.set(practiceCards, { opacity: 0, y: 40, scale: 0.95 });
    gsap.to(practiceCards, {
      opacity: 1,
      y: 0,
      scale: 1,
      duration: 0.7,
      stagger: 0.08,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: '.practices-grid',
        start: 'top 85%',
        once: true
      }
    });
  }

  /* -------------------------------------------------------------------------
     6. STATS SECTION COUNTERS
     Animate the 4 stats (500+, 95%, 4, 15+) from 0 to data-count values.
     ----------------------------------------------------------------------- */
  initCounters('.stat strong[data-count]');

  /* -------------------------------------------------------------------------
     7. PROCESS STEPS STAGGER
     Stagger-reveal 3 .process-step elements.
     ----------------------------------------------------------------------- */
  var processSteps = gsap.utils.toArray('.process-step');
  if (processSteps.length) {
    gsap.from(processSteps, {
      opacity: 0,
      y: 30,
      duration: 0.7,
      stagger: 0.15,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: '.process-grid',
        start: 'top 80%',
        once: true
      }
    });
  }

  /* -------------------------------------------------------------------------
     8a. CTA SECTION BACKGROUND PARALLAX
     Scales and shifts .cta-section__bg on scroll.
     Parent .cta-section already has overflow: hidden in homepage.css.
     ----------------------------------------------------------------------- */
  var ctaBg = document.querySelector('.cta-section__bg');
  if (ctaBg) {
    gsap.set(ctaBg, { willChange: 'transform' });
    gsap.to(ctaBg, {
      scale: 1.15,
      yPercent: -8,
      ease: 'none',
      scrollTrigger: {
        trigger: '.cta-section',
        start: 'top bottom',
        end: 'bottom top',
        scrub: true
      }
    });
  }

  /* -------------------------------------------------------------------------
     8b. CTA CONTENT FADE-UP
     Fade and slide up the CTA text/button block.
     ----------------------------------------------------------------------- */
  var ctaBody = document.querySelector('.cta-section__body');
  if (ctaBody) {
    gsap.from(ctaBody, {
      opacity: 0,
      y: 40,
      duration: 0.8,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: '.cta-section__body',
        start: 'top 85%',
        once: true
      }
    });
  }

  /* -------------------------------------------------------------------------
     9. STATS SECTION BACKGROUND PARALLAX
     Scales and shifts .stats-section__bg on scroll.
     Parent .stats-section already has overflow: hidden in homepage.css.
     ----------------------------------------------------------------------- */
  var statsBg = document.querySelector('.stats-section__bg');
  if (statsBg) {
    gsap.set(statsBg, { willChange: 'transform' });
    gsap.to(statsBg, {
      scale: 1.1,
      yPercent: -5,
      ease: 'none',
      scrollTrigger: {
        trigger: '.stats-section',
        start: 'top bottom',
        end: 'bottom top',
        scrub: true
      }
    });
  }

  /* -------------------------------------------------------------------------
     REFRESH ScrollTrigger
     Recalculates all trigger positions after initial layout is complete.
     ----------------------------------------------------------------------- */
  ScrollTrigger.refresh();

})();
