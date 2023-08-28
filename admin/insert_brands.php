<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if(!isset($_SESSION['admin_name'])  && !isset($_SESSION['admin_email']))
{
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<?php
// this is for including the required php file for connecting to the db
include('../includes/connect.php');
if(isset($_POST['insert_brand']))
{
    $brand_title=$_POST['brand_title'];

    $select_query="select * from `brands` where brand_title='$brand_title'";
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select);

    if($number>0)
    {
        echo "<script>alert('This brand is present inside the database')</script>";

    }
    else{
        $insert_query="insert into `brands` (brand_title) values ('$brand_title')";
        $result=mysqli_query($con,$insert_query);
        if($result)
        {
            echo "<script>alert('Brand has been inserted successfully')</script>";

        }
    }
}
?>
<h3 class="text-center">
    Insert Brands
</h3>
<form action="" method="post" class="mb-2 mt-4">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-primary"><i class="fa-solid fa-receipt"></i></span>
        <div class="form-floating">
            <input type="text" class="form-control p-10" id="floatingInputGroup1" name="brand_title" placeholder="Insert brands">
            <label for="floatingInputGroup1">Insert Brands</label>
        </div>
    </div>
    <div class="input-group w-10 mb-2 mt-3">

        <input type="submit" class="btn btn-primary " name="insert_brand" value="Insert brands">
        <!-- <button type="submit" class="btn btn-primary">Insert Brands</button> -->
    </div>
</form>