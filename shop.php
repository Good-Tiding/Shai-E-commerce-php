
<?php include('layouts/header.php');?>
<?php


include("server/connection.php");

if (isset($_GET['category'])) {
  $category = $_GET['category']; 
}

if(isset($_POST['search']))
{
  $category=$_POST['category'];
  $price=$_POST['price'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=?");
  $stmt->bind_param('si',$category, $price);
  $stmt->execute();
  $products=$stmt->get_result();

}

else
{
  //that's working for small orders but if we have a lot of orders we need a pagination
/*   $stmt = $conn->prepare("SELECT * FROM products");
  $stmt->execute();
  $products=$stmt->get_result(); */
  
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


//2.return number of products in database because of big website we have to count products not fetch them

$stmt =$conn->prepare("SELECT COUNT(*) As total_records From products");
$stmt->execute();
$stmt->bind_result($total_records);
$stmt->store_result();
$stmt->fetch();

//3.products per page

$total_records_per_page=4;
$offset=($page_no-1)*$total_records_per_page;
$previous_page= $page_no-1;
$next_page= $page_no+1;
$adjacents="2";

$total_no_of_pages=ceil($total_records/$total_records_per_page);

//4.get all products but dividing them in the pagination

$stmt1 =$conn->prepare("SELECT * From products LIMIT $offset,$total_records_per_page");
$stmt1->execute();
$products=$stmt1->get_result();


}



?>

  <div class="sections-container d-flex">
    <section id="search" class=" my-5 py-5 ms-5">
        <div class="container py-5 mt-5">
          <p>Search Products</p>
          <hr class="hr-Shop">
        </div>

        <form action="shop.php" method="POST">
          <div class="row mx-auto container">
            <div class=" col-lg-12 col-md-12 col-sm-12">
              <p>Category</p>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="category" value="shoes" id="category_one" <?php if(isset($category) && $category=='shoes'){echo 'checked';}  ?>/>
                <label class="form-check-label" for="flexRadioDefault">
                    Shoes
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="category" value="coats" id="category_two" <?php if(isset($category) && $category=='coats'){echo 'checked';}  ?>/>
                <label class="form-check-label" for="flexRadioDefault2">
                    Coats
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="category" value="skirts" id="category_three" <?php if(isset($category) && $category=='skirts'){echo 'checked';}  ?>/>
                <label class="form-check-label" for="flexRadioDefault3">
                  Skirts
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="category" value="bags" id="category_four" <?php if(isset($category) && $category=='bags'){echo 'checked';}  ?>/>
                <label class="form-check-label" for="flexRadioDefault4">
                    Bags
                </label>
              </div>
            </div>
          </div>

          <div class="row mx-auto container mt-5">
            <div class=" col-lg-12 col-md-12 col-sm-12">
              <p>Price</p>
              <input type="range" class="form-range w-50" name="price" value="<?php if(isset($price)) {echo $price;} else {echo '100';} ?>" min="1" max="1000" id="customRange2"/>
              <div class="w-50">
                <span style="float: left;">1</span>
                <span style="float: right;">1000</span>
              </div>
            </div>
          </div>

          <div class="form-group my-3 mx-3">
            <input type="submit" name="search" value="Search" class="btn btn-primary">
          </div>

        </form>
    </section>
      
    <section id="shop" class="my-5 py-3">
        <div class="container text-start py-5 mt-5">
          <h3>Our  Products</h3>
          <hr class="hr-Shop">
          <p>Here you can checkout our products</p>
        </div>

      <div class="row mx-auto container-fluid">

        <?php while($row =$products->fetch_assoc()){ ?>

          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid img mb-3" src="assets/img/<?php echo $row['product_image']?>" alt="">
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']?></h5>
            <h4 class="p-price"><?php echo $row['product_price']?></h4>
            <a href="<?php echo "single-product.php?product_id=". $row['product_id']; ?>"><button class="shop-now">Buy Now</button></a>
          </div>
        
        <?php }?>

            
       
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
        </div>
    </section>
  </div>

  <?php include('layouts/footer.php')?>