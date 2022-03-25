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
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <?php
                if (isset($_POST['viewcategory_btn'])) {
                    $id = $_POST['viewcategory_id'];

                    $query = "SELECT * FROM products where unix_timestamp(bid_end_datetime) >= " . strtotime(date("Y-m-d H:i")) . " and category_id='$id' ";
                    $query_run = mysqli_query($connection, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Product image-->
                                    <?php echo '<img src=" admin/uploads/' . $row['product_image'] . '" class="rounded mx-auto d-block" width="225px;" height="250px;" alt="Image">' ?>
                                    <div class="mx-auto d-block">
                                        <span class="badge badge-pill badge-warning text-white"><i class="fa fa-hourglass-half"></i> <?php echo date("M d,Y h:i A", strtotime($row['bid_end_datetime'])) ?></span>
                                    </div>
                                    <!-- Product details-->
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
                        echo "No Records Found";
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <?php
    include('scripts.php');
    include('footer.php');
    ?>

</body>

</html>