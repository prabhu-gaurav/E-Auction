<!DOCTYPE html>
<html lang="en">
<?php
include('auth-session.php');
include('head.php');
?>
<body>
    <?php
    include('navbar.php');
    ?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $connection = mysqli_connect("localhost", "root", "", "eauction");
                $query = "SELECT * FROM products where unix_timestamp(bid_end_datetime) >= " . strtotime(date("Y-m-d H:i")) . "";
                $query_run = mysqli_query($connection, $query);
                if (mysqli_num_rows($query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                        <div class="col mb-5">
                            <div class="card">
                                <!-- Product image-->
                                <?php echo '<img src=" admin/uploads/' . $row['product_image'] . '" class="rounded mx-auto d-block" width="200px;" height="220px;" alt="Image">' ?>
                                <!-- Product details-->
                                <div class="float-right align-top d-flex">
                                    <span class="badge badge-pill badge-warning text-white rounded mx-auto d-block"><i class="fa fa-hourglass-half"></i> <?php echo date("M d,Y h:i A", strtotime($row['bid_end_datetime'])) ?></span>
                                </div>
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $row['product_name']; ?></h5>
                                        <!-- Product price-->
                                        Starting Price : 
                                        ₹<?php echo $row['product_price']; ?>
                                        <hr class="solid">
                                    </div>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <form action="view_product.php?<?php echo $row['product_id'] ?>" method="post">
                                        <input type="hidden" name="viewproduct_id" value="<?php echo $row['product_id']; ?>">
                                        <div class="text-center"><button type="submit" name="viewproduct_btn" class="btn btn-outline-dark mt-auto">Bid</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No Products currently available for bidding. Stay tuned!.</p>";
                }
                ?>
            </div>
        </div>
    </section>
    <?php
    include("footer.php");
    include("scripts.php");
    ?>
</body>
</html>