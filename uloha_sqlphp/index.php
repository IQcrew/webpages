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

    <h1>Pridať nového pacienta</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="rodne_cislo">Rodné číslo:</label>
    <input type="text" id="rodne_cislo" name="rodne_cislo" required><br><br>
    <label for="meno">Meno:</label>
    <input type="text" id="meno" name="meno" required><br><br>
    <label for="priezvisko">Priezvisko:</label>
    <input type="text" id="priezvisko" name="priezvisko" required><br><br>
    <label for="datum_narodenie">Dátum narodenia:</label>
    <input type="date" id="datum_narodenie" name="datum_narodenie" required><br><br>
    <label for="nemocnica_id">Nemocnica:</label>
    <select id="nemocnica_id" name="nemocnica_id" required>
        <?php
        // Fetch hospital IDs and names from the "Nemocnica" table
        $sql = "SELECT Nemocnica_ID, Nazov FROM Nemocnica";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["Nemocnica_ID"] . "'>" . $row["Nazov"] . "</option>";
            }
        } else {
            echo "<option value=''>Nenašli sa žiadne nemocnice</option>";
        }
        ?>
    </select><br><br>
    <input type="submit" value="Odoslat" name="Odoslat">
</form>
        <style>
        input:required:invalid {
        background-color: #ed4a4a;
 
        }
        </style>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["Odoslat"])) {
        // Get the form data
        $rodne_cislo = $_POST["rodne_cislo"];
        $meno = $_POST["meno"];
        $priezvisko = $_POST["priezvisko"];
        $datum_narodenie = $_POST["datum_narodenie"];
        $nemocnica_id = $_POST["nemocnica_id"];

        // Prepare and execute the SQL statement to insert a new patient
        $sql = "INSERT INTO Pacient (Rodne_cislo, Meno, Priezvisko, Datum_narodenie, Nemocnica_ID)
                VALUES ('$rodne_cislo', '$meno', '$priezvisko', '$datum_narodenie', $nemocnica_id)";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Nový pacient bol úspešne pridaný.</p>";
        } else {
            echo "Chyba: " . $sql . "<br>" . $conn->error;
        }
        $_POST = array(); 
    }
    ?>


<br/><br/>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="rodne_cislo_filter">Filtrovať podľa rodného čísla:</label>
    <input type="text" id="rodne_cislo_filter" name="rodne_cislo_filter" value="<?php echo isset($_POST['rodne_cislo_filter']) ? $_POST['rodne_cislo_filter'] : ''; ?>">
    <br><br>
    <label for="meno_filter">Filtrovať podľa mena:</label>
    <input type="text" id="meno_filter" name="meno_filter" value="<?php echo isset($_POST['meno_filter']) ? $_POST['meno_filter'] : ''; ?>">
    <br><br>
    <label for="priezvisko_filter">Filtrovať podľa priezviska:</label>
    <input type="text" id="priezvisko_filter" name="priezvisko_filter" value="<?php echo isset($_POST['priezvisko_filter']) ? $_POST['priezvisko_filter'] : ''; ?>">
    <br><br>
    <label for="datum_narodenie_filter">Filtrovať podľa dátumu narodenia:</label>
    <input type="date" id="datum_narodenie_filter" name="datum_narodenie_filter" value="<?php echo isset($_POST['datum_narodenie_filter']) ? $_POST['datum_narodenie_filter'] : ''; ?>">
    <br><br>
    <label for="nemocnica_filter">Filtrovať podľa nemocnice:</label>
    <select id="nemocnica_filter" name="nemocnica_filter">
        <option value="">Všetky</option>
        <?php
        // Fetch hospital IDs and names from the "Nemocnica" table
        $sql = "SELECT Nemocnica_ID, Nazov FROM Nemocnica";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $selected = (isset($_GET['nemocnica_filter']) && $_GET['nemocnica_filter'] == $row['Nemocnica_ID']) ? 'selected' : '';
                echo "<option value='" . $row["Nemocnica_ID"] . "' $selected>" . $row["Nazov"] . "</option>";
            }
        } else {
            echo "<option value=''>Nenašli sa žiadne nemocnice</option>";
        }
        ?>
    </select>
    <br><br>
    <input type="submit" name="Filter" value="Filtrovat">
</form>

<table>
    <tr>
        <th>ID pacienta</th>
        <th>Rodné číslo</th>
        <th>Meno</th>
        <th>Priezvisko</th>
        <th>Dátum narodenia</th>
        <th>Nemocnica</th>
    </tr>
    <?php
    // Get the filter values
    if(isset($_POST["Filter"])){

    $rodne_cislo_filter = $_POST["rodne_cislo_filter"];
    $meno_filter = $_POST["meno_filter"];
    $priezvisko_filter = $_POST["priezvisko_filter"];
    $datum_narodenie_filter = $_POST["datum_narodenie_filter"];
    $nemocnica_filter = $_POST["nemocnica_filter"];

    $sql = "SELECT Pacient.Pacient_ID, Pacient.Rodne_cislo, Pacient.Meno, Pacient.Priezvisko, Pacient.Datum_narodenie, Nemocnica.Nazov AS Nemocnica
            FROM Pacient
            INNER JOIN Nemocnica ON Pacient.Nemocnica_ID = Nemocnica.Nemocnica_ID
            WHERE LOWER(Pacient.Rodne_cislo) LIKE '%$rodne_cislo_filter%'
            AND LOWER(Pacient.Meno) LIKE '%$meno_filter%'
            AND LOWER(Pacient.Priezvisko) LIKE '%$priezvisko_filter%'
            AND ('$datum_narodenie_filter' = '' OR Pacient.Datum_narodenie = '$datum_narodenie_filter')";

        if(!isset($nemocnica_filter) or $nemocnica_filter != ''){
            $sql .= "AND ('$nemocnica_filter' = '' OR Pacient.Nemocnica_ID = $nemocnica_filter)";
        }
    }
    else{
        $sql = "SELECT Pacient.Pacient_ID, Pacient.Rodne_cislo, Pacient.Meno, Pacient.Priezvisko, Pacient.Datum_narodenie, Nemocnica.Nazov AS Nemocnica
        FROM Pacient
        INNER JOIN Nemocnica ON Pacient.Nemocnica_ID = Nemocnica.Nemocnica_ID";
    }
    $result = $conn->query($sql);

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Loop through each row and display the data in the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Pacient_ID"] . "</td>";
            echo "<td>" . $row["Rodne_cislo"] . "</td>";
            echo "<td>" . $row["Meno"] . "</td>";
            echo "<td>" . $row["Priezvisko"] . "</td>";
            echo "<td>" . $row["Datum_narodenie"] . "</td>";
            echo "<td>" . $row["Nemocnica"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Žiadni pacienti nenájdení.</td></tr>";
    }

    // Close the connection
    $conn->close();
    ?>
</table>



</body>

</html>