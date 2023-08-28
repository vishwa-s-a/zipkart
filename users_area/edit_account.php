<?php
//logic to check whether the user is logged in or not to give him access of this page
if(!isset($_SESSION['user_email'])  && !isset($_SESSION['username']))
{
    echo "<script>window.open('user_login.php','_self')</script>";
}

?>

<?php
if (isset($_GET['edit_account'])) {
    $user_email = $_SESSION['user_email'];
    $user_query = "select * from `user_table` where user_email='$user_email'";
    $user_query_result = mysqli_query($con, $user_query);
    $user_data = mysqli_fetch_assoc($user_query_result);
    $user_address = $user_data['user_address'];
    $user_contact = $user_data['user_mobile'];
    $user_id = $user_data['user_id'];
    $user_image = $user_data['user_image'];
    //getting new data for updating the user
    if (isset($_POST['user_update'])) {
        $new_name = $_POST['user_username'];
        $new_email = $_POST['user_email'];
        $new_address = $_POST['user_address'];
        $new_contact = $_POST['user_mobile'];

        $temp=$_FILES['user_image']['name'];
        if(empty($temp))
        {
            $new_user_image = $user_image;
        }
        else{
            $new_image = basename($_FILES['user_image']['name']);
            $new_image_temp = $_FILES['user_image']['tmp_name'];

            $fileExtension = pathinfo($new_image, PATHINFO_EXTENSION);
            $new_user_image = $new_contact . '.' . $fileExtension;

            //now to delete the old image of user
            $filepath = "user_images/$user_image";
            unlink($filepath); //this function will delete the previous file

            //move the uploaded file
            move_uploaded_file($new_image_temp, "user_images/$new_user_image");

            
        }
        

        //now the update query
        $update_query = "update `user_table` set username='$new_name',user_email='$new_email',user_image='$new_user_image',user_address='$new_address',user_mobile='$new_contact' where user_id=$user_id";
        $update_result = mysqli_query($con, $update_query);
        if ($update_result) {
            echo "<script>alert('Updated the details')</script>";
            $_SESSION['username'] = $new_name;
            $_SESSION['user_email'] = $new_email;
            echo "<script>window.open('profile.php?edit_account','_self')</script>";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zipkart- Edit account</title>
</head>

<body>
    <h3 class="text-center text-success mb-3">Edit account</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center ">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_username"
                value="<?php echo $_SESSION['username'] ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_email"
                value="<?php echo $_SESSION['user_email'] ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto mb-1" name="image_text"
                value="upload a new profile picture" disabled>
            <input type="file" class="form-control w-50 m-auto" name="user_image" value="<?php echo $user_image ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_address" value="<?php echo $user_address ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_contact ?>">
        </div>

        <input type="submit" class="btn btn-primary mb-2 mt-2" value="Update" name="user_update">
    </form>
</body>

</html>