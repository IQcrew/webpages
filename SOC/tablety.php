<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>E-Electronics Slovakia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="produkty.css">
    <meta charset="UTF-8">

    

</head>

    
    


<body>

    <header>
        <nav>
            <ul>
                <li class="search-form">

                    <div class="logo-icon">
                    <i class="fas fa-mobile-alt"></i>

                        <form action="/vyhladavanie" method="GET">
                        <input type="text" placeholder="🔍︎ Vyhľadať..." name="query">
                        <button type="submit">Hľadať</button>
                    




                        <div class="profile-icon" >
                            <a href="profil.php">
                            <i class="fas fa-user-circle"></i>
                                 <span>Môj profil</span>
                        </div>

                        <div class="cart-icon" >
                            <a href="kosik.php">
                            <i class="fas fa-shopping-basket"></i>
                                <span>Košík</span>
                        </div>
                    </div>
                </li>
                
                <li class="white-bar">
                <a href="SOČ - E-Elektonics.php">Domov </a>
                <a href="info.php">Info o nás </a>
        
                </li>

                
                
                    </form>
                
            </ul>
        </nav>
    </header>
   
    
<div class="categories">
                        <div class="category-item">
                            <a href="pocitace.php">  
                                <i class="fas fa-desktop"></i>
                                Počítače
                            
                        </div>
                        <div class="category-item" href ="mobli.php">
                            <a href="mobili.php"> 
                                <i class="fas fa-mobile-alt"></i>
                                Mobily
                            
                        </div>
                        <div class="category-item">
                            <a href="tablety.php"> 
                                <i class="fas fa-tablet"></i>
                                Tablety
                            
                        </div>
                        <div class="category-item">
                            <a href="notebooky.php">
                                <i class="fas fa-laptop"></i>
                                Notebooky
                            
                        </div>
</div>
<br>

<div class="products-container"style="
    bottom: 0px;
    top: 105px;
    right: 0px;
    left: 100px;">
        <div class="product">
        <a href="samsung.php">
            <img src="apple.jpg" alt="Produkt 1" style="height: 220px;">
        </a>
            <p style="font-size: 18px; ">
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">iPad Air M1 256 GB WiFi</span><br><br>
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Dostupnosť: Na sklade 4ks</span><br><br>
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Cena:  900€</span> 
            </p>
        
        </div>

        <div class="product" >
        <a href="samsung.php">
            <img src="honor.jpg" alt="Produkt 2"style="height: 220px;">
        </a>
            <p style="font-size: 18px; ">
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">HONOR Pad X9 4 GB/128 GB </span><br><br>
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Dostupnosť: Na sklade 2ks</span><br><br>
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Cena:  190€</span>
        
            </p>
        
        </div>

        <div class="product" >
        <a href="samsung.php">
            <img src="samsungt.jpg" alt="Produkt 3"style="height: 220px;">
        </a>
            <p style="font-size: 18px; "> 
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Samsung Galaxy Tab S9 FE</span><br><br>
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Dostupnosť: Na sklade 3ks</span><br><br>
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Cena:  600€</span> 
            </p>
        
        </div>

        <div class="product" >
        <a href="samsung.php">
            <img src="lenovo.jpg" alt="Produkt 4" style="height: 220px;">
        </a>
            <p style="font-size: 18px; ">
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Lenovo Tab P12  </span><br><br>
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Dostupnosť: Na sklade 4ks</span><br><br>
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Cena:  400€</span> 
            </p>
        
        </div>

        <div class="product" >
        <a href="samsung.php">
            <img src="ipad.jpg" alt="Produkt 5"style="height: 220px;">
        </a>
            <p style="font-size: 18px; ">
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">iPad mini 64 GB</span><br><br>
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Dostupnosť: Na sklade 4ks</span><br><br>
                <span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Cena:  600€</span>
            </p>
        
        </div>

    </div>

<div class="category-news">
        <span class="red-line"></span><span class="news-text">Novinky</span>
        <div class="calendar-icon">
            <i class="far fa-calendar-alt"></i>
            <span class="date">7.12.2023</span>
        </div>
        <div class="additional-text">
            <p>Ďalšie Samsungy dostávajú <br>
            aktualizáciu na Android 14</p>
        </div>
        <div class="additional-textsw">
            <p>Spoločnosť Samsung vydala nové <br>
            aktualizácie so systémom <br>
            Android 14 pre smartfóny<br>
            Galaxy S21 FE, Galaxy A52s,<br>
            Galaxy A33</p>
        </div>

        <button id="toggleButton">Zobraziť viac noviniek</button>

        <div class="calendar-icon" id="calendarIcon" style="display: none;">
            <i class="far fa-calendar-alt"></i>
            <span class="date">5.12.2023</span>
        </div>
        <div class="additional-text" id="additionalText" style="display: none;">
            <p>Xiaomi 14 Ultra dostane <br>
            väčšiu batériu a rýchle <br>
            nabíjanie</p>
        </div>
        <div class="additional-texts" id="additionalTexts" style="display: none;">
            <p>Xiaomi 14 Ultra má byť tým <br>
            najlepším, čo dokáže čínska <br>
            spoločnosť.</p>
        </div>
    </div>

    <script>
        document.getElementById("toggleButton").addEventListener("click", function() {
            var calendarIcon = document.getElementById("calendarIcon");
            var additionalText = document.getElementById("additionalText");
            var additionalTexts = document.getElementById("additionalTexts");
            var buttonText = document.getElementById("toggleButton");

            if (calendarIcon.style.display === "none") {
                calendarIcon.style.display = "block";
                additionalText.style.display = "block";
                additionalTexts.style.display = "block";
                buttonText.textContent = "Skryť";
            } else {
                calendarIcon.style.display = "none";
                additionalText.style.display = "none";
                additionalTexts.style.display = "none";
                buttonText.textContent = "Zobraziť viac noviniek";
            }
        });
    </script>



    
    <footer id="page-footer">
    
        <div class="footer-links">
            <div class="footer-column">
            <a href="pocitace.php" ><i class="fas fa-desktop"></i>Počítače</a>
                <a href="notebooky.php"><i class="fas fa-laptop"></i>Notebooky</a>
                <a href="tv.php"> <i class="fas fa-tv"></i>TV</a>
                <a href="mobili.php"><i class="fas fa-mobile-alt"></i>Mobily</a>
            </div>
            <div class="footer-column">
                <a href="profil.php"><i class="fas fa-user"></i>Môj profil</a>
                <a href="kosik.php"><i class="fas fa-shopping-basket"></i>Košík</a>
            </div>
            <div class="footer-column">
            <p><i class="fas fa-envelope"></i>Kontakt <br>Tel.: 0949 481 207 <br>E-mail : daniel.sugar456@gmail.com</p> 
            


            <!-- Pridaj ďalšie odkazy podľa potreby -->
        </div>
        </div>
        <p>&copy; 2023 E-Electronics Slovakia. Všetky práva vyhradené.</p>
    </footer>

    <div class="custom-scrollbar-footer"></div>

    <script>
      window.addEventListener('scroll', function() {
        var footer = document.querySelector('footer');
        var scrollPosition = window.scrollY;

        if (scrollPosition > 490) { // Zmena tu
            footer.classList.add('active');
        } else {
        footer.classList.remove('active');
        }
        });
    </script>

















</body>
</html>