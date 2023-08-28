<?php
include('../includes/connect.php');

//function to display all the products
function getproducts()
{
    global $con;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "select * from `products` order by rand()";
            $result_query = mysqli_query($con, $select_query);
            while ($product = mysqli_fetch_assoc($result_query)) {
                $product_id = $product['product_id'];
                $product_title = $product['product_title'];
                $product_description = $product['product_description'];
                $trimmed_product_description = substr($product_description, 0, 90);
                $product_category = $product['category_id'];
                $product_brand = $product['brand_id'];
                $product_image1 = $product['product_image1'];
                $product_price = $product['product_price'];
                echo "<div class='col-lg-4 col-md-6 col-sm-10 mb-3 '>
                <div class='card' style='width: 18rem;'>
                <img src='admin/product_images/$product_image1' class='card-img-top ' alt='$product_title' >
                <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$trimmed_product_description<a href='product_details.php?product_id=$product_id' class='nav-link'>...</a></p>
                <p class='card-text'>Price: $product_price ₹</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>

                </div>
                </div>
                </div>";
            }
        }


    }
}

//function to display unique categories
function get_unique_category(){
    global $con;
    if(isset($_GET['category']))
    {
        $category_id=$_GET['category'];
        $select_query = "select * from `products` where category_id=$category_id";
            $result_query = mysqli_query($con, $select_query);
            $num_of_rows=mysqli_num_rows($result_query);
            if($num_of_rows==0)
            {
                echo "<h3 class='text-center pt-4 text-danger'>No stock for this category</h3>";
            }
            else{
            while ($product = mysqli_fetch_assoc($result_query)) {
                $product_id = $product['product_id'];
                $product_title = $product['product_title'];
                $product_description = $product['product_description'];
                $trimmed_product_description = substr($product_description, 0, 90);
                $product_category = $product['category_id'];
                $product_brand = $product['brand_id'];
                $product_image1 = $product['product_image1'];
                $product_price = $product['product_price'];
                echo "<div class='col-md-4 mb-2 '>
                <div class='card' style='width: 18rem;'>
                <img src='admin/product_images/$product_image1' class='card-img-top ' alt='$product_title' >
                <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$trimmed_product_description<a href='product_details.php?product_id=$product_id' class='nav-link'>...</a></p>
                <p class='card-text'>Price: $product_price ₹</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>

                </div>
                </div>
                </div>";
            }
            }
    }
}

//function to get unique brands
function get_unique_brand(){
    global $con;
    if(isset($_GET['brand']))
    {
        $brand_id=$_GET['brand'];
        $select_query = "select * from `products` where brand_id=$brand_id";
            $result_query = mysqli_query($con, $select_query);
            $num_of_rows=mysqli_num_rows($result_query);
            if($num_of_rows==0)
            {
                echo "<h3 class='text-center pt-4 text-danger'>No stock for this brand</h3>";
            }
            else{
            while ($product = mysqli_fetch_assoc($result_query)) {
                $product_id = $product['product_id'];
                $product_title = $product['product_title'];
                $product_description = $product['product_description'];
                $trimmed_product_description = substr($product_description, 0, 90);
                $product_category = $product['category_id'];
                $product_brand = $product['brand_id'];
                $product_image1 = $product['product_image1'];
                $product_price = $product['product_price'];
                echo "<div class='col-md-4 mb-2 '>
                <div class='card' style='width: 18rem;'>
                <img src='admin/product_images/$product_image1' class='card-img-top ' alt='$product_title' >
                <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$trimmed_product_description<a href='product_details.php?product_id=$product_id' class='nav-link'>...</a></p>
                <p class='card-text'>Price: $product_price ₹</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>

                </div>
                </div>
                </div>";
            }
            }
    }
}

