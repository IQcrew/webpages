<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="utility.css">
    <link rel="stylesheet" href="reponsive.css">
    <link rel="stylesheet" href="normalize.css">
    <link rel="shortcut icon"  href="https://img.freepik.com/free-vector/detailed-travel-logo_23-2148616611.jpg?w=740&t=st=1699697792~exp=1699698392~hmac=6b7d7ace27330db4fa6c1fb645d704828b84b0a094f6bdb9c137310ef638cc76">
    <title>YourHoliday</title>
</head>
<body>

    

    <nav class = "navbar">
        <div class = "container flex">
            <a href = "index.php" class = "site-brand">
                Your<span>Holiday</span>
            </a>
         
            <button type = "button" id = "navbar-show-btn" class = "flex">
                <i class = "fas fa-bars"></i>
            </button>
            <div id = "navbar-collapse">
                <button type = "button" id = "navbar-close-btn" class = "flex">
                    <i class = "fas fa-times"></i>
                </button>
            <ul class = "navbar-nav">
                
                <li class = "nav-item">
                    <a href = "index.php" class = "nav-link">Domov</a>
                </li>
                <li class = "nav-item">
                    <a href = "galeria.php" class = "nav-link">Galéria</a>
                </li>
                <li class = "nav-item">
                    <a href = "index.php" class = "nav-link">Blog</a>
                </li>
                <li class = "nav-item">
                    <a href = "index.php" class = "nav-link">O nás</a>
                </li>
                <li class = "nav-item">
                    <a href = "kontakt.php" class = "nav-link">Kontakt</a>
                </li>
            </ul>
        </div>
    </nav>


    <header class = "flex">
        <div class = "container">
            <div class = "header-title">
                <h1>Najlepšia dovelenka pre Vás a Vašu rodinu</h1>
                <p></p>
            </div>
            <div class = "header-form">
                <h2>Vyberte si Vašu destináciu</h2>
                <form class ="flex">
                    <input type = "text" class = "form-control" placeholder="Destinácia">
                    <input type="date" class = "form-control" placeholder="Date"> 
                    <input type="number" class ="form-control" placeholder="Price ($)"> 
                    <input type="submit" class = "btn" value = "Search">
                </form>
            </div>
        </div>
    </header>

    <section id = "featured" class = "py-4">
        <div class = "container">
            <div class = "title-wrap">
                <span class = "sm-title">Spoznajte najpopulárnejšie destinácie roku 2024</span>
                <h2 class = "lg-title">Populárne destinácie</h2>
            </div>

            <div class = "featured-row">
                <div class = "featured-item my-2 shadow">
                    <img src = "images/featured-reo-de-janeiro-brazil.jpg" alt = "featured place">
                    <div class = "featured-item-content">
                        <span>
                            <i class = "fas fa-map-marker-alt"></i>
                            Reo De Janeiro, Brazil 
                        </span>
                        <div>
                            <p class = "text">Nezabudnutelná dovolenka v Rio de JANEIRO. 
                                Južná Amerika
                                Latino</p>
                        </div>
                    </div>
                </div>

                <div class = "featured-item my-2 shadow">
                    <img src = "images/featured-north-bondi-australia.jpg" alt = "featured place">
                    <div class = "featured-item-content">
                        <span>
                            <i class = "fas fa-map-marker-alt"></i>
                            North Bondi, Australia
                        </span>
                        <div>
                            <p class = "text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                                Dicta sed dignissimos libero soluta illum, harum amet excepturi sit?</p>
                        </div>
                    </div>
                </div>

                <div class = "featured-item my-2 shadow">
                    <img src = "images/featured-berlin-germany.jpg" alt = "featured place">
                    <div class = "featured-item-content">
                        <span>
                            <i class = "fas fa-map-marker-alt"></i>
                            Berlin, Germany
                        </span>
                        <div>
                            <p class = "text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                                Dicta sed dignissimos libero soluta illum, harum amet excepturi sit?</p>
                        </div>
                    </div>
                </div>

                <div class = "featured-item my-2 shadow">
                    <img src = "images/featured-khwaeng-wat-arun-thailand.jpg" alt = "featured place">
                    <div class = "featured-item-content">
                        <span>
                            <i class = "fas fa-map-marker-alt"></i>
                            Khwaeng wat arun, thailand
                        </span>
                        <div>
                            <p class = "text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                                Dicta sed dignissimos libero soluta illum, harum amet excepturi sit?</p>
                        </div>
                    </div>
                </div>

                <div class = "featured-item my-2 shadow">
                    <img src = "images/featured-rome-italy.jpg" alt = "featured place">
                    <div class = "featured-item-content">
                        <span>
                            <i class = "fas fa-map-marker-alt"></i>
                            Rome, Italy
                        </span>
                        <div>
                            <p class = "text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                                Dicta sed dignissimos libero soluta illum, harum amet excepturi sit?</p>
                        </div>
                    </div>
                </div>

                <div class = "featured-item my-2 shadow">
                    <img src = "images/featured-fuvahmulah-maldives.jpg" alt = "featured place">
                    <div class = "featured-item-content">
                        <span>
                            <i class = "fas fa-map-marker-alt"></i>
                            fuvahmulah, maldives
                        </span>
                        <div>
                            <p class = "text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                                Dicta sed dignissimos libero soluta illum, harum amet excepturi sit?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- end of featured section -->

        <!-- services section -->
        
                <div class = "title-wrap">
                    <span class = "sm-title">Využite služby cestovnej kancelárie YourHoliday, ktoré sa postarajú o Vašu bezstarostnosť </span>
                    <h2 class = "lg-title">Naše služby</h2>
                </div>

                <section id = "services" class = "py-4">
                    <div class = "container">
                <div class = "services-row">
                    <div class = "services-item">
                        <span class = "services-icon">
                            <i class = "fas fa-hotel"></i>
                        </span>
                        <h3>Luxurious Hotel</h3>
                        <p class = "text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem quo, totam repellat velit, dignissimos sequi error a minima architecto fugit nisi dolorum repellendus?</p>
                        <a href = "#" class = "btn">Read more</a>
                    </div>


                    <div class = "services-item">
                        <span class = "services-icon">
                            <i class = "fas fa-map-marked-alt"></i>
                        </span>
                        <h3>Trave Guide</h3>
                        <p class = "text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem quo, totam repellat velit, dignissimos sequi error a minima architecto fugit nisi dolorum repellendus?</p>
                        <a href = "#" class = "btn">Read more</a>
                    </div>


                    <div class = "services-item">
                        <span class = "services-icon">
                            <i class = "fas fa-money-bill"></i>
                        </span>
                        <h3>Suitable Price</h3>
                        <p class = "text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem quo, totam repellat velit, dignissimos sequi error a minima architecto fugit nisi dolorum repellendus?</p>
                        <a href = "#" class = "btn">Read more</a>
                    </div>
                </div>
            </div>
        </section>
 <!-- end of services section -->

