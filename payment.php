<?php
//logic to check whether the user is logged in or not to give him access of this page
if(!isset($_SESSION['user_email'])  && !isset($_SESSION['username']))
{
    echo "<script>window.open('cart.php','_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zipkart-payment</title>
</head>

<body>
    <div class="container p-0 ">
        <div class="bg-light">
            <h3 class="text-center">
                ZipKart
            </h3>
            <p class="text-center">
                Buy your happiness at best cost
            </p>
        </div>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-4">
                <form action="" method="post">

                    <div class="card text-center mb-3">
                        <div class="card-header">
                            <h3 class="text-center text-primary">Payment options</h3>
                        </div>
                        <div class="card-body text-center table-responsive">

                            <table class="table table-hover align-middle table-borderless">
                                <tbody>
                                    <tr>
                                        <th scope="row"><input type='checkbox' name='option' value='upi'></th>
                                        <td><label class="form-check-label" for="option">UPI</label></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><input type='checkbox' name='option' value='db_card'></th>
                                        <td><label class="form-check-label" for="option">Debit-card</label></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><input type='checkbox' name='option' value='cr_card'></th>
                                        <td><label class="form-check-label" for="option">Credit-card</label></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><input type='checkbox' name='option' value='cod'></th>
                                        <td><label class="form-check-label" for="option">COD</label></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-body-secondary ">
                            <div>
                                <input type="submit" value="Confirm" class="btn btn-primary px-3 py-2"
                                    name="payment_option">
                            </div>
                        </div>
                    </div>

                </form>

            </div>


        </div>

    </div>
</body>

</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['payment_option'])) {
    $user_ip = getIPAddress();
    $user_query = "select * from `user_table` where user_ip='$user_ip'";
    $user_result = mysqli_query($con, $user_query);
    $user_data = mysqli_fetch_array($user_result);

    $user_id = $user_data['user_id'];

    $var = $_POST['option'];
    if ($var == 'cod') {

        $invoice_number=mt_rand();
        $status='pending';
        $quantity=0;
        $total_cart_value = 0;
        $product_array=[];
        $select_query = "select * from `cart_details` where ip_address='$user_ip'";
        $result_query = mysqli_query($con, $select_query);
        $cart_items=mysqli_num_rows($result_query);
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            //adding product_id to product_array
            array_push($product_array,$product_id);
            $qty = $row['quantity'];
            $quantity+=$qty;
            $price_query = "select * from `products` where product_id=$product_id";
            $result = mysqli_query($con, $price_query);
            $data = mysqli_fetch_assoc($result);
            $ind_price = $data['product_price'];
            $temp_price = $ind_price * $qty;
            $total_cart_value += $temp_price;
        }
        // now to convert php array into json array 
        $json_array=json_encode($product_array); // this is converted to string datatype so we can easily insert into db

        //now to insert all the above details into user_orders table
        $insert_orders="insert into `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status) values ($user_id,$total_cart_value,$invoice_number,$quantity,NOW(),'$status')";
        $insert_orders_result=mysqli_query($con,$insert_orders);
        if($insert_orders_result)
        {
            echo "<script>alert('Order is submitted successfully')</script>";

        }

        //now to insert the order details into orders_pending table
        $insert_orders_pending="insert into `orders_pending` (user_id,invoice_number,product_id,quantity,order_status) values ($user_id,$invoice_number,'$json_array',$quantity,'$status')";
        $insert_orders_pending_result=mysqli_query($con,$insert_orders_pending);

        //after all these operations we have to empty the cart
        $empty_cart="delete from `cart_details` where ip_address='$user_ip'";
        $empty_cart_result=mysqli_query($con,$empty_cart);

        echo "<script>window.open('users_area/profile.php','_self')</script>"; 


    }


}
?>