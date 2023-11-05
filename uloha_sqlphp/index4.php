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

<h1>Pridať novú chorobu</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nazov">Názov:</label>
    <input type="text" id="nazov" name="nazov" required><br><br>
    <label for="typ">Typ:</label>
    <input type="text" id="typ" name="typ" required><br><br>
    <label for="trvanie">Trvanie (dni):</label>
    <input type="number" min="0" id="trvanie" name="trvanie" required><br><br>
    <label for="inkubacna_doba">Inkubačná doba (dni):</label>
    <input type="number" min="0" id="inkubacna_doba" name="inkubacna_doba" required><br><br>
    <label for="priznak_id">Príznak:</label>
<select id="priznak_id" name="priznak_id" required>
    <?php
    // Fetch priznak IDs and names from the "Priznak" table
    $sql = "SELECT Priznak_ID, Nazov FROM Priznak";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["Priznak_ID"] . "'>" . $row["Nazov"] . "</option>";
        }
    } else {
        echo "<option value=''>Nenašli sa žiadne príznaky</option>";
    }
    ?>
</select>
<br />
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
        $typ = $_POST["typ"];
        $trvanie = $_POST["trvanie"];
        $inkubacna_doba = $_POST["inkubacna_doba"];
        $priznak_id = $_POST["priznak_id"];

        // Prepare and execute the SQL statement to insert a new Choroba
        $sql = "INSERT INTO Choroba (Nazov, Typ, Trvanie, Inkubacna_doba, Priznak_ID)
                VALUES ('$nazov', '$typ', '$trvanie', '$inkubacna_doba', '$priznak_id')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Nová choroba bola úspešne pridaná.</p>";
        } else {
            echo "Chyba: " . $sql . "<br>" . $conn->error;
        }
    }
?>
<br /><br />
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nazov_filter">Filtrovať podľa názvu:</label>
    <input type="text" id="nazov_filter" name="nazov_filter" value="<?php echo isset($_POST['nazov_filter']) ? $_POST['nazov_filter'] : ''; ?>">
    <br><br>
    <label for="typ_filter">Filtrovať podľa typu:</label>
    <input type="text" id="typ_filter" name="typ_filter" value="<?php echo isset($_POST['typ_filter']) ? $_POST['typ_filter'] : ''; ?>">
    <br><br>
    <label for="trvanie_filter">Filtrovať podľa trvania:</label>
    <input type="number" id="trvanie_filter" name="trvanie_filter" value="<?php echo isset($_POST['trvanie_filter']) ? $_POST['trvanie_filter'] : ''; ?>">
    <br><br>
    <label for="inkubacna_doba_filter">Filtrovať podľa inkubačnej doby:</label>
    <input type="number" id="inkubacna_doba_filter" name="inkubacna_doba_filter" value="<?php echo isset($_POST['inkubacna_doba_filter']) ? $_POST['inkubacna_doba_filter'] : ''; ?>">
    <br><br>
    <label for="priznak_filter">Filtrovať podľa príznaku:</label>
    <select id="priznak_filter" name="priznak_filter">
        <option value="">Všetky</option>
        <?php
        // Fetch priznak IDs and names from the "Priznak" table
        $sql = "SELECT Priznak_ID, Nazov FROM Priznak";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $selected = (isset($_POST['priznak_filter']) && $_POST['priznak_filter'] == $row['Priznak_ID']) ? 'selected' : '';
                echo "<option value='" . $row["Priznak_ID"] . "' $selected>" . $row["Nazov"] . "</option>";
            }
        } else {
            echo "<option value=''>Nenašli sa žiadne príznaky</option>";
        }
        ?>
    </select>
    <br><br>
    <input type="submit" name="Filter" value="Filtrovať">
</form>

<table>
    <tr>
        <th>ID choroby</th>
        <th>Názov</th>
        <th>Typ</th>
        <th>Trvanie</th>
        <th>Inkubačná doba</th>
        <th>Priznak</th>
    </tr>
    <?php
    $sql = "SELECT Choroba.Choroba_ID, Choroba.Nazov, Choroba.Typ, Choroba.Trvanie, Choroba.Inkubacna_doba, Priznak.Nazov AS Priznak
            FROM Choroba
            INNER JOIN Priznak ON Choroba.Priznak_ID = Priznak.Priznak_ID";
    $result = $conn->query($sql);

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through each row and display the data in the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Choroba_ID"] . "</td>";
            echo "<td>" . $row["Nazov"] . "</td>";
            echo "<td>" . $row["Typ"] . "</td>";
            echo "<td>" . $row["Trvanie"] . "</td>";
            echo "<td>" . $row["Inkubacna_doba"] . "</td>";
            echo "<td>" . $row["Priznak"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Žiadne choroby nenájdené.</td></tr>";
    }

    // Close the connection
    $conn->close();
    ?>
</table>





</body>