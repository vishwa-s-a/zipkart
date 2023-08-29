<!-- Modal  -->
<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
    aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-body'>
                <h6>Are you sure you want to delete this user?</h6>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'><a href='index.php?view_users'
                        class='text-light text-decoration-none'>No</a></button>
                <button type='button' class='btn btn-primary'><a href='index.php?delete_user=<?php echo $id ?>'
                        class='text-light text-decoration-none'>Yes</a></button>
            </div>
        </div>
    </div>
</div>