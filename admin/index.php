<?php 
include('layouts/header.php');
include('pages_protector.php');
include('layouts/sidebar.php');
?>



<?php


include("../server/connection.php"); 
$stmt =$conn->prepare("SELECT COUNT(*) As total_records From products");
$stmt->execute();
$stmt->bind_result($total_products_records);
$stmt->store_result();
$stmt->fetch();


$stmt =$conn->prepare("SELECT COUNT(*) As total_records From orders");
$stmt->execute();
$stmt->bind_result($total_orders_records);
$stmt->store_result();
$stmt->fetch();

$stmt =$conn->prepare("SELECT COUNT(*) As total_records From users");
$stmt->execute();
$stmt->bind_result($total_users_records);
$stmt->store_result();
$stmt->fetch();

?>


<body>
  <div class="container-fluid">
    <div class="row" >

      
      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-1" >
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-0">
          <h1 class="h2" style="padding-top: 20px; margin:auto;"> Admin Dashboard - E-Commerce </h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2"></div>
          </div>
        </div>

        <main class="index-cards col-md-9 ms-sm-auto col-lg-10 px-4 d-flex justify-content-center align-items-center" style="height: 80vh; margin-right:110px;">
                <div class="row ">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Total Products</h5>
                                <p class="card-text"><?php echo $total_products_records; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Total <br>Orders</br></h5>
                                <p class="card-text"><?php echo $total_orders_records; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text"><?php echo $total_users_records; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
     </div>
    </div>
</body>
</html>
