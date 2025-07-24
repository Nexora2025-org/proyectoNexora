<?php  
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nexora - Your Home, Your Future</title>
  <link rel="stylesheet" href="./assets/css/styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <link rel="icon" href="./assets/img/logo.png" type="image/x-icon" />
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar" id="navbar">
    <div class="nav-container">
      <div class="nav-fuscvam">
        <img src="./assets/img/FUSCVAMicon.png" alt="FUSCVAM icon" class="fuscvam-icon" />
         <img src="./assets/img/logoCooperativa.png" alt="Cooperativa icono" class="cooperativa-icon"> 
      </div>
      <ul class="nav-menu" id="nav-menu">
        <li><a href="#inicio" class="nav-link">Home</a></li>
        <li><a href="#cooperativa" class="nav-link">Cooperative</a></li>
        <li><a href="#software" class="nav-link">Our Software</a></li>
        <li><a href="#testimonios" class="nav-link">Testimonials</a></li>
        <li><a href="#contacto" class="nav-link">Join the Cooperative</a></li>
        <li>
          <div class="language-label">
            <i class="fas fa-globe"></i>
            <span>Language:</span>
          </div>
          <select class="language-selector" id="language-selector">
            <option value="es">Español</option>
            <option value="en" selected>English</option>
          </select>
        </li>
      </ul>
      <div class="nav-toggle" id="nav-toggle">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section id="inicio" class="hero">
    <div class="hero-container">
      <div class="hero-content">
        <h1 class="hero-title">
          Your <span class="gradient-text">Own Home</span><br>
          Is Possible in Uruguay
        </h1>

        <p class="hero-description">
          Join our housing cooperative and access your own home through our savings and loan system.
          Plus, manage everything with our specialized software.
        </p>
        <div class="hero-buttons">
          <button class="btn btn-primary" onclick="scrollToSection('cooperativa')">
            <i class="fas fa-home"></i>
            Learn About the Cooperative
          </button>
          <button class="btn btn-secondary" onclick="scrollToSection('software')">
            <i class="fas fa-laptop"></i>
            About our Software
          </button>
        </div>
        <div class="hero-stats">
          <div class="stat">
            <span class="stat-number">500+</span>
            <span class="stat-label">Families with a home</span>
          </div>
          <div class="stat">
            <span class="stat-number">15</span>
            <span class="stat-label">Years of experience</span>
          </div>
          <div class="stat">
            <span class="stat-number">100%</span>
            <span class="stat-label">Transparency</span>
          </div>
        </div>
      </div>
      <div class="hero-image">
        <div class="floating-card card-1">
          <i class="fas fa-key"></i>
          <span>Your key to the future</span>
        </div>
        <div class="floating-card card-2">
          <i class="fas fa-chart-line"></i>
          <span>Smart savings</span>
        </div>
        <div class="floating-card card-3">
          <i class="fas fa-users"></i>
          <span>United community</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Cooperative Section -->
  <section id="cooperativa" class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Housing Cooperative</h2>
        <p class="section-subtitle">The safest path to your own home</p>
      </div>
      <div class="features-grid">
        <div class="feature-card" data-aos="fade-up">
          <div class="feature-icon">
            <i class="fas fa-piggy-bank"></i>
          </div>
          <h3>Savings System</h3>
          <p>Save systematically with affordable installments and get your home without large upfront capital.</p>
        </div>
        <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
          <div class="feature-icon">
            <i class="fas fa-handshake"></i>
          </div>
          <h3>Mutual Aid</h3>
          <p>We work together in construction, reducing costs and strengthening community ties.</p>
        </div>
        <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
          <div class="feature-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h3>Collective Ownership</h3>
          <p>A collective ownership system that guarantees housing permanence and accessibility.</p>
        </div>
        <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
          <div class="feature-icon">
            <i class="fas fa-map-marked-alt"></i>
          </div>
          <h3>Premium Locations</h3>
          <p>Strategically located lots in Montevideo and across the country with all services.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Software Section -->
  <section id="software" class="section section-dark">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Nexora Management Software</h2>
        <p class="section-subtitle">Advanced technology to manage your cooperative</p>
      </div>
      <div class="software-content">
        <div class="software-features">
          <div class="software-feature" data-aos="fade-right">
            <div class="feature-icon">
              <i class="fas fa-users-cog"></i>
            </div>
            <div class="feature-content">
              <h3>Member Management</h3>
              <p>Manage complete information for all members, check and upload payments. Enhanced digitalization for easier management.</p>
            </div>
          </div>
          <div class="software-feature" data-aos="fade-right" data-aos-delay="100">
            <div class="feature-icon">
              <i class="fa-solid fa-calculator fa-sm"></i>
            </div>
            <div class="feature-content">
              <h3>Financial Control</h3>
              <p>Detailed tracking of income, expenses, installments, and personal records in real time.</p>
            </div>
          </div>
          <div class="software-feature" data-aos="fade-right" data-aos-delay="200">
            <div class="feature-icon">
              <i class="fas fa-chart-pie"></i>
            </div>
            <div class="feature-content">
              <h3>Smart Reports</h3>
              <p>Generate automatic reports for assemblies, members records and reports for the buildings of the cooperative.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="testimonios" class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">What Our Members Say</h2>
        <p class="section-subtitle">Real stories of families who achieved their home</p>
      </div>
      <div class="testimonials-grid">
        <div class="testimonial-card" data-aos="fade-up">
          <div class="testimonial-content">
            <div class="stars">
              <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
              <i class="fas fa-star"></i><i class="fas fa-star"></i>
            </div>
            <p>"After 5 years of saving, we finally have our home. The process was transparent and the software let us see everything in real time."</p>
          </div>
          <div class="testimonial-author">
            <div class="author-avatar">
              <i class="fas fa-user"></i>
            </div>
            <div class="author-info">
              <h4>María González</h4>
              <span>Member since 2018</span>
            </div>
          </div>
        </div>
        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
          <div class="testimonial-content">
            <div class="stars">
              <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
            </div>
            <p>"The mutual aid experience was incredible. We didn't just build houses, we built a community. The software made all the management easy."</p>
          </div>
          <div class="testimonial-author">
            <div class="author-avatar">
              <i class="fas fa-user"></i>
            </div>
            <div class="author-info">
              <h4>Joaquin Rodríguez</h4>
              <span>Member since 2019</span>
            </div>
          </div>
        </div>
        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
          <div class="testimonial-content">
            <div class="stars">
              <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
            </div>
            <p>"As the cooperative administrator, this software changed our lives. Everything automated and transparent for all members."</p>
          </div>
          <div class="testimonial-author">
            <div class="author-avatar">
              <i class="fas fa-user"></i>
            </div>
            <div class="author-info">
              <h4>Ana Martínez</h4>
              <span>Administrator</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="contacto" class="section section-dark">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Ready for your own home?</h2>
        <p class="section-subtitle">Contact us and start your journey to your own home</p>
      </div>
      <div class="contact-grid">
      <div class="contact-content">
           <section id="requirements" class="section">
           <div class="container">
           <div class="section-header">
      <h2 class="section-title">Requirements to Join</h2>
      <p class="section-subtitle">These are the basic requirements to become a member of the cooperative:</p>
    </div>
    <ul class="requirements-list">
      <li>Be of legal age (18 years or older).</li>
      <li>Be a legal resident of Uruguay.</li>
      <li>Have a minimum monthly income of 30 Indexed Units.</li>
      <li>Commit to the savings and mutual aid system.</li>
      <li>Complete the application and provide the required documents.</li>
    </ul>
  </div>
