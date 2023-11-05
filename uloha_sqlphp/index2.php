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

<h1>Pridať novú nemocnicu</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nazov">Názov:</label>
    <input type="text" id="nazov" name="nazov" required><br><br>
    <label for="stat">Štát:</label>
    <input type="text" id="stat" name="stat" required><br><br>
    <label for="mesto">Mesto:</label>
    <input type="text" id="mesto" name="mesto" required><br><br>
    <label for="pocet_lozok">Počet lôžok:</label>
    <input type="number" id="pocet_lozok" name="pocet_lozok" required><br><br>
    <input type="submit" value="Odoslať" name="odoslat">
</form>
<style>
    input:required:invalid {
        background-color: #ed4a4a;
    }
</style>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["Odoslat"])) {
        // Get the form data
        $nazov = $_POST["nazov"];
        $stat = $_POST["stat"];
        $mesto = $_POST["mesto"];
        $pocet_lozok = $_POST["pocet_lozok"];

        // Prepare and execute the SQL statement to insert a new Nemocnica
        $sql = "INSERT INTO Nemocnica (Nazov, Stat, Mesto, Pocet_Lozok)
                VALUES ('$nazov', '$stat', '$mesto', $pocet_lozok)";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Nová nemocnica bola úspešne pridaná.</p>";
        } else {
            echo "Chyba: " . $sql . "<br>" . $conn->error;
        }
    }
?>
<br><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nazov_filter">Filtrovať podľa názvu:</label>
    <input type="text" id="nazov_filter" name="nazov_filter" value="<?php echo isset($_POST['nazov_filter']) ? $_POST['nazov_filter'] : ''; ?>">
    <br><br>
    <label for="stat_filter">Filtrovať podľa štátu:</label>
    <input type="text" id="stat_filter" name="stat_filter" value="<?php echo isset($_POST['stat_filter']) ? $_POST['stat_filter'] : ''; ?>">
    <br><br>
    <label for="mesto_filter">Filtrovať podľa mesta:</label>
    <input type="text" id="mesto_filter" name="mesto_filter" value="<?php echo isset($_POST['mesto_filter']) ? $_POST['mesto_filter'] : ''; ?>">
    <br><br>
    <label for="lozka_filter">Filtrovať podľa počtu lôžok:</label>
    <input type="number" id="lozka_filter" name="lozka_filter" value="<?php echo isset($_POST['lozka_filter']) ? $_POST['lozka_filter'] : ''; ?>">
    <br><br>
    <input type="submit" name="Filter" value="Filtrovať">
</form>




<table>
    <tr>
        <th>ID nemocnice</th>
        <th>Názov</th>
        <th>Štát</th>
        <th>Mesto</th>
        <th>Počet lôžok</th>
    </tr>
    <?php
    // Get the filter values
    if (isset($_POST["Filter"])) {
        $nazov_filter = $_POST["nazov_filter"];
        $stat_filter = $_POST["stat_filter"];
        $mesto_filter = $_POST["mesto_filter"];
        $lozka_filter = $_POST["lozka_filter"];

        $sql = "SELECT * FROM Nemocnica
                WHERE LOWER(Nazov) LIKE '%$nazov_filter%'
                AND LOWER(Stat) LIKE '%$stat_filter%'
                AND LOWER(Mesto) LIKE '%$mesto_filter%'";

        if($lozka_filter != '0'){
            $sql .= "AND Pocet_Lozok = $lozka_filter";
        }

    } else {
        $sql = "SELECT * FROM Nemocnica";
    }

    $result = $conn->query($sql);

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through each row and display the data in the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nemocnica_ID"] . "</td>";
            echo "<td>" . $row["Nazov"] . "</td>";
            echo "<td>" . $row["Stat"] . "</td>";
            echo "<td>" . $row["Mesto"] . "</td>";
            echo "<td>" . $row["Pocet_Lozok"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Nenašli sa žiadne nemocnice.</td></tr>";
    }

    // Close the connection
    $conn->close();
    ?>
</table>



</body>