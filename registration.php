<?php  
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>registration</title>
</head>

<body>

    <div class="back-button">
        <a href="login.php"><i class="fa-solid fa-arrow-left" style="color: #000000;"></i></a>
    </div>

    <div class="form-wrapper">
        <p class="welcome-title">Create account</p>
        <form method="post">
            <input class="user-input" type="text" name="FultNavn" placeholder="Fult Navn" required /><br />
            <input class="user-input" type="password" name="passord" placeholder="Password" required /><br />
            <input class="user-input" type="number" name="TelefonNummer" placeholder="TelefonNummer" required /><br />


            <a href="registration.php"><button class="user-button" type="submit" value="Logg inn"
                    name="submit">Create</button></a>
            <p class="redirection-regi" style="text-align: center; padding: 30px 0 0 0; color: #333;">Har du en bruker?
                klikk <a href="login.php"> Her </a>vis du vil logge inn igjen</p>
        </form>
    </div>




    <?php
    if (isset($_POST['submit'])) {
        //Gjøre om POST-data fra formen til variabler
        $FultNavn = $_POST['FultNavn'];
        $Password = md5($_POST['passord']);
        $TelefonNummer = $_POST['TelefonNummer'];

        //Koble til databasen 
        $dbc = mysqli_connect('localhost', 'root', '', 'barevifter')
            or die('Error connecting to Mysql server');

        //Gjør klar SQL-strengen
        $query = "INSERT INTO kunde(FultNavn, TelefonNummer, passord) VALUES ('$FultNavn', '$TelefonNummer', '$Password')";

        //utføre spørring
        $result = mysqli_query($dbc, $query)
            or die(' Error querying databases. ');


        //koble fra databasen
        mysqli_close($dbc);

        //sjekk om spørring gir resulater
        if (@$result) {
            //login success 
            // echo "Takk for at du lagde bruker! Trykk <a href='index.php'>her</a> for å logge inn";
        } else {
            // login failure 
            echo "Noe gikk galt, Prøv igjen!";
        }
    }

    ?>

</body>

</html>