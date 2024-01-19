<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    $dbc = mysqli_connect('localhost', 'root', '', 'barevifter') or die('Error connecting to MySQL server');

    // Insert a new row into the `bestilling` table to represent the order
    $insertOrderQuery = "INSERT INTO bestilling (bestillingsDato, BestillingKunde) VALUES (NOW(), {$_SESSION['id']})";
    mysqli_query($dbc, $insertOrderQuery) or die('Error inserting order into bestilling.');

    // Get the newly inserted order ID
    $orderId = mysqli_insert_id($dbc);

    // Fetch items from the user's cart
    $cartQuery = "SELECT * FROM cart WHERE kunde = {$_SESSION['id']}";
    $cartResult = mysqli_query($dbc, $cartQuery) or die('Error querying cart.');

    // Insert cart items into the produkt_i_bestilling table
    while ($cartRow = mysqli_fetch_assoc($cartResult)) {
        $productId = $cartRow['produkt'];

        $insertItemQuery = "INSERT INTO produkt_i_bestilling (bestilling, produkt) VALUES ($orderId, $productId)";
        mysqli_query($dbc, $insertItemQuery) or die('Error inserting items into produkt_i_bestilling.');
    }

    // Clear the user's cart after checkout
    $clearCartQuery = "DELETE FROM cart WHERE kunde = {$_SESSION['id']}";
    mysqli_query($dbc, $clearCartQuery) or die('Error clearing cart after checkout.');

    mysqli_close($dbc);
    // Redirect to a confirmation page or do something else after checkout
    header("Location: cart.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="seccondary.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/ced2e054c6.js" crossorigin="anonymous"></script>
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
                    <?php if ($_SESSION) {
                        echo $_SESSION['FultNavn'];
                    } ?>
                </h1>
                <div class="settings">
                    <div>
                        <?php
                        if ($_SESSION) {
                            echo '<a href="logout.php"><button class="logoutButton">Logg ut</button></a>';
                        } else {
                            echo '<a href="login.php"><button class="logoutButton">Logg inn</button></a>';
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="produkter-cart-wrapper">
        <?php
        // Koble til databasen 
        $dbc = mysqli_connect('localhost', 'root', '', 'barevifter')
            or die('Error connecting to MySQL server');

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove'])) {
            $itemId = $_POST['itemId'];

            // Prepare the SQL statement to delete the item from the cart
            $deleteQuery = "DELETE FROM cart WHERE idid = $itemId";

            // Execute the delete query
            mysqli_query($dbc, $deleteQuery) or die('Error deleting item from cart.');
        }

        // Gjør klar SQL-strengen
        $query = "SELECT * FROM cart WHERE kunde = {$_SESSION['id']}";

        // Utføre spørring
        $result = mysqli_query($dbc, $query)
            or die('Error querying database.');

        while ($row = mysqli_fetch_assoc($result)) {
            // Access columns by their names
            echo "<br>";

            $productId = $row['produkt'];
            $productQuery = "SELECT * FROM produkter WHERE id = $productId";

            // Utføre spørring for å hente produktinformasjon
            $productResult = mysqli_query($dbc, $productQuery)
                or die('Error querying produkter table.');

            // Fetch and print product information
            while ($productRow = mysqli_fetch_assoc($productResult)) {
                echo "<div class='cart-produkter-flex'>";
                echo "<div class='cart-produkter-wrapper'>";
                echo "<br><h1 class='storrelse'>" . $productRow["Størrelse"] . "</h1>";
                echo "<br><h2 class='storrelse'>" . $productRow["type"] . "</h2>";
                echo "<br><h3 class='storrelse'>" . $productRow["hastighet"] . "</h3>";
                echo "<br><h2 class='storrelse'>" . $productRow["pris"] . "</h2>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='itemId' value='{$row['idid']}'>";
                echo "<button type='submit' name='remove' class='remove-product'>Remove <i class='fa-solid fa-trash' style='color: #000000;'></i></button>";
                echo "</form>";
                echo "<br>";
                echo "<br>";
                echo "</div>";
                echo "</div>";
            }
        }


        mysqli_close($dbc);

        ?>

        <form method="post">
            <!-- ... your existing code for displaying cart items ... -->

            <div class="checkout-cart">
                <span>
                    <h1>Total Pris : 999kr</h1>
                </span>
                <div class="checkout-button">
                    <button type="submit" name="checkout">Checkout</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>