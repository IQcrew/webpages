<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data

    // Redirect to another page
    header("Location: variables.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <title>C# Učenie: Premenné</title>
    <style>
        .image-container{
            flex-direction: column;
        }
    </style>
</head>
<body>

<div id="container">
    <div id="sidebar" class="sidenav animate__fadeInLeft animate__animated">
        <a href="../index.php"><img src="../assets/csharp.png" alt="C#" width="40%" style="margin:20px bottom" data-aos="fade-left" class="center-image"></a>
        <a href="installation.php" class="sidenavtext">Inštalácia VS</a>
        <a href="introduction.php" class="sidenavtext">Úvod do C#</a>
        <a href="variables.php" class="sidenavtext">Premenné a dátové typy</a>
        <a href="input.php" class="sidenavtext">Vstup a prevod dát</a>
        <a href="operators.php" class="sidenavtext">Operátory</a>
        <a href="conditions.php" class="sidenavtext">Vetvenie (podmienky)</a>
        <a href="collections.php" class="sidenavtext">Kolekcie (Pole a Zoznamy)</a>
        <a href="loops.php" class="sidenavtext">Cykly</a>
        <a href="functions.php" class="sidenavtext">Funkcie (Metódy)</a>
    </div>

    <div id="content">
        <h1 class="animate__fadeInDown animate__animated">Premenné a dátové typy</h1>

        <p class="animate__fadeInDown animate__animated">
            V C#, premenne sa používajú na ukladanie a spravovanie údajov vo vašich programoch.
            Sú to kontajnery, ktoré uchovávajú hodnoty rôznych typov, ako sú celé čísla, desatinné čísla alebo reťazce.
        </p>

        <iframe class="video animate__fadeInDown animate__animated" width="560" height="315" src="https://www.youtube.com/embed/ly36kn0ug4k?si=N9MEDMlgoqZOTs66" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

            <h2 class="animate__fadeInDown animate__animated">
           otazka 1?    
        </h2>
        <div class="image-container">
        <div class = "test-images">
            <img class="animate__fadeInDown animate__animated" src="assets/test.png"  width="320" height="180" id="right" alt="Možnosť 1" onclick="changeColor(this)">
            <img class="animate__fadeInDown animate__animated" src="assets/test.png"  width="320" height="180" alt="Možnosť 2" onclick="changeColor(this)">
        </div>
        <div class = "test-images">
            <img class="animate__fadeInDown animate__animated" src="assets/test.png"  width="320" height="180" alt="Možnosť 3" onclick="changeColor(this)">
            <img class="animate__fadeInDown animate__animated" src="assets/test.png"  width="320" height="180" alt="Možnosť 4" onclick="changeColor(this)">
        </div>
        </div>
        <h2 class="animate__fadeInDown animate__animated">
           otazka 2?    
        </h2>
        <div class="image-container">
        <div class = "test-images">
            <img class="animate__fadeInDown animate__animated" src="assets/test.png"  width="320" height="180" id="right" alt="Možnosť 1" onclick="changeColor(this)">
            <img class="animate__fadeInDown animate__animated" src="assets/test.png"  width="320" height="180" alt="Možnosť 2" onclick="changeColor(this)">
        </div>
        <div class = "test-images">
            <img class="animate__fadeInDown animate__animated" src="assets/test.png"  width="320" height="180" alt="Možnosť 3" onclick="changeColor(this)">
            <img class="animate__fadeInDown animate__animated" src="assets/test.png"  width="320" height="180" alt="Možnosť 4" onclick="changeColor(this)">
        </div>
        </div>
        <h2 class="animate__fadeInDown animate__animated">
           otazka 3?    
        </h2>
        <div class="image-container">
        <div class = "test-images">
            <img class="animate__fadeInDown animate__animated" src="assets/test.png"  width="320" height="180" id="right" alt="Možnosť 1" onclick="changeColor(this)">
            <img class="animate__fadeInDown animate__animated" src="assets/test.png"  width="320" height="180" alt="Možnosť 2" onclick="changeColor(this)">
        </div>
        <div class = "test-images">
            <img class="animate__fadeInDown animate__animated" src="assets/test.png"  width="320" height="180" alt="Možnosť 3" onclick="changeColor(this)">
            <img class="animate__fadeInDown animate__animated" src="assets/test.png"  width="320" height="180" alt="Možnosť 4" onclick="changeColor(this)">
        </div>
        </div>
        
    </div>
</div>

<script src="script.js"></script>
</body>

</html>