</section>
      </div>
       
        <form class="contact-form" data-aos="fade-left" id="contact-form" name="contact-form" method="post" action="./back/sumbitPetition.php">
  <div class="form-group">
    <input type="text" id="name" name="name" placeholder="First Name" required>
  </div>
  <div class="form-group">
    <input type="text" id="surname" name="surname" placeholder="Last Name" required>
  </div>
  <div class="form-group">
    <input type="email" id="email" name="email" placeholder="Your Email" required>
  </div>
  <div class="form-group">
    <input type="date" id="birthdate" name="birthdate" placeholder="Date of Birth" required>
  </div>
  <div class="form-group">
    <input type="tel" id="phone" name="phone" placeholder="Your Phone">
  </div>
  <div class="form-group">
    <input type="number" id="income" name="income" placeholder="Your Monthly Income" required>
  </div>
  <div class="form-group">
    <input type="text" id="CI" name="CI" placeholder="Your ID Number" required>
  </div>
  <div class="form-group">
    <input type="text" id="address" name="address" placeholder="Your Address" required>
  </div>
  <div class="form-group">
    <input type="text" id="occupation" name="occupation" placeholder="Your Occupation" required>
  </div>
  <div class="form-group">
    <select id="lawful_resident" name="lawful_resident" required>
      <option value="" disabled selected>Are you a legal resident?</option>
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select>
  </div>
  <div class="form-group">
    <select id="marital_status" title="marital_status" name="marital_status" required>
      <option value="" disabled selected>Marital Status</option>
      <option value="single">Single</option>
      <option value="married">Married</option>
      <option value="divorced">Divorced</option>
      <option value="widowed">Widowed</option>
    </select>
  </div>
  <div class="form-group">
    <textarea id="message" name="message" placeholder="Tell us more about your interest..." rows="4"></textarea>
  </div>
  <button type="submit" class="btn btn-primary btn-full" id="form-submit">
    <i class="fas fa-paper-plane"></i>
    Submit Request
  </button>
  <?php
   if (isset($_SESSION['error'])) {
     echo '<p class="error" style="color: red;"> There was an error with your request</p>';
     unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<p class="success" style="color: green;"> Your request was sent successfully</p>';
    unset($_SESSION['success']);
}
                ?>

