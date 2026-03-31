/**
 * Servizio Page — Structured Navigator
 * JS for service detail pages.
 * Features: scroll-spy sidebar, scroll-driven process timeline, FAQ accordion, section fade-in
 */
(function() {
  'use strict';

  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // ========== A. SCROLL-SPY ==========
  if (!reducedMotion) {
    var sidebarLinks = document.querySelectorAll('.service-sidebar__link');
    var sections = document.querySelectorAll('.service-section');

    if (sidebarLinks.length && sections.length) {
      sections.forEach(function(section) {
        ScrollTrigger.create({
          trigger: section,
          start: 'top 40%',
          end: 'bottom 40%',
          onToggle: function(self) {
            if (self.isActive) {
              var id = section.getAttribute('id');
              sidebarLinks.forEach(function(link) {
                link.classList.remove('is-active');
                if (link.getAttribute('href') === '#' + id) {
                  link.classList.add('is-active');
                }
              });
            }
          }
        });
      });
    }
  }

  // ========== SIDEBAR LINK SMOOTH SCROLL (always runs) ==========
  var sidebarLinksAll = document.querySelectorAll('.service-sidebar__link');
  sidebarLinksAll.forEach(function(link) {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      var targetId = this.getAttribute('href').substring(1);
      var target = document.getElementById(targetId);
      if (target) {
        var headerOffset = 80;
        var elementPosition = target.getBoundingClientRect().top + window.pageYOffset;
        var offsetPosition = elementPosition - headerOffset - 24;

        window.scrollTo({
          top: offsetPosition,
          behavior: reducedMotion ? 'auto' : 'smooth'
        });
      }
    });
  });

  // ========== B. PROCESS TIMELINE (scroll-driven) ==========
  if (!reducedMotion) {
    var timeline = document.querySelector('.process-timeline');

    if (timeline) {
      var steps = timeline.querySelectorAll('.process-timeline__step');
      var progress = timeline.querySelector('.process-timeline__progress');
      var track = timeline.querySelector('.process-timeline__track');

      // Entrance animation: each step fades in as it scrolls into view
      steps.forEach(function(step) {
        gsap.to(step, {
          opacity: 1,
          y: 0,
          duration: 0.7,
          ease: 'power2.out',
          scrollTrigger: {
            trigger: step,
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        });

        // Activate marker when step is in the center of viewport
        ScrollTrigger.create({
          trigger: step,
          start: 'top 60%',
          end: 'bottom 40%',
          onToggle: function(self) {
            if (self.isActive) {
              step.classList.add('is-active');
            } else {
              step.classList.remove('is-active');
            }
          }
        });
      });

      // Progress line fills as user scrolls through the timeline
      if (progress && track) {
        gsap.to(progress, {
          height: '100%',
          ease: 'none',
          scrollTrigger: {
            trigger: timeline,
            start: 'top 60%',
            end: 'bottom 50%',
            scrub: 0.3
          }
        });
      }
    }
  }

  // ========== C. FAQ ACCORDION (always runs — functional, not decorative) ==========
  var accordionGroups = document.querySelectorAll('[data-accordion]');

  accordionGroups.forEach(function(group) {
    var items = group.querySelectorAll('[data-accordion-item]');

    items.forEach(function(item) {
      var btn = item.querySelector('.service-accordion__btn');
      var panel = item.querySelector('.service-accordion__panel');
      var panelInner = item.querySelector('.service-accordion__panel-inner');

      if (!btn || !panel || !panelInner) return;

      btn.addEventListener('click', function() {
        var isOpen = item.classList.contains('is-open');

        // Close all items in same group
        items.forEach(function(otherItem) {
          if (otherItem !== item && otherItem.classList.contains('is-open')) {
            var otherPanel = otherItem.querySelector('.service-accordion__panel');
            var otherBtn = otherItem.querySelector('.service-accordion__btn');
            otherItem.classList.remove('is-open');
            otherBtn.setAttribute('aria-expanded', 'false');
            otherPanel.setAttribute('aria-hidden', 'true');
            if (reducedMotion) {
              otherPanel.style.height = '0';
            } else {
              gsap.to(otherPanel, {
                height: 0,
                duration: 0.4,
                ease: 'power2.inOut'
              });
            }
          }
        });

        // Toggle current item
        if (isOpen) {
          item.classList.remove('is-open');
          btn.setAttribute('aria-expanded', 'false');
          panel.setAttribute('aria-hidden', 'true');
          if (reducedMotion) {
            panel.style.height = '0';
          } else {
            gsap.to(panel, {
              height: 0,
              duration: 0.4,
              ease: 'power2.inOut',
              onComplete: function() {
                ScrollTrigger.refresh();
              }
            });
          }
        } else {
          item.classList.add('is-open');
          btn.setAttribute('aria-expanded', 'true');
          panel.setAttribute('aria-hidden', 'false');
          if (reducedMotion) {
            panel.style.height = 'auto';
          } else {
            gsap.to(panel, {
              height: panelInner.offsetHeight,
              duration: 0.4,
              ease: 'power2.inOut',
              onComplete: function() {
                ScrollTrigger.refresh();
              }
            });
          }
        }
      });
    });
  });

  // ========== D. FADE-IN SECTIONS ==========
  if (!reducedMotion) {
    var fadeTargets = document.querySelectorAll('.service-section');
    fadeTargets.forEach(function(el) {
      gsap.fromTo(el,
        { opacity: 0, y: 30 },
        {
          opacity: 1,
          y: 0,
          duration: 0.8,
          ease: 'power2.out',
          scrollTrigger: {
            trigger: el,
            start: 'top 80%',
            toggleActions: 'play none none none'
          }
        }
      );
    });
  }

})();
