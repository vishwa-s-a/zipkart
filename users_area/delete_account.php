<?php
//logic to check whether the user is logged in or not to give him access of this page
if(!isset($_SESSION['user_email'])  && !isset($_SESSION['username']))
{
    echo "<script>window.open('user_login.php','_self')</script>";
}

?>

<h3 class="text-center text-danger mt-5">
    Delete Account
</h3>
<form action="" method="post" class="mt-5">
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="delete" value="Delete Account">
    </div>
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="dont_delete" value="Don't Delete Account">
    </div>
</form>
<?php
$email=$_SESSION['user_email'];
if(isset($_POST['delete']))
{
    $user_query = "select * from `user_table` where user_email='$email'";
    $user_query_result = mysqli_query($con, $user_query);
    $user_data = mysqli_fetch_assoc($user_query_result);
    $user_image = $user_data['user_image'];

    //now to delete the old image of user
    $filepath = "user_images/$user_image";
    unlink($filepath); //this function will delete the previous file

    $delete_query="delete from `user_table` where user_email='$email'";
    $delete_result=mysqli_query($con,$delete_query);
    if($delete_result)
    {
        session_unset();
        session_destroy();
        echo "<script>alert('Account Deleted Successfully')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}

if(isset($_POST['dont_delete']))
{
    echo "<script>window.open('profile.php?pending_orders','_self')</script>";

}
?>