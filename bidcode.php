<?php
include('auth-session.php');
if (isset($_POST['bidbtn'])) {
    $username =   $_POST['user_name'];
    $product_id = $_POST['product_id'];
    $bid_amount = $_POST['bid_amount'];
    $query = "SELECT * FROM bids WHERE user_name ='$username' and product_id='$product_id'";
    $query_run = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $bid_amt = $row['bid_amount'];
        $usrnm = $row['user_name'];
    }
    $rows = mysqli_num_rows($query_run);
    if ($bid_amount > $bid_amt) {
        if ($rows == 1) {
            $query = "UPDATE bids SET bid_amount ='$bid_amount' WHERE product_id='$product_id' and user_name = '$username'";
            $query_run = mysqli_query($connection, $query);
            $_SESSION['success'] = 'Bid Updated';
            header('Location: viewbid.php');
        } else {
            $query = "INSERT into bids(user_name,product_id,bid_amount) VALUES ('$username','$product_id','$bid_amount')";
            $query_run = mysqli_query($connection, $query);
            $product_id = $_POST['product_id'];
            $_SESSION['success'] = 'Bid Added';
            header('Location: viewbid.php');
        }
    } else {
        $_SESSION['status'] = 'Bid Should be higher than current bidding amount.';
        header('Location: viewbid.php');
    }
}
