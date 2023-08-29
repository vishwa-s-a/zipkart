<?php
//logic to check whether the admin is logged in or not to give him access of the admin dashboard
if(!isset($_SESSION['admin_name'])  && !isset($_SESSION['admin_email']))
{
    echo "<script>window.open('admin_login.php','_self')</script>";
}

?>
<h3 class="text-center text-success">
    All Users
</h3>
<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead>
            <tr class="table-primary">
                <th>Sl.no</th>
                <th>Username</th>
                <th>User Email</th>
                <th>User Contact</th>
                <th>User Address</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $number = 1;
            $orders = "select * from `user_table`";
            $result = mysqli_query($con, $orders);
            $num_rows = mysqli_num_rows($result);
            if ($num_rows == 0) {
                echo "<h3 class='text-danger text-center mt-5'>No users yet</h3>";
            } else {
                while ($data = mysqli_fetch_assoc($result)) {
                    $id = $data['user_id'];
                    $name = $data['username'];
                    $mail = $data['user_email'];
                    $contact = $data['user_mobile'];
                    $address= $data['user_address'];


                    $modal_name='exampleModal'.$id;
                    $target_modal='#'.$modal_name;

                    echo "<tr>
                <td>$number</td>
                <td>$name</td>
                <td>$mail</td>
                <td>$contact</td>
                <td>$address</td>
                <td><a href='index.php?delete_user=$id' type='button' data-bs-toggle='modal' data-bs-target=$target_modal><i class='fa-solid fa-trash'></i></a></td>
                </tr>
                <!-- Modal  -->
                <div class='modal fade' id=$modal_name tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
                    aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h6>Are you sure you want to delete this user?</h6>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'><a href='index.php?view_users'
                                        class='text-light text-decoration-none'>No</a></button>
                                <button type='button' class='btn btn-primary'><a href='index.php?delete_user=$id'
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
                <h6>Are you sure you want to delete this user?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="index.php?view_users"
                        class="text-light text-decoration-none">No</a></button>
                <button type="button" class="btn btn-primary"><a href="index.php?delete_user=<?php echo $id ?>"
                        class="text-light text-decoration-none">Yes</a></button>
            </div>
        </div>
    </div>
</div> -->