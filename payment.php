<?php
include('auth-session.php');
if (isset($_POST['pay_btn'])) {
    $username = $_POST['user_name'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phnumber'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $prid = $_POST['prid'];
    $prprize = $_POST['prprize'];
    $paymethod = $_POST['paymethod'];
    $paystatus = $_POST['paystatus'];

    $query = "INSERT into orders(username,firstname,lastname,phonenumber,address,country,state,city,pincode,product_id,amount_paid,payment_method,payment_status) VALUES ('$username','$firstname','$lastname','$phonenumber','$address','$country','$state','$city','$pincode','$prid','$prprize','$paymethod','$paystatus')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo "<h3>Payment Successful.</h3><br/>
        <p class='link'>Click here to get your bill <a href='viewresult.php'>Back</a>.</p>";

    } else {
        echo "<h3>Payment UnSuccessful.</h3><br/>
        <p class='link'>Please try again after sometime.<a href='viewresult.php'>Back</a>.</p>";
    }

}
?>