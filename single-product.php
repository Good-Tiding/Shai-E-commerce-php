
<?php include('layouts/header.php');?>
<?php

if (isset($_GET['product_id']))
{
  include("server/connection.php");
  $product_id=$_GET['product_id'];
  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id= ?");
  $stmt->bind_param("i",$product_id);
  if ($stmt) 
  {
     $stmt->execute();
     $product=$stmt->get_result();
  } 
}

else
{
header('location: index.php');
}

?>




 




    <section class=" container single-product my-5 pt-5">
   
        <div class="row mt-5">
        <?php while($row = $product->fetch_assoc()) {?>

        

            <div class="col-lg-5 col-md-6 col-sm-12">
                <img id="main-img" class=" img-fluid w-100 pb-2" src="assets/img/<?php echo $row['product_image']; ?>"  alt="" />
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img class="small-img w-100" src="assets/img/<?php echo $row['product_image']; ?>" height="230" width="125" alt="" />
                    </div>

                    <div class="small-img-col">
                        <img class="small-img w-100" src="assets/img/<?php echo $row['product_image2']; ?>" height="230" width="125" alt="" />
                    </div>

                    <div class="small-img-col">
                        <img class="small-img w-100" src="assets/img/<?php echo $row['product_image3']; ?>" height="230" width="125" alt="" />
                    </div>

                    <div class="small-img-col">
                        <img class="small-img w-100" src="assets/img/<?php echo $row['product_image4']; ?>" height="230" width="125" alt="" />
                    </div>

                </div>
            </div> 
            

            <div class="col-lg-6 col-md-12 col-12">
              <h6>Men/Shoes</h6>
              <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
              <h2>$<?php echo $row['product_price']; ?></h2>

              <form  method="POST" action="cart.php"> 
            <!--     save all of the information in the post method and pass it to the cart.php  -->
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
                <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
                <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />

                <input type="number"name="product_quantity" value="1">
                <button class="shop-now" type="submit" name="add_to_cart"> Add to cart</button>
              </form>
              <h4 class="mt-5 mb-5">Product Details</h4>
              <span><?php echo $row['product_description']; ?></span>
            </div>
        
          <?php } ?>  
        </div>   
    </section>


    <section id="Related-Products" class="my-5 pb-5">
        <div class="container text-center py-5 mt-5">
          <h3>Related  Products</h3>
          <hr class="hr-Home">
          
        </div>

        <div class="row mx-auto container-fluid">

            <?php include('server/get_featured_products.php')?>
            <?php while($row = $featured_products->fetch_assoc()){?>

          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid img mb-3" src="assets/img/<?php echo $row['product_image']; ?>" />
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
            <a href="<?php echo "single-product.php?product_id=". $row['product_id']; ?>"><button class="shop-now">Buy Now</button></a>
          </div>

          <?php } ?>

        </div>
      </section>

        <script>

            var mainImg=document.getElementById("main-img")
            var smallImg=document.getElementsByClassName("small-img")
            for(let i=0; i<smallImg.length ;i++)
            {
                smallImg[i].onclick=function()
                {
                 mainImg.src=smallImg[i].src;
                }
            }
        </script>

<?php include('layouts/footer.php')?>