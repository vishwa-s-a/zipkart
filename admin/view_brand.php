<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if(!isset($_SESSION['admin_name'])  && !isset($_SESSION['admin_email']))
{
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<h3 class="text-center text-success">
    All Brands
</h3>
<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead >
            <tr class="table-primary">
                <th>Sl. no</th>
                <th>Brand Title</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $number=1;
            $brand="select * from `brands`";
            $brand_result=mysqli_query($con,$brand);
            while($data=mysqli_fetch_assoc($brand_result))
            {
                $id=$data['brand_id'];
                $title=$data['brand_title'];


                $modal_name='exampleModal'.$id;
                $target_modal='#'.$modal_name;

                echo "<tr>
                <td>$number</td>
                <td>$title</td>
                <td><a href='index.php?edit_brand=$id'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_brand=$id' type='button' data-bs-toggle='modal' data-bs-target=$target_modal><i class='fa-solid fa-trash'></i></a></td>
                </tr>
                <!-- Modal  -->
                <div class='modal fade' id=$modal_name tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                 <div class='modal-dialog' role='document'>
                   <div class='modal-content'>
                     <div class='modal-body'>
                       <h6>Are you sure you want to delete this brand?</h6>
                     </div>
                     <div class='modal-footer'>
                       <button type='button' class='btn btn-secondary' data-dismiss='modal'><a href='index.php?view_brand' class='text-light text-decoration-none'>No</a></button>
                       <button type='button' class='btn btn-primary'><a href='index.php?delete_brand=$id' class='text-light text-decoration-none'>Yes</a></button>
                     </div>
                   </div>
                 </div>
               </div>";

                $number++;

            }
            ?>
        </tbody>
    </table>
</div>

 <!-- Modal 
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h6>Are you sure you want to delete this brand?</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="index.php?view_brand" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href="index.php?delete_brand=<?php echo $id?>" class="text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div> -->