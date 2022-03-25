<?php
include('../auth-session.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 class="bg-primary text-white"> ' . $_SESSION['success'] . '</h2>';
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2 class="bg-primary text-white"> ' . $_SESSION['status'] . '</h2>';
                unset($_SESSION['status']);
            }
            ?>
            <div class="table-responsive">
                <?php
                $connection = mysqli_connect("localhost", "root", "", "eauction");
                $i = 1;
                $cat = array();
                $cat[] = '';
                $qry = $connection->query("SELECT * FROM products ");
                while ($row = $qry->fetch_assoc()) {
                    $cat[$row['product_id']] = $row['product_name'];
                }
                $query = "SELECT * from orders";
                $query_run = mysqli_query($connection, $query);
                ?>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> First Name </th>
                            <th> Last Name </th>
                            <th>Phone Number</th>
                            <th>Address </th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $row['firstname']; ?></b></td>
                                    <td><?php echo $row['lastname']; ?></b></td>
                                    <td><?php echo $row['phonenumber']; ?></b></td>
                                    <td><?php echo $row['address']; ?></b></td>
                                    <td><?php echo $cat[$row['product_id']] ?></td>
                                    <td><?php echo $row['amount_paid']; ?></td>
                                    <td><?php echo $row['payment_method']; ?></b></td>
                                    <td><?php echo $row['payment_status']; ?></b></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "No Records Found";
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<!-- /container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>