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
    $pole12 = [
        "Mor ho",
        [
        "Štúr",
        "Botto",
        "Kráľ"
        ],
        [92,912,365],
        [
        [
        "Devín",
        "Marína",
        ],
        [
        "poézia",
        "próza",
        ],
        [
        "epika",
        "lyrika",
        "dráma"
        ]
        ],
        [
        "román",
        "poviedka",
        80,
        [
        "novela",
        "báseň",
        "pieseň"
        ]
        ]
        ];

    for ($i = 0; $i < count($pole12); $i++){
        if($i == 0 ){
            echo $pole12[$i];
            echo "<br>";
        }
        else if($i == 1 || $i == 2){
            foreach ($pole12[$i] as $el){
                echo "$el";
                echo "<br>";
            }
        }
        else{
            foreach ($pole12[$i] as $el){
                if(is_array($el)){
                    foreach ( $el as $val ){
                        echo "$val";
                        echo "<br>";
                    }
                }
                else{
                    echo "$el";
                    echo "<br>";
                }
            
            
            
            }
        }
    }
    ?>
</body>
</html>