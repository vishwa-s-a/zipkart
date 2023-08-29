<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if(!isset($_SESSION['admin_name'])  && !isset($_SESSION['admin_email']))
{
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<h3 class="text-center text-success">
    All Orders
</h3>
<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead>
            <tr class="table-primary">
                <th>Sl.no</th>
                <th>Order ID</th>
                <th>Due Amount</th>
                <th>Invoice Number</th>
                <th>Total Products</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $number = 1;
            $orders = "select * from `user_orders`";
            $result = mysqli_query($con, $orders);
            $num_rows = mysqli_num_rows($result);
            if ($num_rows == 0) {
                echo "<h3 class='text-danger text-center mt-5'>No orders yet</h3>";
            } else {
                while ($data = mysqli_fetch_assoc($result)) {
                    $id = $data['order_id'];
                    $amount = $data['amount_due'];
                    $invoice = $data['invoice_number'];
                    $products = $data['total_products'];
                    $date = $data['order_date'];
                    $status = $data['order_status'];

                    $modal_name='exampleModal'.$id;
                    $target_modal='#'.$modal_name;
                    
                    echo "<tr>
                <td>$number</td>
                <td>$id</td>
                <td>$amount</td>
                <td>$invoice</td>
                <td>$products</td>
                <td>$date</td>
                <td>$status</td>
                <td><a href='index.php?delete_order=$id' type='button' data-bs-toggle='modal' data-bs-target=$target_modal><i class='fa-solid fa-trash'></i></a></td>
                </tr>
                <!-- Modal  -->
                <div class='modal fade' id=$modal_name tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
                    aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h6>Are you sure you want to delete this order?</h6>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'><a href='index.php?view_orders'
                                        class='text-light text-decoration-none'>No</a></button>
                                <button type='button' class='btn btn-primary'><a href='index.php?delete_order=$id'
                                        class='text-light text-decoration-none'>Yes</a></button>
                            </div>
                        </div>
                    </div>
                </div>";
                    $number++;

                }
            }

            ?>
        </tbody>
    </table>
</div>

<!-- Modal 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h6>Are you sure you want to delete this order?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="index.php?view_orders"
                        class="text-light text-decoration-none">No</a></button>
                <button type="button" class="btn btn-primary"><a href="index.php?delete_order=<?php echo $id ?>"
                        class="text-light text-decoration-none">Yes</a></button>
            </div>
        </div>
    </div>
</div> -->