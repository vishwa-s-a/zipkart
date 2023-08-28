<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zipkart-User Registration</title>
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="styles.css">
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid my-3">
        <h3 class="text-center ">
            New user registration
        </h3>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- user name -->
                    <div class="form-outline my-2">
                        <label for="user_username" class="form-label">User Name</label>
                        <input type="text" id="user_username" class="form-control" name="user_username"
                            placeholder="Enter your username" autocomplete="off" required="required" required
                            value="<?php echo isset($_SESSION['user_input']['user_username']) ? $_SESSION['user_input']['user_username'] : ''; ?>">
                    </div>
                    <!-- user email -->
                    <div class="form-outline my-2">
                        <label for="user_email" class="form-label">User Email</label>
                        <input type="email" id="user_email" class="form-control" name="user_email"
                            placeholder="Enter your email" autocomplete="off" required="required" required
                            value="<?php echo isset($_SESSION['user_input']['user_email']) ? $_SESSION['user_input']['user_email'] : ''; ?>">
                    </div>

                    <!-- user image -->

                    <div class="form-outline my-2">
                        <label for="user_image" class="form-label">Profile picture</label>
                        <input type="file" id="user_image" class="form-control" name="user_image" required="required"
                            required
                            value="<?php echo isset($_SESSION['user_input']['user_image']) ? $_SESSION['user_input']['user_image'] : ''; ?>">
                    </div>

                    <!-- user password -->
                    <div class="form-outline my-2">
                        <label for="user_password" class="form-label">User password</label>
                        <input type="password" id="user_password" class="form-control" name="user_password"
                            placeholder="Enter your password" autocomplete="off" required="required" required
                            value="<?php echo isset($_SESSION['user_input']['user_password']) ? $_SESSION['user_input']['user_password'] : ''; ?>">
                    </div>

                    <!-- confirm user password -->
                    <div class="form-outline my-2">
                        <label for="conf_user_password" class="form-label">confirm password</label>
                        <input type="password" id="conf_user_password" class="form-control" name="conf_user_password"
                            placeholder="Confirm your password" autocomplete="off" required="required" required
                            value="<?php echo isset($_SESSION['user_input']['conf_user_password']) ? $_SESSION['user_input']['conf_user_password'] : ''; ?>">
                    </div>

                    <!-- user address -->
                    <div class="form-outline my-2">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" name="user_address"
                            placeholder="Enter your address" autocomplete="off" required="required" required
                            value="<?php echo isset($_SESSION['user_input']['user_address']) ? $_SESSION['user_input']['user_address'] : ''; ?>">
                    </div>

                    <!-- user contact -->
                    <div class="form-outline my-2">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" class="form-control" name="user_contact"
                            placeholder="Enter your contact" autocomplete="off" required="required" required
                            value="<?php echo isset($_SESSION['user_input']['user_contact']) ? $_SESSION['user_input']['user_contact'] : ''; ?>">
                    </div>

                    <div class="mt-3 pt-3">
                        <input type="submit" value="Register" class="btn btn-primary px-3 py-2" name="user_register">
                        <p class="mt-2 pt-1 small fw-bold">Already have an account ?<a href="user_login.php"
                                class="link-danger"> Login</a></p>
                    </div>

                </form>

            </div>
            

        </div>
        <div class="text-center mt-3">
            <a role="button" class="btn btn-primary " href="../index.php">Home</a>
        </div>
        

    </div>
   
    <!-- bootstrap javascript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user_ip = getIPAddress();
if (isset($_POST['user_register'])) {
    session_start();

    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = basename($_FILES['user_image']['name']);
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    //hashing the password to store it in database
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);


    //to check whether the entered user name is available or not
    $check_query = "select * from `user_table` where user_email='$user_email' or user_mobile='$user_contact'";
    $check_result = mysqli_query($con, $check_query);

    $check_num_rows = mysqli_num_rows($check_result);
    if ($check_num_rows > 0) {
        echo "<script>alert('Entered contact details already exists, give different email or contact number')</script>";

    } elseif ($user_password != $conf_user_password) {
        echo "<script>alert('confirm password did not match')</script>";

    } else {
        $fileExtension = pathinfo($user_image, PATHINFO_EXTENSION);
        $user_image_new = $user_contact . '.' . $fileExtension;
        move_uploaded_file($user_image_temp, "user_images/$user_image_new");

        //insert query
        $insert_query = "insert into `user_table` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile) values ('$user_username','$user_email','$hash_password','$user_image_new','$user_ip','$user_address','$user_contact')";
        $insert_result = mysqli_query($con, $insert_query);
        if ($insert_result) {
            $_SESSION['user_email'] = $user_email;
            $_SESSION['username'] = $user_username;
            echo "<script>alert('User registered successfully')</script>";
        } else {
            die(mysqli_error($con));
        }


        //selecting cart items and asking user to check out
        $select_cart_items = "select * from `cart_details` where ip_address='$user_ip'";
        $result_cart = mysqli_query($con, $select_cart_items);
        $rows_count = mysqli_num_rows($result_cart);
        if ($rows_count > 0) {
            echo "<script>alert('You have items in your cart')</script>";
            echo "<script>window.open('../checkout.php','_self')</script>";

        } else {
            echo "<script>window.open('../index.php','_self')</script>";
        }


    }

}

?>