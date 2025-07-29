<?php
session_start();

// Define allowed languages
$allowed_languages = array('es', 'en');

// Determine the selected or default language
// If a language is selected via URL, save it in the session
if (isset($_GET['lang']) && in_array($_GET['lang'], $allowed_languages)) {
  $_SESSION['lang'] = $_GET['lang']; // Save the selected language in the session
} elseif (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = 'es'; // Default language
}

// Load the corresponding language file
$lang_file = $_SESSION['lang'] . '.php';
if (file_exists("langs/" . $lang_file)) {
  include("langs/" . $lang_file); // Include the language file
} else {
  // Fallback to default language if file not found
  include("langs/es.php");
  error_log("Error: Language file not found for " . $_SESSION['lang'] . ". Falling back to Spanish.");
}

// Function to get the translated string
function traducir($key) {
  global $lang; // Ensure the $lang variable is available
  return isset($lang[$key]) ? $lang[$key] : $key; // Return the key if translation is not found
}
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo traducir('page_title'); ?></title>
  <link rel="stylesheet" href="./assets/css/landingstyles.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="icon" href="./assets/img/logo.png" type="image/x-icon" class="favicon">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar" id="navbar">
      <div class="nav-container">
          <div class="nav-fuscvam">
              <img src="./assets/img/FUSCVAMicon.png" alt="<?php echo traducir('fuscvam_icon_alt'); ?>" class="fuscvam-icon">
              <img src="./assets/img/logoCooperativa.png" alt="<?php echo traducir('cooperative_icon_alt'); ?>" class="cooperativa-icon">
          </div>
          <ul class="nav-menu" id="nav-menu">
              <li><a href="#inicio" class="nav-link"><?php echo traducir('nav_home'); ?></a></li>
              <li><a href="#cooperativa" class="nav-link"><?php echo traducir('nav_cooperative'); ?></a></li>
              <li><a href="#software" class="nav-link"><?php echo traducir('nav_software'); ?></a></li>
              <li><a href="#testimonios" class="nav-link"><?php echo traducir('nav_testimonials'); ?></a></li>
              <li><a href="#contacto" class="nav-link"><?php echo traducir('nav_application'); ?></a></li>
              <li>
                  <div class="language-label">
                      <i class="fas fa-globe"></i>
                      <span><?php echo traducir('language_label'); ?></span>
                  </div>
                  <select class="language-selector" id="language-selector" onchange="window.location.href = this.value;">
                      <option value="?lang=es" <?php echo ($_SESSION['lang'] == 'es') ? 'selected' : ''; ?>><?php echo traducir('lang_spanish'); ?></option>
                      <option value="?lang=en" <?php echo ($_SESSION['lang'] == 'en') ? 'selected' : ''; ?>><?php echo traducir('lang_english'); ?></option>
                  </select>
              </li>
              <!-- Link a la App web de la cooperativa -->
              <li><a href="../App/login.html" class="nav-link"><?php echo traducir('nav_login'); ?></a></li>
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
                  <?php echo traducir('hero_title_part1'); ?><span class="gradient-text"><?php echo traducir('hero_title_gradient'); ?></span><br>
                  <?php echo traducir('hero_title_part2'); ?>
              </h1>
              <p class="hero-description">
                  <?php echo traducir('hero_description'); ?>
              </p>
              <div class="hero-buttons">
                  <button class="btn btn-primary" onclick="scrollToSection('cooperativa')">
                      <i class="fas fa-home"></i>
                      <?php echo traducir('btn_learn_cooperative'); ?>
                  </button>
                  <button class="btn btn-secondary" onclick="scrollToSection('software')">
                      <i class="fas fa-laptop"></i>
                      <?php echo traducir('btn_about_software'); ?>
                  </button>
              </div>
              <div class="hero-stats">
                  <div class="stat">
                      <span class="stat-number">500+</span>
                      <span class="stat-label"><?php echo traducir('stat_families'); ?></span>
                  </div>
                  <div class="stat">
                      <span class="stat-number">5</span>
                      <span class="stat-label"><?php echo traducir('stat_experience'); ?></span>
                  </div>
                  <div class="stat">
                      <span class="stat-number">100%</span>
                      <span class="stat-label"><?php echo traducir('stat_transparency'); ?></span>
                  </div>
              </div>
          </div>
          <div class="hero-image">
              <div class="floating-card card-1">
                  <i class="fas fa-key"></i>
                  <span><?php echo traducir('card_key_future'); ?></span>
              </div>
              <div class="floating-card card-2">
                  <i class="fas fa-chart-line"></i>
                  <span><?php echo traducir('card_digital_records'); ?></span>
              </div>
              <div class="floating-card card-3">
                  <i class="fas fa-users"></i>
                  <span><?php echo traducir('card_united_community'); ?></span>
              </div>
          </div>
      </div>
  </section>
  <!--Sección Información Cooperativa -->
  <section id="cooperativa" class="section">
      <div class="container">
          <div class="section-header">
              <h2 class="section-title"><?php echo traducir('cooperative_section_title'); ?></h2>
              <p class="section-subtitle"><?php echo traducir('cooperative_section_subtitle'); ?></p>
          </div>
          <div class="features-grid">
              <div class="feature-card" data-aos="fade-up">
                  <div class="feature-icon">
                      <i class="fas fa-piggy-bank"></i>
                  </div>
                  <h3><?php echo traducir('feature_savings_title'); ?></h3>
                  <p><?php echo traducir('feature_savings_description'); ?></p>
              </div>
              <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                  <div class="feature-icon">
                      <i class="fas fa-handshake"></i>
                  </div>
                  <h3><?php echo traducir('feature_mutual_aid_title'); ?></h3>
                  <p><?php echo traducir('feature_mutual_aid_description'); ?></p>
              </div>
              <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                  <div class="feature-icon">
                      <i class="fas fa-shield-alt"></i>
                  </div>
                  <h3><?php echo traducir('feature_collective_ownership_title'); ?></h3>
                  <p><?php echo traducir('feature_collective_ownership_description'); ?></p>
              </div>
              <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                  <div class="feature-icon">
                      <i class="fas fa-map-marked-alt"></i>
                  </div>
                  <h3><?php echo traducir('feature_premium_locations_title'); ?></h3>
                  <p><?php echo traducir('feature_premium_locations_description'); ?></p>
              </div>
          </div>
      </div>
  </section>
  <!--Seccion Software -->
  <section id="software" class="section section-dark">
      <div class="container">
          <div class="section-header">
              <h2 class="section-title"><?php echo traducir('software_section_title'); ?></h2>
              <p class="section-subtitle"><?php echo traducir('software_section_subtitle'); ?></p>
          </div>
          <div class="software-content">
              <div class="software-features">
                  <div class="software-feature" data-aos="fade-right">
                      <div class="feature-icon">
                          <i class="fas fa-users-cog"></i>
                      </div>
                      <div class="feature-content">
                          <h3><?php echo traducir('software_member_management_title'); ?></h3>
                          <p><?php echo traducir('software_member_management_description'); ?></p>
                      </div>
                  </div>
                  <div class="software-feature" data-aos="fade-right" data-aos-delay="100">
                      <div class="feature-icon">
                          <i class="fa-solid fa-calculator fa-sm"></i>
                      </div>
                      <div class="feature-content">
                          <h3><?php echo traducir('software_financial_control_title'); ?></h3>
                          <p><?php echo traducir('software_financial_control_description'); ?></p>
                      </div>
                  </div>
                  <div class="software-feature" data-aos="fade-right" data-aos-delay="200">
                      <div class="feature-icon">
                          <i class="fas fa-chart-pie"></i>
                      </div>
                      <div class="feature-content">
                          <h3><?php echo traducir('software_smart_reports_title'); ?></h3>
                          <p><?php echo traducir('software_smart_reports_description'); ?></p>
                      </div>
                  </div>
                  <div class="software-feature" data-aos="fade-right" data-aos-delay="300">
                      <div class="feature-icon">
                          <i class="fas fa-cloud"></i>
                      </div>
                      <div class="feature-content">
                          <h3><?php echo traducir('software_cloud_access_title'); ?></h3>
                          <p><?php echo traducir('software_cloud_access_description'); ?></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Sección Testimonios -->
  <section id="testimonios" class="section">
      <div class="container">
          <div class="section-header">
              <h2 class="section-title"><?php echo traducir('testimonials_section_title'); ?></h2>
              <p class="section-subtitle"><?php echo traducir('testimonials_section_subtitle'); ?></p>
          </div>
          <div class="testimonials-grid">
              <div class="testimonial-card" data-aos="fade-up">
                  <div class="testimonial-content">
                      <div class="stars">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                      </div>
                      <p><?php echo traducir('testimonial_1_text'); ?></p>
                  </div>
                  <div class="testimonial-author">
                      <div class="author-avatar">
                          <i class="fas fa-user"></i>
                      </div>
                      <div class="author-info">
                          <h4><?php echo traducir('testimonial_1_author'); ?></h4>
                          <span><?php echo traducir('testimonial_1_role'); ?></span>
                      </div>
                  </div>
              </div>
              <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                  <div class="testimonial-content">
                      <div class="stars">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                      </div>
                      <p><?php echo traducir('testimonial_2_text'); ?></p>
                  </div>
                  <div class="testimonial-author">
                      <div class="author-avatar">
                          <i class="fas fa-user"></i>
                      </div>
                      <div class="author-info">
                          <h4><?php echo traducir('testimonial_2_author'); ?></h4>
                          <span><?php echo traducir('testimonial_2_role'); ?></span>
                      </div>
                  </div>
              </div>
              <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                  <div class="testimonial-content">
                      <div class="stars">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                      </div>
                      <p><?php echo traducir('testimonial_3_text'); ?></p>
                  </div>
                  <div class="testimonial-author">
                      <div class="author-avatar">
                          <i class="fas fa-user"></i>
                      </div>
                      <div class="author-info">
                          <h4><?php echo traducir('testimonial_3_author'); ?></h4>
                          <span><?php echo traducir('testimonial_3_role'); ?></span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!--Sección Contacto -->
  <section id="contact" class="section section-dark">
      <div class="container">
          <div class="section-header">
              <h2 class="section-title"><?php echo traducir('contact_section_title'); ?></h2>
              <p class="section-subtitle"><?php echo traducir('contact_section_subtitle'); ?></p>
          </div>
          <div class="contact-grid">
              <div class="contact-content">
                  <section id="requirements" class="section" data-aos="fade-left">
                      <div class="container">
                          <div class="section-header">
                              <h2 class="section-title"><?php echo traducir('requirements_title'); ?></h2>
                              <p class="section-subtitle"><?php echo traducir('requirements_subtitle'); ?></p>
                          </div>
                          <ul class="requirements-list">
                              <li><?php echo traducir('req_1'); ?></li>
                              <li><?php echo traducir('req_2'); ?></li>
                              <li><?php echo traducir('req_3'); ?></li>
                              <li><?php echo traducir('req_4'); ?></li>
                              <li><?php echo traducir('req_5'); ?></li>
                          </ul>
                      </div>
                  </section>
              </div>
              <form class="contact-form" id="contact-form" name="contact-form" method="POST">
                  <div class="form-group">
                      <input type="text" id="name" name="name" placeholder="<?php echo traducir('form_placeholder_first_name'); ?>" required>
                  </div>
                  <div class="form-group">
                      <input type="text" id="surname" name="surname" placeholder="<?php echo traducir('form_placeholder_last_name'); ?>" required>
                  </div>
                  <div class="form-group">
                      <input type="email" id="email" name="email" placeholder="<?php echo traducir('form_placeholder_email'); ?>" required>
                  </div>
                  <div class="form-group">
                      <input type="date" id="birthdate" name="birthdate" placeholder="<?php echo traducir('form_placeholder_dob'); ?>" required >
                  </div>
                  <div class="form-group">
                      <input type="tel" id="phone" name="phone" pattern="\d{6,9}" placeholder="<?php echo traducir('form_placeholder_phone'); ?>" maxlength="9" required>
                  </div>
                  <div class="form-group">
                      <input type="text" id="CI" name="CI" pattern="\d{6,8}" maxlength="8" placeholder="<?php echo traducir('form_placeholder_id'); ?>" required>
                  </div>
                  <div class="form-group">
                      <select name="appointment" id="appointment" required disable></select>
                  </div>
                  <button type="submit" class="btn btn-primary btn-full" id="form-submit">
                      <i class="fas fa-paper-plane"></i>
                      <?php echo traducir('form_submit_button'); ?>
                  </button>
                  <?php
                  if (isset($_SESSION['error'])) {
                      echo '<p class="error" style="color: red;">' . traducir('form_error_message') . '</p>';
                      unset($_SESSION['error']);
                  }
                  if (isset($_SESSION['success'])) {
                      echo '<p class="success" style="color: green;">' . traducir('form_success_message') . '</p>';
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
              <h2 class="section-title"><?php echo traducir('about_us_title'); ?></h2>
              <p class="section-subtitle"><?php echo traducir('about_us_subtitle'); ?></p>
          </div>
          <div class="about-content">
              <div class="about-text" data-aos="fade-right" data-aos-delay="200">
                  <h3><?php echo traducir('about_us_heading'); ?></h3>
                  <p>
                      <?php echo traducir('about_us_paragraph_1'); ?>
                  </p>
                  <p>
                      <?php echo traducir('about_us_paragraph_2'); ?>
                  </p>
              </div>
              <div class="contact-info">
                  <div class="contact-item" data-aos="fade-right">
                      <div class="contact-icon">
                          <i class="fas fa-map-marker-alt"></i>
                      </div>
                      <div class="contact-details">
                          <h3><?php echo traducir('contact_location_title'); ?></h3>
                          <p><?php echo traducir('contact_location_address'); ?></p>
                      </div>
                  </div>
                  <div class="contact-item" data-aos="fade-right" data-aos-delay="100">
                      <div class="contact-icon">
                          <i class="fas fa-phone"></i>
                      </div>
                      <div class="contact-details">
                          <h3><?php echo traducir('contact_phone_title'); ?></h3>
                          <p><?php echo traducir('contact_phone_number'); ?></p>
                      </div>
                  </div>
                  <div class="contact-item" data-aos="fade-right" data-aos-delay="200">
                      <div class="contact-icon">
                          <i class="fas fa-envelope"></i>
                      </div>
                      <div class="contact-details">
                          <h3><?php echo traducir('contact_email_title'); ?></h3>
                          <p><?php echo traducir('contact_email_address'); ?></p>
                      </div>
                  </div>
              </div>
              <div class="about-image" data-aos="fade-left" data-aos-delay="200">
                  <span class="expand-icon"> <i class="fa-solid fa-expand"></i></span>
                  <img src="./assets/img/CooperativaFoto.jpg" alt="<?php echo traducir('cooperative_image_alt'); ?>">
              </div>
          </div>
      </div>
  </section>
  <!-- Footer -->
  <footer class="footer">
      <div class="container">
          <div class="footer-content">
              <div class="footer-section">
                  <div class="footer-logo">
                      <i class="fas fa-home"></i>
                      <span>Covinova</span>
                  </div>
                  <p><?php echo traducir('footer_description'); ?></p>
                  <div class="social-links">
                      <a href="#"><i class="fab fa-facebook"></i></a>
                      <a href="#"><i class="fab fa-instagram"></i></a>
                      <a href="#"><i class="fab fa-linkedin"></i></a>
                      <a href="#"><i class="fab fa-youtube"></i></a>
                  </div>
              </div>
              <div class="footer-section">
                  <h3><?php echo traducir('footer_info_title'); ?></h3>
                  <ul>
                      <li><a href="#sobrenosotros"><?php echo traducir('footer_link_about_us'); ?></a></li>
                      <li><a href="#preguntas"><?php echo traducir('footer_link_faq'); ?></a></li>
                      <li><a href="#terminos"><?php echo traducir('footer_link_terms'); ?></a></li>
                      <li><a href="#privacidad"><?php echo traducir('footer_link_privacy'); ?></a></li>
                  </ul>
              </div>
              <div class="footer-section">
                  <h3><?php echo traducir('footer_contact_title'); ?></h3>
                  <div class="footer-contact">
                      <p><i class="fas fa-map-marker-alt"></i> <?php echo traducir('footer_contact_location'); ?></p>
                      <p><i class="fas fa-phone"></i> <?php echo traducir('footer_contact_phone'); ?></p>
                      <p><i class="fas fa-envelope"></i> <?php echo traducir('footer_contact_email'); ?></p>
                  </div>
              </div>
          </div>
          <div class="footer-bottom">
              <p><?php echo traducir('footer_copyright'); ?></p>
          </div>
      </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./assets/js/script.js"></script>
  <div id="lightbox" class="lightbox">
      <span class="lightbox-close">&times;</span>
      <img src="./assets/img/CooperativaFoto.jpg" alt="<?php echo traducir('cooperative_image_expanded_alt'); ?>">
  </div>
  <script src="./assets/js/appoinments.js"></script>
</body>
</html>
