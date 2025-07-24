


document.addEventListener('DOMContentLoaded', function () {
  const navToggle = document.getElementById('nav-toggle');
  const navMenu = document.getElementById('nav-menu');
  const languageSelector = document.getElementById('language-selector');
   const expandIcon = document.querySelector('.about-image .expand-icon');
    const lightbox = document.getElementById('lightbox');
    const lightboxClose = document.querySelector('.lightbox-close');
  languageSelector.addEventListener('change', function () {
    const selectedLanguage = languageSelector.value;
    if (selectedLanguage === 'es') {
      window.location.href = 'index.php';
    }
    if (selectedLanguage === 'en') {
          window.location.href = `index-en.php`;
    }
  
  })
    expandIcon.addEventListener('click', () => {
      lightbox.style.display = 'block';
    });

    lightboxClose.addEventListener('click', () => {
      lightbox.style.display = 'none';
    });

    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox) {
        lightbox.style.display = 'none';
      }
    });
  if (navToggle && navMenu) {
    navToggle.addEventListener('click', function () {
      navMenu.classList.toggle('active');
      navToggle.classList.toggle('active');
    });

    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', function () {
        navMenu.classList.remove('active');
        navToggle.classList.remove('active');
      });
    });
  }

  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', function () {
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });

  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        const offsetTop = target.offsetTop - 70;
        window.scrollTo({
          top: offsetTop,
          behavior: 'smooth'
        });
      }
    });
  });

  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('aos-animate');
      } else {
        entry.target.classList.remove('aos-animate');
      }
    });
  }, observerOptions);

  document.querySelectorAll('[data-aos]').forEach(el => {
    observer.observe(el);
  });


  const floatingCards = document.querySelectorAll('.floating-card');
  floatingCards.forEach((card, index) => {
    card.style.animationDelay = `${index * 1}s`;
  });

  const stats = document.querySelectorAll('.stat-number');
  const animateCounter = (element, target) => {
    let current = 0;
    const increment = target / 100;
    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }
      if (target === 100) {
        element.textContent = Math.floor(current) + '%';
      } else {
        element.textContent = Math.floor(current) + (target >= 500 ? '+' : '');
      }
    }, 20);
  };

  const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const statNumber = entry.target;
        const text = statNumber.textContent;
        let target = parseInt(text.replace(/\D/g, ''));

        if (text.includes('%')) {
          target = 100;
        } else if (text.includes('+')) {
          target = parseInt(text.replace('+', ''));
        }

        animateCounter(statNumber, target);
        statsObserver.unobserve(statNumber);
      }
    });
  }, { threshold: 0.5 });

  stats.forEach(stat => {
    statsObserver.observe(stat);
  });

  let currentTestimonial = 0;
  const testimonials = document.querySelectorAll('.testimonial-card');
  function showTestimonial(index) {
    testimonials.forEach((testimonial, i) => {
      testimonial.style.opacity = i === index ? '1' : '0.7';
      testimonial.style.transform = i === index ? 'scale(1)' : 'scale(0.95)';
    });
  }

  if (testimonials.length > 0) {
    showTestimonial(0);
    setInterval(() => {
      currentTestimonial = (currentTestimonial + 1) % testimonials.length;
      showTestimonial(currentTestimonial);
    }, 5000);
  }

  window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero');
    if (hero) {
      const heroHeight = hero.offsetHeight;
      if (scrolled < heroHeight) {
        const rate = scrolled * -0.2;
        hero.style.transform = `translateY(${rate}px)`;
      }
    }
  });

  const inputs = document.querySelectorAll('input, select, textarea');
  inputs.forEach(input => {
    input.addEventListener('blur', validateField);
    input.addEventListener('input', clearError);
  });

  function validateField(e) {
    const field = e.target;
    const value = field.value.trim();
    clearError(e);
    
    if (field.hasAttribute('required') && !value) {
      showFieldError(field, 'Este campo es obligatorio');
      return false;
    }

    if (field.type === 'email' && value && !isValidEmail(value)) {
      showFieldError(field, 'Ingresa un email válido');
      return false;
    }

    if (field.type === 'tel' && value && !isValidPhone(value)) {
      showFieldError(field, 'Ingresa un teléfono válido');
      return false;
    }
    return true;
  }

  function clearError(e) {
    const field = e.target;
    const errorElement = field.parentNode.querySelector('.field-error');
    if (errorElement) {
      errorElement.remove();
    }
    field.classList.remove('error');
  }

  function showFieldError(field, message) {
    field.classList.add('error');
    const errorElement = document.createElement('div');
    errorElement.className = 'field-error';
    errorElement.textContent = message;
    errorElement.style.color = '#ef4444';
    errorElement.style.fontSize = '0.875rem';
    errorElement.style.marginTop = '0.25rem';
    field.parentNode.appendChild(errorElement);
  }

  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  function isValidPhone(phone) {
    const phonePattern = /^\+?[0-9\s\-]{6,20}$/;
    const onlyDigits = phone.replace(/\D/g, '');
    return phonePattern.test(phone) && onlyDigits.length >= 6;
  }

  document.body.classList.add('loading');
});

// Scroll a la seccion seleccionada
function scrollToSection(sectionId) {
  const section = document.getElementById(sectionId);
  if (section) {
    const offsetTop = section.offsetTop - 70;
    window.scrollTo({
      top: offsetTop,
      behavior: 'smooth'
    });
  }
}


