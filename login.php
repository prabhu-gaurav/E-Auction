<!DOCTYPE html>
<html lang="en">

<head>
<?php
    include('head.php');
?>
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="img/lg.jpg" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <?php
                require('db.php');
                session_start();
                if (isset($_POST['username'])) {
                    $username = stripslashes($_REQUEST['username']);    
                    $username = mysqli_real_escape_string($connection, $username);
                    $password = stripslashes($_REQUEST['password']);
                    $password = mysqli_real_escape_string($connection, $password);
                    $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
                    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                    $rows = mysqli_num_rows($result);
                    if ($rows == 1) {
                        $_SESSION['username'] = $username;
                        header("Location: index.php");
                    } else {
                        echo "<div class='afform'>
                            <h3>Incorrect Username/password.</h3><br/>
                            <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                            </div>";
                    }
                } else {
                ?>
                    <form class="form" method="post" name="login">
                        <!-- Username -->
                        <div class="form-outline mb-4">
                            <input type="text" id="form3Example3" name="username" class="form-control form-control-lg" placeholder="Enter Username" required/>
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4" name="password" class="form-control form-control-lg" placeholder="Enter password" required/>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="registration.php" class="link-danger">Register</a></p>
                        </div>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
            Copyright © 2021. All rights reserved.
        </div>
        <!-- Copyright -->

        <!-- Right -->
        <div>
            <a href="admin/login.php" class="text-white" style="text-decoration: none;">
                <b>Admin Login</b>
            </a>
        </div>
        <!-- Right -->
    </div>
</body>

</html>