<!-- testimonials section -->

        <div class = "title-wrap">
            <span class = "sm-title">Vaša spokojnosť</span>
            <h2 class = "lg-title">Recenzie</h2>
        </div>
        <section id = "testimonials" class = "py-4">
            <div class = "container">
        <div class = "test-row">
            <div class = "test-item">
                <p class = "text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda blanditiis, asperiores, velit iste eos officiis tempora magni quaerat quo consectetur expedita cum recusandae facere nam voluptate minus iusto eum. Delectus!</p>
                <div class = "test-item-info">
                    <img src = "images/test-3.jpg" alt = "testimonial">
                    <div>
                        <h3>Kevin Wilson</h3>
                        <p class = "text">Trip to Brazil</p>
                    </div>
                </div>
            </div>

            <div class = "test-item">
                <p class = "text">Bolo ppč!</p>
                <div class = "test-item-info">
                    <img src = "images/test-2.jpg" alt = "testimonial">
                    <div>
                        <h3>Ben Davis</h3>
                        <p class = "text">Trip to Maldives</p>
                    </div>
                </div>
            </div>

            <div class = "test-item">
                <p class = "text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem sapiente amet expedita quae autem deleniti quo magni numquam facilis soluta dicta, praesentium ipsum, quos optio sed quibusdam! Reprehenderit recusandae provident id nemo!</p>
                <div class = "test-item-info">
                    <img src = "images/test-1.jpg" alt = "testimonial">
                    <div>
                        <h3>Jaura Jones</h3>
                        <p class = "text">Trip to Thailand</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of testimonials section -->

         <!-- footer -->
         <footer class = "py-4">
            <div class = "container footer-row">
                <div class = "footer-item">
                    <a href = "index.php" class = "site-brand">
                        Trip<span>Boss</span>
                    </a>
                    <p class = "text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet voluptates maiores nam vitae iusto. Placeat rem sint voluptas natus exercitationem autem quod neque, odit laudantium reiciendis ipsa suscipit veritatis voluptate.</p>
                </div>

                <div class = "footer-item">
                    <h2>Follow us on: </h2>
                    <ul class = "social-links">
                        <li>
                            <a href = "https://www.facebook.com/?locale=sk_SK">
                                <i class = "fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href = "https://www.instagram.com">
                                <i class = "fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href = "https://www.twitter.com">
                                <i class = "fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href = "https://sk.pinterest.com/">
                                <i class = "fab fa-pinterest"></i>
                            </a>
                        </li>
                        <li>
                            <a href = "https://www.youtube.com/">
                                <i class = "fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class = "footer-item">
                    <h2>Popular Places:</h2>
                    <ul>
                        <li><a href = "#">Thailand</a></li>
                        <li><a href = "#">Australia</a></li>
                        <li><a href = "#">Maldives</a></li>
                        <li><a href = "#">Switzerland</a></li>
                        <li><a href = "#">Germany</a></li>
                    </ul>
                </div>

                <div class = "subscribe-form footer-item">
                    <h2>Subscribe for Newsletter!</h2>
                    <form class = "flex">
                        <input type = "email" placeholder="Enter Email" class = "form-control">
                        <input type = "submit" class = "btn" value = "Subscribe">
                    </form>
                </div>
            </div>
        </footer>
        <!-- end of footer -->
     


    

</body>
</html>
