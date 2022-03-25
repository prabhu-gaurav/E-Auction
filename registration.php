<!DOCTYPE html>
<html lang="en">

<head>
<?php
    include('head.php');
?>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="img/regi.png" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <?php
                    require('db.php');
                    if (isset($_REQUEST['username'])) 
                    {
                        $username = stripslashes($_REQUEST['username']);
                        $username = mysqli_real_escape_string($connection, $username);
                        $email    = stripslashes($_REQUEST['email']);
                        $email    = mysqli_real_escape_string($connection, $email);
                        $password = stripslashes($_REQUEST['password']);
                        $password = mysqli_real_escape_string($connection, $password);
                        $usertype = $_POST['usertype'];


                        $email_query = "SELECT * FROM users WHERE email='$email' ";
                        $email_query_run = mysqli_query($connection, $email_query);
                        if (mysqli_num_rows($email_query_run) > 0) 
                        {
                            echo "<div class='afform'>
                                    <h3>Email already in use.</h3><br/>
                                    <p class='link'>Click here to <a href='login.php'>Login</a></p>
                                    </div>";
                        }
                        else
                        {
                            $query = "INSERT into `users` (username, email, password,usertype) VALUES ('$username', '$email' ,'" . md5($password) . "','$usertype')";
                            $result   = mysqli_query($connection, $query);
                            if ($result) 
                            {
                                echo "<div class='afform'>
                                    <h3>You have registered successfully.</h3><br/>
                                    <p class='link'>Click here to <a href='login.php'>Login</a></p>
                                    </div>";
                            } 
                            else 
                            {
                                echo "<div class='afform'>
                                    <h3>Required fields are missing.</h3><br/>
                                    <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                                    </div>";
                            }
                        }
                    } 
                    else 
                    {
                    ?>
                        <form class="form" method="post" name="login">
                            <!-- Username -->
                            <div class="form-outline mb-4">
                                <input type="text" id="form3Example3" name="username" class="form-control" placeholder="Enter Username" required/>
                            </div>

                            <!-- Email  -->
                            <div class="form-outline mb-4">
                                <input type="email" id="form3Example3" name="email" class="form-control" placeholder="Enter Email" required/>
                            </div>

                            <!-- Password -->
                            <div class="form-outline mb-3">
                                <input type="password" id="form3Example4" name="password" class="form-control" placeholder="Enter password" required/>
                            </div>
                            <div class="form-outline mb-3">
                                <input type="password" id="form3Example4" name="cpassword" class="form-control" placeholder="Confirm Your Password" required/>
                            </div>

                            <input type="hidden" name="usertype" value="user">

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                                <p class="small fw-bold mt-2 pt-1 mb-0">Have a account? <a href="login.php" class="link-danger">Log In</a></p>
                            </div>

                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">     
            <div class="text-center text-white">
                Copyright © 2021. All rights reserved.
            </div>        
        </div>
    </section>
</body>

</html>