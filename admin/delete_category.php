<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if(!isset($_SESSION['admin_name'])  && !isset($_SESSION['admin_email']))
{
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<?php
if (isset($_GET['delete_category'])) {
    $id = $_GET['delete_category'];

    //delete query
    $delete = "delete from `categories` where category_id=$id";
    $delete_result = mysqli_query($con, $delete);

    if ($delete_result) {
        echo "<script>alert('Successfully deleted the category')</script>";
        echo "<script>window.open('index.php?view_category','_self')</script>";

    }

}
?>