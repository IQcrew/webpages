<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Databaza chorob</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="bg"> </div>
    <?php
    $tempList = [
        [
            "nazov" => "angína",
            "typ" => "virus",
            "trvanie" => 4,
            "nebezpecnost" => 2,
        ],
        [
            "nazov" => "chripka",
            "typ" => "virus",
            "trvanie" =>  7,
            "nebezpecnost" => 3,
        ],
        [
            "nazov" => "rakovina pečene",
            "typ" => "rakovina",
            "trvanie" => 4,
            "nebezpecnost" => 6,
        ],
        [
            "nazov" => "migréna",
            "typ" => "chronické",
            "trvanie" => 1,
            "nebezpecnost" => 1,
        ],
        [
            "nazov" => "nadcha",
            "typ" => "virus",
            "trvanie" => 3,
            "nebezpecnost" => 1,
        ],
    ];
    if(!isset($_SESSION["list"])){$_SESSION["list"] = $tempList;}
    if (isset($_POST["index"])) { array_splice($_SESSION["list"], $_POST["index"], 1);}
    if(isset($_POST["nazov"]) && isset($_POST["typ"])){
        $_SESSION["list"] = array_merge($_SESSION["list"], array(["nazov" => $_POST["nazov"],
        "typ" => $_POST["typ"], "trvanie" => $_POST["trvanie"], "nebezpecnost" => $_POST["nebezpecnost"]]));
    }
    
    

    ?>
    <h1>Databáza chorôb</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Názov</th>
            <th>Typ</th>
            <th>Trvanie</th>
            <th>Nebezpečnosť</th>
        </tr>
        <?php
            foreach( $_SESSION["list"] as $i => $choroba ){
            echo "<tr>";
            echo "<td>".$i."</td>";
            echo "<td>".$choroba["nazov"]."</td>";
            echo "<td>".$choroba["typ"]."</td>";
            echo "<td>".$choroba["trvanie"]." dní </td>";
            echo "<td>".$choroba["nebezpecnost"]." stupňa </td>";
            
            }
        ?>
    </table>  
    <div class="secondPart">
    <form method="post" name="add">
        <input type="text" class="inputText" name="nazov" placeholder="Názov choroby" required="required">
        <input type="text" class="inputText" name="typ" placeholder="Typ choroby" required="required">
        <div>
            <output>Trvanie: </output>
            <input type="range" name="trvanie" min="1" max="31" value="1" oninput="this.nextElementSibling.value = this.value">
            <output>1</output>
            <output> Dní</output>
        </div>
        <div>
            <output> Nebezpečnosť: </output>
            <input type="range" name="nebezpecnost" min="1" max="6" value="1" oninput="this.nextElementSibling.value = this.value">
            <output>1</output>
            <output> Stupňa</output>
        </div>
        <input type="submit" class="inputButton" name="submit" value="Pridať">

    </form>     
    <br><br>
    <form method="post" name="clear">
        <?php
            echo "<input type=\"number\" class=\"inputText\" name=\"index\" min=\"0\" value=\"0\" max=".(count($_SESSION["list"])-1).">"
        ?>
        <input type="submit" class="inputButton red" name="remove" value="Odstrániť">
    </form>
    </div>
</body>