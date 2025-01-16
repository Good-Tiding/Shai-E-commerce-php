 
<?php 

include('layouts/header.php');

?>

      <section id="Home">
        <div class="container">
          <!--  we put this div to ensure that this div is along with the logo pic in the navbar if we name the div of both of them the same  -->
          <h5>New Arrivals</h5>
          <h1><span class="Best-Prices">Best Prices</span> This Season</h1>
          <p>E-shop offers the best products foe the most affordable prices</p>
          <a href="<?php echo "shop.php" ?>"> <button class="shop-now"  >Shop Now</button></a>
        </div>
      </section>

      <section id="Brand" class="container mt-5">
        <div class=" row">
        
<!--           every img in large screen will take 3 columns and we have 12 columns in our webpage so every row will have 4 images  -->
           <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand (1).png" alt="" />
           <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand (2).png" alt="" />
           <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand (3).png" alt="" />
           <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand (4).png" alt="" />
       
        </div>
      </section>

      <section id="Card" class="w-100 mt-5">
      <form action="shop.php" method="POST">
        <div class="row p-0 m-0 ">

          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img img-fluid" src="assets/img/Shoes.png" alt="" />
            <div class="details">
              <h2>Extremely Awesome Shoes</h2>
              <input type="hidden" name="category" value="shoes">
              <button class="shop-now" >Shop Now</button>  
            </div>
          </div> 


          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img img-fluid " src="assets/img/bag.jpeg" alt="" />
            <div class="details">
              <h2>Extremely Awesome Bags</h2>
              <button class="shop-now">Shop Now</button>  
            </div>
          </div> 


          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img img-fluid" src="assets/img/skirt.png" alt="" />
            <div class="details">
              <h2>Extremely Awesome Skirts</h2>
              <button class="shop-now" >Shop Now</button>  
            </div>
          </div> 
           
        </div>
      </form>
      </section>

      <section id="Featured" class="my-5 pb-5">
          <div class="container text-center py-5 mt-5">
            <h3>Our  Awesome Coats</h3>
            <hr class="hr-Home">
            <p>Here you can checkout our Coats</p>
          </div>

          <div class="row mx-auto container-fluid">
            <?php include('server/get_coats.php')?>
            <?php while($row = $coats_products->fetch_assoc()){?>

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

      
      <section id="Featured" class="my-5 pb-5">
        <div class="container text-center my-5 pb-5">
          <h3>Our  Bags</h3>
          <hr class="hr-Home">
          <p>Here you can checkout our Bags</p>
        </div>

        <div class="row mx-auto container-fluid">
            <?php include('server/get_bags.php')?>
            <?php while($row = $bags_products->fetch_assoc()){?>

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


      


      <section id="Banner">
        <div class="container">
          <h4>MID SEASON'S SALE</h4>
          <h1 class="h1">Autumn Collection<br> Up to 30% OFF</h1>
          <a href="<?php echo "shop.php" ?>"><button class="shop-now" >Shop Now</button></a>
        </div>
      </section>


      <section id="Featured" class="my-5 pb-5">
        <div class="container text-center py-5 mt-5">
          <h3>Our  Awesome Shoes</h3>
          <hr class="hr-Home">
          <p>Here you can checkout our Shoes</p>
        </div>

        <div class="row mx-auto container-fluid">
            <?php include('server/get_shoes.php')?>
            <?php while($row = $shoes_products->fetch_assoc()){?>

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


      <section id="Featured" class="my-5 pb-5">
        <div class="container text-center pb-5 ">
          <h3>Our  Awesome Skirts</h3>
          <hr class="hr-Home">
          <p>Here you can checkout our Skirts</p>
        </div>

        <div class="row mx-auto container-fluid">
            <?php include('server/get_skirts.php')?>
            <?php while($row = $skirts_products->fetch_assoc()){?>

              <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid img mb-3" src="assets/img/<?php echo $row['product_image']; ?>" height="230" width="125" />
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


    

      
 <?php include('layouts/footer.php')?>