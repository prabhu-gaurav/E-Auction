<html>
<?php include('auth-session.php'); ?>

<head>
    <title>Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/checkout.css">
</head>

<body>
    <?php
    if (isset($_POST['chk_btn'])) {
        $id = $_POST['product_id'];
        $ppr = $_POST['product_price'];

        $cat = array();
        $cat[] = '';
        $qry = $connection->query("SELECT * FROM products ");
        while ($row = $qry->fetch_assoc()) {
            $cat[$row['product_id']] = $row['product_name'];
        }
        $query = "SELECT * FROM bidwin INNER JOIN products ON bidwin.product_id=products.product_id where bidwin.product_id='$id'";
        $query_run = mysqli_query($connection, $query);
        foreach ($query_run as $row) {
    ?>
            <div class="userdet">
                <form action="payment.php" method="POST">
                    <h1>Checkout</h1>
                    <input id="user" type="text" name="firstname" placeholder="FirstName" required>
                    <input type="text" name="lastname" placeholder="LastName" required><br>
                    <input type="number" name="phnumber" placeholder="Phone Number" required><br>
                    <input type="text" name="address" placeholder="Address" required><br>
                    <input type="text" name="country" placeholder="Country" required><br>
                    <input type="text" name="state" placeholder="State" required><br>
                    <input type="text" name="city" placeholder="City" required><br>
                    <input type="text" name="pincode" placeholder="Pincode" required><br>
                    <hr>
                    <h1>Payment</h1>
                    <label for="credit"><input type="radio" name="paymethod" value="credit" checked>Credit</label><br>
                    <label for="debit"><input type="radio" name="paymethod" value="debit">Debit</label><br>
                    <input type="text" name="noc" placeholder="Name on Card" required><br>
                    <input type="text" name="cn" placeholder="Card Number" required><br>
                    <input type="text" name="expiry" placeholder="Expiry" required><br>
                    <input type="password" name="cvv" placeholder="CVV" required><br>
                    <input type="hidden" name="user_name" value="<?php echo $_SESSION['username']; ?>">
                    <input type="hidden" name="prid" value="<?php echo $id ?>">
                    <input type="hidden" name="prprize" value="<?php echo $ppr ?>">
                    <input type="hidden" name="paystatus" value="Paid">
                    <button type="submit" value="submit"  name="pay_btn">Pay</button>
                </form>
            </div>
            <div class="proddet">

                <div class="col-md-4 mb-4">
                    <ul class="list-group mb-3 z-depth-1">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo '<img src=" admin/uploads/' . $row['product_image'] . '" width="100px;" height="100px;" alt="Image">' ?></h6>
                            </div>
                            <div>
                                <h6 class="my-0"><?php echo ucwords($cat[$row['product_id']]) ?></h6>
                            </div>
                            <span class="text-muted">₹ <?php echo $row['final_amount']; ?></span>
                        </li>
                        <hr>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (INR)</span>
                            <strong>₹ <?php echo $row['final_amount']; ?></strong>
                        </li>
                    </ul>
                </div>
        <?php
        }
    } else {
        echo "There is some issue.";
    }
        ?>
            </div>
</body>

</html>