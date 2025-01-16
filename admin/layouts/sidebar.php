<?php
include('layouts/header.php');
?>

<div class="container-fluid mt-5 pt-0">
    <div class="row">
        <!-- Mobile Sidebar (Horizontal) -->
        <div class="col-12 d-block d-md-none"> 
          
            <nav class=" navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid ">
              
                    <!-- Horizontal Sidebar -->
                    <div class="collapse navbar-collapse mt-5" id="horizontal-sidebar">
                        <ul class="navbar-nav w-100 justify-content-center">
                            <li class="nav-item"><a href="index.php" class="nav-link text-white">Dashboard</a></li>
                            <li class="nav-item"><a href="products.php" class="nav-link text-white">Products</a></li>
                            <li class="nav-item"><a href="orders.php" class="nav-link text-white">Orders</a></li>
                            <li class="nav-item"><a href="add_product.php" class="nav-link text-white">Add New Product</a></li>
                            <li class="nav-item"><a href="account.php" class="nav-link text-white">Admin Account</a></li>
                            <li class="nav-item"><a href="help.php" class="nav-link text-white">Help</a></li>
                        </ul>
                    </div>
                    <div class="contentss">

                    </div>
                </div>
            </nav>
        </div>

        <!-- Large Screens Sidebar (Vertical) -->
        <div class="col-md-3 col-lg-2 p-0 d-none d-md-block" id="vertical-sidebar">
            <!-- Sidebar as vertical for larger screens -->
            <div class="bg-dark sidebar d-flex flex-column vh-100">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="index.php" class="nav-link text-white">Dashboard</a></li>
                    <li class="nav-item"><a href="products.php" class="nav-link text-white">Products</a></li>
                    <li class="nav-item"><a href="orders.php" class="nav-link text-white">Orders</a></li>
                    <li class="nav-item"><a href="add_product.php" class="nav-link text-white">Add New Product</a></li>
                    <li class="nav-item"><a href="account.php" class="nav-link text-white">Admin Account</a></li>
                    <li class="nav-item"><a href="help.php" class="nav-link text-white">Help</a></li>
                </ul>
            </div>
        </div>

     
    </div>
</div>
