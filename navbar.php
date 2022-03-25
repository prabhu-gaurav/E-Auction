<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">
                <img src="img/main-icon.jpg" width="150" height="100" class="d-inline-block align-top" alt="">
            </a>
        </nav>
        <a class="navbar-brand" href="index.php"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactus.php">Contact Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                        <?php
                        $connection = mysqli_connect("localhost", "root", "", "eauction");
                        $query = "SELECT * from categories order by category_name asc";
                        $query_run = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                            <form action="category.php?<?php echo $row['category_id'] ?>" method="post">
                                <input type="hidden" name="viewcategory_id" value="<?php echo $row['category_id']; ?>">
                                <div class="dropdown-item bg-dark"><button type="submit" name="viewcategory_btn" class="btn mt-auto bg-dark text-white"><?php echo $row['category_name']; ?></button></div>
                            </form>
                        <?php
                        }
                        ?>
                    </div>
                </li>
            </ul>
            <ul class="nav-item dropdown">
                <a class="nav-link text-white bg-info dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="twxt-center text-gray-600 small">
                        <b><?php echo $_SESSION['username']; ?></b>
                    </span>
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu bg-dark" style="width:100px;height:100px;" aria-labelledby="userDropdown">
                    <a class="dropdown-item bg-primary text-white" href="viewbid.php">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-400"></i>
                        View Your Bids
                    </a>

                    <a class="dropdown-item bg-success text-white" href="viewresult.php">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-400"></i>
                        Products Won
                    </a>

                    <a class="dropdown-item bg-danger text-white" href="logout.php">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-400"></i>
                        Logout
                    </a>
                </div>
            </ul>

        </div>
    </nav>