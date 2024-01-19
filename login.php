<?php
session_start();
$feil = "";
if (isset($_POST['submit'])) {
    //Gjør om POST fra formen til variabler
    $FultNavn = $_POST['FultNavn'];
    $Password = md5($_POST['passord']);

    //Denne koden kobles til databasen
    $dbc = mysqli_connect('localhost', 'root', '', 'barevifter')
        or die('Error connecting to Mysql server');

    //Gjør klar SQL-strengen
    $query = "SElECT * from kunde where FultNavn='$FultNavn' and passord='$Password'";

    //Gjør en spørring 
    $result = mysqli_query($dbc, $query)
        or die(' Error querying databases. ');

    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION = $row;
    }
    //koble fra databasen
    mysqli_close($dbc);

    //sjekk om spørring gir resultater
    if ($result->num_rows > 0) {
        //login success
        header('location: index.php');
    } else {
        //login failure
        $feil = "<div class='feil'>feil FultNavn eller passord</div>";
    }

}
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
        <a href="index.php"><i class="fa-solid fa-arrow-left" style="color: #000000;"></i></a>
    </div>

    <div class="form-wrapper">
        <p class="welcome-title">Welcome</p>
        <div class="feil-wrapper">
            <?php echo $feil; ?>
        </div>
        <form method="post">
            <input class="user-input" type="text" name="FultNavn" placeholder="FultNavn" required /><br />
            <input class="user-input" type="password" name="passord" placeholder="Password" required /><br />

            <a href="registration.php"><button class="user-button" type="submit" value="Logg inn" name="submit">Log
                    in</button></a>
            <p class="redirection-regi" style="text-align: center; padding: 30px 0 0 0; color: #333;">Har ikke bruker?
                klikk <a href="registration.php"> Her </a>for å registrere ny bruker</p>
        </form>
    </div>

</body>

</html>