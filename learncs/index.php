<!DOCTYPE html>
<html>
<head>
    <title>Učte sa programovať v C#</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700&display=swap">
    <style>

    </style>
</head>
<body>
    <header class="fullscreen-header" id="head">
        <div class="header-text animate__animated">
            <h1 class="typing-text">Chcete sa naučiť C#?</h1>
        </div>
        <button class="scroll-button animate__animated" onclick="scrollToContent()">↓↓↓ - ANO - ↓↓↓</button>
    </header>

    <div class="center" id="prve" data-aos="fade-left">
        <section class="about-section animate__animated">
            <div class="section-container">
                <h2>C#</h2>
                <p>
                    C# je priateľský a všestranný programovací jazyk vyvinutý spoločnosťou Microsoft. Je skvelou voľbou pre začiatočníkov a ponúka <span class="highlights">veľa možnosti</span>.
                </p>
            </div>
            <div class="center image">
                <img src="assets/csharp.png"  alt="C#"  width="40%" data-aos="fade-left">
            </div>
        </section>
    </div>

    <div class="center" data-aos="fade-right" id="tretie">
        <section class="key-facts-section right-aligned animate__animated">
            <div class="center image">
                <img src="assets/dotnet.png" alt="Kľúčové informácie" class="modern-image" width="90%" data-aos="fade-right">
            </div>
            <div class="section-container">
                <h2>Kde ho môžem využiť?</h2>
                <p>
                    C# vytvorila spoločnosť Microsoft Corporation v roku 2000, určený pre <span class="highlights">.NET Framework</span> a bežne sa používa na aplikácie pre Windows, web, hry, umelú inteligenciu, cloud, IoT a mobilné aplikácie.
                </p>
            </div>
        </section>
    </div>
    
    <div class="center" data-aos="fade-left" id="stvrte">
        <section class="quotes-section animate__animated">
            <div class="section-container">
                <h2>Čo hovoria programátori o C#?</h2>
                <blockquote>
                    <p>"C# je ideálny jazyk pre začiatočníkov." - Sarah Lee</p>
                    <p >"Odomkni svoj <span class="highlights">potenciál</span> a začni programovať ešte dnes!" - James Smith</p>
                </blockquote>
            </div>
            <div class="center image">
                <img src="assets/quotes.png" alt="Citáty" class="modern-image" width="90%" data-aos="fade-left">
            </div>
        </section>
    </div>
    <div class="center" id="druhe" data-aos="fade-right">
        <section class="why-learn-section right-aligned animate__animated">
            <div class="center image">
                <img src="assets/coding.png" alt="Programovanie" width="40%" data-aos="fade-right">
            </div>
            <div class="section-container">
                <h2>Prečo sa učiť C#?</h2>
                <p>
                S C# máte všetko na jednom mieste vo Visual Studiu, vďaka jeho integrovaným funkciam, je vývoj <span class="highlights">rýchly a jednoduchý</span>. Stačí niekoľko kliknutí a ľahká inštalácia a môžete začať vytvárať svoju prvú hru alebo aplikáciu.
                </p>
            </div>
        </section>
    </div>


    <!-- Add similar divs for other sections with unique IDs -->

    <script>
        function scrollToContent() {
            const content = document.getElementById("prve");
            content.scrollIntoView({ behavior: "smooth" });
        }

        // Intersection Observer to trigger animations when the sections come into view
        const sections = document.querySelectorAll('.animate__animated');
        const options = {
            threshold: 0.2,
        };
        
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                        // An array of possible animation directions
                        const animationDirections = ['animate__fadeInLeft', 'animate__fadeInRight', 'animate__fadeInUp', 'animate__fadeInDown'];

                        // Get a random animation direction
                        const randomDirection = animationDirections[Math.floor(Math.random() * animationDirections.length)];

                        // Add the random animation class to the element
                        entry.target.classList.add(randomDirection);
                    observer.unobserve(entry.target);
                }
            });
        }, options);

        sections.forEach((section) => {
            observer.observe(section);
        });


    </script>

    <footer>
        &copy; 2023 Krkoška Šimon
    </footer>
</body>
</html>
