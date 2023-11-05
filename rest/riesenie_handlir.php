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
            foreach ($pole as $temp){
                if(gettype($temp) == 'array') {
                    vypisPole($temp);
                }
                else{
                    echo "$temp <br>";
                }
            }
            
        }
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

    vypisPole($pole8);
    ?>
</body>
</html>