//function to display all brands
function getbrands()
{
    global $con;
    $select_brand = "select * from `brands`";
    $result_brand = mysqli_query($con, $select_brand);
    while ($row_data = mysqli_fetch_assoc($result_brand)) {
        $brand_id = $row_data['brand_id'];
        $brand_title = $row_data['brand_title'];
        echo "<li class='nav-item  text-light '>
                        <a class='nav-link 'href='index.php?brand=$brand_id'>
                            <h6>$brand_title</h6>
                        </a>
                        </li>";
    }
}
//function to display all categories
function getcategories()
{
    global $con;
    $select_category = "select * from `categories`";
    $result_category = mysqli_query($con, $select_category);
    while ($row_data = mysqli_fetch_assoc($result_category)) {
        $category_id = $row_data['category_id'];
        $category_title = $row_data['category_title'];
        echo "<li class='nav-item  text-light '>
                        <a class='nav-link 'href='index.php?category=$category_id'>
                            <h6>$category_title</h6>
                        </a>
                        </li>";
    }
}

//function to search the product 
function search_product()
{
    global $con;
    //if Search is required then only we do the search operation
    if(isset($_GET['search_data_product']))
    {
        $search_data=$_GET['search_data'];
        $select_query = "select * from `products` where product_keywords like '%$search_data%'";
            $result_query = mysqli_query($con, $select_query);
            $result_num_rows=mysqli_num_rows($result_query);
            if($result_num_rows==0)
            {
                echo "<h3 class='text-center pt-4 text-danger'>No matches found, no products found in this category</h3>";
            }
            else{
            while ($product = mysqli_fetch_assoc($result_query)) {
                $product_id = $product['product_id'];
                $product_title = $product['product_title'];
                $product_description = $product['product_description'];
                $trimmed_product_description = substr($product_description, 0, 90);
                $product_category = $product['category_id'];
                $product_brand = $product['brand_id'];
                $product_image1 = $product['product_image1'];
                $product_price = $product['product_price'];
                echo "<div class='col-md-4 mb-2 '>
                <div class='card' style='width: 18rem;'>
                <img src='admin/product_images/$product_image1' class='card-img-top ' alt='$product_title' >
                <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$trimmed_product_description<a href='product_details.php?product_id=$product_id' class='nav-link'>...</a></p>
                <p class='card-text'>Price: $product_price ₹</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>

                </div>
                </div>
                </div>";
            }
        }

    }
}

//function to display the details of the 
function get_product_details(){
    global $con;
    if(isset($_GET['product_id']))
    {
        $product_id=$_GET['product_id'];
        $select_query = "select * from `products` where product_id=$product_id";
        $result_query = mysqli_query($con, $select_query);
        $product = mysqli_fetch_assoc($result_query);
        $product_title = $product['product_title'];
        $product_description = $product['product_description'];
        $product_category = $product['category_id'];

        //getting the category name
        $select_category="select * from `categories` where category_id=$product_category";
        $result_category=mysqli_query($con, $select_category);
        $category=mysqli_fetch_assoc($result_category);
        $category_title=$category['category_title'];

        $product_brand = $product['brand_id'];
        //getting the brand name
        $select_brand="select * from `brands` where brand_id=$product_brand";
        $result_brand=mysqli_query($con, $select_brand);
        $brand=mysqli_fetch_assoc($result_brand);
        $brand_title=$brand['brand_title'];

        $product_image1 = $product['product_image1'];
        $product_image2 = $product['product_image2'];
        $product_image3 = $product['product_image3'];
        $product_price = $product['product_price'];
        echo "<div class='row py-3 px-4'>
        <div class='col-md-6'>
            <div id='carouselExampleIndicators' class='carousel carousel-dark slide'>
                <div class='carousel-indicators'>
                    <button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='0' class='active'
                        aria-current='true' aria-label='Slide 1'></button>
                    <button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='1'
                        aria-label='Slide 2'></button>
                    <button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='2'
                        aria-label='Slide 3'></button>
                </div>
                <div class='carousel-inner'>
                    <div class='carousel-item active'>
                        <img src='admin/product_images/$product_image1' class='d-block w-100 product' alt='...'>
                    </div>
                    <div class='carousel-item'>
                        <img src='admin/product_images/$product_image2' class='d-block w-100 product' alt='...'>
                    </div>
                    <div class='carousel-item'>
                        <img src='admin/product_images/$product_image3' class='d-block w-100 product' alt='...'>
                    </div>
                </div>
                <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleIndicators'
                    data-bs-slide='prev'>
                    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                    <span class='visually-hidden'>Previous</span>
                </button>
                <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleIndicators'
                    data-bs-slide='next'>
                    <span class='carousel-control-next-icon' aria-hidden='true'></span>
                    <span class='visually-hidden'>Next</span>
                </button>
            </div>
        </div>
        <!-- to display content -->
        <div class='col-md-6'>
            <h5 class='card-title'>$product_title</h5>
            <h6 class='pt-2 pb-0'>Description:</h6>
            <p class='card-text'>$product_description</p>
            <p class='card-text'>Category: $category_title</p>
            <p class='card-text'>Brand: $brand_title</p>
            <p class='card-text'>Price: $product_price ₹</p>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
        </div>
    </div>";


    }

}

