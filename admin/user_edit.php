<?php
include('../auth-session.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit Users </h6>
        </div>
        <div class="card-body">
            <?php
            if (isset($_POST['useredit_btn'])) {
                $id = $_POST['uesredit_id'];

                $query = "SELECT * FROM users WHERE user_id='$id' ";
                $query_run = mysqli_query($connection, $query);

                foreach ($query_run as $row) {
            ?>
                    <form action="code.php" method="POST">
                        <input type="hidden" name="uesredit_id" value="<?php echo $row['user_id'] ?>">
                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control" placeholder="Enter Username" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email" required>
                        </div>

                        <div class="form-group">
                            <label>User type</label>
                            <select name="edit_usertype" class="form-control">
                                <option value="<?php echo $row['usertype'] ?>"></option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                        <a href="users.php" class="btn btn-danger"> CANCEL </a>
                        <button type="submit" name="userupdatebtn" class="btn btn-primary"> Update </button>
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