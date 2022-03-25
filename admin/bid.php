<?php
include('../auth-session.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php
        $connection = mysqli_connect("localhost", "root", "", "eauction");
        $query = "SELECT * from categories";
        $query_run = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($query_run)) {
        ?>
            <form action="category.php?<?php echo $row['category_id'] ?>" method="post">
                <input type="hidden" name="viewcategory_id" value="<?php echo $row['category_id']; ?>">
                <div class="dropdown-item"><button type="submit" name="viewcategory_btn" class="btn mt-auto"><?php echo $row['category_name']; ?></button></div>
            </form>
        <?php
        }
        ?>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <form action="code.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="usr_id" value="<?php echo $row['user_name'] ?>">
                    <input type="hidden" name="prd_id" value="<?php echo $row['product_id'] ?>">
                    <button name="delrc_btn" class="btn btn-danger">DELETE All the Bids</button>
                </form>
            </h6>
        </div>
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
                $query = "SELECT * from bids";
                $query_run = mysqli_query($connection, $query);
                ?>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> User Name </th>
                            <th>Product Name </th>
                            <th>Bid Amount </th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $row['user_name']; ?></b></td>
                                    <td><?php echo $cat[$row['product_id']] ?></td>
                                    <td><?php echo $row['bid_amount']; ?></td>
                                    <td>
                                        <form action="code.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="usr_id" value="<?php echo $row['user_name'] ?>">
                                            <input type="hidden" name="prd_id" value="<?php echo $row['product_id'] ?>">
                                            <button name="won_btn" class="btn btn-success">Won</button>
                                        </form>
                                    </td>
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