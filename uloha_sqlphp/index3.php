<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Databaza</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
    require_once("header.php");
    require_once("connect.php");
?>

<h1>Pridať nový príznak</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nazov">Názov:</label>
    <input type="text" id="nazov" name="nazov" required><br><br>
    <label for="popis">Popis:</label>
    <input type="text" id="popis" name="popis" required><br><br>
    <label for="oblast">Oblast:</label>
    <input type="text" id="oblast" name="oblast" required><br><br>
    <label for="zavaznost">Závažnosť:</label>
    <select id="zavaznost" name="zavaznost" required>
        <option value="Vysoká">Vysoká</option>
        <option value="Nízka">Nízka</option>
        <option value="Mala">Mala</option>
    </select>
    <br />
    <input type="submit" value="Odoslať" value="Odoslat">
</form>
<style>
    input:required:invalid {
        background-color: #ed4a4a;
    }
</style>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"  and isset($_POST["Odoslat"])) {
    // Get the form data
    $nazov = $_POST["nazov"];
    $popis = $_POST["popis"];
    $oblast = $_POST["oblast"];
    $zavaznost = $_POST["zavaznost"];

    // Prepare and execute the SQL statement to insert a new priznak
    $sql = "INSERT INTO Priznak (Nazov, Popis, Oblast, Zavaznost)
            VALUES ('$nazov', '$popis', '$oblast', '$zavaznost')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Nový príznak bol úspešne pridaný.</p>";
    } else {
        echo "Chyba: " . $sql . "<br>" . $conn->error;
    }
    $_POST = array();
}
?>

<br><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nazov_filter">Filtrovať podľa názvu:</label>
    <input type="text" id="nazov_filter" name="nazov_filter" value="<?php echo isset($_POST['nazov_filter']) ? $_POST['nazov_filter'] : ''; ?>">
    <br><br>
    <label for="popis_filter">Filtrovať podľa popisu:</label>
    <input type="text" id="popis_filter" name="popis_filter" value="<?php echo isset($_POST['popis_filter']) ? $_POST['popis_filter'] : ''; ?>">
    <br><br>
    <label for="oblast_filter">Filtrovať podľa oblasti:</label>
    <input type="text" id="oblast_filter" name="oblast_filter" value="<?php echo isset($_POST['oblast_filter']) ? $_POST['oblast_filter'] : ''; ?>">
    <br><br>
    <label for="zavaznost_filter">Filtrovať podľa závažnosti:</label>
    <input type="text" id="zavaznost_filter" name="zavaznost_filter" value="<?php echo isset($_POST['zavaznost_filter']) ? $_POST['zavaznost_filter'] : ''; ?>">
    <br><br>
    <input type="submit" name="Filter" value="Filtrovať">
</form>


<table>
    <tr>
        <th>ID príznaku</th>
        <th>Názov</th>
        <th>Popis</th>
        <th>Oblast</th>
        <th>Závažnosť</th>
    </tr>
    <?php
    // Get the filter values
    if (isset($_POST["Filter"])) {
        $nazov_filter = $_POST["nazov_filter"];
        $popis_filter = $_POST["popis_filter"];
        $oblast_filter = $_POST["oblast_filter"];
        $zavaznost_filter = $_POST["zavaznost_filter"];

        $sql = "SELECT * FROM Priznak
                WHERE LOWER(Nazov) LIKE '%$nazov_filter%'
                AND LOWER(Popis) LIKE '%$popis_filter%'
                AND LOWER(Oblast) LIKE '%$oblast_filter%'
                AND LOWER(Zavaznost) LIKE '%$zavaznost_filter%'";
    } else {
        $sql = "SELECT * FROM Priznak";
    }

    $result = $conn->query($sql);

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through each row and display the data in the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Priznak_ID"] . "</td>";
            echo "<td>" . $row["Nazov"] . "</td>";
            echo "<td>" . $row["Popis"] . "</td>";
            echo "<td>" . $row["Oblast"] . "</td>";
            echo "<td>" . $row["Zavaznost"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Nenašli sa žiadne príznaky.</td></tr>";
    }

    // Close the connection
    $conn->close();
    ?>
</table>



</body>