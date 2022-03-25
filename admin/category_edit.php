<?php
include('../auth-session.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> EDIT Category </h6>
        </div>
        <div class="card-body">
            <?php

            if (isset($_POST['ctedit_btn'])) {
                $id = $_POST['ctedit_id'];
                $query = "SELECT * FROM categories WHERE category_id='$id' ";
                $query_run = mysqli_query($connection, $query);
                foreach ($query_run as $row) {
            ?>
                    <form action="code.php" method="POST">

                        <input type="hidden" name="ctedit_id" value="<?php echo $row['category_id'] ?>">

                        <div class="form-group">
                            <label> Category Name </label>
                            <input type="text" name="edit_ctname" value="<?php echo $row['category_name'] ?>" class="form-control" placeholder="Enter Username" required>
                        </div>
                        <a href="categories.php" class="btn btn-danger"> CANCEL </a>
                        <button type="submit" name="updatectbtn" class="btn btn-primary"> Update </button>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>