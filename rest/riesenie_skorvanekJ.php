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


        function PoleVypis($pole) {
            foreach ($pole as $prvok){
                if(is_array($prvok)) {PoleVypis($prvok);}
                else{echo "$prvok <br>";}
            }
        }
        $pole8 = [
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

    PoleVypis($pole8);
    ?>
</body>
</html>