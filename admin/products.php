<?php 
include('layouts/header.php');
include('pages_protector.php');
include('layouts/sidebar.php');
?>

<?php


include("../server/connection.php"); 


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


  //2.return number of products

  $stmt =$conn->prepare("SELECT COUNT(*) As total_records From products");
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

  //4.get all  products

  $stmt1 =$conn->prepare("SELECT * From  products LIMIT $offset,$total_records_per_page");
  $stmt1->execute();
  $products=$stmt1->get_result();
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
        <h2 class="text-center"> Products</h2>
        <hr>
        <?php  if(isset($_GET['edit_success_message'])){?>
            <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message'];?></p>
        <?php }?>

        <?php  if(isset($_GET['edit_failure_message'])){?>
            <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message'];?></p>
        <?php }?>

        <?php  if(isset($_GET['deleted_successfully'])){?>
            <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully'];?></p>
        <?php }?>

        <?php  if(isset($_GET['deleted_failure'])){?>
            <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure'];?></p>
        <?php }?>

        <?php  if(isset($_GET['insert_success_message'])){?>
            <p class="text-center" style="color: green;"><?php echo $_GET['insert_success_message'];?></p>
        <?php }?>

        <?php  if(isset($_GET['insert_failure_message'])){?>
            <p class="text-center" style="color: red;"><?php echo $_GET['insert_failure_message'];?></p>
        <?php }?>

        <?php  if(isset($_GET['images_updated_success_message'])){?>
            <p class="text-center" style="color: green;"><?php echo $_GET['images_updated_success_message'];?></p>
        <?php }?>

        <?php  if(isset($_GET['images_updated_failure_message'])){?>
            <p class="text-center" style="color: red;"><?php echo $_GET['images_updated_failure_message'];?></p>
        <?php }?>
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col"> Product ID</th>
                    <th scope="col"> Product Name</th>
                    <th scope="col"> Product Image</th>
                    <th scope="col"> Product Price</th>
                    <th scope="col"> Product Offer</th>
                    <th scope="col"> Product category</th>
                    <th scope="col"> Product Color</th>
                    <th scope="col">Edit Images</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Add data rows here -->
                  <?php foreach($products as $product){?>
                    <tr>
                      <td><?php echo $product['product_id'];?></td>
                      <td><?php echo $product['product_name'];?></td>
                      <td><img src="<?php echo " ../assets/img/".$product['product_image'];?>" style="width:70px; height:70px"></td>
                      <td>$<?php echo $product['product_price'];?></td>
                      <td><?php echo $product['product_special_offer'];?>%</td>
                      <td><?php echo $product['product_category'];?></td>
                      <td><?php echo $product['product_color'];?></td>
                      <td><a class="btn btn-warning" href="<?php echo "edit_images.php?product_id=". $product['product_id']."&product_name=". $product['product_name'] ?>">Edit Images</a></td>
                      <td><a class="btn btn-primary" href="<?php echo "edit_product.php?product_id=". $product['product_id']; ?>">Edit</a></td>
                      <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
      </main>
    </div>
  </div>

  <!-- Pagination Container at the bottom -->
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mt-3">
      <li class="page-item <?php if($page_no<=1){echo 'disabled';} ?>">
        <a class="page-link" href="<?php if($page_no<=1){echo '#';} else{echo "?page_no=".($previous_page);} ?>">
          Previous
        </a>
      </li>
      
      <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
     <!--  <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li> -->
      
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
