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
                if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                    echo '<h2 class="bg-primary text-white"> ' . $_SESSION['success'] . '</h2>';
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                    echo '<h2 class="bg-danger text-white"> ' . $_SESSION['status'] . '</h2>';
                    unset($_SESSION['status']);
                }
                ?>
                <div class="table-responsive">
                    <?php
                    $username = $_SESSION['username'];
                    $i = 1;
                    $connection = mysqli_connect("localhost", "root", "", "eauction");
                    $cat = array();
                    $cat[] = '';
                    $qry = $connection->query("SELECT * FROM products  ");
                    while ($row = $qry->fetch_assoc()) {
                        $cat[$row['product_id']] = $row['product_name'];
                    }

                    $sql = $connection->query("SELECT * FROM products");
                    while ($rows = $sql->fetch_assoc()) {
                        $get = $connection->query("SELECT * FROM bids where product_id = {$rows['product_id']} order by bid_amount desc limit 1 ");
                        $bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0;
                    }

                    $query = "SELECT * FROM bids INNER JOIN products ON bids.product_id=products.product_id  Where bids.user_name = '$username'";
                    $query_run = mysqli_query($connection, $query);
                    ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Product Image</th>
                                <th>Product Name </th>
                                <th>Your Bid</th>
                                <th>Bid</th>
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
                                        <td><?php echo ucwords($cat[$row['product_id']]) ?></td>
                                        <td><?php echo $row['bid_amount']; ?></td>
                                        <td>
                                            <form action="view_product.php" method="post">
                                                <input type="hidden" name="viewproduct_id" value="<?php echo $row['product_id'] ?>">
                                                <button type="submit" name="viewproduct_btn" class="btn btn-success">BID</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<h4 class='text-center'>Here you will see all the items you have bid on.</h4>";
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