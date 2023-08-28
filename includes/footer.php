<!-- footer section -->
<div class="bg-primary p-2 text-center text-light ">
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-3 py-2 px-1">
            <a href="index.php"><img src="images/zipkart-logo.png" class="profile" alt="admin images"></a>
            <p class="fw-lighter">Your Ultimate Destination for Online Shopping. Explore our vast collection of quality products, 
                ranging from electronics and fashion to home essentials. Experience seamless shopping with fast delivery and secure payments.</p>
            <a href="#" class="mx-2"><i class="fa-brands fa-facebook fa-xl" style="color: #f0f2f5;"></i></i></a>
            <a href="#" class="mx-2"><i class="fa-brands fa-instagram fa-xl" style="color: #f0f2f5;"></i></i></a>
            <a href="#" class="mx-2"><i class="fa-brands fa-twitter fa-xl" style="color: #f0f2f5;"></i></i></a>


        </div>
        <div class="col-md-3">
            <ul class="navbar-nav text-center">
                <li class="nav-item bg-primary text-light ">
                    <a class="nav-link" href="#">
                        <h6>Categories</h6>
                    </a>
                </li>
                <?php

                //error displaying code
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                $required = ['Clearance sale', "Heavy discounts", "Grocery", "Fashion"];
                foreach ($required as $value) {
                    $select_category = "select * from `categories` where category_title='$value'";
                    $result2_category = mysqli_query($con, $select_category);
                    $row_data = mysqli_fetch_assoc($result2_category);
                    $category_id = $row_data['category_id'];
                    echo "<li class='nav-item  text-light '>
                            <a class='nav-link' href='index.php?category=$category_id'>
                                <h6 class='fw-lighter'>$value</h6>
                            </a>
                        </li>";
                }
                ?>
            </ul>
        </div>
        <div class="col-md-3">
            <ul class="navbar-nav  text-center">
                <li class="nav-item bg-primary text-light ">
                    <a class="nav-link" href="#">
                        <h6>Quick links</h6>
                    </a>
                </li>
                <li class="nav-item  text-light ">
                    <a class="nav-link" href="index.php">
                        <h6 class="fw-lighter">Home</h6>
                    </a>
                </li>
                <li class="nav-item  text-light ">
                    <a class="nav-link" href="display_all_products.php">
                        <h6 class="fw-lighter">Products</h6>
                    </a>
                </li>
                <li class="nav-item  text-light ">
                    <a class="nav-link" href="users_area/user_registration.php">
                        <h6 class="fw-lighter">Register</h6>
                    </a>
                </li>
                <li class="nav-item  text-light ">
                    <a class="nav-link" href="#">
                        <h6 class="fw-lighter">Contacts</h6>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <p>Copyright &copy 2023 All Rights Reserved by Vishwa </p>
</div>