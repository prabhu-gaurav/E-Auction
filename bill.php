<?php
include('auth-session.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>PHP Print</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bill.css" media="print">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
                if (isset($_POST['bill_btn'])) 
                {
                    $id = $_POST['product_id'];
                    $username = $_SESSION['username'];
                    $i=1;
                    $cat = array();
                    $cat[] = '';
                    $qry = $connection->query("SELECT * FROM products  ");
                    while ($row = $qry->fetch_assoc()) {
                        $cat[$row['product_id']] = $row['product_name'];
                    }
                    $query = "SELECT * FROM orders INNER JOIN products ON orders.product_id=products.product_id Where orders.username = '$username' and orders.product_id = '$id'";
                    $query_run = mysqli_query($connection, $query);
                    ?>
                    <table class="table table-bordered" id="dataTable" width="75%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Pin Code </th>
                                <th>Product Name</th>
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
                                        <td><?php echo $row['id']?></td>
                                        <td><?php echo $row['firstname']?></td>
                                        <td><?php echo $row['lastname']?></td>
                                        <td><?php echo $row['phonenumber']?></td>
                                        <td><?php echo $row['address']?></td>
                                        <td><?php echo $row['country']?></td>
                                        <td><?php echo $row['state']?></td>
                                        <td><?php echo $row['city']?></td>
                                        <td><?php echo $row['pincode']?></td>
                                        <td><?php echo ucwords($cat[$row['product_id']]) ?></td>
                                        <td><?php echo $row['amount_paid']; ?></td>
                                        <td><?php echo $row['payment_method']?></td>
                                        <td><?php echo $row['payment_status']?></td>
                                    </tr>
                            <?php
                                }
                            }} else {
                                echo "<h4 class='text-center'>Please Pay for the item to get your bill.</h4>";
                            }
                            ?>
                        </tbody>
                    </table>
            </div>

                <div class="text-center">
                    <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>