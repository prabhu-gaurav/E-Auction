<html>
<?php
include('auth-session.php');
include('head.php');
?>

<body>
    <?php
    include('navbar.php');
    ?>
    <section class="py-5 bg-secondary">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <h1 class="text-uppercase text-white bg-dark text-center font-weight-bold">About Us</h1>
            </div>
            <div class="text-white">
                <p>E-Auction is a online auction house where you can find the most rare and collectible items and also some mordern artpieces.</p>
                <p>You can place a bid on product you want and if you win the bid you get the product for the price you bidded for.</p>
            </div>
        </div>
    </section>

    <?php
    include("scripts.php");
    include("footer.php");
    ?>
</body>

</html>