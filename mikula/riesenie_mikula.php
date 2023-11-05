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
        $pole15 = [
            [80,60,40,20],
            "čaj",
            [
                "káva",
                "kofola",
                "kláštorná"
            ],
            [
                [
                    "minerálka",
                    "rajec",
                    "voda"
                ],
                [
                    "mlieko",
                    "sirup",
                    "džús",
                ],
                [
                    "pepsi",
                    "coca cola"
                ]
            ],
            [
                "pramenitá",
                [
                    "perlivá",
                    "neperlivá"
                ],
                39,
                "bublinky"
            ]
        ];

    function rozbalPole($pole) {
        foreach ($pole as $element){
            if(gettype($element) == 'array') {
                rozbalPole($element);
            }
            else{
                echo "$element <br>";
            }
        }
        
    }
    print_r($pole15);

    echo "<pre>";
    print_r($pole15);
    echo "</pre>";
    ?>
</body>
</html>