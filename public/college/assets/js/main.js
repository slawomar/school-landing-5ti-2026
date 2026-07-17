/**
* Template Name: College
* Template URL: https://bootstrapmade.com/college-bootstrap-education-template/
* Updated: Jun 19 2025 with Bootstrap v5.3.6
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  if (mobileNavToggleBtn) {
    mobileNavToggleBtn.addEventListener('click', mobileNavToogle);
  }

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function(e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

  /**
   * Init swiper sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    });
  }

  window.addEventListener("load", initSwiper);

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

  /**
   * Init isotope layout and filters
   */
  document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {
    let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
    let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
    let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

    let initIsotope;
    imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {
      initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
        itemSelector: '.isotope-item',
        layoutMode: layout,
        filter: filter,
        sortBy: sort
      });
    });

    isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
      filters.addEventListener('click', function() {
        isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
        this.classList.add('filter-active');
        initIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        if (typeof aosInit === 'function') {
          aosInit();
        }
      }, false);
    });

  });


  

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  // Inline scripts moved from home.blade.php
  document.addEventListener('DOMContentLoaded', function () {
    // Timeline toggle (shows only maxVisible items)
    try {
      var timeline = document.querySelector('.timeline[data-max-visible]');
      if (timeline) {
        var maxVisible = parseInt(timeline.dataset.maxVisible, 10) || 4;
        var items = Array.from(timeline.querySelectorAll('.timeline-item'));
        var toggle = document.querySelector('.timeline-toggle');
        if (!toggle || items.length <= maxVisible) {
          if (toggle) toggle.style.display = 'none';
        } else {
          function updateItems(expanded) {
            items.forEach(function (item, index) {
              if (index >= maxVisible) {
                item.classList.toggle('timeline-item-hidden', !expanded);
              }
            });
            toggle.textContent = expanded ? 'Pokaż mniej' : 'Pokaż więcej';
            toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
          }
          updateItems(false);
          toggle.addEventListener('click', function () {
            var expanded = toggle.getAttribute('aria-expanded') === 'true';
            updateItems(!expanded);
            if (expanded) {
              timeline.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
          });
        }
      }
    } catch (e) {
      console.error('Timeline init error', e);
    }

    // Lightbox handlers
    try {
      var lightbox = document.getElementById('lightbox');
      var lightboxImage = document.getElementById('lightbox-image');
      if (lightbox && lightboxImage) {
        window.openLightbox = function (element) {
          var img = element.querySelector('img');
          if (!img) return;
          lightboxImage.src = img.src;
          lightbox.style.display = 'flex';
          document.body.style.overflow = 'hidden';
        };

        window.closeLightbox = function (event) {
          if (event && event.target.id !== 'lightbox') return;
          lightbox.style.display = 'none';
          document.body.style.overflow = 'auto';
        };

        document.addEventListener('keydown', function (event) {
          if (event.key === 'Escape') {
            window.closeLightbox();
          }
        });
      }
    } catch (e) {
      console.error('Lightbox init error', e);
    }
  });

})();