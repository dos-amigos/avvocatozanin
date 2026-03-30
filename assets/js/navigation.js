/* ==========================================================================
   Navigation — Header sticky behavior, mega-dropdown, and mobile menu
   Depends on: gsap, ScrollTrigger (global), window.lenis (from scroll.js)
   ========================================================================== */

(function() {
  'use strict';

  var header = document.querySelector('.header');
  if (!header) return;

  /* ==========================================================================
     1. Sticky Header — Hide on Scroll Down, Show on Scroll Up
     ========================================================================== */

  var showHeader = gsap.from(header, {
    yPercent: -100,
    paused: true,
    duration: 0.25,
    ease: 'power2.out'
  }).progress(1); // Start in "shown" state

  ScrollTrigger.create({
    start: 'top top',
    end: 99999,
    onUpdate: function(self) {
      // -1 = scrolling up, 1 = scrolling down
      if (self.direction === -1) {
        showHeader.play();   // Scrolling up -> show
      } else if (self.scroll() > 300) {
        showHeader.reverse(); // Scrolling down past 300px -> hide
      }
    }
  });

  // Transition from transparent to solid after 50px scroll
  ScrollTrigger.create({
    start: 50,
    onEnter: function() {
      header.classList.add('header--scrolled');
    },
    onLeaveBack: function() {
      if (!header.hasAttribute('data-no-hero')) {
        header.classList.remove('header--scrolled');
      }
    }
  });

  /* ---------- Topbar — visible near top of page (desktop only) ---------- */
  var topbar = document.querySelector('.topbar');

  if (topbar && window.innerWidth >= 1280) {
    var isTopbarVisible = false;
    var TOPBAR_THRESHOLD = 150;

    // Initial state: hidden above viewport
    gsap.set(topbar, { yPercent: -100 });

    var topbarTween = gsap.to(topbar, {
      yPercent: 0, paused: true, duration: 0.3, ease: 'power2.out'
    });

    var shiftHeader = gsap.to(header, {
      top: 36, paused: true, duration: 0.3, ease: 'power2.out'
    });

    function showTopbarFn() {
      if (isTopbarVisible) return;
      isTopbarVisible = true;
      topbarTween.play();
      shiftHeader.play();
    }

    function hideTopbarFn() {
      if (!isTopbarVisible) return;
      isTopbarVisible = false;
      topbarTween.reverse();
      shiftHeader.reverse();
    }

    // Show on page load if at top
    if (window.scrollY === 0) {
      showTopbarFn();
    }

    ScrollTrigger.create({
      start: 'top top', end: 99999,
      onUpdate: function(self) {
        if (self.scroll() < TOPBAR_THRESHOLD) {
          showTopbarFn();
        } else {
          hideTopbarFn();
        }
      }
    });
  }

  /* ==========================================================================
     2. Mega Dropdowns — Open on hover (desktop), click fallback
     ========================================================================== */

  var dropdownItems = document.querySelectorAll('.header__menu-item--has-dropdown');
  var activeDropdown = null;
  var dropdownCloseTimeout = null;

  function openDropdown(menuItem) {
    var trigger = menuItem.querySelector('.header__link--dropdown');
    var panel = menuItem.querySelector('.mega-dropdown');
    if (!trigger || !panel) return;

    // Close any other open dropdown first
    if (activeDropdown && activeDropdown !== menuItem) {
      closeDropdown(activeDropdown);
    }

    if (activeDropdown === menuItem) return;
    activeDropdown = menuItem;

    // Clear any pending close timeout
    if (dropdownCloseTimeout) {
      clearTimeout(dropdownCloseTimeout);
      dropdownCloseTimeout = null;
    }

    // Update ARIA states
    trigger.setAttribute('aria-expanded', 'true');
    panel.setAttribute('aria-hidden', 'false');

    // Animate items
    var items = panel.querySelectorAll('.mega-dropdown__item');
    gsap.fromTo(items,
      { opacity: 0, y: 20 },
      {
        opacity: 1,
        y: 0,
        duration: 0.4,
        stagger: { each: 0.08, from: 'start' },
        ease: 'power2.out'
      }
    );

    ScrollTrigger.refresh();
  }

  function closeDropdown(menuItem) {
    if (!menuItem) return;
    var trigger = menuItem.querySelector('.header__link--dropdown');
    var panel = menuItem.querySelector('.mega-dropdown');
    if (!trigger || !panel) return;

    if (activeDropdown === menuItem) activeDropdown = null;

    trigger.setAttribute('aria-expanded', 'false');
    panel.setAttribute('aria-hidden', 'true');

    var items = panel.querySelectorAll('.mega-dropdown__item');
    gsap.to(items, {
      opacity: 0,
      y: 20,
      duration: 0.2,
      stagger: { each: 0.03 },
      ease: 'power2.in'
    });

    ScrollTrigger.refresh();
  }

  dropdownItems.forEach(function(menuItem) {
    // Open on hover (desktop)
    menuItem.addEventListener('mouseenter', function() {
      if (dropdownCloseTimeout) {
        clearTimeout(dropdownCloseTimeout);
        dropdownCloseTimeout = null;
      }
      openDropdown(menuItem);
    });

    menuItem.addEventListener('mouseleave', function() {
      dropdownCloseTimeout = setTimeout(function() {
        closeDropdown(menuItem);
      }, 200);
    });

    // Click navigates to the parent page (hover already handles dropdown)
    var trigger = menuItem.querySelector('.header__link--dropdown');
    if (trigger) {
      var panelId = trigger.getAttribute('aria-controls');
      var hrefMap = {
        'mega-dropdown-servizi': '/servizi'
      };
      trigger.addEventListener('click', function(e) {
        e.preventDefault();
        var dest = hrefMap[panelId];
        if (dest) window.location.href = dest;
      });
    }
  });

  // Close on click outside
  document.addEventListener('click', function(e) {
    if (activeDropdown) {
      var panel = activeDropdown.querySelector('.mega-dropdown');
      var trigger = activeDropdown.querySelector('.header__link--dropdown');
      if (panel && trigger && !panel.contains(e.target) && !trigger.contains(e.target)) {
        closeDropdown(activeDropdown);
      }
    }
  });

  /* ==========================================================================
     3. Mobile Menu
     ========================================================================== */

  var mobileToggle = document.querySelector('.mobile-menu__toggle');
  var mobileMenu = document.getElementById('mobile-menu');
  var mobileLinks = mobileMenu ? mobileMenu.querySelectorAll('.mobile-menu__link') : [];
  var isMobileMenuOpen = false;

  function openMobileMenu() {
    if (isMobileMenuOpen) return;
    isMobileMenuOpen = true;

    // Update ARIA states
    mobileToggle.setAttribute('aria-expanded', 'true');
    mobileMenu.setAttribute('aria-hidden', 'false');

    // Add open class
    mobileMenu.classList.add('mobile-menu--open');

    // Lock body scroll via Lenis (Pitfall 7)
    if (window.lenis) {
      window.lenis.stop();
    }

    // Animate links with stagger
    gsap.fromTo(mobileLinks,
      { opacity: 0, y: 20 },
      {
        opacity: 1,
        y: 0,
        duration: 0.5,
        stagger: {
          each: 0.1,
          from: 'start'
        },
        ease: 'power2.out',
        delay: 0.2 // Wait for overlay to fade in
      }
    );
  }

  function closeMobileMenu() {
    if (!isMobileMenuOpen) return;
    isMobileMenuOpen = false;

    // Update ARIA states
    mobileToggle.setAttribute('aria-expanded', 'false');
    mobileMenu.setAttribute('aria-hidden', 'true');

    // Remove open class
    mobileMenu.classList.remove('mobile-menu--open');

    // Unlock body scroll
    if (window.lenis) {
      window.lenis.start();
    }

    // Reset link styles
    gsap.set(mobileLinks, { opacity: 0, y: 20 });
  }

  if (mobileToggle && mobileMenu) {
    // Toggle on click
    mobileToggle.addEventListener('click', function() {
      if (isMobileMenuOpen) {
        closeMobileMenu();
      } else {
        openMobileMenu();
      }
    });

    // Close on mobile link click (for same-page anchors)
    mobileLinks.forEach(function(link) {
      link.addEventListener('click', function() {
        closeMobileMenu();
      });
    });

    // Close on window resize crossing 1280px
    var resizeTimer;
    window.addEventListener('resize', function() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function() {
        if (window.innerWidth >= 1280 && isMobileMenuOpen) {
          closeMobileMenu();
        }
      }, 100);
    });
  }

  /* ==========================================================================
     4. Keyboard Navigation (Accessibility)
     ========================================================================== */

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      // Close mega-dropdown
      if (activeDropdown) {
        var activeTrigger = activeDropdown.querySelector('.header__link--dropdown');
        closeDropdown(activeDropdown);
        if (activeTrigger) activeTrigger.focus();
      }

      // Close mobile menu
      if (isMobileMenuOpen) {
        closeMobileMenu();
        mobileToggle.focus(); // Return focus to toggle
      }
    }
  });

  /* ==========================================================================
     5. Focus Trap for Mobile Menu
     ========================================================================== */

  if (mobileMenu && mobileToggle) {
    mobileMenu.addEventListener('keydown', function(e) {
      if (e.key !== 'Tab' || !isMobileMenuOpen) return;

      var focusableElements = mobileMenu.querySelectorAll(
        'a[href], button, textarea, input, select, [tabindex]:not([tabindex="-1"])'
      );

      // Include the toggle button in the focus trap
      var allFocusable = [mobileToggle];
      focusableElements.forEach(function(el) {
        allFocusable.push(el);
      });

      var firstFocusable = allFocusable[0];
      var lastFocusable = allFocusable[allFocusable.length - 1];

      if (e.shiftKey) {
        // Shift + Tab: if on first element, go to last
        if (document.activeElement === firstFocusable) {
          e.preventDefault();
          lastFocusable.focus();
        }
      } else {
        // Tab: if on last element, go to first
        if (document.activeElement === lastFocusable) {
          e.preventDefault();
          firstFocusable.focus();
        }
      }
    });

    // Also trap from the toggle button
    mobileToggle.addEventListener('keydown', function(e) {
      if (e.key !== 'Tab' || !isMobileMenuOpen) return;

      var focusableElements = mobileMenu.querySelectorAll(
        'a[href], button, textarea, input, select, [tabindex]:not([tabindex="-1"])'
      );

      if (e.shiftKey && focusableElements.length > 0) {
        // Shift + Tab from toggle: go to last link in menu
        e.preventDefault();
        focusableElements[focusableElements.length - 1].focus();
      }
    });
  }

})();
