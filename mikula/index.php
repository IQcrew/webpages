<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
        $form1 = array(
            "name" => "",
            "priezvisko" => "",
            "pohlavie" => "neuvedene",
            "farby" => array(),
    
    
        );
    if ($_SERVER["REQUEST_METHOD"] == "POST") {



    if(isset($_POST["name"])){ $form1["name"] = $_POST["name"]; }
    if(isset($_POST["priezvisko"])){ $form1["priezvisko"] = $_POST["priezvisko"]; }
    if(isset($_POST["gender"])){ $form1["pohlavie"] = $_POST["gender"]; }

    if(isset($_POST["modra"])){ $form1["farby"][] = $_POST["modra"]; }
    if(isset($_POST["cervena"])){ $form1["farby"][] = $_POST["cervena"]; }
    if(isset($_POST["zelena"])){ $form1["farby"][] = $_POST["zelena"]; }
    if(isset($_POST["cierna"])){ $form1["farby"][] = $_POST["cierna"]; }
    
    }
    print_r ($form1);
    echo "<br>";


    ?>
    <div class="formular">
    
    <form method="post" class ="frm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

    <div class="f1">
    Meno: 
    <input type="text" name="name"  value="<?php echo $form1["name"];?>">
    <br><br>
    Priezvisko: 
    <input type="text" name="priezvisko" value="<?php echo $form1["priezvisko"];?>">
    <br><br>
    <input type="radio" id="male" name="gender" value="male">
    <label for="male">muz</label><br>
    <input type="radio" id="female" name="gender" value="female">
    <label for="female">zena</label>
    <br><br>
    </div>

    <div class="f2">
    <input type="checkbox" id="modra" name="modra" value="modra">
    <label for="modra"> Modra</label><br>
    <input type="checkbox" id="cervena" name="cervena" value="cervena">
    <label for="cervena"> Cervena</label><br>
    <input type="checkbox" id="zelena" name="zelena" value="zelena">
    <label for="zelena"> Zelena</label><br>
    <input type="checkbox" id="cierna" name="cierna" value="cierna">
    <label for="cierna"> Cierna</label><br>
    <br><br>
    <input type="submit" name="submit" value="Submit">  
    </form>
    </div>
    </div>







    <!--BMI CALCULATOR-->
    <?php
    $height = $weight = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $height = isset($_POST["height"]) ? $_POST["height"] : "";
    $weight = isset($_POST["weight"]) ? $_POST["weight"] : "";    
    }

    
    ?>
        <div class="bmi">

            <h1> Vypocet BMI</h1>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <input type="text" name="weight" placeholder="vaha v kg" value="<?php echo $weight;?>">
    <br><br>
    <input type="text" name="height" placeholder="vyska v cm" value="<?php echo $height;?>">
    <br><br>
    <input type="submit" name="submit" value="Submit">  
    </form>
    </div>

    <?php
        echo "<br>";
        
        if(isset($_POST["height"]) && isset($_POST["weight"]) && $_POST["height"] != "" && $_POST["weight"] != ""){
            $tempColor = "resY";
            $resNum = $weight/(($height/100)*($height/100));
    
            if($resNum >= 18.5){$tempColor = "resG";}
            if($resNum >= 25){$tempColor = "resO";}
            if($resNum >= 40){$tempColor = "resR";}
            echo "<div class=\"".$tempColor."\"> <h1> Vase BMI je: ".$resNum." </h1> </div>";
        }
        else{
            echo "<div class=\""."resW"."\"> <h1> Vase BMI je:  </h1> </div>";
        }

    ?>
</body>
</html>