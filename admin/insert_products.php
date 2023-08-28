<?php
session_start();
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if(!isset($_SESSION['admin_name'])  && !isset($_SESSION['admin_email']))
{
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<?php
include('../includes/connect.php');

if(isset($_POST['insert_product']))
{
    $product_title=$_POST['product_title'];
    $product_description=$_POST['product_description'];
    $product_keywords=$_POST['product_keywords'];
    $product_category=$_POST['product_category'];
    $product_brand=$_POST['product_brand'];
    $product_price=$_POST['product_price'];
    $product_status='true';

    //accessing images
    $product_image1=basename($_FILES['product_image1']['name']);
    $product_image2=basename($_FILES['product_image2']['name']);
    $product_image3=basename($_FILES['product_image3']['name']);

    //accessing images tmp name
    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];
   

    //checking for empty fields
    if($product_title=='' or $product_brand=='' or $product_category=='' or $product_description=='' or $product_image1=='' or $product_image2=='' or $product_image3=='' or $product_keywords=='' or $product_price=='')
    {
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    }
    else{
        //renaming the files to our convenience  
        $fileExtension = pathinfo($product_image1, PATHINFO_EXTENSION);
        $new_product_image1 = $product_title . '(1)' . '.' . $fileExtension;

        $fileExtension = pathinfo($product_image2, PATHINFO_EXTENSION);
        $new_product_image2 = $product_title . '(2)' . '.' . $fileExtension;

        $fileExtension = pathinfo($product_image3, PATHINFO_EXTENSION);
        $new_product_image3 = $product_title . '(3)' . '.' . $fileExtension;

        //storing the uploaded file into a folder
        move_uploaded_file($temp_image1,"product_images/$new_product_image1");
        move_uploaded_file($temp_image2,"product_images/$new_product_image2");
        move_uploaded_file($temp_image3,"product_images/$new_product_image3");

        //error displaying code
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        //insert query
        $insert_product="insert into `products` (product_title,product_description,product_keywords,category_id,brand_id,product_image1,product_image2,product_image3,product_price,date,status) values ('$product_title','$product_description','$product_keywords','$product_category','$product_brand','$new_product_image1','$new_product_image2','$new_product_image3','$product_price',NOW(),'$product_status')";
        $result1_query=mysqli_query($con,$insert_product);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        if($result1_query)
        {
            echo "<script>alert('Successfully inserted the product')</script>";
        }
        else{
            echo "<script>alert('Unsuccessful')</script>";
        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin</title>
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

<body class="bg-light">

    <div class="container mt-3">
        <h3 class="text-center">Insert Products</h3>

        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" class="form-control" name="product_title" id="product_title"
                    placeholder="Enter product title" autocomplete="off" required="required">
            </div>
            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Product description</label>
                <input type="text" class="form-control" name="product_description" id="product_description"
                    placeholder="Enter product description" autocomplete="off" required="required">
            </div>
            <!-- keywords -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product keywords</label>
                <input type="text" class="form-control" name="product_keywords" id="product_keywords"
                    placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>
            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">select a category</option>
                    <?php
                        $select_query="select * from `categories`";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query))
                        {
                            $category_title=$row['category_title'];
                            $category_id=$row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?>

                </select>
            </div>
            <!-- brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brand" id="" class="form-select">
                    <option value="">select a brand</option>
                    <?php
                        $select_brand="select * from `brands`";
                        $result_brand=mysqli_query($con,$select_brand);
                        while($row_data=mysqli_fetch_assoc($result_brand))
                        {
                            $brand_title=$row_data['brand_title'];
                            $brand_id=$row_data['brand_id'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                    ?>

                </select>
            </div>
            <!-- image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" class="form-control" name="product_image1" id="product_image1"
                     required="required">
            </div>
            <!-- image 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product image 2</label>
                <input type="file" class="form-control" name="product_image2" id="product_image2"
                     required="required">
            </div>
            <!-- image 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product image 3</label>
                <input type="file" class="form-control" name="product_image3" id="product_image3"
                     required="required">
            </div>
            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" class="form-control" name="product_price" id="product_price"
                    placeholder="Enter product price" autocomplete="off" required="required">
            </div>

            <!-- submit button -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-primary" value="Insert Product">
            </div>

        </form>
    </div>


    <!-- bootstrap javascript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>