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
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <?php
                if (isset($_POST['viewproduct_btn'])) {
                    $id = $_POST['viewproduct_id'];

                    $query = "SELECT * FROM products WHERE unix_timestamp(bid_end_datetime) >= " . strtotime(date("Y-m-d H:i")) . " and product_id='$id' ";
                    $query_run = mysqli_query($connection, $query);
                    foreach ($query_run as $row) {
                ?>
                        <div class="col-md-6"><?php echo '<img src=" admin/uploads/' . $row['product_image'] . '" class="card-img-top mb-5 mb-md-0"  alt="Image">' ?></div>
                        <div class="col-md-6">
                            <h1 class="display-5 fw-bolder"><?php echo $row['product_name']; ?></h1>
                            <div class="fs-5 mb-5">
                                Product Original Price :
                                <span>₹<?php echo $row['product_price']; ?></span>
                            </div>
                            <p class="lead"><?php echo $row['product_description']; ?></p>
                            <p class="lead"><b>Until :</b><?php echo date("M d,Y h:i A", strtotime($row['bid_end_datetime'])) ?></p>
                            <div class="mb-5">
                                Highest Bidding : ₹
                                <?php
                                $query = "SELECT * FROM bids WHERE product_id='$id' order by bid_amount desc limit 1 ";
                                $query_run = mysqli_query($connection, $query);
                                foreach ($query_run as $row) {
                                ?>
                                    <span style="color:red;"><b><?php echo $row['bid_amount']; ?></b></span>
                                <?php
                                }
                                ?>
                            </div>
                            <form action="bidcode.php?<?php echo $row['product_id'] ?>" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                                <input type="hidden" name="user_name" value="<?php echo $_SESSION['username']; ?>">
                                <div class="d-flex">
                                    Enter Bidding Amount : ₹
                                    <span><input type="number" class="form-control text-right" name="bid_amount" required></span>
                                </div>
                                <a href="index.php" class="btn btn-secondary">Cancel</a>
                                <button name="bidbtn" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                <?php
                    }
                } else {
                    echo "No Records Found";
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