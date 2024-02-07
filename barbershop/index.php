<!DOCTYPE html>
<html lang="sk"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">
    <title>Holičstvo</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        section {
            margin: 30px;
        }
        header {
            display: flex;
            justify-content: space-around;
            height: 100vh; /* 100% of the viewport height */
            width: 100%;
            background-image: url("src/barber1.png");
            background-size: cover; /* Ensure the background image covers the entire header */
            position: relative; /* Create a stacking context for absolute positioning */
        }
        .galery{
            height: 70vh; /* 100% of the viewport height */
            width: 100%;
            background-image: url("src/barber1.png");
            background-size: cover; /* Ensure the background image covers the entire header */
            position: relative; /* Create a stacking context for absolute positioning */
        }

        section h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2em;
            font-size: 50px;
            color: white;
            text-align: center;
            text-shadow: 2px 2px 4px #000000;
        }

        section p {
            font-family: 'Dancing Script', cursive;
            font-size: 2em;
            font-size: 30px;
            color: white;
            text-align: center;
            text-shadow: 2px 2px 4px #000000;
        }
        .headDiv p{
            font-family: 'Dancing Script', cursive;
            font-size: 2em;
            font-size: 50px;
            color: white;
            text-align: center;
            text-shadow: 2px 2px 4px #000000;
        }
        .headDiv h1 {
            text-align: center;
            padding-top: 30vh;
            font-family: 'Dancing Script', cursive;
            font-size: 2em;
            font-size: 80px;
            color: white;
            text-shadow: 2px 2px 4px #000000;
        }
        .formSection{
            
        }
    </style>
</head>
<script>
function checkWorkingDay() {
    var optionsList = [9, 10, 11, 12, 13, 14, 15, 16];
    const selectedDate = new Date(document.getElementById('date').value);
    const dayOfWeek = selectedDate.getDay();
    var comboBox = document.getElementById("hour");
    comboBox.innerHTML = "";

    getReservationsForDay()
        .then(bookedDates => {
            const myArray = [];
            for (var i = 0; i < bookedDates.length; i++){
                myArray.push(bookedDates[i]["Hour"]);
            }
            for (var i = 0; i < optionsList.length; i++) {
                if (dayOfWeek === 0 || dayOfWeek === 6 ) {
                    continue;
                }
                if(myArray.includes(optionsList[i].toString())) { continue;}
                if(datesHaveSameDayMonthYear(new Date(), selectedDate) && optionsList[i] <= new Date().getHours()){continue;}
                var option = document.createElement("option");
                option.text = optionsList[i];
                comboBox.add(option);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
function datesHaveSameDayMonthYear(date1, date2) {
    return date1.getDay() === date2.getDay() &&
           date1.getMonth() === date2.getMonth() &&
           date1.getFullYear() === date2.getFullYear();
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
                    console.error('Error fetching reservations:', xhr.status, xhr.statusText);
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
    
    // Check if the date is valid
    if (isNaN(dateObject.getTime())) {
        console.error('Invalid date format');
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

// Fetch data from the 'products' table
$sql = "SELECT product_id, name,price FROM products";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $products = [];
}

$conn->close();
?>
<body>
    <header>
        <div class="headDiv">
        <h1>Vitajte v našom holičstve</h1>
        <p>Zažite umenie holenia a úpravy v našom prémiovom holičstve.</p>
        </div>
    </header>


    <section>
        <div class="formSection">
        <h2>Objednajte si termín</h2>
        <p>Vyplňte nižšie uvedený formulár a objednajte si termín u nášho skúseného holiča.</p>
        <form action="process_reservation.php" method="POST">
            <label for="time">Reservation Time:</label>
            <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" required oninput="checkWorkingDay()">

            <br>
            <label for="hour">Select an hour:</label>
            <select id="hour" name="hour"></select>
            <br>
            <label for="product">Choose a product:</label>
            <select name="product" id="product">
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['name']." ".$product['price']."€"; ?>"><?php echo $product['name']." ".$product['price']."€"; ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required><br>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required><br>

            <input type="submit" value="Submit">
        </form>
        </div>
    </section>
    <section class="galery">
    </section>
    <section>
        <h2>Kontaktné informácie</h2>
        <p>Pre otázky nás môžete kontaktovať:</p>
        <p>Email: info@holicka.com</p>
        <p>Telefón: +421 123 456-789</p>

        <h2>Adresa</h2>
        <p>Navštívte nás na nasledujúcej adrese:</p>
        <p>123 Holícka ulica, Žilina, 010 01</p>

        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d162.86207600698705!2d18.739758074050453!3d49.22344859497971!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ssk!2ssk!4v1707149682095!5m2!1ssk!2ssk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>


</body>
</html>
