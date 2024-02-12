<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <style>
        header {
            background-color: #0a1921;
            color: #fff; 
            text-align: center; 
            width: 100%;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: absolute;
            top: 0;
            height: 60px;
        }

        .logo {
            max-width: 50px;
            padding-left: 19px;
            padding-top: 5px;
        }

        .login-logout {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            padding: 20px;
        }
        input[type="text"] {
            padding: 12px; 
            border-radius: 25px;
            border: 1px solid #ccc;
            font-size: 16px;
            outline: none; 
            transition: border-color 0.3s ease; 
            width: 250px; 
        }

        input[type="text"]:focus,
        input[type="text"]:hover {
            border-color: #007bff; 
        }

        input[type="submit"] {
            margin: 10px;
            padding: 12px 24px;
            background-color: #0f3349;
            color: white;
            border: none;
            border-radius: 25px; 
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease; 
        }

        input[type="submit"]:hover {
            background-color: #0056b3; 
        }

        .icon-search {
            position: absolute;
            right: 12px; 
            top: 50%; 
            transform: translateY(-50%); 
            color: #888; 
            cursor: pointer;
        }
        form {
            display: flex;
            align-items: center;
            position: relative;
        }

        label {
            margin-right: 10px;
            font-weight: bold;
        }
        .row{
            display: flex;
            flex-direction: row;
        }
    </style>
</head>
<body>
<header>
    <div class="row">

        <a href="index.php">
            <img src="src/logo_white.png" alt="Logo" class="logo">
        </a>
        <form action="produkty.php" method="GET" >
            <input type="submit" value="Vyhľadať">
            <input type="text" id="search" name="search" value="" >
        </form>
    </div>
    <div class="row">
        
        <nav>
            <?php
        
        
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo '<a href="profil.php" class="login-logout">Profil</a>';
            echo '<a href="logout.php" class="login-logout">Odhlásiť sa</a>';
        } else {
            echo '<a href="login.php" class="login-logout">Login</a>';
        }
        ?>
    </nav>
</div>
</header>

</body>
</html>
