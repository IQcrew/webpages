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

<!-- header -->
<header class = "flex header-sm">
    <div class = "container">
        <div class = "header-title">
            <h1>Contact</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus rerum maxime enim odit illum in molestias beatae doloremque, ratione optio.</p>
        </div>
    </div>
</header>
<!-- header -->

<!-- contact section -->
<section id = "contact" class = "py-4">
    <div class = "container">
        <div class = "title-wrap">
            <span class = "sm-title">get in touch with us</span>
            <h2 class = "lg-title">contact us</h2>
        </div>

        <div class = "contact-row">
            <div class = "contact-left">
                <form class = "contact-form">
                    <input type = "text" class = "form-control" placeholder="Your name">
                    <input type = "email" class = "form-control" placeholder="Your email">
                    <textarea rows = "4" class = "form-control" placeholder="Your message" style = "resize: none;"></textarea>
                    <input type = "submit" class = "btn" value = "Send message">
                </form>
            </div>
            <div class = "contact-right my-2">
                <div class = "contact-item">
                    <span class = "contact-icon flex">
                        <i class = "fa fa-phone-alt"></i>
                    </span>
                    <div>
                        <span>Phone</span>
                        <p class = "text">+421-903-888-XXX</p>
                    </div>
                </div>
                <div class = "contact-item">
                    <span class = "contact-icon flex">
                        <i class = "fa fa-map-marked-alt"></i>
                    </span>
                    <div>
                        <span>Address</span>
                        <p class = "text">Makov ,Centrum, 4xx, Slovensko</p>
                    </div>
                </div>
                <div class = "contact-item">
                    <span class = "contact-icon flex">
                        <i class = "fa fa-envelope"></i>
                    </span>
                    <div>
                        <span>Message</span>
                        <p class = "text">info@yourholiday.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of contact section -->
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