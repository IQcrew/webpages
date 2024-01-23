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
                    <a href = "index.php" class = "nav-link">Galéria</a>
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
                <h1>Gallery</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus rerum maxime enim odit illum in molestias beatae doloremque, ratione optio.</p>
            </div>
        </div>
    </header>
    <!-- header -->

    <!-- gallery section -->
    <div id = "gallery" class = "py-4">
        <div class = "container">
            <div class = "gallery-row">
                <div class = "gallery-item shadow">
                    <img src = "images/gallery-1.jpg" alt = "gallery img">
                    <span class = "zoom-icon">
                        <i class = "fas fa-search-plus"></i>
                    </span>
                </div>
                <div class = "gallery-item shadow">
                    <img src = "images/gallery-2.jpg" alt = "gallery img">
                    <span class = "zoom-icon">
                        <i class = "fas fa-search-plus"></i>
                    </span>
                </div>
                <div class = "gallery-item shadow">
                    <img src = "images/gallery-3.jpg" alt = "gallery img">
                    <span class = "zoom-icon">
                        <i class = "fas fa-search-plus"></i>
                    </span>
                </div>
                <div class = "gallery-item shadow">
                    <img src = "images/gallery-4.jpg" alt = "gallery img">
                    <span class = "zoom-icon">
                        <i class = "fas fa-search-plus"></i>
                    </span>
                </div>
                <div class = "gallery-item shadow">
                    <img src = "images/gallery-5.jpg" alt = "gallery img">
                    <span class = "zoom-icon">
                        <i class = "fas fa-search-plus"></i>
                    </span>
                </div>
                <div class = "gallery-item shadow">
                    <img src = "images/gallery-6.jpg" alt = "gallery img">
                    <span class = "zoom-icon">
                        <i class = "fas fa-search-plus"></i>
                    </span>
                </div>
                <div class = "gallery-item shadow">
                    <img src = "images/gallery-7.jpg" alt = "gallery img">
                    <span class = "zoom-icon">
                        <i class = "fas fa-search-plus"></i>
                    </span>
                </div>
                <div class = "gallery-item shadow">
                    <img src = "images/gallery-8.jpg" alt = "gallery img">
                    <span class = "zoom-icon">
                        <i class = "fas fa-search-plus"></i>
                    </span>
                </div>
                <div class = "gallery-item shadow">
                    <img src = "images/gallery-9.jpg" alt = "gallery img">
                    <span class = "zoom-icon">
                        <i class = "fas fa-search-plus"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- end of gallery section -->

     <!-- img modal -->
     <div id = "img-modal-box">
        <div id = "img-modal">
            <button type = "button" id = "modal-close-btn" class = "flex">
                <i class = "fas fa-times"></i>
            </button>
            <button type = "button" id = "prev-btn" class = "flex">
                <i class = "fas fa-chevron-left"></i>
            </button>
            <button type = "button" id = "next-btn" class = "flex">
                <i class = "fas fa-chevron-right"></i>
            </button>
            <img src = "images/gallery-1.jpg">
        </div>
    </div>
    <!-- end of img modal -->

 <!-- popular places section -->
 <section id = "popular" class = "py-4">
    <div class = "title-wrap">
        <span class = "sm-title">know about some coo destination</span>
        <h2 class = "lg-title">Populárne destinácie</h2>
    </div>

    <div class = "popular-row">
        <div class = "popular-item shadow">
            <img src = "images/popular-1.jpg" alt = "">
            <div>
                <span>Eiffel Tower, Paris</span>
                <ul class = "rating flex">
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star-half-alt"></i></li>
                    <li>&nbsp;400 hodnotení</li>
                </ul>
                <p class = "text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, quia!</p>
            </div>
        </div>

        <div class = "popular-item shadow">
            <img src = "images/popular-2.jpg" alt = "">
            <div>
                <span>Machu Picchu, Peru</span>
                <ul class = "rating flex">
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star-half-alt"></i></li>
                    <li>&nbsp;400 hodnotení</li>
                </ul>
                <p class = "text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, quia!</p>
            </div>
        </div>

        <div class = "popular-item shadow">
            <img src = "images/popular-3.jpg" alt = "">
            <div>
                <span>Acropolis, Athens</span>
                <ul class = "rating flex">
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star-half-alt"></i></li>
                    <li>&nbsp;400 hodnotení</li>
                </ul>
                <p class = "text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, quia!</p>
            </div>
        </div>

        <div class = "popular-item shadow">
            <img src = "images/popular-4.jpg" alt = "">
            <div>
                <span>Bali, Indonesia</span>
                <ul class = "rating flex">
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star-half-alt"></i></li>
                    <li>&nbsp;400 hodnotení</li>
                </ul>
                <p class = "text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, quia!</p>
            </div>
        </div>

        <div class = "popular-item shadow">
            <img src = "images/popular-5.jpg" alt = "">
            <div>
                <span>Dubai, United Arab Emirates</span>
                <ul class = "rating flex">
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star-half-alt"></i></li>
                    <li>&nbsp;400 hodnotení</li>
                </ul>
                <p class = "text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, quia!</p>
            </div>
        </div>

        <div class = "popular-item shadow">
            <img src = "images/popular-6.jpg" alt = "">
            <div>
                <span>Bhutan</span>
                <ul class = "rating flex">
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star-half-alt"></i></li>
                    <li>&nbsp;400 hodnotení</li>
                </ul>
                <p class = "text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, quia!</p>
            </div>
        </div>

        <div class = "popular-item shadow">
            <img src = "images/popular-7.jpg" alt = "">
            <div>
                <span>Havana, Cuba</span>
                <ul class = "rating flex">
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star-half-alt"></i></li>
                    <li>&nbsp;400 hodnotení</li>
                </ul>
                <p class = "text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, quia!</p>
            </div>
        </div>

        <div class = "popular-item shadow">
            <img src = "images/popular-8.jpg" alt = "">
            <div>
                <span>Moskva, Russia</span>
                <ul class = "rating flex">
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star"></i></li>
                    <li><i class = "fas fa-star-half-alt"></i></li>
                    <li>&nbsp;400 hodnotení</li>
                </ul>
                <p class = "text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, quia!</p>
            </div>
        </div>
    </div>
