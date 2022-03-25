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
                <div class="table-responsive">
                    <?php
                    $username = $_SESSION['username'];
                    $connection = mysqli_connect("localhost", "root", "", "eauction");
                    $i = 1;
                    $query = "SELECT * FROM bidwin INNER JOIN products ON bidwin.product_id=products.product_id Where bidwin.username = '$username'";
                    $query_run = mysqli_query($connection, $query);
                    ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>no. </th>
                                <th>Product Name </th>
                                <th>Product Image</th>
                                <th>Prize</th>
                                <th>Buy</th>
                                <th>Bill</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo '<img src=" admin/uploads/' . $row['product_image'] . '" width="100px;" height="100px;" alt="Image">' ?></td>
                                        <td><?php echo $row['product_name']; ?></td>
                                        <td><?php echo $row['final_amount']; ?></td>
                                        <td>
                                            <form action="checkout.php" method="post">
                                                <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                                                <input type="hidden" name="product_price" value="<?php echo $row['final_amount'] ?>">
                                                <button type="submit" name="chk_btn" class="btn btn-success">BUY</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="bill.php" method="post">
                                                <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                                                <input type="hidden" name="product_price" value="<?php echo $row['final_amount'] ?>">
                                                <button type="submit" name="bill_btn" class="btn btn-success">BILL</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<h4 class='text-center'>If you have won an item in auction it will appear here shortly.</h4>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
    include('scripts.php');
    include('footer.php');
    ?>
</body>

</html>