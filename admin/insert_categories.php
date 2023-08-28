<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if(!isset($_SESSION['admin_name'])  && !isset($_SESSION['admin_email']))
{
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<?php
include('../includes/connect.php');
if (isset($_POST['insert_category'])) {
    $category_title = $_POST['category_title']; //from this we will extract the value entered in the form

    //to avoid duplicate entries into db we will screen the input for redundancy
    $select_query = "select * from `categories` where category_title='$category_title'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);
    if ($number > 0) {
        //already entered data is present so we avoid redundancy by not inserting this data into db
        echo "<script>alert('This category is present inside the database')</script>";
    } else {
        $insert_query = "insert into `categories` (category_title) values ('$category_title')";
        $result = mysqli_query($con, $insert_query); //here $con is from connect.php
        if ($result) {
            echo "<script>alert('Category has been inserted successfully')</script>";
        }
    }

}
?>
<h3 class="text-center">
    Insert Categories
</h3>
<form action="" method="post" class="mb-2 mt-4">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-primary"><i class="fa-solid fa-receipt"></i></span>
        <div class="form-floating">
            <input type="text" class="form-control p-10" id="floatingInputGroup1" name="category_title"
                placeholder="Insert categories">
            <label for="floatingInputGroup1">Insert Categories</label>
        </div>
    </div>
    <div class="input-group w-10 mb-2 mt-3">

        <input type="submit" class="btn btn-primary" name="insert_category" value="Insert Categories">
        <!-- <button type="submit" class="btn btn-primary">Insert Categories</button> -->
    </div>
</form>