</section>
<!-- end of popular places section -->


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

    <script src = "js/script.js"></script>
    <script>
        // image modal
        const allGalleryItem = document.querySelectorAll('.gallery-item');
        const imgModalDiv = document.getElementById('img-modal-box');
        const modalCloseBtn = document.getElementById('modal-close-btn');
        const nextBtn = document.getElementById('next-btn');
        const prevBtn = document.getElementById('prev-btn');
        let imgIndex = 0;

        allGalleryItem.forEach((galleryItem) => {
            galleryItem.addEventListener('click', () => {
                imgModalDiv.style.display = "block";
                let imgSrc = galleryItem.querySelector('img').src;
                imgIndex = parseInt(imgSrc.split("-")[1].substring(0, 1));
                showImageContent(imgIndex);
            })
        });

        // next click
        nextBtn.addEventListener('click', () => {
            imgIndex++;
            if(imgIndex > allGalleryItem.length){
                imgIndex = 1;
            }
            showImageContent(imgIndex);
        });

        // previous click
        prevBtn.addEventListener('click', () => {
            imgIndex--;
            if(imgIndex <= 0){
                imgIndex = allGalleryItem.length;
            }
            showImageContent(imgIndex);
        });

        function showImageContent(index){
            imgModalDiv.querySelector('#img-modal img').src = `images/gallery-${index}.jpg`;
        }

        modalCloseBtn.addEventListener('click', () => {
            imgModalDiv.style.display = "none";
        })
    </script>

</body>
</html>