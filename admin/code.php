<?php
include('../auth-session.php');

//Categories
//Insert Category
if (isset($_POST['categorybtn'])) {
    $category_name = $_POST['category_name'];

    $query = "INSERT into categories(category_name) VALUES ('$category_name')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = 'Category Added';
        header('Location: categories.php');
    } else {
        $_SESSION['status'] = 'Category Not Added';
        header('Location: categories.php');
    }
}

//Update Category
if (isset($_POST['updatectbtn'])) {
    $id = $_POST['ctedit_id'];
    $ctname = $_POST['edit_ctname'];

    $query = "UPDATE categories SET category_name ='$ctname' WHERE category_id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: categories.php');
    } else {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: categoris.php');
    }
}


//Delete Category
if (isset($_POST['delete_ctbtn'])) {
    $delete_id = $_POST['delete_id'];
    $query = "DELETE FROM categories WHERE category_id = '$delete_id'";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        $_SESSION['success'] = 'Category Deleted';
        header('Location: categories.php');
    } else {
        $_SESSION['status'] = 'Category Not Deleted';
        header('Location: categories.php');
    }
}

//Products
//Insert Products
if (isset($_POST['productbtn'])) {
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $bid_end_datetime = $_POST['bid_end_datetime'];
    $img_loc = $_FILES['product_image']['tmp_name'];
    $product_image = $_FILES['product_image']['name'];

    if (file_exists('uploads/' . $_FILES['product_image']['name'])) {
        $store = $_FILES['product_image']['name'];
        $_SESSION['status'] = "Image already exists. '.$store'";
        header('Location: product.php');
    } else {
        $query = "INSERT into products (category_id,product_name,product_description,product_price,bid_end_datetime,product_image) VALUES ('$category_id','$product_name','$product_description','$product_price','$bid_end_datetime','$product_image')";
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            move_uploaded_file($_FILES['product_image']['tmp_name'], 'uploads/' . $_FILES['product_image']['name']);
            $_SESSION['success'] = 'Product Added';
            header('Location: product.php');
        } else {
            $_SESSION['status'] = 'Product Not Added';
            header('Location: product.php');
        }
    }
}
//Update Products
if (isset($_POST['updtprdtbtn'])) {
    $ctid = $_POST['ctedit_id'];
    $prdid = $_POST['prdedit_id'];
    $prdname = $_POST['editprd_name'];
    $prddesc = $_POST['editprd_description'];
    $prdprc = $_POST['editprd_price'];
    $prddt = $_POST['edit_bid_end_datetime'];
    $editprd_image = $_FILES['editprd_image']['name'];

    $query = "UPDATE products SET category_id='$ctid', product_name='$prdname', product_description='$prddesc', product_price='$prdprc', bid_end_datetime='$prddt' ,product_image='$editprd_image ' WHERE product_id='$prdid' ";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        move_uploaded_file($_FILES['editprd_image']['tmp_name'], 'uploads/' . $_FILES['editprd_image']['name']);
        $_SESSION['success'] = 'Product Updated';
        header('Location: product.php');
    } else {
        $_SESSION['status'] = 'Product Not Updated';
        header('Location: product.php');
    }
}


//Delete Products
if (isset($_POST['delete_prbtn'])) {
    $delete_id = $_POST['delete_id'];
    $query = "DELETE FROM products WHERE product_id = '$delete_id'";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        $_SESSION['success'] = 'Product Deleted';
        header('Location: product.php');
    } else {
        $_SESSION['status'] = 'Product Not Deleted';
        header('Location: product.php');
    }
}

//Register user through admin panel
if (isset($_POST['registerbtn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($connection, $password);
    $cpassword = stripslashes($_REQUEST['confirmpassword']);
    $cpassword = mysqli_real_escape_string($connection, $cpassword);
    $usertype = $_POST['usertype'];

    $email_query = "SELECT * FROM users WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: users.php');
    } else {
        if ($password === $cpassword) {
            $query = "INSERT INTO users (username,email,password,usertype) VALUES ('$username','$email','" . md5($password) . "','$usertype')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: users.php');
            } else {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: users.php');
            }
        } else {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');
        }
    }
}

//User edit
if (isset($_POST['userupdatebtn'])) {
    $userid = $_POST['uesredit_id'];
    $username = $_POST['edit_username'];
    $useremail = $_POST['edit_email'];
    $usertype = $_POST['edit_usertype'];

    $query = "UPDATE users SET username='$username', email='$useremail', usertype='$usertype' WHERE user_id='$userid' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: users.php');
    } else {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: users.php');
    }
}

//Delete User
if (isset($_POST['delete_usrbtn'])) {
    $delete_id = $_POST['delete_id'];
    $query = "DELETE FROM users WHERE user_id = '$delete_id'";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        $_SESSION['success'] = 'User Deleted';
        header('Location: users.php');
    } else {
        $_SESSION['status'] = 'User Not Deleted';
        header('Location: users.php');
    }
}

//Admin Login
if (isset($_POST['login_btn'])) {
    $username_login = $_POST['username'];
    $password_login = stripslashes($_REQUEST['password']);
    $password_login = mysqli_real_escape_string($connection, $password_login);

    $query = "SELECT * FROM users WHERE username='$username_login' AND password='" . md5($password_login) . "' LIMIT 1";
    $query_run = mysqli_query($connection, $query);
    $usertypes = mysqli_fetch_array($query_run);

    if ($usertypes['usertype'] == "admin") {
        $_SESSION['username'] = $username_login;
        header('Location: index.php');
    } else if ($usertypes['usertype'] == "user") {
        $_SESSION['username'] = $username_login;
        header('Location: ../index.php');
    } else {
        echo "<div class='afform'>
        <h3>Invalid</h3><br/>
        <p class='link'>Click here to <a href='login.php'>Login</a></p>
         </div>";
    }
}
//BIDWIN Code
if (isset($_POST['won_btn'])) {
    $id = $_POST['prd_id'];
    $uname = $_POST['usr_id'];
    $connection = mysqli_connect("localhost", "root", "", "eauction");
    $qry = "SELECT * FROM bids WHERE product_id='$id' and user_name='$uname' ";
    $qry_run = mysqli_query($connection, $qry);
    while ($row = $qry_run->fetch_assoc()) {
        $username = $row['user_name'];
        $product_id = $row['product_id'];
        $bid_amount = $row['bid_amount'];
    }
    $query = "INSERT into bidwin(username,product_id,final_amount) VALUES('$username','$product_id','$bid_amount') ";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        header('Location: bid.php');
    } else {
        echo "<div class='afform'>
                <h3>Some Error Occured. Please Try Again.</h3><br/>
                <p class='link'>Click here to get <a href='bid.php'>Back</a>.</p>
            </div>";
    }
}

if (isset($_POST['delrc_btn'])) {
    $query = "truncate table bids";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) 
    {
        header('Location: bid.php');
    } 
    else 
    {
        echo "<div class='afform'>
                <h3>Some Error Occured. Please Try Again.</h3><br/>
                <p class='link'>Click here to get <a href='bid.php'>Back</a>.</p>
            </div>";
    }

}