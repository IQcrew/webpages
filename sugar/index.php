<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Frica</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
      
   </head>
   <body>

   <?php
$host = "localhost";
$username = "root"; // Default MySQL username for XAMPP
$password = "";     // Default MySQL password is usually empty in XAMPP
$database = "electronic_eshop"; // Change to your actual database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
      <!-- header section start -->
      <div class="header_section haeder_main">
         <div class="container-fluid">
            <nav class="navbar navbar-light bg-light justify-content-between">
               <div id="mySidenav" class="sidenav">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                  <a href="index.php">Domov</a>
                  <a href="pc.php">Počítače</a>
                  <a href="mobili.php">Mobili</a>
                  <a href="tablet.php">Tablety</a>
                  <a href="laptop.php">Notebooky</a>
                  <a href="profil.php">Profil</a>
                  <a href="kosik.php">Košík</a>

               </div>
               <span style="font-size:30px;cursor:pointer; color: #fff;" onclick="openNav()"><img src="images/toggle-icon.png"></span>
               <h1> E-Elecronics Slovakia </h1>
               <form class="form-inline ">
                  <div class="login_text">
                     <ul>
                        <li><a href="profil.php"><img src="images/user-icon.png"></a></li>
                        <li><a href="kosik.php"><img src="images/trolly-icon.png"></a></li>
                        
                        <form action="search.php" method="GET">
                           <input type="text" placeholder="🔍︎ Vyhľadať..." name="search">
                           <button type="button" onclick="submitForm()">Hľadať</button>
                        </form>
                     </ul>
                  </div>
               </form>
            </nav>
         </div>
      </div>
      <!-- header section end -->
      <!-- banner section start -->
      <div class="banner_section layout_padding">
         <div id="my_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="row border_1">
                        <div class="col-md-4">
                           </div>
                              <div class="col-md-4">
                                 <h3 class="banner_taital">E-Elecronics Slovakia</h3>
                           
                           </div>
                        <div class="col-md-4">
                           <div class="image_2"><img src="images/img-2.png" style="width:100%"></div>
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- banner section end -->
      <!-- catagary section start -->
      <div class="catagary_section layout_padding">
         <div class="container">
            <div class="catagary_main">
               <div class="catagary_left">
                  <h2 class="categary_text">Kategórie</h2>
               </div>
               <div class="catagary_right">
                  <div class="catagary_menu">
                     <ul>
                        <li><a href="index.php">Domov</a></li>
                        <li><a href="pc.php">Počítače</a></li>
                        <li><a href="mobili.php">Mobili</a></li>
                        <li><a href="tablet.php">Tablety</a></li>
                        <li><a href="laptop.php">Notebooky</a></li>
                        
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      

      
      <!-- catagary section end -->
      <!-- computers section start -->
      <div class="computers_section layout_padding">
   <div class="container">
      <h1 class="computers_taital">Počítače</h1>
   </div>
</div>
<div class="computers_section_2">
   <div class="container-fluid">
      <div class="computer_main">
      <div class="row">
    <?php
    // SQL dotaz pre načítanie prvých 3 počítačov
    $sql = "SELECT * FROM products WHERE category = 'PC' LIMIT 3";
    $result = mysqli_query($conn, $sql);

    // Prechádzajte získanými produktami a zobrazte ich
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="col-md-4">
        <a href="product.php?product_id=<?php echo $row['product_id']; ?>">
            <div class="computer_img"><img src="imgs/<?php echo $row['image_path']; ?>"></div>
            <h4 class="computer_text"><?php echo $row['name']; ?></h4>
        </a>
        <div class="computer_text_main">
            <h4 class="dell_text"><?php echo $row['category']; ?></h4>
            <h6 class="price_text"><a href="#">$<?php echo $row['price']; ?></a></h6>
            <h6 class="price_text_1"><a href="#">Dostupné: <?php echo $row['available_quantity']; ?></a></h6>
        </div>
    </div>
    <?php
    }
    ?>
    <div class="read_bt"><a href="pc.php">zobraziť viac</a></div>
