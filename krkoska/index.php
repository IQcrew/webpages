<!DOCTYPE html>
<html>
<head>
    <title>Učte sa programovať v C#</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Add your custom styles here */
        .fullscreen-header {
            background-image: url('assets/header-bg.jpg'); /* Replace 'your-image.jpg' with your image URL */
            background-size: cover;
            background-position: center;
            height: 100vh; /* 100% of the viewport height */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .header-text {
            color: #fff; /* Text color */
            font-size: 2rem;
        }

        .scroll-button {
            font-family: Arial, sans-serif; /* Change the font to your preferred font-family */
            font-size: 24px; /* Adjust the font size as needed */
            opacity: 0; /* Initially hidden */
            transform: translateY(20px); /* Initially positioned off-screen */
            margin-top: 20px;
            background-color: #00bfff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: opacity 0.5s, transform 0.5s;
        }

        .scroll-button.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
    <body>
    <header class="fullscreen-header">
        <div class="header-text animate__animated animate__fadeInDown">
            <h1>Chcete sa naučiť C#?</h1>
        </div>
        <button class="scroll-button" onclick="scrollToContent()">↓↓↓ - ANO - ↓↓↓</button>
    </header>

    <div class="center" id="prve" data-aos="fade-left">
    <section class="about-section animate__animated">
        <div class="section-container">
            <h2>C#</h2>
            <p>
                C# je priateľský a všestranný programovací jazyk vyvinutý spoločnosťou Microsoft. Je skvelou voľbou pre začiatočníkov a ponúka <span class="highlights">silné možnosti</span>.
            </p>
        </div>
        <div class="center image">
            <img src="assets/csharp.png" alt="C#" class="section-img" data-aos="fade-left">
        </div>
    </section>
</div>

<div class="center" id="druhe" data-aos="fade-right">
    <section class="why-learn-section right-aligned animate__animated">
        <div class="center image">
            <img src="assets/coding.png" alt="Programovanie" class="section-img" data-aos="fade-right">
        </div>
        <div class="section-container">
            <h2>Prečo sa učiť C#?</h2>
            <p>
                C# je ideálnym jazykom pre začiatok programovania. Používa sa na vytváranie rôznych aplikácií, od hier po web vývoj.
            </p>
        </div>
    </section>
</div>

<div class="center" data-aos="fade-left">
    <section class="quotes-section animate__animated">
        <div class="section-container">
            <h2>Významné citáty</h2>
            <blockquote>
                <p>"C# je ideálny jazyk pre začiatočníkov." - Sarah Lee</p>
                <p>"Odomkni svoj <span class="highlights">potenciál</span> s C#. Začni programovať ešte dnes!" - James Smith</p>
            </blockquote>
        </div>
        <div class="center image">
            <img src="assets/quotes.png" alt="Citáty" class="section-img" data-aos="fade-left">
        </div>
    </section>
</div>

<div class="center" data-aos="fade-right">
    <section class="key-facts-section right-aligned animate__animated">
        <div class="center image">
            <img src="assets/key-facts.png" alt="Kľúčové informácie" class="section-img" data-aos="fade-right">
        </div>
        <div class="section-container">
            <h2>Kľúčové informácie</h2>
            <p>
                C# je známe tým, že ho vytvorila spoločnosť Microsoft Corporation, prvýkrát vydal v roku 2000, je navrhnuté pre <span class="highlights">.NET Framework</span> a bežne sa používa na aplikácie pre Windows, web vývoj a hry.
            </p>
        </div>
    </section>
</div>


    <!-- Add similar divs for other sections with unique IDs -->

    <script>
        
        function scrollToContent() {
            const content = document.getElementById("prve"); // Change "content" to the ID of your first content section
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
                    entry.target.classList.add('animate__fadeInLeft');
                    observer.unobserve(entry.target);
                }
            });
        }, options);

        sections.forEach((section) => {
            observer.observe(section);
        });

        // Show the button only after scrolling
        const scrollButton = document.querySelector(".scroll-button");
        window.addEventListener("scroll", () => {
            if (window.scrollY > 50) {
                scrollButton.classList.add("show");
            }
        });
    </script>

    <footer>
        &copy; 2023 Krkoška Simon
    </footer>
</body>
</html>
