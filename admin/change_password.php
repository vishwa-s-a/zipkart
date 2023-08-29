<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if (!isset($_SESSION['admin_name']) && !isset($_SESSION['admin_email'])) {
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>


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


<?php
if(isset($_POST['change_password']))
{
    $entered_password=$_POST['old_password'];
    $new_password=$_POST['new_password'];

    $admin_email = $_SESSION['admin_email'];
    $admin_query = "select * from `admin_table` where admin_email='$admin_email'";
    $admin_query_result = mysqli_query($con, $admin_query);
    $admin_data = mysqli_fetch_assoc($admin_query_result);

    $admin_id=$admin_data['admin_id'];
    $admin_password=$admin_data['admin_password'];

    if(password_verify($entered_password,$admin_password))
    {
        $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
        //now the update query
        $update_query = "update `admin_table` set admin_password='$hash_password' where admin_id=$admin_id";
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