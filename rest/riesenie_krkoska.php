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
        function vypisPole($pole) {
            foreach ($pole as $prvok){
                if(gettype($prvok) == 'array') {
                    vypisPole($prvok);
                }
                else{
                    echo "$prvok <br>";
                }
            }
            
        }
        $pole1 = [
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

    vypisPole($pole1);
    ?>
</body>
</html>