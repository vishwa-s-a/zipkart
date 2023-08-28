<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if(!isset($_SESSION['admin_name'])  && !isset($_SESSION['admin_email']))
{
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<div class="container mt-4 ">
    <h3 class="text-center">Edit Category</h3>
    <?php
    $id = $_GET['edit_category'];
    $category_query = "select * from `categories` where category_id=$id";
    $category_result = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_assoc($category_result);
    $title = $category_data['category_title'];
    ?>
    <form action="" method="post">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="category_title" class="form-label mt-3">Category Title</label>
            <input type="text" id="category_title" name="category_title" class="form-control"
                value="<?php echo $title ?>">
        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-primary" name="update_category" value="Update">
        </div>
    </form>
</div>

<?php
if (isset($_POST['update_category'])) {
    $category_title = $_POST['category_title'];

    //the update query
    $update = "update `categories` set category_title='$category_title' where category_id=$id";
    $update_result = mysqli_query($con, $update);
    if ($update_result) {
        echo "<script>alert('Category updated successfully')</script>";
        echo "<script>window.open('index.php?view_category','_self')</script>";
    }
}
?>