(() => {
  'use strict';

  const doc = document.documentElement;
  const header = document.getElementById('header');

  // Floating header state
  const updateHeader = () => {
    if (!header) return;
    header.classList.toggle('scrolled', window.scrollY > 24);
  };
  updateHeader();
  window.addEventListener('scroll', updateHeader, { passive: true });

  // Theme
  const themeToggle = document.querySelector('.theme-toggle');
  const savedTheme = localStorage.getItem('ag_theme');
  const preferredTheme = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
  const initialTheme = savedTheme || preferredTheme;

  const setTheme = (theme) => {
    doc.setAttribute('data-theme', theme);
    if (!themeToggle) return;
    const icon = themeToggle.querySelector('i');
    if (!icon) return;
    icon.classList.toggle('fa-sun', theme === 'light');
    icon.classList.toggle('fa-moon', theme !== 'light');
    themeToggle.setAttribute('aria-label', theme === 'light' ? 'Use dark theme' : 'Use light theme');
  };

  setTheme(initialTheme);
  themeToggle?.addEventListener('click', () => {
    const nextTheme = doc.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
    localStorage.setItem('ag_theme', nextTheme);
    setTheme(nextTheme);
  });

  // Mobile navigation
  const menuToggle = document.querySelector('.menu-toggle');
  const navLinks = document.querySelector('.nav-links');

  const closeMenu = () => {
    menuToggle?.classList.remove('active');
    navLinks?.classList.remove('active');
    menuToggle?.setAttribute('aria-expanded', 'false');
  };

  menuToggle?.setAttribute('aria-expanded', 'false');
  menuToggle?.addEventListener('click', () => {
    const isOpen = navLinks?.classList.toggle('active') ?? false;
    menuToggle.classList.toggle('active', isOpen);
    menuToggle.setAttribute('aria-expanded', String(isOpen));
  });

  navLinks?.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeMenu));
  document.addEventListener('click', (event) => {
    if (!navLinks?.classList.contains('active')) return;
    if (event.target.closest('.navbar')) return;
    closeMenu();
  });
  window.addEventListener('resize', () => {
    if (window.innerWidth > 900) closeMenu();
  });

  // Counters
  const counters = [...document.querySelectorAll('.counter')];
  const animateCounter = (counter) => {
    if (counter.dataset.animated === 'true') return;
    counter.dataset.animated = 'true';
    const target = Number(counter.dataset.target || 0);
    const duration = 1200;
    const start = performance.now();

    const tick = (now) => {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      counter.textContent = String(Math.round(target * eased));
      if (progress < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  };

  if ('IntersectionObserver' in window) {
    const counterObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        animateCounter(entry.target);
        observer.unobserve(entry.target);
      });
    }, { threshold: 0.45 });
    counters.forEach((counter) => counterObserver.observe(counter));
  } else {
    counters.forEach(animateCounter);
  }

  // Hero presentation slider
  const heroSlides = [...document.querySelectorAll('.hero-slide')];
  let heroIndex = Math.max(heroSlides.findIndex((slide) => slide.classList.contains('active')), 0);
  if (heroSlides.length) heroSlides[heroIndex].classList.add('active');
  if (heroSlides.length > 1) {
    window.setInterval(() => {
      heroSlides[heroIndex].classList.remove('active');
      heroIndex = (heroIndex + 1) % heroSlides.length;
      heroSlides[heroIndex].classList.add('active');
    }, 3800);
  }

  // Project image slider
  const slidesTrack = document.querySelector('.slides');
  if (slidesTrack) {
    const slides = [...slidesTrack.querySelectorAll('.slide')];
    const next = document.querySelector('.slider-btn.next');
    const previous = document.querySelector('.slider-btn.prev');
    const isRtl = doc.dir === 'rtl';
    let index = 0;

    const renderSlider = () => {
      const offset = index * 100 * (isRtl ? 1 : -1);
      slidesTrack.style.transform = `translateX(${offset}%)`;
    };

    next?.addEventListener('click', () => {
      index = (index + 1) % slides.length;
      renderSlider();
    });
    previous?.addEventListener('click', () => {
      index = (index - 1 + slides.length) % slides.length;
      renderSlider();
    });
  }

  // Progressive reveal
  const revealTargets = document.querySelectorAll(
    '.service-card, .project-card, .template-card, .feature, .process-card, .contact-form, .contact-info, .about-image, .about-text, .project-details, .slider'
  );

  revealTargets.forEach((item, index) => {
    item.classList.add('reveal-item');
    item.style.transitionDelay = `${Math.min(index % 4, 3) * 70}ms`;
  });

  if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -35px' });
    revealTargets.forEach((item) => revealObserver.observe(item));
  } else {
    revealTargets.forEach((item) => item.classList.add('is-visible'));
  }
})();


// Premium timeline reveal
const journeyItems = [...document.querySelectorAll('.journey-card')];

if ('IntersectionObserver' in window) {
  const journeyObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      const itemIndex = journeyItems.indexOf(entry.target);
      window.setTimeout(() => entry.target.classList.add('show'), Math.max(itemIndex, 0) * 110);
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.14 });

  journeyItems.forEach((item) => journeyObserver.observe(item));
} else {
  journeyItems.forEach((item) => item.classList.add('show'));
}


// Back to top button
document.addEventListener('DOMContentLoaded', () => {
 const btn = document.querySelector('.back-to-top');
 if (!btn) return;

 const toggleButton = () => {
   if (window.scrollY > 300) {
     btn.classList.add('show');
   } else {
     btn.classList.remove('show');
   }
 };

 toggleButton();
 window.addEventListener('scroll', toggleButton, {passive:true});

 btn.addEventListener('click', () => {
   window.scrollTo({top:0, behavior:'smooth'});
 });
});