</form>
   
            </div>
        </div>
    </section>
    <section id="about">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">About Us</h2>
      <p class="section-subtitle">Mutual Aid Housing Cooperative</p>
    </div>
    <div class="about-content">
      <div class="about-text" data-aos="fade-right" data-aos-delay="200">
        <h3>Mutual Aid Housing Cooperative in Uruguay</h3>
        <p>
          At Covinova, our mission is to provide decent housing for those who need it most.
          We are committed to mutual aid, solidarity and transparency.
          Our savings and loan system allows us to offer affordable, high-quality housing to our members.
        </p>
        <p>
          Our goal is to strengthen the community and support people who want to improve their quality of life.
          That’s why we offer a sustainable and responsible housing model tailored to each person’s needs and possibilities.
        </p>
      </div>
       <div class="contact-info">
          <div class="contact-item" data-aos="fade-right">
            <div class="contact-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="contact-details">
              <h3>Location</h3>
              <p>Av. 18 de Julio 1234<br>Montevideo, Uruguay</p>
            </div>
          </div>
          <div class="contact-item" data-aos="fade-right" data-aos-delay="100">
            <div class="contact-icon">
              <i class="fas fa-phone"></i>
            </div>
            <div class="contact-details">
              <h3>Phone</h3>
              <p>+598 93 395 215<br>+598 99 999 999</p>
            </div>
          </div>
          <div class="contact-item" data-aos="fade-right" data-aos-delay="200">
            <div class="contact-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="contact-details">
              <h3>Email</h3>
              <p>nexorahlp@gmail.com</p>
            </div>
          </div>
        </div>
      <div class="about-image" data-aos="fade-left" data-aos-delay="200">
        <span class="expand-icon"><i class="fa-solid fa-expand"></i></span>
        <img src="./assets/img/CooperativaFoto.jpg" alt="Image of the cooperative">
      </div>
    </div>
  </div>
</section>


    <footer class="footer">
  <div class="container">
    <div class="footer-content">
      <div class="footer-section">
        <div class="footer-logo">
          <i class="fas fa-home"></i>
          <span>CoopViva</span>
        </div>
        <p>Building homes, strengthening communities. Your trusted housing cooperative in Uruguay.</p>
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="footer-section">
        <h3>Services</h3>
        <ul>
          <li><a href="#cooperativa">Housing Cooperative</a></li>
          <li><a href="#">Legal Advice</a></li>
          <li><a href="#">Project Management</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Information</h3>
        <ul>
          <li><a href="#">About Us</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Terms and Conditions</a></li>
          <li><a href="#">Privacy Policy</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Contact</h3>
        <div class="footer-contact">
          <p><i class="fas fa-map-marker-alt"></i> Montevideo, Uruguay</p>
          <p><i class="fas fa-phone"></i> +598 93 395215</p>
          <p><i class="fas fa-envelope"></i> covinova@gmail.com</p>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 Nexora Uruguay. All rights reserved.</p>
    </div>
  </div>
</footer>
    <script src="./assets/js/script.js"></script>
<div id="lightbox" class="lightbox">
  <span class="lightbox-close">&times;</span>
  <img src="./assets/img/CooperativaFoto.jpg" alt="Enlarged cooperative image">
</div>
</body>
</html>