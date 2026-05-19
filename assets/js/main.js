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
