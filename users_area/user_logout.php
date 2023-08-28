<?php
//logic to check whether the user is logged in or not to give him access of this page
if(!isset($_SESSION['user_email'])  && !isset($_SESSION['username']))
{
    echo "<script>window.open('user_login.php','_self')</script>";
}

?>
<?php
session_start();

session_unset();

session_destroy();

echo "<script>window.open('../index.php','_self')</script>";
?>