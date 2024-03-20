<!DOCTYPE html>
<html lang="sk"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <link rel="stylesheet" href="src/button.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" 
     type="image/png" 
     href="src/logo.png">
    <title>Barbershop</title>
    <style>

    </style>
</head>
<script>
function checkWorkingDay() {
    var optionsList = [9, 10, 11, 12, 13, 14, 15, 16];
    const selectedDate = new Date(document.getElementById('date').value);
    const dayOfWeek = selectedDate.getDay();
    var comboBox = document.getElementById("hour");
    comboBox.innerHTML = "";
     
    getReservationsForDay(convertToDateFormat(selectedDate)) 
        .then(bookedDates => {
            const myArray = bookedDates ? bookedDates.map(entry => entry.Hour) : []; 
            for (var i = 0; i < optionsList.length; i++) { 
                
                if (dayOfWeek === 0 || dayOfWeek === 6 ) { 
                    continue;
                }
                
                if(myArray.includes(optionsList[i].toString())) { continue;} 
                
                if(convertToDateFormat(new Date()) === convertToDateFormat(selectedDate) && optionsList[i] <= new Date().getHours()){continue;} 
                var option = document.createElement("option");
                option.text = optionsList[i]+":00"; 
                option.value = optionsList[i].toString();
                comboBox.add(option);
            }
        })
        .catch(error => {
            console.error('Chyba:', error);
        });
}


function getReservationsForDay(date) {
    return new Promise((resolve, reject) => {
        var xhr = new XMLHttpRequest();

        var phpPage = 'get_reservations.php?date=' + date;

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var reservations = JSON.parse(xhr.responseText);
                    resolve(reservations);
                } else {
                    console.error('Chyba pri načítaní rezervácií:', xhr.status, xhr.statusText);
                    reject(xhr.statusText);
                }
            }
        };

        xhr.open('GET', phpPage, true);
        xhr.send();
    });
}


function convertToDateFormat(inputDate) {
    const dateObject = new Date(inputDate);
    
    if (isNaN(dateObject.getTime())) {
        console.error('Neplatný formát dátumu');
        return null;
    }

    const year = dateObject.getFullYear();
    const month = String(dateObject.getMonth() + 1).padStart(2, '0');
    const day = String(dateObject.getDate()).padStart(2, '0');

    return `${year}-${month}-${day}`;
}

</script>

<?php
include 'db_connection.php';


$sql = "SELECT sluzba_id, name,price FROM sluzby";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sluzby = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $sluzby = [];
}

$conn->close();
?>
<body>
    <header>
        <div class="headDiv">
        <h1>Vitajte v našom barbershope</h1>
        <p>Zažite umenie holenia a úpravy v našom prémiovom barbershope.</p>
        </div>
    </header>


    <section style="width:100%;background: linear-gradient(30deg, #0a1921, #35666f);">
        <div class="formSection">
        <h2>Objednajte si termín</h2>
        <p>Vyplňte nižšie uvedený formulár a objednajte si termín.</p>
        <form action="process_reservation.php" method="POST">
            <label for="time">Čas rezervácie:</label>
            <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" required oninput="checkWorkingDay()">

            <br>
            <label for="hour">Vyberte hodinu:</label>
            <select id="hour" name="hour"></select>
            <br>
            <label for="product">Vyberte službu:</label>
            <select name="product" id="product">
                <?php foreach ($sluzby as $product): ?>
                    <option value="<?php echo $product['name']." ".$product['price']."€"; ?>"><?php echo $product['name']." ".$product['price']."€"; ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="firstName">Meno:</label>
            <input type="text" id="firstName" name="firstName" required><br>

            <label for="lastName">Priezvisko:</label>
            <input type="text" id="lastName" name="lastName" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="phoneNumber">Telefónne číslo:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required><br>

            <input type="submit" value="Rezervovať sa">
        </form>

        </div>
    </section>
    <section class="galery">
        <h2 style="text-align:left; padding-left:50px; font-size:90px;">Vyskúšajte náš e-shop</h2>
        <div class="customButton" style="padding-left:250px;">
            <a href="produkty.php" class="button type--A">
                <div class="button__line"></div>
                <div class="button__line"></div>
                <span class="button__text">Nakupovať</span>
                <div class="button__drow1"></div>
                <div class="button__drow2"></div>
            </a>
        </div>
        </section>
    <section class="bottom">
        <div>

            <h2>Kontaktné informácie</h2>
            <p>Pre otázky nás môžete kontaktovať:</p>
            <p>Email: barbershopsoc@gmail.com</p>
            <p>Telefón: +421 123 456-789</p>
            
            <h2>Adresa</h2>
            <p>Navštívte nás na nasledujúcej adrese:</p>
            <p>8 Kempelenova, Žilina, 010 15</p>
        </div>
        <div >
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d774.7233349154218!2d18.746490503201738!3d49.22240398143839!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ssk!2ssk!4v1707342563302!5m2!1ssk!2ssk" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <?php include "footer.html"; ?>
</body>

</html>
