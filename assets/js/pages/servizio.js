/**
 * Servizio Page — Editorial Layout
 * Accordion, sticky contact bar, GSAP scroll animations
 */
;(function () {
  'use strict'

  var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches

  /* ========== FAQ ACCORDION ========== */
  document.querySelectorAll('[data-accordion-item]').forEach(function (item) {
    var btn = item.querySelector('.sv-accordion__btn')
    var panel = item.querySelector('.sv-accordion__panel')
    if (!btn || !panel) return

    btn.addEventListener('click', function () {
      var isOpen = item.classList.contains('is-open')

      // Close all siblings
      item.closest('.sv-accordion').querySelectorAll('[data-accordion-item]').forEach(function (sibling) {
        if (sibling === item) return
        sibling.classList.remove('is-open')
        sibling.querySelector('.sv-accordion__btn').setAttribute('aria-expanded', 'false')
        var sibPanel = sibling.querySelector('.sv-accordion__panel')
        sibPanel.setAttribute('aria-hidden', 'true')
        if (prefersReduced) {
          sibPanel.style.height = '0'
        } else if (window.gsap) {
          gsap.to(sibPanel, { height: 0, duration: 0.35, ease: 'power2.inOut' })
        } else {
          sibPanel.style.height = '0'
        }
      })

      // Toggle current
      if (isOpen) {
        item.classList.remove('is-open')
        btn.setAttribute('aria-expanded', 'false')
        panel.setAttribute('aria-hidden', 'true')
        if (prefersReduced) {
          panel.style.height = '0'
        } else if (window.gsap) {
          gsap.to(panel, { height: 0, duration: 0.35, ease: 'power2.inOut' })
        } else {
          panel.style.height = '0'
        }
      } else {
        item.classList.add('is-open')
        btn.setAttribute('aria-expanded', 'true')
        panel.setAttribute('aria-hidden', 'false')
        var inner = panel.querySelector('.sv-accordion__panel-inner')
        var h = inner.offsetHeight
        if (prefersReduced) {
          panel.style.height = h + 'px'
        } else if (window.gsap) {
          gsap.to(panel, { height: h, duration: 0.35, ease: 'power2.inOut' })
        } else {
          panel.style.height = h + 'px'
        }
      }
    })
  })

  /* ========== STICKY CONTACT BAR ========== */
  var stickyBar = document.getElementById('sv-sticky-bar')
  if (stickyBar) {
    var hero = document.querySelector('.sv-hero')
    var heroHeight = hero ? hero.offsetHeight : 400

    window.addEventListener('scroll', function () {
      if (window.scrollY > heroHeight) {
        stickyBar.classList.add('is-visible')
      } else {
        stickyBar.classList.remove('is-visible')
      }
    }, { passive: true })
  }

  /* ========== GSAP SCROLL ANIMATIONS ========== */
  if (!prefersReduced && window.gsap && window.ScrollTrigger) {
    gsap.registerPlugin(ScrollTrigger)

    // Hero text entrance
    var heroText = document.querySelector('.sv-hero__text-inner')
    if (heroText) {
      gsap.from(heroText.children, {
        y: 30,
        opacity: 0,
        duration: 0.8,
        stagger: 0.15,
        ease: 'power2.out'
      })
    }

    // Panoramica fade in
    var editorial = document.querySelector('.sv-editorial__body')
    if (editorial) {
      gsap.from(editorial, {
        scrollTrigger: { trigger: editorial, start: 'top 85%' },
        y: 30,
        opacity: 0,
        duration: 0.8,
        ease: 'power2.out'
      })
    }

    // Cosa include rows stagger
    var includeRows = document.querySelectorAll('.sv-includes__row')
    if (includeRows.length) {
      gsap.from(includeRows, {
        scrollTrigger: { trigger: '.sv-includes', start: 'top 80%' },
        y: 30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.12,
        ease: 'power2.out'
      })
    }

    // Timeline steps stagger
    var timelineSteps = document.querySelectorAll('.sv-timeline__step')
    if (timelineSteps.length) {
      gsap.from(timelineSteps, {
        scrollTrigger: { trigger: '.sv-timeline', start: 'top 80%' },
        y: 30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.15,
        ease: 'power2.out'
      })
    }

    // Stats counters
    document.querySelectorAll('.sv-stats__item strong[data-count]').forEach(function (el) {
      var target = parseInt(el.getAttribute('data-count'), 10)
      ScrollTrigger.create({
        trigger: el,
        start: 'top 90%',
        once: true,
        onEnter: function () {
          gsap.to({ val: 0 }, {
            val: target,
            duration: 1.5,
            ease: 'power2.out',
            onUpdate: function () {
              el.textContent = Math.round(this.targets()[0].val)
            }
          })
        }
      })
    })

    // FAQ items
    var faqItems = document.querySelectorAll('.sv-accordion__item')
    if (faqItems.length) {
      gsap.from(faqItems, {
        scrollTrigger: { trigger: '.sv-accordion', start: 'top 85%' },
        y: 20,
        opacity: 0,
        duration: 0.5,
        stagger: 0.08,
        ease: 'power2.out'
      })
    }
  }
})()
