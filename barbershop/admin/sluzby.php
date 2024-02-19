<!DOCTYPE html>
<html lang="en">
<?php include 'header.php';
    include '..\db_connection.php';
    include 'admin_auth.php';
?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Sluzby</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" 
        type="image/png" 
        href="src/logo.png">
        <style>
        .delete-button{
            display: block;
            width: 150px;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
            background-color: red;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }
        .form-container {
            margin-left: auto;
            margin-right: auto;
            width: 30%;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container input[type="text"],
        .form-container input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; 
        }

        .form-container input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: #2f9fff;
        }
        .flex-box {
            display: flex;
            flex-direction: row;
        }
        .flex-box div{
            flex: 1; 
            box-sizing: border-box;
        }
    </style>
</head>


<body>
<div class="container flex-box">
<div >
<h2 style="text-align:center;">Služby</h2>

<table>
    <colgroup>
        <col style="width: 50%;">
        <col style="width: 25%;">
        <col style="width: 25%;">
    </colgroup>
    <tr>
        <th>Názov</th>
        <th>Cena</th>
        <th></th>
    </tr>
    <?php

    $sql = "SELECT * FROM sluzby";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["price"] . "€</td>";
            echo "<td><a class=\"delete-button\" href='delete_service.php?id=" . $row["sluzba_id"] . "'>Odstrániť</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Žiadne Služby nenájdené.</td></tr>";
    }
    $conn->close();
    ?>
</table>

</div>
<div>
<h2 style="text-align:center;">Pridať Službu</h2>
<form action="add_service.php" method="POST" class="form-container">
    <label for="name">Názov:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="price">Cena:</label>
    <input type="number" id="price" name="price" min="1" required ><br>

    <input type="submit" value="Pridať produkt">
</form>
</div>
</div>
<?php include "../footer.html"; ?> 
</body>
</html>
