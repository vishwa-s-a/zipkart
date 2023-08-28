<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if(!isset($_SESSION['admin_name'])  && !isset($_SESSION['admin_email']))
{
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<div class="container mt-4 ">
    <h3 class="text-center">Edit Brand</h3>
    <?php
    $id = $_GET['edit_brand'];
    $brand_query = "select * from `brands` where brand_id=$id";
    $brand_result = mysqli_query($con, $brand_query);
    $brand_data = mysqli_fetch_assoc($brand_result);
    $title = $brand_data['brand_title'];
    ?>
    <form action="" method="post">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="brand_title" class="form-label mt-3">Brand Title</label>
            <input type="text" id="brand_title" name="brand_title" class="form-control"
                value="<?php echo $title ?>">
        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-primary" name="update_brand" value="Update">
        </div>
    </form>
</div>

<?php
if (isset($_POST['update_brand'])) {
    $brand_title = $_POST['brand_title'];

    //the update query
    $update = "update `brands` set brand_title='$brand_title' where brand_id=$id";
    $update_result = mysqli_query($con, $update);
    if ($update_result) {
        echo "<script>alert('Brand updated successfully')</script>";
        echo "<script>window.open('index.php?view_brand','_self')</script>";
    }
}
?>