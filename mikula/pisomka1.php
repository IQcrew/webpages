<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    
    <?php
        function Pole_Generator()
        {
            $pole = [];
            for ($i=0; $i < rand(20,30); $i++) {
                $tmp_pole = [];
                for ($j=0; $j < rand(5,10); $j++) { 
                    $tmp_pole[] = rand(0,9);
                }
                $pole[] = $tmp_pole;
            }
            return $pole;
        }

        

        echo "<br>";
        echo "<br>";

        //1.
        // Vypíš pole vygenerované funkciou Pole_Generator()
        // Zariadte aby bol výpis tvarovo rovnaký ako v ukážke

        /*
            3 | 2 | 0 | 9 | 3 | 9 | 3 |
            6 | 8 | 4 | 5 | 7 |
            4 | 0 | 2 | 6 | 7 | 0 | 6 | 7 |
            4 | 3 | 9 | 6 | 7 | 5 |
            0 | 7 | 7 | 4 | 2 | 8 |
            6 | 3 | 7 | 1 | 4 | 0 |
            7 | 0 | 1 | 4 | 4 | 8 | 1 | 8 |
            2 | 0 | 9 | 7 | 4 | 6 | 2 | 6 | 4 |
            4 | 0 | 4 | 7 | 3 | 8 | 0 | 6 |
            3 | 6 | 1 | 0 | 6 | 3 | 4 |
            8 | 5 | 2 | 6 | 0 |
            9 | 8 | 2 | 6 | 7 |
            5 | 8 | 1 | 7 | 4 | 8 | 8 |
            3 | 2 | 6 | 2 | 2 | 1 |
            9 | 8 | 8 | 8 | 0 | 1 | 0 | 8 |
            7 | 8 | 3 | 3 | 9 | 8 | 4 |
            1 | 1 | 6 | 3 | 6 | 9 |
            9 | 0 | 8 | 8 | 9 | 2 | 8 | 4 |
            3 | 0 | 0 | 8 | 5 | 3 | 6 | 3 |
            5 | 6 | 8 | 6 | 2 | 9 |
            5 | 7 | 4 | 1 | 4 |
            1 | 5 | 2 | 9 | 5 | 2 | 0 | 5 |
            1 | 0 | 3 | 6 | 5 | 7 | 5 | 2 |
            2 | 6 | 0 | 4 | 7 |
            6 | 4 | 0 | 3 | 6 | 6 | 9 | 9 | 5 |
            8 | 0 | 4 | 6 | 6 |
        */


//  ------------- Uloha 1 Riešenie ------------------------------------------------------

        $pole = Pole_Generator();
        
        foreach ($pole as $p){
            foreach ( $p as $k){
                echo " ", $k, " |";
            }
            echo "<br>";
        }

        
//  ------------- Uloha 1 Riešenie ------------------------------------------------------

        
        echo "<br>";
        echo "<br>";

        //2.
        // Sprav funkciu Obvod(), ktorej pošleš 2 čísla, a ona ti vráti obvod obdlžníka 
        //vypočítaného pomocou týchto 2 čisiel. 
        //napr. echo Obvod(2,4); vypíše 12



//  ------------- Uloha 2 Riešenie ------------------------------------------------------


        function Obvod($a, $b){
            return ($a+$b)*2;
        }


//  ------------- Uloha 2 Riešenie ------------------------------------------------------

        echo Obvod(2,4);  // 12
        
        echo "<br>";
        echo "<br>";

        //3..
        // Pomocou cyklu foreach vypíšte pole $ludia, pričom každého človeka vo vnútri pola $ludia vypíšete v nasledujúcom tvare
        // (Meno) (Priezvisko) má email: (Email) a má (Farba trička) tričko. <br>
        // Napr. Jozef Mrkva má email: jozefmrkva@gmail.com a má červené tričko.

        $ludia = [
            [
                "meno"=>"Jozef",
                "priezvisko"=>"Mrkva",
                "email"=>"jozefmrkva@gmail.com",
                "tricko"=>"červené"
            ],
            [
                "meno"=>"Palo",
                "priezvisko"=>"Zajac",
                "email"=>"palozajac@gmail.com",
                "tricko"=>"modré"
            ],
            [
                "meno"=>"Jan",
                "priezvisko"=>"Smrek",
                "email"=>"jansmrek@gmail.com",
                "tricko"=>"biele"
            ],
        ]
        ;



//  ------------- Uloha 3 Riešenie ------------------------------------------------------


foreach( $ludia as $person){
    echo sprintf("%s %s má email: %s a má %s tričko. <br>", $person["meno"], $person["priezvisko"], $person["email"], $person["tricko"]);
}

//  ------------- Uloha 3 Riešenie ------------------------------------------------------
        

         echo "<br>";
         echo "<br>";

        //4.
        //Sprav funkciu Calculator(), ktorej pošlete 2 čísla a jeden string v ktorom bude jeden z tychto 
        //znakov : +, -, /, * . Následne funkcia vráti vysledok, ktorý vznikne použitím poslaného 
        //znamienka a 2 poslaných čísiel ..... napr   echo Calculator("+",1,2); vypíše 3


//  ------------- Uloha 4 Riešenie ------------------------------------------------------

        function Calculator($operator, $a, $b){
            return eval("return $a $operator $b ;");
        }


//  ------------- Uloha 4 Riešenie ------------------------------------------------------

        echo Calculator("+",1,2);  //3
        echo "<br>";
        echo "<br>";

        


        //5.
        // Vypíš každé 10 číslo od 0 až po 1000
        // Po každom vypísanom čísle napíšte echo "<br>";


//  ------------- Uloha 5 Riešenie ------------------------------------------------------

        for($i = 0; $i < 1000; $i+=10){
            echo $i;
            echo "<br>";
        }

//  ------------- Uloha 5 Riešenie ------------------------------------------------------
        

        echo "<br>";
        echo "<br>";


    ?>


</body>
</html>