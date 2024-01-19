<?php
session_start();

if (isset($_POST['submit'])) {
    $id = $_SESSION['id'];
    $produkt = $_POST['product_type'];

    //Koble til databasen 
    $dbc = mysqli_connect('localhost', 'root', '', 'barevifter')
        or die('Error connecting to Mysql server');

    //Gjør klar SQL-strengen
    $query = "INSERT INTO cart(produkt, kunde) VALUES ('$produkt', '$id')";

    //utføre spørring
    $result = mysqli_query($dbc, $query)
        or die(' Error querying databases. ');


    //koble fra databasen
    mysqli_close($dbc);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="seccondary.css">
    <script src="script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>

<body>

    <nav>
        <div class="nav">
            <a href="index.php">
                <h1>B&V</h1>
            </a>
            <div class="nav-navigation">
                <a href="cart.php">
                    <h1>Cart <img src="images/ion_cart.png" alt=""></h1>
                </a>
                <h1 class="test">
                    <?php echo $_SESSION['FultNavn'] ?>
                </h1>
            </div>
        </div>
    </nav>

    <div class="produkt-flex">
        <div class="produkt-wrapper">

            <div class="produkt-img">
                <img src="images/produkt-img.png" alt="">
            </div>

            <div class="produkt-info">
                <h1>Vifte</h1>
                <form method="POST">
                    <div class="storrelse-produkt">
                        <h2>Produkt Type :</h2>
                        <input type="radio" id="checkboxA" name="product_type" value="1">
                        <label for="checkboxA">Type A</label>

                        <input type="radio" id="checkboxB" name="product_type" value="2">
                        <label for="checkboxB">Type B</label>

                        <input type="radio" id="checkboxC" name="product_type" value="3">
                        <label for="checkboxC">Type C</label>
                    </div>
                    <p>Pris 999 kr.</p>
                    <h3>Lorem, impusen dolor sit.
                        Lorem, impusen dolor sit. Lorem,
                    </h3>
                    <div class="add-to-cart">
                        <input type="submit" value="add to cart" name="submit">
                    </div>

                </form>
            </div>

        </div>
    </div>

    <div class="produkt-spesifikasjoner" id="productDetails">
        <h1>Tekniske Spesifikasjoner +</h1>
        <p>
            <b>Produkttype</b> Vifte
            <br>
            <br>
            <b>Type A har</b> Large Vifte, Hatisghet Høy, Pris 100kr
            <br>
            <br>
            <b>Type B har</b> Medium Vifte, Hatisghet Medium, Pris 75kr
            <br>
            <br>
            <b>Type C har</b> Small Vifte, Hatisghet Low, Pris 50kr
        </p>
    </div>



</body>

</html>