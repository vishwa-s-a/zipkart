<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if(!isset($_SESSION['admin_name'])  && !isset($_SESSION['admin_email']))
{
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<?php
if (isset($_GET['delete_order'])) {
    $id = $_GET['delete_order'];

    //delete query
    $delete = "delete from `user_orders` where order_id=$id";
    $delete_result = mysqli_query($con, $delete);

    if ($delete_result) {
        echo "<script>alert('Successfully deleted the order')</script>";
        echo "<script>window.open('index.php?view_orders','_self')</script>";

    }

}
?>