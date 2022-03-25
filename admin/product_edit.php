<?php
include('../auth-session.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit Product </h6>
        </div>
        <div class="card-body">
            <?php
            if (isset($_POST['prdedit_btn'])) {
                $id = $_POST['prdedit_id'];
                $connection = mysqli_connect("localhost", "root", "", "eauction");
                $query = "SELECT * FROM products INNER JOIN categories ON products.category_id=categories.category_id  Where products.product_id = '$id'";
                $query_run = mysqli_query($connection, $query);
                foreach ($query_run as $row) {
            ?>
                    <form action="code.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="prdedit_id" value="<?php echo $row['product_id'] ?>" required>

                        <div class="form-group">
                            <label> Product Name </label>
                            <input type="text" name="editprd_name" value="<?php echo $row['product_name'] ?>" class="form-control" placeholder="Enter Product Name" required>
                        </div>

                        <div class="form-group">
                            <label> Product Description </label>
                            <input type="text" name="editprd_description" value="<?php echo $row['product_description'] ?>" class="form-control" placeholder="Enter Product Description" required>
                        </div>

                        <div class="form-group">
                            <label> Product Price </label>
                            <input type="text" name="editprd_price" value="<?php echo $row['product_price'] ?>" class="form-control" placeholder="Enter Product Price" required>
                        </div>

                        <div class="form-group">
                            <label> Bidding End Date/Time </label>
                            <input type="datetime-local" name="edit_bid_end_datetime" value="<?php echo $row['bid_end_datetime'] ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label> Product Image </label>
                            <input type="file" name="editprd_image" class="form-control" value="<?php echo '<img src=" uploads/' . $row['product_image'] . '" alt="Image">' ?>">
                            <?php echo '<img src=" uploads/' . $row['product_image'] . '" width="250px;" height="250px;" alt="Image">' ?>
                        </div>


                        <div class="form-group">
                            <label> Category</label>
                            <select class="form-control" name="ctedit_id">
                                <option value="<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></option>
                                <?php
                                $connection = mysqli_connect("localhost", "root", "", "eauction");
                                $query = "SELECT * from categories";
                                $query_run = mysqli_query($connection, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                        <option value="<?php echo $row['category_id'] ?>" <?php echo isset($category_id) && $category_id == $row['category_id'] ? 'selected' : '' ?>><?php echo $row['category_name']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

        </div>
        <div class="modal-footer">
            <a href="product.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
            <button type="submit" name="updtprdtbtn" class="btn btn-primary">Save</button>
        </div>
        </form>
        </form>
<?php
                }
            }
?>
    </div>
</div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>