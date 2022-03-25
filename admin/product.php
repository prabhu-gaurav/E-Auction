<?php
include('../auth-session.php');
include('includes/header.php');
include('includes/navbar.php');
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label> Category</label>
            <select class="form-control" name="category_id">
              <option value=""></option>
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

          <div class="form-group">
            <label> Product Name </label>
            <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name" required>
          </div>

          <div class="form-group">
            <label> Product Description </label>
            <input type="text" name="product_description" class="form-control" placeholder="Enter Product Description" required>
          </div>

          <div class="form-group">
            <label> Product Price </label>
            <input type="text" name="product_price" class="form-control" placeholder="Enter Product Price" required>
          </div>

          <div class="form-group">
            <label> Bidding End Date/Time </label>
            <input type="datetime-local" name="bid_end_datetime" class="form-control" required>
          </div>


          <div class="form-group">
            <label> Product Image </label>
            <input type="file" name="product_image" class="form-control" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="productbtn" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
          Add Product
        </button>
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
        $cat = array();
        $cat[] = '';
        $qry = $connection->query("SELECT * FROM categories ");
        while ($row = $qry->fetch_assoc()) {
          $cat[$row['category_id']] = $row['category_name'];
        }
        $query = "SELECT * from products";
        $query_run = mysqli_query($connection, $query);
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th> Product Id </th>
              <th> Category Name</th>
              <th>Product Name </th>
              <th>Product Description</th>
              <th>Product Price </th>
              <th>Product End Date/Time</th>
              <th>Product Image </th>
              <th>Edit </th>
              <th>Delete </th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (mysqli_num_rows($query_run) > 0) {
              while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                <tr>
                  <td><?php echo $row['product_id']; ?></td>
                  <td><?php echo ucwords($cat[$row['category_id']]) ?></td>
                  <td><?php echo $row['product_name']; ?></td>
                  <td><?php echo $row['product_description']; ?></td>
                  <td><?php echo $row['product_price']; ?></td>
                  <td><?php echo $row['bid_end_datetime']; ?></td>
                  <td><?php echo '<img src=" uploads/' . $row['product_image'] . '" width="100px;" height="100px;" alt="Image">' ?></td>
                  <td>
                    <form action="product_edit.php" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="prdedit_id" value="<?php echo $row['product_id'] ?>">
                      <button type="submit" name="prdedit_btn" class="btn btn-success"> EDIT</button>
                    </form>
                  </td>
                  <td>
                    <form action="code.php" method="post">
                      <input type="hidden" name="delete_id" value="<?php echo $row['product_id']; ?>">
                      <button type="submit" name="delete_prbtn" class="btn btn-danger"> DELETE</button>
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