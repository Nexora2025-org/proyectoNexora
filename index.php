<?php  
session_start(); 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covinova - Tu Hogar, Tu Futuro</title>
    <link rel="stylesheet" href="./assets/css/landingstyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="icon" href="./assets/img/logo.png" type="image/x-icon" class="favicon">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <div class="nav-fuscvam">
                <img src="./assets/img/FUSCVAMicon.png" alt="FUSCVAM icono" class="fuscvam-icon">
                <img src="./assets/img/logoCooperativa.png" alt="Cooperativa icono" class="cooperativa-icon">
            </div>
            <ul class="nav-menu" id="nav-menu">
                <li><a href="#inicio" class="nav-link">Inicio</a></li>
                <li><a href="#cooperativa" class="nav-link">Cooperativa</a></li>
                <li><a href="#software" class="nav-link">Nuestro Software</a></li>
                <li><a href="#testimonios" class="nav-link">Testimonios</a></li>
                <li><a href="#contacto" class="nav-link">Solicitud de ingreso</a></li>
                <li>
                    <div class="language-label">
                        <i class="fas fa-globe"></i>
                        <span>Idioma:</span>
                    </div>
                    <select class="language-selector" id="language-selector" >
                        <option value="es" selected>Español</option>
                        <option value="en">English</option>
                    </select>
                </li>
                <!-- Link a la App web de la cooperativa -->
                <li><a href="./front/App/login.html" class="nav-link">Iniciar Sesión</a></li>
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
                    Tu <span class="gradient-text">Hogar Propio</span><br>
                    Es Posible en Uruguay
                </h1>

                <p class="hero-description">
                    Únete a nuestra cooperativa de vivienda y accede a tu casa propia con nuestro sistema de ahorro y
                    préstamo.
                    Además, gestiona todo con nuestro software especializado.
                </p>
                <div class="hero-buttons">
                    <button class="btn btn-primary" onclick="scrollToSection('cooperativa')">
                        <i class="fas fa-home"></i>
                        Conocer Cooperativa
                    </button>
                    <button class="btn btn-secondary" onclick="scrollToSection('software')">
                        <i class="fas fa-laptop"></i>
                        Acerca de nuestro Software
                    </button>
                </div>
                <div class="hero-stats">
                    <div class="stat">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Familias con hogar</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">5</span>
                        <span class="stat-label">Años de experiencia</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">100%</span>
                        <span class="stat-label">Transparencia</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="floating-card card-1">
                    <i class="fas fa-key"></i>
                    <span>Clave para el futuro</span>
                </div>
                <div class="floating-card card-2">
                    <i class="fas fa-chart-line"></i>
                    <span>Registros digitales</span>
                </div>
                <div class="floating-card card-3">
                    <i class="fas fa-users"></i>
                    <span>Comunidad unida</span>
                </div>
            </div>
        </div>
    </section>

    <!--Sección Información Cooperativa -->
    <section id="cooperativa" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Cooperativa de Vivienda</h2>
                <p class="section-subtitle">El camino más seguro hacia tu hogar propio</p>
            </div>
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up">
                    <div class="feature-icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <h3>Sistema de Ahorro</h3>
                    <p>Ahorra de forma sistemática con cuotas accesibles y obtén tu vivienda sin necesidad de grandes
                        capitales iniciales.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Ayuda Mutua</h3>
                    <p>Trabajamos juntos en la construcción, reduciendo costos y fortaleciendo los lazos comunitarios.
                    </p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Propiedad Colectiva</h3>
                    <p>Sistema de propiedad colectiva que garantiza la permanencia y accesibilidad de la vivienda.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3>Ubicaciones Premium</h3>
                    <p>Terrenos estratégicamente ubicados en Montevideo y el interior del país con todos los servicios.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!--Seccion Software -->
    <section id="software" class="section section-dark">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Software de Gestión</h2>
                <p class="section-subtitle">Contamos con tecnología avanzada para ayudarte a administrar tu vivienda en
                    nuestra cooperativa</p>
            </div>
            <div class="software-content">
                <div class="software-features">
                    <div class="software-feature" data-aos="fade-right">
                        <div class="feature-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="feature-content">
                            <h3>Gestión de Socios</h3>
                            <p>Administra información completa de todos los cooperativistas, comprobación y
                                digitalización de pagos, para facilitar la gestión.</p>
                        </div>
                    </div>
                    <div class="software-feature" data-aos="fade-right" data-aos-delay="100">
                        <div class="feature-icon">
                            <i class="fa-solid fa-calculator fa-sm"></i>
                        </div>
                        <div class="feature-content">
                            <h3>Control Financiero</h3>
                            <p>Seguimiento detallado de ingresos, egresos, cuotas y registros personales en tiempo real.
                            </p>
                        </div>
                    </div>
                    <div class="software-feature" data-aos="fade-right" data-aos-delay="200">
                        <div class="feature-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="feature-content">
                            <h3>Reportes Inteligentes</h3>
                            <p>Genera reportes automáticos para asambleas, socios y reportes de las obras de la
                                cooperativa.</p>
                        </div>
                    </div>
                    <div class="software-feature" data-aos="fade-right" data-aos-delay="300">
                        <div class="feature-icon">
                            <i class="fas fa-cloud"></i>
                        </div>
                        <div class="feature-content">
                            <h3>Acceso en la Nube</h3>
                            <p>Accede a tu información desde cualquier dispositivo, de forma segura y en cualquier
                                momento.</p>
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
                <h2 class="section-title">Lo que dicen nuestros cooperativistas</h2>
                <p class="section-subtitle">Historias reales de familias que lograron su hogar</p>
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
                        <p>"LLevo 3 meses dentro de covinova, me encanta. Todo en un solo lugar para administrar, un ambiente cooperativo y transparente. Una experiencia increíble."</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h4>María González</h4>
                            <span>Cooperativista desde 2018</span>
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

                        </div>
                        <p>"La experiencia de ayuda mutua fue increíble. No solo construimos casas, construimos una
                            comunidad. El software facilitó toda la gestión."</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h4>Joaquin Rodríguez</h4>
                            <span>Cooperativista desde 2019</span>
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
                        <p>"Como administrador de la cooperativa, el software de Nexora nos cambió la vida. Todo
                            automatizado y transparente para todos los socios."</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h4>Ana Martínez</h4>
                            <span>Administradora</span>
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
                <h2 class="section-title">¿Listo para tu hogar propio?</h2>
                <p class="section-subtitle">Agenda una cita y comienza tu camino hacia tu hogar propio</p>
            </div>
            <div class="contact-grid">
                <div class="contact-content">
                   
                    <section id="requirements" class="section" data-aos="fade-left">
                        <div class="container">
                            <div class="section-header">
                                <h2 class="section-title">Requisitos para Ingresar</h2>
                                <p class="section-subtitle">Estos son los requisitos básicos para ser parte de la
                                    cooperativa:</p>
                            </div>
                            <ul class="requirements-list">
                                <li>Ser mayor de edad (18 años o más).</li>
                                <li>Ser residente legal en Uruguay.</li>
                                <li>Contar con un ingreso mensual mínimo de 30 Unidades Indexadas.</li>
                                <li>Comprometerse con el sistema de ahorro y ayuda mutua.</li>
                                <li>Completar la solicitud y proporcionar documentos requeridos.</li>
                            </ul>
                        </div>
                    </section>
                </div> 
                <form class="contact-form"  id="contact-form" name="contact-form" action="./back/apiUsers.php" method="POST">
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Primer nombre" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="surname" name="surname" placeholder="Primer apellido" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Tu email" required>
                    </div>
                    <div class="form-group">
                        <input type="date" id="birthdate" name="birthdate" placeholder="Fecha de nac." required >
                    </div>
                    <div class="form-group">
                        <input type="tel" id="phone" name="phone" pattern="\d{6,9}"  placeholder="Tu teléfono de contacto: 095123456" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="CI" name="CI" pattern="\d{6,8}" maxlength="8" placeholder="Debe contener solo números" required>
                    </div>
                    <div class="form-group">
                        <select name="appointment" id="appointment" required disable></select>

                    </div>
                    <button type="submit" class="btn btn-primary btn-full" id="form-submit">
                        <i class="fas fa-paper-plane"></i>
                        Solicitar ingreso
                    </button>
                     <?php
               if (isset($_SESSION['error'])) {
     echo '<p class="error" style="color: red;"> Hubo un error con tu solicitud</p>';
     unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<p class="success" style="color: green;"> Tu solicitud fue enviada con exito</p>';
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
                <h2 class="section-title">Sobre Nosotros</h2>
                <p class="section-subtitle">Cooperativa de Vivienda de Ayuda Mutua</p>
            </div>
            <div class="about-content">
                <div class="about-text" data-aos="fade-right" data-aos-delay="200">
                    <h3>Cooperativa de viviendas de ayuda mutua en Uruguay</h3>
                    <p>
                        En Covinova, nuestra misión es brindar una vivienda digna a las personas que la necesitan. Para
                        lograr esto, estamos comprometidos con la ayuda mutua, la solidaridad y la transparencia.
                        Nuestro sistema de ahorro y préstamo nos permite brindar viviendas asequibles y de calidad a
                        nuestros socios.
                    </p>
                    <p>
                        Nuestro objetivo es fortalecer la comunidad y apoyar a las personas que quieren mejorar su
                        calidad de vida. Por eso, ofrecemos un modelo de vivienda sostenible y responsable, que se
                        ajusta a las necesidades y posibilidades de cada persona.
                    </p>
                </div>
                <div class="contact-info">
                        <div class="contact-item" data-aos="fade-right">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Ubicación</h3>
                                <p>Av. 18 de Julio 1234<br>Montevideo, Uruguay</p>
                            </div>
                        </div>
                        <div class="contact-item" data-aos="fade-right" data-aos-delay="100">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Teléfono</h3>
                                <p>+598 93 395 215</p>
                            </div>
                        </div>
                        <div class="contact-item" data-aos="fade-right" data-aos-delay="200">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Email</h3>
                                <p>covinovahlp@gmail.com</p>
                            </div>
                        </div>
                    </div>
                <div class="about-image" data-aos="fade-left" data-aos-delay="200">
                    <span class="expand-icon"> <i class="fa-solid fa-expand"></i></span>

                    <img src="./assets/img/CooperativaFoto.jpg" alt="Imagen de la cooperativa">
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
                    <p>Construyendo hogares, fortaleciendo comunidades. Tu cooperativa de vivienda de confianza en
                        Uruguay.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Información</h3>
                    <ul>
                        <li><a href="#sobrenosotros">Sobre Nosotros</a></li>
                        <li><a href="#preguntas">Preguntas Frecuentes</a></li>
                        <li><a href="#terminos">Términos y Condiciones</a></li>
                        <li><a href="#privacidad">Política de Privacidad</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contacto</h3>
                    <div class="footer-contact">
                        <p><i class="fas fa-map-marker-alt"></i> Montevideo, Uruguay</p>
                        <p><i class="fas fa-phone"></i> +598 93 395215</p>
                        <p><i class="fas fa-envelope"></i> covinovahlp@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Covinova Uruguay. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="./assets/js/script.js"></script>
    <div id="lightbox" class="lightbox">
        <span class="lightbox-close">&times;</span>
        <img src="./assets/img/CooperativaFoto.jpg" alt="Imagen ampliada de la cooperativa">
    </div>
    <script src="./assets/js/appoinments.js"></script>
</body>

</html>