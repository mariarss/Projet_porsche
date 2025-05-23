<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Découvrez les voitures Porsche, synonymes de luxe, performance et innovation. Explorez nos modèles emblématiques.">
    <title>Porsche - Expérience Premium</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --porsche-red: #D5001C;
            --porsche-dark: #1A1A1A;
            --porsche-light: #F0F0F0;
            --transition-slow: 0.5s ease;
            --transition-fast: 0.3s ease;
        }

        [data-theme="dark"] {
            --porsche-light: #1A1A1A;
            --porsche-dark: #F0F0F0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            color: var(--porsche-dark);
            background-color: var(--porsche-light);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Loader */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--porsche-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .loader::after {
            content: '';
            width: 50px;
            height: 50px;
            border: 5px solid var(--porsche-red);
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            transition: background-color 0.4s, padding 0.4s;
        }

        .navbar.scrolled {
            background-color: rgba(0, 0, 0, 0.9);
            padding: 10px 50px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        .navbar-logo {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            color: var(--porsche-light);
            text-decoration: none;
        }

        .navbar-logo span {
            color: var(--porsche-red);
        }

        .nav-menu {
            display: flex;
            gap: 20px;
        }

        .nav-menu a {
            color: var(--porsche-light);
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            transition: color var(--transition-fast);
        }

        .nav-menu a:hover {
            color: var(--porsche-red);
        }

        .hamburger {
            display: none;
            font-size: 24px;
            color: var(--porsche-light);
            cursor: pointer;
        }

        .theme-toggle {
            background: none;
            border: none;
            color: var(--porsche-light);
            font-size: 18px;
            cursor: pointer;
            transition: transform var(--transition-fast);
        }

        .theme-toggle:hover {
            transform: scale(1.2);
        }

        /* Hero Section */
        .hero {
            position: relative;
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }

        .hero-video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.7);
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.3) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding: 0 20px;
            opacity: 0;
            transform: translateY(50px);
            animation: fadeInUp 1.5s forwards 0.5s;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: 2px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-primary {
            display: inline-block;
            padding: 12px 30px;
            background: var(--porsche-red);
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            border-radius: 30px;
            transition: transform var(--transition-fast), background var(--transition-fast), box-shadow var(--transition-fast);
            border: none;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(213, 0, 28, 0.3);
        }

        .btn-primary:hover {
            background: #ee0023;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(213, 0, 28, 0.5);
        }

        .btn-primary:active {
            transform: translateY(1px);
        }

        /* Video Controls */
        .video-controls {
            position: absolute;
            bottom: 40px;
            right: 40px;
            z-index: 2;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s forwards 1.5s;
        }

        .btn-video {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 50%;
            backdrop-filter: blur(5px);
            transition: all var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-video:hover {
            background: var(--porsche-red);
            transform: scale(1.1);
        }

        /* Sections */
        section {
            padding: 100px 50px;
            position: relative;
            background-attachment: fixed;
        }

        section h2 {
            font-size: 2.5rem;
            margin-bottom: 40px;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        section h2:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 4px;
            background-color: var(--porsche-red);
        }

        /* About Section */
        #about {
            background: var(--porsche-light);
            color: var(--porsche-dark);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        #about p {
            max-width: 800px;
            margin: 0 auto 20px;
            font-size: 1.1rem;
        }

        #about p strong {
            color: var(--porsche-red);
            font-weight: 600;
        }

        .about-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
            width: 100%;
            max-width: 1200px;
        }

        .milestone {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform var(--transition-slow);
        }

        .milestone:hover {
            transform: translateY(-10px);
        }

        .milestone-year {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--porsche-red);
            margin-bottom: 15px;
        }

        /* Models Section */
        .models {
            background: var(--porsche-dark);
            color: white;
            text-align: center;
        }

        .models h2:after {
            left: 50%;
            transform: translateX(-50%);
        }

        .model-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .model-card {
            background: #222;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
            position: relative;
        }

        .model-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
        }

        .model-card:hover .model-overlay {
            opacity: 0.2;
        }

        .model-card:hover .model-details {
            transform: translateY(0);
        }

        .model-image-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .model-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .model-card:hover img {
            transform: scale(1.1);
        }

        .model-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            opacity: 0.5;
            transition: opacity var(--transition-fast);
        }

        .model-content {
            padding: 20px;
            position: relative;
        }

        .model-card h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: white;
            position: relative;
            padding-bottom: 10px;
        }

        .model-card h3:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 3px;
            background: var(--porsche-red);
        }

        .model-card p {
            color: #ccc;
            margin-bottom: 15px;
        }

        .model-details {
            background: rgba(34, 34, 34, 0.9);
            padding: 15px;
            transform: translateY(100%);
            transition: transform var(--transition-fast);
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .model-details-btn {
            display: inline-block;
            padding: 8px 20px;
            background: var(--porsche-red);
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-size: 14px;
            transition: background var(--transition-fast);
        }

        .model-details-btn:hover {
            background: #ee0023;
        }

        /* Contact Section */
        #contact {
            background: var(--porsche-light);
            color: var(--porsche-dark);
            text-align: center;
        }

        #contact h2:after {
            left: 50%;
            transform: translateX(-50%);
        }

        #contact p {
            max-width: 600px;
            margin: 0 auto 30px;
            font-size: 1.1rem;
        }

        .contact-form {
            max-width: 600px;
            margin: 40px auto 0;
            display: grid;
            gap: 20px;
        }

        .form-group {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px;
            background: white;
            border: 2px solid transparent;
            border-radius: 8px;
            font-size: 16px;
            transition: all var(--transition-fast);
        }

        .form-control:focus {
            border-color: var(--porsche-red);
            outline: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-control:invalid:not(:focus):not(:placeholder-shown) {
            border-color: #ff4d4d;
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        /* Footer */
        footer {
            background: var(--porsche-dark);
            color: white;
            padding: 40px 50px;
            text-align: center;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
            gap: 30px;
        }

        .footer-logo {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }

        .footer-logo span {
            color: var(--porsche-red);
        }

        .footer-social {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            transition: all var(--transition-fast);
        }

        .social-icon:hover {
            background: var(--porsche-red);
            transform: translateY(-5px);
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-links a {
           สี: #ccc;
            text-decoration: none;
            transition: color var(--transition-fast);
        }

        .footer-links a:hover {
            color: var(--porsche-red);
        }

        .footer-contact p {
            margin-bottom: 10px;
            color: #ccc;
        }

        .copyright {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #999;
            font-size: 14px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 1s ease, transform 1s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Scroll indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 3;
            opacity: 0;
            animation: fadeInUp 1s forwards 2s;
        }

        .scroll-indicator p {
            margin-bottom: 8px;
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .scroll-arrow {
            width: 30px;
            height: 50px;
            border: 2px solid white;
            border-radius: 15px;
            position: relative;
        }

        .scroll-arrow:before {
            content: '';
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            background: white;
            border-radius: 50%;
            opacity: 1;
            animation: scrollDown 2s infinite;
        }

        @keyframes scrollDown {
            0% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateX(-50%) translateY(30px);
            }
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }

            .navbar.scrolled {
                padding: 10px 20px;
            }

            .nav-menu {
                position: fixed;
                top: 0;
                right: -100%;
                height: 100vh;
                width: 250px;
                background: var(--porsche-dark);
                flex-direction: column;
                align-items: center;
                justify-content: center;
                transition: right 0.3s ease;
            }

            .nav-menu.active {
                right: 0;
            }

            .hamburger {
                display: block;
            }

            .hero-content h1 {
                font-size: 2.5rem;
            }

            section {
                padding: 70px 20px;
            }

            .model-cards {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }

            .footer-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    
    <!-- Hero Section -->
    <section class="hero">
        <video id="heroVideo" autoplay loop muted playsinline class="hero-video">
            <source src="images/videos/porsche.webm" type="video/webm">
            <source src="images/videos/porsche.mp4" type="video/mp4">
            Votre navigateur ne supporte pas les vidéos HTML5.
        </video>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>EXPLOREZ L'INNOVATION PORSCHE</h1>
            <p>Le luxe, la performance, et l'innovation à son apogée. Découvrez nos voitures de sport d'exception conçues pour ceux qui recherchent l'excellence.</p>
            <a href="#models" class="btn-primary">DÉCOUVRIR NOS MODÈLES</a>
        </div>
        <div class="video-controls">
            <button id="pauseButton" class="btn-video" aria-label="Mettre en pause ou lire la vidéo">
                <i class="fas fa-pause"></i>
            </button>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <h2>Notre Histoire</h2>
        <p><strong>Porsche</strong> a été fondée en 1931 par l'ingénieur Ferdinand Porsche, initialement comme un bureau d'études automobile.</p>
        <p>Une histoire marquée par l'innovation, la performance et l'élégance intemporelle.</p>
        <div class="about-content fade-in">
            <div class="milestone">
                <div class="milestone-year">1931</div>
                <p>Ferdinand Porsche fonde son bureau d'études automobile qui deviendra plus tard la marque emblématique que nous connaissons aujourd'hui.</p>
            </div>
            <div class="milestone">
                <div class="milestone-year">1948</div>
                <p><strong>Ferry Porsche</strong> lance la première voiture de la marque, la légendaire <strong>Porsche 356</strong>, symbole du renouveau d'après-guerre.</p>
            </div>
            <div class="milestone">
                <div class="milestone-year">1964</div>
                <p>Naissance de la mythique <strong>Porsche 911</strong>, qui deviendra l'icône intemporelle de la marque et de l'industrie automobile tout entière.</p>
            </div>
            <div class="milestone">
                <div class="milestone-year">Aujourd'hui</div>
                <p>Porsche continue d'innover avec des modèles électriques comme la <strong>Taycan</strong>, des SUV de luxe et des versions toujours plus performantes de sa légendaire 911.</p>
            </div>
        </div>
    </section>

    <!-- Models Section -->
    <section id="models" class="models">
        <h2>Nos Modèles</h2>
        <div class="model-cards fade-in">
            <div class="model-card">
                <div class="model-image-container">
                    <img src="images/911.jpg" alt="Porsche 911" loading="lazy">
                    <div class="model-overlay"></div>
                </div>
                <div class="model-content">
                    <h3>Porsche 911</h3>
                    <p>Performance pure et design iconique. La légende Porsche par excellence.</p>
                </div>
                
            </div>
            <div class="model-card">
                <div class="model-image-container">
                    <img src="images/taycan.jpg" alt="Porsche Taycan" cared="lazy">
                    <div class="model-overlay"></div>
                </div>
                <div class="model-content">
                    <h3>Porsche Taycan</h3>
                    <p>Performance électrique avec une technologie de pointe révolutionnaire.</p>
                </div>
                
            </div>
            <div class="model-card">
                <div class="model-image-container">
                    <img src="images/macan.jpg" alt="Porsche Macan" loading="lazy">
                    <div class="model-overlay"></div>
                </div>
                <div class="model-content">
                    <h3>Porsche Macan</h3>
                    <p>Un SUV compact de luxe alliant performance exceptionnelle et confort.</p>
                </div>
                
            </div>
            <div class="model-card">
                <div class="model-image-container">
                    <img src="images/cayenne.jpg" alt="Porsche Cayenne" loading="lazy">
                    <div class="model-overlay"></div>
                </div>
                <div class="model-content">
                    <h3>Porsche Cayenne</h3>
                    <p>Un SUV puissant et luxueux conçu pour toutes les aventures.</p>
                </div>
                
            </div>
            <div class="model-card">
                <div class="model-image-container">
                    <img src="images/GT3.jpg" alt="Porsche GT3" loading="lazy">
                    <div class="model-overlay"></div>
                </div>
                <div class="model-content">
                    <h3>Porsche GT3</h3>
                    <p>Le parfait équilibre entre sportivité extrême et élégance raffinée.</p>
                </div>
                
            </div>
            <div class="model-card">
                <div class="model-image-container">
                    <img src="images/718.jpg" alt="Porsche 718" loading="lazy">
                    <div class="model-overlay"></div>
                </div>
                <div class="model-content">
                    <h3>Porsche 718</h3>
                    <p>Un roadster conçu pour une conduite dynamique et des sensations uniques.</p>
                </div>
                
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <h2>Contactez-nous</h2>
        <p>Pour plus d'informations ou pour réserver un essai exclusif, notre équipe est à votre disposition.</p>
        <form class="contact-form fade-in" id="contactForm" novalidate>
            <div class="form-group">
                <label for="name" class="sr-only">Votre nom</label>
                <input type="text" id="name" class="form-control" placeholder="Votre nom" required>
            </div>
            <div class="form-group">
                <label for="email" class="sr-only">Votre email</label>
                <input type="email" id="email" class="form-control" placeholder="Votre email" required>
            </div>
            <div class="form-group">
                <label for="model" class="sr-only">Modèle qui vous intéresse</label>
                <select id="model" class="form-control" required>
                    <option value="" disabled selected>Modèle qui vous intéresse</option>
                    <option value="911">Porsche 911</option>
                    <option value="taycan">Porsche Taycan</option>
                    <option value="macan">Porsche Macan</option>
                    <option value="cayenne">Porsche Cayenne</option>
                    <option value="gt3">Porsche GT3</option>
                    <option value="718">Porsche 718</option>
                </select>
            </div>
            <div class="form-group">
                <label for="message" class="sr-only">Votre message</label>
                <textarea id="message" class="form-control" placeholder="Votre message" required></textarea>
            </div>
            <button type="submit" class="btn-primary">Envoyer</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <div class="footer-logo">PORSCHE<span>.</span></div>
                <p>Excellence, Performance, Innovation</p>
                <div class="footer-social">
                    <a href="https://www.facebook.com/porsche" class="social-icon" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/porsche" class="social-icon" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                    <a href="https://x.com/porsche" class="social-icon" aria-label="Twitter" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.youtube.com/@Porsche" class="social-icon" aria-label="YouTube" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h4>Liens Rapides</h4>
                <a href="#">Accueil</a>
                <a href="#about">À Propos</a>
                <a href="#models">Modèles</a>
                <a href="#contact">Contact</a>
            </div>
            <div class="footer-contact">
                <h4>Contact</h4>
                <p><i class="fas fa-map-marker-alt"></i> 123 Avenue des Champs-Élysées, Paris</p>
                <p><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
                <p><i class="fas fa-envelope"></i> info@porsche.fr</p>
            </div>
        </div>
        <div class="copyright">
            © 2025 Porsche. Tous droits réservés.
        </div>
    </footer>

    <script>
        // Loader
        window.addEventListener('load', () => {
            document.querySelector('.loader').classList.add('hidden');
        });

        // Fallback pour masquer le loader après 5 secondes
        setTimeout(() => {
            const loader = document.querySelector('.loader');
            if (loader) {
                loader.classList.add('hidden');
            }
        }, 5000);

        // Video play/pause functionality
        const video = document.getElementById('heroVideo');
        const pauseButton = document.getElementById('pauseButton');
        if (pauseButton && video) {
            pauseButton.addEventListener('click', () => {
                if (video.paused) {
                    video.play();
                    pauseButton.innerHTML = '<i class="fas fa-pause"></i>';
                } else {
                    video.pause();
                    pauseButton.innerHTML = '<i class="fas fa-play"></i>';
                }
            });
        }

        // Navbar scroll effect
        const navbar = document.querySelector('.navbar');
        if (navbar) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        }

        // Hamburger menu
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        if (hamburger && navMenu) {
            hamburger.addEventListener('click', () => {
                navMenu.classList.toggle('active');
                hamburger.innerHTML = navMenu.classList.contains('active')
                    ? '<i class="fas fa-times"></i>'
                    : '<i class="fas fa-bars"></i>';
            });
        }

        // Theme toggle
        const themeToggle = document.querySelector('.theme-toggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                themeToggle.innerHTML = newTheme === 'dark'
                    ? '<i class="fas fa-sun"></i>'
                    : '<i class="fas fa-moon"></i>';
            });
        }

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        if (themeToggle) {
            themeToggle.innerHTML = savedTheme === 'dark'
                ? '<i class="fas fa-sun"></i>'
                : '<i class="fas fa-moon"></i>';
        }

        // IntersectionObserver for fade-in animations
        const fadeElements = document.querySelectorAll('.fade-in');
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.1 }
        );
        fadeElements.forEach((element) => observer.observe(element));

        // Form validation
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;
                const model = document.getElementById('model').value;
                const message = document.getElementById('message').value;

                if (name && email && model && message) {
                    alert('Formulaire envoyé avec succès !');
                    contactForm.reset();
                } else {
                    alert('Veuillez remplir tous les champs.');
                }
            });
        }
    </script>
</body>
</html>