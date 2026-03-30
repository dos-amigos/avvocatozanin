/* ==========================================================================
   Main Entry Point — Studio Legale Zanin
   Initializes all modules on DOMContentLoaded.
   This file will grow as more modules are added in later plans.
   ========================================================================== */

document.addEventListener('DOMContentLoaded', function() {
  // Initialize Lucide icons (per D-16)
  lucide.createIcons();

  // Loading screen — show only on first visit this session (per D-10)
  var loadingScreen = document.querySelector('.loading-screen');
  if (loadingScreen) {
    if (!sessionStorage.getItem('visited')) {
      sessionStorage.setItem('visited', '1');
      // Loading screen visible via CSS; hide after delay
      setTimeout(function() {
        loadingScreen.classList.add('loading-screen--hidden');
      }, 1500);
    } else {
      loadingScreen.style.display = 'none';
    }
  }

  console.log('Studio Legale Zanin — inizializzato');
});