//function to get the ip address of user
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  


// function for cart
function cart(){
    
    if(isset($_GET['add_to_cart']))
    {
       global $con;
       $get_ip_add=getIPAddress();
       $get_product_id=$_GET['add_to_cart'];
       $select_query="select * from `cart_details` where ip_address='$get_ip_add' and product_id=$get_product_id";
       $result_query=mysqli_query($con,$select_query);
       $num_of_rows=mysqli_num_rows($result_query);
       if($num_of_rows>0)
       {
            echo "<script>alert('This item is already present inside cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";

       }
       else{

            $insert_query="insert into `cart_details` (product_id,ip_address,quantity) values ($get_product_id,'$get_ip_add',1) ";
            $result_query=mysqli_query($con,$insert_query);
            echo "<script>alert('This item is added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";


       }
    }
}
// function to display the number of cart items
function cart_item(){
    global $con;
    if(isset($_GET['add_to_cart']))
    {
        $get_ip_add=getIPAddress();
        $select_query="select * from `cart_details` where ip_address='$get_ip_add'";
        $result_query=mysqli_query($con,$select_query);
        $no_items=mysqli_num_rows($result_query);

    }
    else{
        $get_ip_add=getIPAddress();
        $select_query="select * from `cart_details` where ip_address='$get_ip_add'";
        $result_query=mysqli_query($con,$select_query);
        $no_items=mysqli_num_rows($result_query);
    }
    echo $no_items;
}

//function to find the total value of the cart
function total_cart_price(){
    global $con;
    $total_cart_value=0;
    $get_ip_add=getIPAddress();
    $select_query="select * from `cart_details` where ip_address='$get_ip_add'";
    $result_query=mysqli_query($con,$select_query);
    while($row=mysqli_fetch_assoc($result_query))
    {
        $product_id=$row['product_id'];
        $qty=$row['quantity'];
        $price_query="select * from `products` where product_id=$product_id";
        $result=mysqli_query($con,$price_query);
        $data=mysqli_fetch_assoc($result);
        $ind_price=$data['product_price'];
        $temp_price=$ind_price*$qty;
        $total_cart_value+=$temp_price;
    }
    echo $total_cart_value;
}

//function to get the number of pending orders
function get_order_details(){
    global $con;
    $user_email=$_SESSION['user_email'];
    $details_query="select * from `user_table` where user_email='$user_email'";
    $details_query_result=mysqli_query($con,$details_query);
    $row=mysqli_fetch_assoc($details_query_result);
    $user_id=$row['user_id'];
    if(isset($_GET['pending_orders']))
    {
        $get_orders="select * from `user_orders` where user_id=$user_id and order_status='pending'";
        $get_orders_result=mysqli_query($con,$get_orders);
        $num_rows=mysqli_num_rows($get_orders_result);
        if($num_rows>0)
        {
            echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$num_rows</span> pending orders</h3>";
            echo "<p class='text-center text-dark'><a href='profile.php?my_orders' class='text-dark' >Order details</a></p>";

        }
        else{
            echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>0</span> pending orders</h3>";
            echo "<p class='text-center text-dark'><a href='../index.php' class='text-dark' >Explore products</a></p>";


        }
    }
}
?>