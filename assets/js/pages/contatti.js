/**
 * Contatti page — client-side enhancements
 * - GSAP entrance animations for contact info items (staggered fade-up)
 * - Client-side form validation (enhances server-side, does not replace)
 * - Smooth scroll to first invalid field
 */

(function () {
  'use strict';

  // ========== GSAP entrance animations ==========
  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!prefersReducedMotion) {
      gsap.registerPlugin(ScrollTrigger);

      // Page hero
      gsap.from('.page-hero__body > *', {
        y: 30,
        opacity: 0,
        duration: 0.9,
        stagger: 0.15,
        ease: 'power2.out',
        delay: 0.2,
      });

      // Contact info items — staggered fade-up on scroll
      gsap.from('.contatti-info__item', {
        scrollTrigger: {
          trigger: '.contatti-info__list',
          start: 'top 80%',
          once: true,
        },
        y: 24,
        opacity: 0,
        duration: 0.6,
        stagger: 0.1,
        ease: 'power2.out',
      });

      // Form wrapper
      gsap.from('.contatti-form-wrap', {
        scrollTrigger: {
          trigger: '.contatti-form-wrap',
          start: 'top 80%',
          once: true,
        },
        y: 32,
        opacity: 0,
        duration: 0.7,
        ease: 'power2.out',
      });
    }
  }

  // ========== Client-side form validation ==========
  const form = document.getElementById('contatti-form');
  if (!form) return;

  /**
   * Validate a single field and update its error span.
   * @param {HTMLElement} field
   * @returns {boolean} true if valid
   */
  function validateField(field) {
    const errorSpan = document.getElementById(field.id + '-error');
    let message = '';

    if (field.required && !field.value.trim()) {
      message = 'Questo campo è obbligatorio.';
    } else if (field.type === 'email' && field.value.trim()) {
      // Basic email format check
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(field.value.trim())) {
        message = 'Inserisci un indirizzo email valido.';
      }
    }

    if (errorSpan) {
      errorSpan.textContent = message;
    }
    field.setAttribute('aria-invalid', message ? 'true' : 'false');
    return message === '';
  }

  /**
   * Validate the GDPR privacy checkbox.
   * @returns {boolean}
   */
  function validatePrivacy() {
    const checkbox = document.getElementById('cf-privacy');
    const errorSpan = document.getElementById('cf-privacy-error');
    if (!checkbox) return true;

    const valid = checkbox.checked;
    if (errorSpan) {
      errorSpan.textContent = valid ? '' : 'Devi accettare la Privacy Policy per procedere.';
    }
    checkbox.setAttribute('aria-invalid', valid ? 'false' : 'true');
    return valid;
  }

  // Validate fields on blur for progressive feedback
  const fields = form.querySelectorAll('.contatti-form__input');
  fields.forEach(function (field) {
    field.addEventListener('blur', function () {
      validateField(field);
    });
    field.addEventListener('input', function () {
      // Clear error on input
      const errorSpan = document.getElementById(field.id + '-error');
      if (errorSpan && errorSpan.textContent) {
        validateField(field);
      }
    });
  });

  // Privacy checkbox
  const privacyCheckbox = document.getElementById('cf-privacy');
  if (privacyCheckbox) {
    privacyCheckbox.addEventListener('change', validatePrivacy);
  }

  // Form submit handler
  form.addEventListener('submit', function (e) {
    let firstInvalid = null;
    let allValid = true;

    // Validate all required text/email/tel/textarea fields
    const inputFields = [
      document.getElementById('cf-name'),
      document.getElementById('cf-email'),
      document.getElementById('cf-subject'),
      document.getElementById('cf-text'),
    ];

    inputFields.forEach(function (field) {
      if (field) {
        const valid = validateField(field);
        if (!valid && !firstInvalid) {
          firstInvalid = field;
        }
        if (!valid) allValid = false;
      }
    });

    // Validate privacy checkbox
    const privacyValid = validatePrivacy();
    if (!privacyValid) {
      allValid = false;
      if (!firstInvalid) {
        firstInvalid = document.getElementById('cf-privacy');
      }
    }

    if (!allValid) {
      e.preventDefault();

      // Smooth scroll to first invalid field
      if (firstInvalid) {
        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        firstInvalid.focus({ preventScroll: true });
      }
    }
  });

})();
