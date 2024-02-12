<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sluzby</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" 
     type="image/png" 
     href="src/logo.png">
    <style>

    </style>
</head>
<body>
<div class="container">
<h2 style="text-align:center;">Produkty</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Názov</th>
        <th>Cena</th>
        <th>Akcia</th>
    </tr>
    <?php
    include '..\db_connection.php';
    include 'admin_auth.php';
    $sql = "SELECT * FROM sluzby";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["sluzba_id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td><a href='delete_service.php?id=" . $row["sluzba_id"] . "'>Odstrániť</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Žiadne produkty nenájdené.</td></tr>";
    }
    $conn->close();
    ?>
</table>
</div>
<br>
<div class="container">
<h2 style="text-align:center;">Pridať produkt</h2>
<form action="add_service.php" method="POST" style="margin-left:auto;margin-right:auto; width:30%;">
    <label for="name">Názov:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="price">Cena:</label>
    <input type="number" id="price" name="price" min="1" required ><br>

    <input type="submit" value="Pridať produkt">
</form>
</div>
</body>
</html>
