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
        $pole6 = [
            [
                "pes",
                "mačka",
                "zebra"
            ],
            "zvieratá",
            [
                [
                    "medveď",
                    "líška",
                    "vlk"
                ],
                [
                    "veverička",
                    "svišť",
                    "diviak"
                ],
                [
                    "včela",
                    "chrobák"
                ]
            ],
            [60,1,5,223],
            [
                "kačka",
                45,
                [
                    "vták",
                    "šelma",
                    "cicavce"
                ],
                "drozd"
            ]
        ];

    for ($i=0; $i < count($pole6) ; $i++) { 
        if($i == 0 || $i == 3){
            foreach ($pole6[$i] as $val) {
                echo $val;
                echo "<br>";
            }
        }
        if($i == 1){
            echo $pole6[$i];
            echo "<br>";
        }
        if($i == 2){
            foreach($pole6[$i] as $val){
                foreach($val as $el){
                    echo $el;
                    echo "<br>";
                }
            }
        }
        if ($i == 4){
            for($x =0; $x< count($pole6[$i]); $x++){
                if($x == 2){
                    foreach($pole6[$i][$x] as $val){
                        echo $val;
                        echo "<br>";
                    }
                }
                else {
                    echo $pole6[$i][$x];
                    echo "<br>";
                }
            }
        }
    }
    ?>
</body>
</html>