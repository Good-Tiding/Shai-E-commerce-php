<?php 
include('layouts/header.php');
include('pages_protector.php');
include('layouts/sidebar.php');
?>



<?php


include("../server/connection.php"); 


//that's working for small orders but if we have a lot of orders we need a pagination
/*   $stmt = $conn->prepare("SELECT * FROM orders ");
  $stmt->execute();
  $orders=$stmt->get_result(); */


  //1. determine page no

  if(isset($_GET['page_no']) && $_GET['page_no']!='')
  {
    //if the user entered page then the page number is the one that they selected
    $page_no=$_GET['page_no'];
  }

  else
  {
    //if the user not selected a page the  the page number will be 1

    $page_no=1;
  }


  //2.return number of orders

  $stmt =$conn->prepare("SELECT COUNT(*) As total_records From orders");
  $stmt->execute();
  $stmt->bind_result($total_records);
  $stmt->store_result();
  $stmt->fetch();

  //3.products per page

  $total_records_per_page=6;
  $offset=($page_no-1)*$total_records_per_page;
  $previous_page= $page_no-1;
  $next_page= $page_no+1;
  $adjacents="2";

  $total_no_of_pages=ceil($total_records/$total_records_per_page);

  //4.get all orders

  $stmt1 =$conn->prepare("SELECT * From orders LIMIT $offset,$total_records_per_page");
  $stmt1->execute();
  $orders=$stmt1->get_result();
?>

<body>
  <div class="container-fluid">
    <div class="row" >
   
      
      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-1" >
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-0">
         
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2"></div>
          </div>
        </div>
        
        <!-- Table Container -->
        <h2 class="text-center">Orders</h2>
        <hr>
        <?php  if(isset($_GET['edit_order_success'])){?>
            <p class="text-center" style="color: green;"><?php echo $_GET['edit_order_success'];?></p>
        <?php }?>

        <?php  if(isset($_GET['edit_order_failure'])){?>
            <p class="text-center" style="color: red;"><?php echo $_GET['edit_order_failure'];?></p>
        <?php }?>

        <?php  if(isset($_GET['deleted_successfully'])){?>
            <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully'];?></p>
        <?php }?>

        <?php  if(isset($_GET['deleted_failure'])){?>
            <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure'];?></p>
        <?php }?>
        
            <div class="table-responsive ">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">User Phone</th>
                    <th scope="col">User Address</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Add data rows here -->
                  <?php foreach($orders as $order){?>
                    <tr>
                      <td><?php echo $order['order_id'];?></td>
                      <td><?php echo $order['order_status'];?></td>
                      <td><?php echo $order['user_id'];?></td>
                      <td><?php echo $order['order_date'];?></td>
                      <td><?php echo $order['user_phone'];?></td>
                      <td><?php echo $order['user_address'];?></td>
                      <td><a class="btn btn-primary" href="<?php echo "edit_order.php?order_id=". $order['order_id']; ?>">Edit</a></td>
                      <td><a class="btn btn-danger" href="<?php echo "delete_order.php?order_id=". $order['order_id']; ?>">Delete</a></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <!-- </div>
        </div> -->
        
      </main>
    </div>
  </div>

  <!-- Pagination Container at the bottom -->
  <nav aria-label="Page navigation example" >
    <ul class="pagination justify-content-center mt-3">
      <li class="page-item <?php if($page_no<=1){echo 'disabled';} ?>">
        <a class="page-link" href="<?php if($page_no<=1){echo '#';} else{echo "?page_no=".($previous_page);} ?>">
          Previous
        </a>
      </li>
      
      <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
   <!--    <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li> -->
      
   <?php if (isset($_GET['page_no'])>=3){?>
        <li class="page-item"><a class="page-link" href="#">...</a></li>
        <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no; ?>"><?php echo $page_no; ?></a></li>
      <?php }?>
      
      <li class="page-item <?php if($page_no>=$total_no_of_pages){echo 'disabled';} ?>">
        <a class="page-link" href="<?php if($page_no>=$total_no_of_pages){echo '#';} else{echo "?page_no=".($next_page);} ?>">
          Next
        </a>
      </li>
    </ul>
  </nav>
</body>