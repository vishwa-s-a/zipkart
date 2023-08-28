<?php
//logic to check whether the user is logged in or not to give him access of this page
if(!isset($_SESSION['user_email'])  && !isset($_SESSION['username']))
{
    echo "<script>window.open('user_login.php','_self')</script>";
}

?>
<?php
include('includes/connect.php');
include('../functions/common_function.php');
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select = "select * from `user_orders` where order_id=$order_id";
    $result = mysqli_query($con, $select);
    $data = mysqli_fetch_assoc($result);
    $invoice_number = $data['invoice_number'];
    $amount_due = $data['amount_due'];
}

if (isset($_POST['confirm_payment'])) {
    $payment_mode = $_POST['payment_mode'];

    $insert_query = "insert into `user_payments` (order_id,invoice_number,amount,payment_mode,date) values ($order_id,$invoice_number,$amount_due,'$payment_mode',NOW())";
    $insert_result = mysqli_query($con, $insert_query);
    if ($insert_result) {
        echo "<script>alert('Successfully completed the payment')</script>";


        //update query
        $update = "update `user_orders` set order_status='Complete' where order_id=$order_id";
        $update_result = mysqli_query($con, $update);

        echo "<script>window.open('profile.php?my_orders','_self')</script>";


    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zipkart-Payment</title>
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="../styles.css">
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-secondary">
    <!-- <h1 class="text-center text-light">Confirm Payment</h1> -->
    <div class="container my-5">
        <h1 class="text-center text-light">Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number"
                    value="<?php echo $invoice_number ?>" disabled>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" disabled class="form-control w-50 m-auto mb-2" value="Total Amount">
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>"
                    disabled>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select Payment Mode</option>
                    <option>UPI</option>
                    <option>Netbanking</option>
                    <option>Debit-card</option>
                    <option>Cash on Delivery</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="btn btn-primary" name="confirm_payment" value="Confirm">
            </div>
        </form>
    </div>

    <!-- bootstrap javascript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>