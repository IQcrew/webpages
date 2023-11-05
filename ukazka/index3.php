<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Databaza</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require_once("connect.php");

    $err = 0;
    $errFilm = false;
    if (isset($_POST['addActorBtn'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $film_id = $_POST['film_id'];

        if ($first_name == "" || $last_name == "") {
            $err = 1;
        } else if ($film_id == "-1") {
            $errFilm = true;
        } else {
            $sql = "INSERT INTO actor (first_name, last_name) VALUES ('$first_name', '$last_name')";
            // mysqli_query($conn, $sql);
            $isInserted = $conn->query($sql);       // spustenie príkazu $sql v databáze
            if ($isInserted) {
                $last_id = $conn->insert_id; //posledne id
                $sql_medzitabulka = "INSERT INTO film_actor (actor_id, film_id) VALUES ('$last_id', '$film_id')";
                $conn->query($sql_medzitabulka);

                header("Location: index3.php");      // refresh stránky, aby sa vymazali dáta z POST formulára
                exit();                             // ukončenie všetkého ďalšieho po refreshi
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    require_once("header.php");

    ?>




    <form method="post">

        <label for="first_name">Meno:</label>
        <input type="text" id="first_name" name="first_name"><br><br>
        <label for="last_name">Priezvisko:</label>
        <input type="text" id="last_name" name="last_name"><br><br>

        <?php
        if ($err == 1) {
        ?>
            <p style='color:red'> Niečo ste nevyplnili </p>
        <?php
        }
        ?>

        <label for="film">Film</label>
        <select name="film_id" id="film">
            <option value="-1"></option>
            <?php

            $sqlSelectFilm = "SELECT film_id, title FROM film";
            $resultFilm = $conn->query($sqlSelectFilm);           // spustenie príkazu $sql v databáze

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            if ($resultFilm->num_rows > 0) {

                $films = $resultFilm->fetch_all(MYSQLI_ASSOC);       // vytvorenie asociatívneho poľa zo SELECTU

                // echo "<pre>";
                // print_r($countries);
                // echo "</pre>";
            }



            foreach ($films as $film) {
            ?>
                <option value="<?php echo $film['film_id'] ?>">
                    <?php echo $film['title'] ?>
                </option>
            <?php
            }

            ?>
        </select>

        <?php
        if ($errFilm == true) {
        ?>
            <p style='color:red'> Nevybrali ste film </p>
        <?php
        }
        ?>

        <input type="submit" name="addActorBtn" value="Vytvoriť">

    </form>

</body>

</html>