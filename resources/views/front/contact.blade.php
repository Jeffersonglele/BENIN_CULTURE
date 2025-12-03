<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - CULTURE BENIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Space Grotesk', sans-serif;
            background: #fff;
            color: #000;
            min-height: 100vh;
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 100px 20px 50px;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .contact-title {
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, #ffcd00, #ffd700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .contact-subtitle {
            font-size: 1.2rem;
            color: #000;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: start;
        }

        .contact-form {
            background: rgba(30, 30, 30, 0.8);
            padding: 40px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 205, 0, 0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #ffcd00;
            font-weight: 500;
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 205, 0, 0.2);
            border-radius: 12px;
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease;
            font-family: 'Space Grotesk', sans-serif;
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #ffcd00;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 20px rgba(255, 205, 0, 0.2);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .info-card {
            background: rgba(30, 30, 30, 0.8);
            padding: 30px;
            border-radius: 15px;
            border-left: 4px solid #ffcd00;
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }

        .info-icon {
            font-size: 2rem;
            color: #ffcd00;
            margin-bottom: 15px;
        }

        .info-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #ffcd00;
        }

        .info-text {
            color: #ccc;
            line-height: 1.6;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            width: 45px;
            height: 45px;
            background: rgba(255, 205, 0, 0.1);
            border: 2px solid rgba(255, 205, 0, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffcd00;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: #ffcd00;
            color: #000;
            transform: scale(1.1);
        }

        /* Style du bouton d'envoi */
        .btn-submit {
            position: relative;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 16px 40px;
            border: 3px solid transparent;
            font-size: 16px;
            background-color: #000;
            border-radius: 100px;
            font-weight: 600;
            color: #fff;
            box-shadow: 0 0 0 2px #000;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            text-decoration: none;
            width: 100%;
            margin-top: 10px;
        }

        .btn-submit .circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            background-color: #ffcd00;
            border-radius: 50%;
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
            z-index: 1;
        }

        .btn-submit .text {
            position: relative;
            z-index: 2;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
            color: #fff;
        }

        .btn-submit svg {
            position: absolute;
            width: 20px;
            height: 20px;
            fill: #fff;
            z-index: 2;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .btn-submit .arr-1 {
            right: 20px;
            opacity: 1;
        }

        .btn-submit .arr-2 {
            left: -25%;
            opacity: 0;
        }

        .btn-submit:hover {
            box-shadow: 0 0 0 10px transparent;
            border-radius: 15px;
            background-color: #000;
        }

        .btn-submit:hover .arr-1 {
            right: -25%;
            opacity: 0;
        }

        .btn-submit:hover .arr-2 {
            left: 20px;
            opacity: 1;
        }

        .btn-submit:hover .text {
            transform: translateX(10px);
            color: #fff;
        }

        .btn-submit:hover .circle {
            width: 250px;
            height: 250px;
            opacity: 1;
        }

        .btn-submit:active {
            transform: scale(0.98);
            box-shadow: 0 0 0 4px #ffcd00;
        }

        /* Carte */
        .map-container {
            margin-top: 30px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .map-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(45deg, #2a2a2a, #3a3a3a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-style: italic;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .contact-title {
                font-size: 2.5rem;
            }
            
            .contact-form {
                padding: 30px;
            }
        }

        @media (max-width: 480px) {
            .contact-container {
                padding: 80px 15px 30px;
            }
            
            .contact-title {
                font-size: 2rem;
            }
            
            .contact-form {
                padding: 20px;
            }
            
            .info-card {
                padding: 20px;
            }
        }

        /* Animation d'apparition */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }
    </style>
</head>
<body>
    
    <x-navbar />
    <div class="contact-container">
        <!-- En-tête -->
        <div class="contact-header fade-in">
            <h1 class="contact-title">Contactez-Nous</h1>
            <p class="contact-subtitle">
                Nous sommes à votre écoute pour toute question, suggestion ou collaboration concernant la promotion de la culture béninoise.
            </p>
        </div>

        <div class="contact-grid">
            <!-- Formulaire de contact -->
            <div class="contact-form fade-in delay-1">
                <form id="contactForm">
                    <div class="form-group">
                        <label class="form-label" for="name">Nom Complet</label>
                        <input type="text" id="name" class="form-input" placeholder="Votre nom et prénom" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Adresse Email</label>
                        <input type="email" id="email" class="form-input" placeholder="votre@email.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="subject">Sujet</label>
                        <input type="text" id="subject" class="form-input" placeholder="Objet de votre message" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="message">Message</label>
                        <textarea id="message" class="form-textarea" placeholder="Décrivez-nous votre demande..." required></textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        <span class="text">Envoyer le Message</span>
                        <div class="circle"></div>
                        <svg class="arr-1" viewBox="0 0 24 24">
                            <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                        </svg>
                        <svg class="arr-2" viewBox="0 0 24 24">
                            <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Informations de contact -->
            <div class="contact-info">
                <div class="info-card fade-in delay-2">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="info-title">Notre Adresse</h3>
                    <p class="info-text">
                        Rue de la Culture, Plateau<br>
                        Cotonou, Bénin<br>
                        BP 1234 Cotonou
                    </p>
                </div>

                <div class="info-card fade-in delay-2">
                    <div class="info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h3 class="info-title">Téléphone</h3>
                    <p class="info-text">
                        +229 01 90 07 71 39<br>
                        +229 01 90 07 71 39<br>
                        Lundi - Vendredi: 8h - 18h
                    </p>
                </div>

                <div class="info-card fade-in delay-3">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="info-title">Email & Réseaux</h3>
                    <p class="info-text">
                        contact@culturebenin.bj<br>
                        micheeglele@gmail.com<br>
                        collaboration@culturebenin.bj
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Animation au chargement
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
            });

            setTimeout(() => {
                fadeElements.forEach((el, index) => {
                    setTimeout(() => {
                        el.style.transition = 'all 0.8s ease';
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, index * 200);
                });
            }, 100);
        });

        // Gestion du formulaire
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulation d'envoi
            const submitBtn = this.querySelector('.btn-submit');
            const originalText = submitBtn.querySelector('.text').textContent;
            
            submitBtn.querySelector('.text').textContent = 'Envoi en cours...';
            submitBtn.style.cursor = 'not-allowed';
            
            setTimeout(() => {
                submitBtn.querySelector('.text').textContent = 'Message Envoyé !';
                submitBtn.style.background = '#10b981';
                
                setTimeout(() => {
                    submitBtn.querySelector('.text').textContent = originalText;
                    submitBtn.style.background = '#000';
                    submitBtn.style.cursor = 'pointer';
                    this.reset();
                }, 2000);
            }, 1500);
        });
    </script>
</body>
</html>