</div>
            </div>
         </div>
      </div>
      <!-- computers section end -->
      <!-- mans clothes section start -->
      <div class="mans_section layout_padding">
         <div class="container">
            <h1 class="computers_taital">Mobili</h1>
         </div>
      </div>
      <div class="mans_section_2">
         <div class="container-fluid">
            <div class="mans_main">
               <div class="row">
                  <div class="col-md-6">
                     <h1 class="offer_text">Najlepšia ponuka telefónov len pre vás</h1>
                     <p class="lorem_text">Vyberte si z veľkej škály produktov priamo  u nás . Nechajte sa prekvapiť z ponuky a vyberte si to najlepšie pre vás.<s></s></p>
                     <div class="read_bt"><a href="mobili.php">Zobraziť viac</a></div>
                  </div>
                  <div class="col-md-6">
                     <div class="image_3"><img src="imgs/mobile1.jpg"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- mans clothes section end -->
      <!-- womans clothes section start -->
      <div class="computers_section layout_padding">
         <div class="container">
            <h1 class="womans_taital">Tablety</h1>
            <div class="womans_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <h1 class="Get_offer_text">Vrhni sa aj ty na väčšiu obrazovku </h1>
                     <div class="read_bt"><a href="tablet.php">zobraziť viac</a></div>
                  </div>
                  <div class="col-md-6">
                     <div class="image_4"><img src="imgs/tablet4.jpg"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="computers_section layout_padding">
    <div class="container">
        <h1 class="computers_taital">Notebooky</h1>
    </div>
</div>
<div class="computers_section_2">
    <div class="container-fluid">
        <div class="computer_main">
            <div class="row">
                <?php
                // SQL dotaz pre načítanie prvých 3 laptopov
                $laptopSql = "SELECT * FROM products WHERE category = 'Laptop' LIMIT 3";
                $laptopResult = mysqli_query($conn, $laptopSql);

                // Prechádzajte získanými laptopmi a zobrazte ich
                while ($laptopRow = mysqli_fetch_assoc($laptopResult)) {
                ?>
                <div class="col-md-4">
                    <a href="product_detail.php?product_id=<?php echo $laptopRow['product_id']; ?>">
                        <div class="computer_img"><img src="imgs/<?php echo $laptopRow['image_path']; ?>"></div>
                        <h4 class="computer_text"><?php echo $laptopRow['name']; ?></h4>
                    </a>
                    <div class="computer_text_main">
                        <h4 class="dell_text"><?php echo $laptopRow['category']; ?></h4>
                        <h6 class="price_text"><a href="#">$<?php echo $laptopRow['price']; ?></a></h6>
                        <h6 class="price_text_1"><a href="#">Dostupné: <?php echo $laptopRow['available_quantity']; ?></a></h6>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="read_bt"><a href="laptop.php">zobraziť viac</a></div>
            </div>
        </div>
    </div>
</div>
      <!-- womans clothes section end -->
      <!-- footer section start -->
      <div class="footer_section layout_padding margin_top_90">
         <div class="container">
            <div>
               <div class="social_icon">
                  <ul>
                     <li><img src="images/fb-icon.png"></a></li>
                     <li><img src="images/twitter-icon.png"></a></li>
                     <li><img src="images/linkedin-icon.png"></a></li>
                     <li><img src="images/instagram-icon.png"></a></li>
                     <li><img src="images/youtub-icon.png"></a></li>
                  </ul>
               </div>
            </div>
            <div class="footer_section_2">
               <div class="row">
                  <div class="col-lg-3 col-sm-6">
                     <h4 class="adderss_text">O nás</h4>
                     <p class="ipsum_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation u</p>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                     <h4 class="adderss_text">Menu</h4>
                     <div class="footer_menu">
                        <ul>
                           <li><a href="index.php">Domov</a></li>
                           <li><a href="pc.php">Počítače</a></li>
                           <li><a href="mobili.php">Mobili</a></li>
                           <li><a href="tablet.php">Tablety</a></li>
                           <li><a href="laptop.php">Notebooky</a></li>
                        </ul>
                     </div>
                  </div>
                  
                  <div class="col-lg-3 col-sm-6">
                     <h4 class="adderss_text">Kontakt</h4>
                     <div class="call_text"><img src="images/map-icon.png"><span class="paddlin_left_0"><a href="#">London 145 United Kingdom</a></span></div>
                     <div class="call_text"><img src="images/call-icon.png"><span class="paddlin_left_0"><a href="#">Tel.: 0949 481 207</a></span></div>
                     <div class="call_text"><img src="images/mail-icon.png"><span class="paddlin_left_0"><a href="#">E-mail : daniel.sugar456@gmail.com</a></span></div>
                  </div>
               
            </div>
               </div>
            </div>
         </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">2023 E-Electronics Slovakia. Všetky práva vyhradené.
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>  
      <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
      <script>
         function openNav() {
           document.getElementById("mySidenav").style.width = "100%";
         }
         
         function closeNav() {
           document.getElementById("mySidenav").style.width = "0";
         }
      </script> 
      <script>
      function openNav() {
         document.getElementById("mySidenav").style.width = "100%";
      }

      function closeNav() {
         document.getElementById("mySidenav").style.width = "0";
      }
   </script>
   
   </body>
</html>