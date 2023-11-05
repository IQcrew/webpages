<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP - TEST</title>
</head>
<body>
    <?php
        //--------------------------------------------------------------------------
        echo "Cast 1 ------------------------------------------<br><br>";
        //--------------------------------------------------------------------------
        // Vytvorte dve premenné s názvami : produkt a cena

        $produkt = "pracka";
        $cena = 450;

        $withDPH = $cena*1.19;

        echo sprintf("Produkt %s má cenu s DPH: %.2f", $produkt, $withDPH);


        // Vypočítajte do novej premennej : cenaDPH , vzorec: y = (x/100) *119
        // Vypíšte vypočítanú cenu s dph v tvare: Produkt {Názov produktu} má cenu s DPH: {cena s dph} . 

        





        //--------------------------------------------------------------------------
        echo "<br>Cast 2 ------------------------------------------<br><br>";
        //--------------------------------------------------------------------------

        //Vytvorte funkciu calcDPH, kde pošlete jednu premennu (budete tam posielat cenu)
        //Funckia vám vráti cenu s dph pomocou return

        

        function calcDPH($cena){
            return $cena*1.19;
        }


        //Vytvorte si premennu, do ktorej vložíte hodnotu, ktorú vám vráti funkcia calcDPH
        // Vypíšte vypočítanú cenu s dph v tvare: Produkt {Názov produktu} má cenu s DPH: {cena s dph - premenna, do ktorej ste uložili výsledok funkcie} . 

        $produkt = "tomas kulla";
        $cena = 2;

        $withDPH = calcDPH($cena);
        echo sprintf("Produkt %s má cenu s DPH: %.2f", $produkt, $withDPH);




        //--------------------------------------------------------------------------
        echo "<br>Cast 3 ------------------------------------------<br><br>";
        //--------------------------------------------------------------------------

        // Vytvorte indexové (klasické) pole, kde na 0 indexe je meno produktu, 1 indexe je cena bez dph a na 2 je cena s dph 
        // Pri vytváraní pola použite už vytvorené premenné
        
        $pole = [$produkt, $cena, $withDPH];




        //Vypíšte cez for postupne každý prvok z pola ktoré ste práve vytvorili
        

        foreach($pole as $p){
            echo $p;
            echo "    ";
        }




        //--------------------------------------------------------------------------
        echo "<br>Cast 4 ------------------------------------------<br><br>";
        //--------------------------------------------------------------------------

        //vytvorte associatívne pole kde budú 3 kľúče spojené s 3 hodnotami
        // 1. kľúč bude "nazov" a hodnota na tomto kľúči(indexe) bude názov produktu
        // 2. kľúč bude "cena" a hodnota na ňom bude cena produktu
        // 3. kľúč bude "cenaDPH" a hodnota na ňom bude cena s dph
        // pri vytváraní pola pužite znova premenné ako v minulom poli

        
        $produktik = array(
            "nazov" => $produkt,
            "cena" => $cena,
            "cenaDPH" => $withDPH,
        );
        




         //Vypíšte cez foreach postupne každý prvok z associatívneho poľa, ktoré ste práve vytvorili
         //Takto vypíšete každý kľúč a každú hodnotu v tvare: {kľúč} je {hodnota} --- (bude to vypísané 3 krát, pod sebou) 


        foreach ($produktik as $key => $value){
            echo sprintf("%s je %s <br>", $key, $value);
        }



        //--------------------------------------------------------------------------
        echo "<br>Cast 5 ------------------------------------------<br><br>";
        //--------------------------------------------------------------------------

        //Vytvorte funkciu vypisProduktu kde pošlete vami vytvorene asociatívne pole a cez echo vám funkcia vypíše obsah pola v tvare:
        //"Produkt {názov produktu} má cenu s DPH: {cena s dph}
        
        function vypisProduktu($dictonary){
            echo sprintf("Produkt %s má cenu s DPH: %s <br>", $dictonary["nazov"], $dictonary["cenaDPH"]);
        }





        //Funkci vypisProduktu zavoláte s parametrom, ktorým je predchádzajúce pole (vypíše vám obsah poľa v danom tvare)
        
        vypisProduktu($produktik);




        //--------------------------------------------------------------------------
        echo "<br>Cast 6 ------------------------------------------<br><br>";
        //--------------------------------------------------------------------------

        //vytvorte si asociatívne pole kde budú 2 hodnoty (nejaký produkt2)
        //1. kluc bude "nazov" a hodnota s ním spojená bude "Mlieko"
        //2. kluc bude "cena" a hodnota s ním spojená bude 5
        
        $produkt2 = [
            "nazov" => "mlieko",
            "cena" => 5,
        ];


        function pridajDPH($dictonary){
            $dictonary["cenaDPH"] = calcDPH($dictonary["cena"]);
            return $dictonary;
        }

        //Do vami práve vyvoreného poľa dajte novú hodnotu, ktorej kľúč bude "cenaDPH".
        //Na tomto kľúči(indexe) bude hodnota, ktorú vám vráti funkcia na vpočítanie ceny s dph calcDPH
        //pri volaní tejto funkcie bude ako parameter posielat cenu z poľa, ktoré ste naposledy vytvorili (ako premennú, nie iba 5 !)



        $produkt2 = pridajDPH($produkt2);

        //Zavolajte funkciu vypisProduktu a pošlite do nej pole, ktoré ste naposledy vytvorili (produkt2)
        vypisProduktu($produkt2);




        //--------------------------------------------------------------------------
        echo "<br>Cast 7 ------------------------------------------<br><br>";
        //--------------------------------------------------------------------------

        //vytvorte indexové (klasické) pole s názvom produkty, kde budú 2 prvky, tieto prvky budu tie 2 asociatívne polia, ktoré ste doteraz vytvorili (produkt, produkt2)
        

        $pole2 = [$produktik, $produkt2];



        //cez for prejdite pole produkty a každý prvok poslite do funkcie vypisProduktu
        foreach($pole2 as $tmp){
            vypisProduktu($tmp);
        }




        
        //--------------------------------------------------------------------------


    ?>
</body>
</html>








