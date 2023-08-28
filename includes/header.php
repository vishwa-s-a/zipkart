<nav class="navbar navbar-expand-lg  bg-primary">
    <div class="container-fluid">
        <img src="images/zipkart-logo.png" class="logo" alt="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="display_all_products.php">Products</a>
                </li>
                <?php
                if (!isset($_SESSION['username'])) {
                    echo " <li class='nav-item'>
                    <a class='nav-link' href='users_area/user_registration.php'>Register</a>
                </li>";
                } else {
                    echo " <li class='nav-item'>
                    <a class='nav-link' href='users_area/profile.php'>My account</a>
                </li>";
                }

                ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping "
                            style="color: #f1f4f8;"></i><sup>
                            <?php cart_item() ?>
                        </sup></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Total Price:
                        <?php total_cart_price() ?> ₹
                    </a>
                </li>
            </ul>
            <form class="d-flex" role="search" action="search_product.php" method="get">
                <input class="form-control me-2" type="search" name="search_data" placeholder="Search"
                    aria-label="Search">
                <!-- <button class="btn btn-outline-success " type="submit">Search</button> -->
                <input type="submit" class="btn btn-outline-success text-light" name="search_data_product"
                    value="Search">
            </form>
        </div>
    </div>
</nav>
<!-- second child -->
<nav class="navbar navbar-expand-lg  bg-secondary">
    <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <?php
            if(!isset($_SESSION['username']))
            {
                echo "<a class='nav-link' href='#'>Welcome guest</a> ";
            }
            else{
                $username=ucfirst($_SESSION['username']);
                echo "<a class='nav-link' href='#'>Welcome $username</a> ";
            }
            
            ?>
        </li>
        <li class="nav-item">
            <?php
            if(!isset($_SESSION['username']))
            {
                echo "<a class='nav-link' href='users_area/user_login.php'>Login</a> ";
            }
            else{
                echo "<a class='nav-link' href='users_area/user_logout.php'>Logout</a> ";
            }
            ?>
        </li>
    </ul>
</nav>