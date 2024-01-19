<?php
session_start();
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
                    <?php if($_SESSION) {echo $_SESSION['FultNavn']; }?>
                </h1>
                <div class="settings">
                    <div>
                    <?php
                    if($_SESSION) {
                    echo'<a href="logout.php"><button class="logoutButton">Logg ut</button></a>';
                    }else{
                        echo'<a href="login.php"><button class="logoutButton">Logg inn</button></a>';                        
                    }
                    
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="hero-wrapper">
        <div class="hero">
            <div class="hero-img-one">
                <!-- <h1>Bare Vifter Ren Friskhet.</h1> -->
            </div>
            <div class="hero-two">
                <div class="hero-img-two">
                    <h1>produkt</h1>
                </div>
                <div class="hero-img-three">
                    <h1>produkt</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="page-divider">
        <hr>
    </div>

    <div class="recomended-title">
        <h1>produkter.</h1>
    </div>

    <div class="produkter-wrapper">
        <a href="Produkt.php">
            <div class="produkt-wrapper-one">
                <div class="produktOne"></div>
                <h1>Navn på prdoukt</h1>
                <p>Produkt Besrkivelse /kort/</p>
                <p><b>$99</b></p>
            </div>
        </a>
        <div class="produkt-wrapper-one">
            <div class="produktTwo"></div>
            <h1>Navn på prdoukt</h1>
            <p>Produkt Besrkivelse /kort/</p>
            <p><b>$99</b></p>
        </div>
        <div class="produkt-wrapper-one">
            <div class="produktThree"></div>
            <h1>Navn på prdoukt</h1>
            <p>Produkt Besrkivelse /kort/</p>
            <p><b>$99</b></p>
        </div>
        <div class="produkt-wrapper-one">
            <div class="produktFour"></div>
            <h1>Navn på prdoukt</h1>
            <p>Produkt Besrkivelse /kort/</p>
            <p><b>$99</b></p>
        </div>
    </div>




</body>

</html>