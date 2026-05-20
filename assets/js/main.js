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