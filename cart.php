<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!-- php code to do the dynamic updation of the cart -->
<?php
global $con;
$get_ip_add = getIPAddress();
if(isset($_POST['update_cart']))
{
    $quantity=$_POST['quantity'];
    $product_id=$_POST['product_id'];
    $update_query="update `cart_details` set quantity=$quantity where ip_address='$get_ip_add' and product_id=$product_id" ;
    $update_result=mysqli_query($con,$update_query);
    echo "<script>alert('Successfully updated the cart')</script>";
    echo "<script>window.open('cart.php','_self')</script>";
}
?>

<!-- php code to remove the product from cart dynamically -->
<?php
global $con;
$get_ip_add = getIPAddress();
if(isset($_POST['remove']))
{
    $product_id=$_POST['remove_item'];
    $delete_query="delete from `cart_details` where ip_address='$get_ip_add' and product_id=$product_id" ;
    $delete_result=mysqli_query($con,$delete_query);
    echo "<script>alert('Successfully removed the selected item')</script>";
    echo "<script>window.open('cart.php','_self')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zipkart-Cart details</title>
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="styles.css">
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .profile {
            width: 100%;
            height: 100px;
            object-fit: contain;
        }

        .product_image {
            width: 100%;
            height: 100px;
            object-fit: contain;
        }
        body{
            overflow-x: hidden;
        }
    </style>
</head>

<body>


    <div class="container-fluid p-0">
        <!-- first child -->
        <!-- navbar -->
        <?php
        include('includes/header.php');
        ?>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center text-primary">
                Cart details
            </h3>
        </div>

        
        <!-- to check whether cart is empty -->
        <?php
        global $con;
        $get_ip_add = getIPAddress();
        $select_query = "select * from `cart_details` where ip_address='$get_ip_add'";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0)
        {
            echo "<div class='container text-center mb-3'>
            <h3 class='text-center pt-4 text-danger'>Cart is Empty, start shopping</h3>
            <a href='index.php' ><button class='btn btn-primary '>Continue shopping</button></a>
            </div>";
            include('includes/footer.php');
            exit(0);

        }
        
        ?>
        
        <!-- fourth child -->
        <div class="container table-responsive">
            <div class="row">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr class="table-primary">
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody >
                            <!-- php code to display the cart items dynamically -->
                            <?php
                            global $con;
                            $total_cart_value = 0;
                            $get_ip_add = getIPAddress();
                            $select_query = "select * from `cart_details` where ip_address='$get_ip_add'";
                            $result_query = mysqli_query($con, $select_query);
                            while ($row = mysqli_fetch_assoc($result_query)) {
                                $product_id = $row['product_id'];
                                $qty=$row['quantity'];
                                $price_query = "select * from `products` where product_id=$product_id";
                                $result = mysqli_query($con, $price_query);
                                $data = mysqli_fetch_assoc($result);
                                $product_title = $data['product_title'];
                                $product_image = $data['product_image1'];
                                $product_price = $data['product_price'];
                                $total_price=$qty*$product_price;
                                $total_cart_value += $total_price;
                                echo "<tr>
                            <td>$product_title</td>
                            <td><img src='admin/product_images/$product_image' alt='image' class='product_image'></td>
                            <form action='' method='post'>
                            <td><input type='text' class='form-input w-50' name='quantity' id='quantity' placeholder='$qty'>
                            <input type='hidden' name='product_id' value='$product_id'>
                            </td>
                            <td>$total_price ₹</td>
                            <td><input type='checkbox' name='remove_item' value='$product_id'></td>
                            <td>
                                <div class='d-flex'>
                                <input type='submit' class='btn btn-primary mx-2' value='Update' name='update_cart'>
                                <input type='submit' class='btn btn-primary mx-2' value='Remove' name='remove'>

                                </div>
                            </td>
                            </form>
                        </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- subtotal -->
                    <div class="d-flex py-2">
                        <h4 class=" text-primary">Subtotal: <strong>
                                <?php total_cart_price() ?> ₹
                            </strong></h4>
                        <a href="index.php"><button class="btn btn-secondary mx-3">Continue shopping</button></a>
                        <a href="checkout.php"><button class="btn btn-primary mx-3">Checkout</button></a>

                    </div>
                </form>
            </div>
        </div>
        <!-- footer section -->
        <?php
        include('includes/footer.php');
        ?>

    </div>
    <!-- bootstrap javascript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>