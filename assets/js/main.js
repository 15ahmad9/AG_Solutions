  // Navbar Scroll Effect

  const header = document.getElementById('header');

  window.addEventListener('scroll', () => {
    if(window.scrollY > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });

  // Counter Animation

  const counters = document.querySelectorAll('.counter');

  const startCounter = (counter) => {
    const target = +counter.getAttribute('data-target');

    let count = 0;

    const updateCounter = () => {

      const increment = target / 60;

      if(count < target) {

        count += increment;

        counter.innerText = Math.ceil(count);

        requestAnimationFrame(updateCounter);

      } else {

        counter.innerText = target;

      }
    };

    updateCounter();
  };

  // Intersection Observer

  const observer = new IntersectionObserver((entries) => {

    entries.forEach(entry => {

      if(entry.isIntersecting) {

        const counter = entry.target;

        startCounter(counter);

        observer.unobserve(counter);

      }

    });

  }, {
    threshold: 0.5
  });

  counters.forEach(counter => {
    observer.observe(counter);
  });

  // Slider

const slides = document.querySelector('.slides');

if(slides){

    const slide = document.querySelectorAll('.slide');

    const nextBtn = document.querySelector('.next');

    const prevBtn = document.querySelector('.prev');

    let index = 0;

    function updateSlider(){

        slides.style.transform =
            `translateX(${index * 100}%)`;

    }

    nextBtn.addEventListener('click', () => {

        index++;

        if(index >= slide.length){
            index = 0;
        }

        updateSlider();

    });

    prevBtn.addEventListener('click', () => {

        index--;

        if(index < 0){
            index = slide.length - 1;
        }

        updateSlider();

    });

}


/* ========================================
   Hero Slider
======================================== */

const heroSlides = document.querySelectorAll('.hero-slide');

let heroIndex = 0;

function changeHeroSlide(){

    heroSlides.forEach(slide => {
        slide.classList.remove('active');
    });

    heroIndex++;

    if(heroIndex >= heroSlides.length){
        heroIndex = 0;
    }

    heroSlides[heroIndex].classList.add('active');

}

setInterval(changeHeroSlide, 3000);

/* =====================================================
   Dark / Light Mode
===================================================== */

const themeToggle = document.querySelector('.theme-toggle');
const themeIcon = themeToggle ? themeToggle.querySelector('i') : null;
const savedTheme = localStorage.getItem('ag_theme') || 'dark';

document.documentElement.setAttribute('data-theme', savedTheme);

function updateThemeIcon(theme){
    if(!themeIcon) return;

    if(theme === 'light'){
        themeIcon.classList.remove('fa-moon');
        themeIcon.classList.add('fa-sun');
    }else{
        themeIcon.classList.remove('fa-sun');
        themeIcon.classList.add('fa-moon');
    }
}

updateThemeIcon(savedTheme);

if(themeToggle){
    themeToggle.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-theme') || 'dark';
        const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';

        document.documentElement.setAttribute('data-theme', nextTheme);
        localStorage.setItem('ag_theme', nextTheme);
        updateThemeIcon(nextTheme);
    });
}


/* =====================================================
   Mobile Navigation Menu
===================================================== */

const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('.nav-links');

if(menuToggle && navLinks){
    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        navLinks.classList.toggle('active');
    });

    navLinks.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            menuToggle.classList.remove('active');
            navLinks.classList.remove('active');
        });
    });
}
