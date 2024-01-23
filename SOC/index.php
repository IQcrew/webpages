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

                        <form action="index.php" method="GET">
                        <input type="text" placeholder="🔍︎ Vyhľadať..." name="search">
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
        <a href="index.php?category=PC">
            <i class="fas fa-desktop"></i>
            Počítače
        </a>
    </div>
    <div class="category-item">
        <a href="index.php?category=Mobile">
            <i class="fas fa-mobile-alt"></i>
            Mobily
        </a>
    </div>
    <div class="category-item">
        <a href="index.php?category=Tablet">
            <i class="fas fa-tablet"></i>
            Tablety
        </a>
    </div>
    <div class="category-item">
        <a href="index.php?category=Laptop">
            <i class="fas fa-laptop"></i>
            Notebooky
        </a>
    </div>
</div>

</div>
<div class="products-container"style="
    bottom: 0px;
    top: 715px;
    right: 0px;
    left: 80px;">
<?php
include('db_connection.php');

// Get the selected category from the URL
$category = isset($_GET['category']) ? $_GET['category'] : '';
// Get the search query from the URL
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch products from the specified category and matching the search query
$sql = "SELECT * FROM products WHERE 1";
if ($category != '') {
    $sql .= " AND category = '$category'";
}
if ($searchQuery != '') {
    $sql .= " AND name LIKE '%$searchQuery%'";
}

$result = $conn->query($sql);

// Check if there are products
if ($result->num_rows > 0) {
    // Output the products using a foreach loop
    echo '<div class="products-container" style="display: flex; flex-wrap: wrap;">';

    while ($row = $result->fetch_assoc()) {
        echo '<div class="product">';
        echo '<a href="product.php?product_id=' . $row["product_id"] . '">';
        echo '<img src="imgs/' . $row["image_path"] . '" alt="' . $row["name"] . '" style="height: 220px; width: 220px;">';
        echo '</a>';
        echo '<p style="font-size: 18px; ">';
        echo '<span style="border: 2px solid black; padding: 5px; border-radius: 8px;">' . $row["name"] . '</span><br><br>';
        echo '<span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Dostupnosť: Na sklade ' . $row["available_quantity"] . 'ks</span><br><br>';
        echo '<span style="border: 2px solid black; padding: 5px; border-radius: 8px;">Cena: ' . $row["price"] . '€</span>';
        echo '</p>';
        echo '</div>';
    }

    echo '</div>';
} else {
    // If there are no products
    echo 'No products found for the specified category.';
}

// Close the connection
$conn->close();
?>

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