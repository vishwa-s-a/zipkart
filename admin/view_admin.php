<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if (!isset($_SESSION['admin_name']) && !isset($_SESSION['admin_email'])) {
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<h3 class="text-center text-success">
    All Admins
</h3>
<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead>
            <tr class="table-primary">
                <th>Sl.no</th>
                <th>Admin Name</th>
                <th>Admin Email</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $number = 1;
            $orders = "select * from `admin_table`";
            $result = mysqli_query($con, $orders);
            while ($data = mysqli_fetch_assoc($result)) {
                $id = $data['admin_id'];
                $name = $data['admin_name'];
                $mail = $data['admin_email'];

                $modal_name='exampleModal'.$id;
                $target_modal='#'.$modal_name;

                echo "<tr>
                <td>$number</td>
                <td>$name</td>
                <td>$mail</td>
                <td><a href='index.php?delete_admin=$id' type='button' data-bs-toggle='modal' data-bs-target=$target_modal><i class='fa-solid fa-trash'></i></a></td>
                </tr>
                <!-- Modal  -->
                <div class='modal fade' id=$modal_name tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
                    aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                             <h6>Are you sure you want to delete this admin?</h6>
                            </div>
                            <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'><a href='index.php?view_admin'
                             class='text-light text-decoration-none'>No</a></button>
                            <button type='button' class='btn btn-primary'><a href='index.php?delete_admin=$id'
                            class='text-light text-decoration-none'>Yes</a></button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h6>Are you sure you want to delete this admin?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="index.php?view_admin"
                        class="text-light text-decoration-none">No</a></button>
                <button type="button" class="btn btn-primary"><a href="index.php?delete_admin=<?php echo $id ?>"
                        class="text-light text-decoration-none">Yes</a></button>
            </div>
        </div>
    </div>
</div> -->