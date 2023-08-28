<?php
//logic to check whether the user is logged in or not to give him access of this page
if(!isset($_SESSION['user_email'])  && !isset($_SESSION['username']))
{
    echo "<script>window.open('user_login.php','_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zipkart- Change password</title>
</head>

<body>
<div class="container-fluid my-3">
        <h3 class="text-center mb-4">
            Change password
        </h3>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- current password -->
                    <div class="form-outline my-2">
                        <label for="old_password" class="form-label">Current password</label>
                        <input type="password" id="old_password" class="form-control" name="old_password"
                            placeholder="Enter your Current password" autocomplete="off" required="required" required>
                    </div>

                    <!-- new password -->
                    <div class="form-outline my-2">
                        <label for="new_password" class="form-label">New password</label>
                        <input type="password" id="new_password" class="form-control" name="new_password"
                            placeholder="Enter your new password" autocomplete="off" required="required" required>
                    </div>
                    <div class="mt-3 pt-3">
                        <input type="submit" value="submit" class="btn btn-primary px-3 py-2" name="change_password">
                    </div>

                </form>

            </div>
            

        </div>
    </div>
</body>

</html>

<?php
if(isset($_POST['change_password']))
{
    $entered_password=$_POST['old_password'];
    $new_password=$_POST['new_password'];

    $user_email = $_SESSION['user_email'];
    $user_query = "select * from `user_table` where user_email='$user_email'";
    $user_query_result = mysqli_query($con, $user_query);
    $user_data = mysqli_fetch_assoc($user_query_result);

    $user_id=$user_data['user_id'];
    $user_password=$user_data['user_password'];

    if(password_verify($entered_password,$user_password))
    {
        $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
        //now the update query
        $update_query = "update `user_table` set user_password='$hash_password' where user_id=$user_id";
        $update_result = mysqli_query($con, $update_query);
        if ($update_result) {
            echo "<script>alert('Updated the password successfully')</script>";
        }
    }
    else{
        echo "<script>alert('Current password is wrong')</script>";
    }
}

?>