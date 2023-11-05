<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $pole8 = [
            "rastliny",
            [
                "buk",
                "smrek",
                "lipy"
            ],
            [5,0,58,900],
            [
                [
                    "listy",
                    "ihličie"
                ],
                [
                    "tulipán",
                    "ruža",
                    "sedmokráska"
                ],
                [
                    "slnečnica",
                    "podbeľ",
                ]
            ],
            [
                "lieska",
                [
                    "orech",
                    "plod"
                ],
                60,
                "strom"
            ]
        ];

    for ($i=0; $i < count($pole8) ; $i++) { 
        if($i == 0){
            echo $pole8[$i];
            echo "<br>";
        }
        if($i == 1 || $i == 2){
            foreach ($pole8[$i] as $val) {
                echo $val;
                echo "<br>";
            }
        }
        if($i == 3){
            foreach($pole8[$i] as $val){
                foreach($val as $el){
                    echo $el;
                    echo "<br>";
                }
            }
        }
        if ($i == 4){
            for($x =0; $x< count($pole8[$i]); $x++){
                if($x == 1){
                    foreach($pole8[$i][$x] as $val){
                        echo $val;
                        echo "<br>";
                    }
                }
                else {
                    echo $pole8[$i][$x];
                    echo "<br>";
                }
            }
        }
    }
    ?>
</body>
</html>