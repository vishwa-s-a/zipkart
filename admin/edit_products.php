<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if(!isset($_SESSION['admin_name'])  && !isset($_SESSION['admin_email']))
{
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<div class="container mt-5">
    <h3 class="text-center">Edit Products</h3>
    <?php
    $id = $_GET['edit_products'];
    $product_query = "select * from `products` where product_id=$id";
    $product_result = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_assoc($product_result);
    $title = $product_data['product_title'];
    $description = $product_data['product_description'];
    $keywords = $product_data['product_keywords'];
    $image1 = $product_data['product_image1'];
    $image2 = $product_data['product_image2'];
    $image3 = $product_data['product_image3'];
    $price = $product_data['product_price'];
    $category = $product_data['category_id'];
    $brand = $product_data['brand_id'];
    $status = $product_data['status'];

    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" id="product_title" name="product_title" class="form-control"
                value="<?php echo $title ?>">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_desc" class="form-label">Product Description</label>
            <input type="text" id="product_desc" name="product_desc" class="form-control"
                value="<?php echo $description ?>">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_key" class="form-label">Product keywords</label>
            <input type="text" id="product_key" name="product_key" class="form-control" value="<?php echo $keywords ?>">
        </div>
        <!-- categories -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_category" class="form-label">Product Category</label>
            <select name="product_category" id="product_category" class="form-select">
                <?php
                $select_query = "select * from `categories`";
                $result_query = mysqli_query($con, $select_query);

                $select_query1 = "select * from `categories` where category_id=$category";
                $select_query1_result = mysqli_query($con, $select_query1);
                $row = mysqli_fetch_assoc($select_query1_result);
                $category_title = $row['category_title'];
                echo "<option value='$category'>$category_title</option>";

                while ($row = mysqli_fetch_assoc($result_query)) {
                    $category_title = $row['category_title'];
                    $category_id = $row['category_id'];

                    if ($category_id != $category) {
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                }
                ?>
            </select>
        </div>
        <!-- brands -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_brand" class="form-label">Product Brand</label>
            <select name="product_brand" id="product_brand" class="form-select">
                <?php
                $select_brand = "select * from `brands`";
                $result_brand = mysqli_query($con, $select_brand);

                $select_brand1 = "select * from `brands` where brand_id=$brand";
                $select_brand1_result = mysqli_query($con, $select_brand1);
                $row = mysqli_fetch_assoc($select_brand1_result);
                $brand_title = $row['brand_title'];
                echo "<option value='$brand'>$brand_title</option>";

                while ($row_data = mysqli_fetch_assoc($result_brand)) {
                    $brand_title = $row_data['brand_title'];
                    $brand_id = $row_data['brand_id'];
                    if ($brand_id != $brand) {
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }

                }
                ?>
            </select>
        </div>

        <!-- product image1 -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image1" class="form-label"> New Product Image 1</label>
            <input type="file" class="form-control" name="product_image1" value="<?php echo $image1 ?>">
        </div>

        <!-- product image2 -->
        <div class="form-outline m-auto w-50 mb-4">
            <label for="product_image2" class="form-label"> New Product Image 2</label>
            <input type="file" class="form-control" name="product_image2" value="<?php echo $image2 ?>">
        </div>
        <!-- product image3 -->
        <div class="form-outline m-auto w-50 mb-4">
            <label for="product_image3" class="form-label"> New Product Image 3</label>
            <input type="file" class="form-control" name="product_image3" value="<?php echo $image3 ?>">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product price</label>
            <input type="text" id="product_price" name="product_price" class="form-control"
                value="<?php echo $price ?>">
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_status" class="form-label">Product Status</label>
            <input type="text" id="product_status" name="product_status" class="form-control"
                value="<?php echo $status ?>">
        </div>

        <div class="text-center">
            <input type="submit" class="btn btn-primary" name="update_product" value="Update">
        </div>
    </form>
</div>

<!-- editing the product -->
<?php
if (isset($_POST['update_product'])) {
    $product_title = $_POST['product_title'];
    $product_desc = $_POST['product_desc'];
    $product_key = $_POST['product_key'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_status = $_POST['product_status'];

    // $product_image1=$_POST['product_image1'];
    // $product_image2=$_POST['product_image2'];
    // $product_image3=$_POST['product_image3'];

    $temp1 = basename($_FILES['product_image1']['name']);
    $temp2 = basename($_FILES['product_image2']['name']);
    $temp3 = basename($_FILES['product_image3']['name']);

    //for image1
    if (empty($temp1)) {
        $new_product_image1 = $image1;
    } else {
        $new_image1 = basename($_FILES['product_image1']['name']);
        $new_image_temp1 = $_FILES['product_image1']['tmp_name'];

        $fileExtension = pathinfo($new_image1, PATHINFO_EXTENSION);
        $new_product_image1 = $id . '(1)' . '.' . $fileExtension;

        //now to delete the old image of user
        $filepath = "product_images/$image1";
        unlink($filepath); //this function will delete the previous file

        //move the uploaded file
        move_uploaded_file($new_image_temp1, "product_images/$new_product_image1");
    }

    //for image2
    if (empty($temp2)) {
        $new_product_image2 = $image2;
    } else {
        $new_image2 = basename($_FILES['product_image2']['name']);
        $new_image_temp2 = $_FILES['product_image2']['tmp_name'];

        $fileExtension = pathinfo($new_image2, PATHINFO_EXTENSION);
        $new_product_image2 = $id . '(2)' . '.' . $fileExtension;

        //now to delete the old image of user
        $filepath = "product_images/$image2";
        unlink($filepath); //this function will delete the previous file

        //move the uploaded file
        move_uploaded_file($new_image_temp2, "product_images/$new_product_image2");
    }

    //for image3
    if (empty($temp3)) {
        $new_product_image3 = $image3;
    } else {
        $new_image3 = basename($_FILES['product_image3']['name']);
        $new_image_temp3 = $_FILES['product_image3']['tmp_name'];

        $fileExtension = pathinfo($new_image3, PATHINFO_EXTENSION);
        $new_product_image3 = $id . '(3)' . '.' . $fileExtension;

        //now to delete the old image of user
        $filepath = "product_images/$image3";
        unlink($filepath); //this function will delete the previous file

        //move the uploaded file
        move_uploaded_file($new_image_temp3, "product_images/$new_product_image3");
    }


    //the update query
    $update = "update `products` set product_title='$product_title',product_description='$product_desc',product_keywords='$product_key',category_id=$product_category,brand_id=$product_brand,product_image1='$new_product_image1',product_image2='$new_product_image2',product_image3='$new_product_image3',product_price='$product_price',date=NOW(),status='$product_status' where product_id=$id";
    $update_result=mysqli_query($con,$update);
    if($update_result)
    {
        echo "<script>alert('Product updated successfully')</script>";
        echo "<script>window.open('index.php?view_products','_self')</script>";
    }




}

?>