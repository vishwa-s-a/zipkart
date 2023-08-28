<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if(!isset($_SESSION['admin_name'])  && !isset($_SESSION['admin_email']))
{
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<h3 class="text-center text-success">
    All Products
</h3>
<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead >
            <tr class="table-primary">
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Total Sold</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $products="select * from `products`";
            $result=mysqli_query($con,$products);
            while($data=mysqli_fetch_assoc($result))
            {
                $qty=0;
                $id=$data['product_id'];
                $title=$data['product_title'];
                $image=$data['product_image1'];
                $price=$data['product_price'];
                $status=$data['status'];
                $select="select * from `orders_pending` where product_id like '%$id%'";
                $select_result=mysqli_query($con,$select);
                while($row=mysqli_fetch_assoc($select_result))
                {
                    $json_array=$row['product_id'];
                    $array=json_decode($json_array,true);

                    foreach($array as $element)
                    {
                        if($element==$id)
                        {
                            $qty++;
                        }
                    }
                }

                echo "<tr>
                <td>$id</td>
                <td>$title</td>
                <td><img src='product_images/$image' alt='image' class='profile'></td>
                <td>$price</td>
                <td>$qty</td>
                <td>$status</td>
                <td><a href='index.php?edit_products=$id'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_products=$id' type='button' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
            </tr>";

            }
            
            ?>
        </tbody>
    </table>
</div>

 <!-- Modal  -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h6>Are you sure you want to delete this product?</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="index.php?view_products" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href="index.php?delete_products=<?php echo $id?>" class="text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div>