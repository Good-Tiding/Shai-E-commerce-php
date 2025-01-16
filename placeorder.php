

<?php include('layouts/header.php');?>
<?php

include("server/connection.php");

    if(!isset($_SESSION['logged_in']))
    {
      header('location: login.php');
      exit;
    }
    
    if( !empty($_SESSION['cart']) )
    {
     
    }

    else
    {
      header('location: index.php');
    }


    if(isset($_POST['place_order']))
    {
 
      //1. get user info and store it in the database

      $name=$_POST['name'];
      $email=$_POST['email'];
      $city=$_POST['city'];
      $phone=$_POST['phone'];
      $address=$_POST['address'];
      $order_cost=$_SESSION['total'];
      $order_status="not paid";
      $user_id= $_SESSION['user_id'] ;
      $order_date=date('Y-m-d H:i:s');

      $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                               VALUES (?,?,?,?,?,?,?);");

      $stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date); 

      $stmt_status= $stmt->execute();

      if(!$stmt_status)
      {
        header('location:index.php');
        exit;
      }

      //fetch the order_id after insert the order in the orders table
       $order_id = $stmt->insert_id;                      

      // echo $order_id;
      
      //2. get products that we ordered in our orders table from cart session
      //3. store each single  item in order-item table

      foreach( $_SESSION['cart'] as  $key=>$value )
      {
          //get the array of every product
          $product = $_SESSION['cart'][$key];


          $product_id=$product['product_id'];
          $product_name=$product['product_name'];
          $product_image=$product['product_image'];
          $product_price=$product['product_price'];
          $product_quantity=$product['product_quantity'];

          $stmt = $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
          VALUES (?,?,?,?,?,?,?,?);");

          $stmt->bind_param('iissiiis',$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date); 
          $stmt->execute();
      }
      //5. remove enerything from the cart(after payment)(part 5)
       $_SESSION['order_placed'] = true; 
        /* unset($_SESSION['cart']);
        unset($_SESSION['total']);
        unset($_SESSION['quantity']); */
     
     

      //6.inform user that everything is good or there is a problem
      header('location: payment.php?order_id='. $order_id);
      exit;
    }
   

     
?>



    


    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 >Place Order</h2>
            <hr class="hr-Home">
        </div>
        <div class="container mx-auto ">
            <form id="place-order-form" action="placeorder.php" method="POST" autocomplete="off">

                <div class="form-group place-order-small-element">
                    <label >Name</label>
                    <input type="text" class="form-control" id="place-order-name" name="name" placeholder="Name" required/>
                </div>

                <div class="form-group place-order-small-element">
                    <label >Email</label>
                    <input type="email" class="form-control" id="place-order-email" name="email" placeholder="Email" required/>
                </div>

                <div class="form-group place-order-small-element">
                    <label >Phone</label>
                    <input type="tel" class="form-control" id="place-order-phone" name="phone" placeholder="phone" required/>
                </div>

                <div class="form-group place-order-small-element">
                    <label >City</label>
                    <input type="text" class="form-control" id="place-order-city" name="city" placeholder="City" required/>
                </div>

                <div class="form-group place-order-large-element">
                    <label >Address</label>
                    <input type="text" class="form-control" id="place-order-address" name="address" placeholder="Address" required/>
                </div>

                <div class="form-group place-order-btn-container">
                    <p>Total amount : $<?php if (isset($_SESSION['total'])){ echo  $_SESSION['total'];} ?></p>
                    <input type="submit"  id="place-order-btn"  name="place_order" value="Place Order" />
                </div>

            </form>
        </div>
    </section>




   
 <?php include('layouts/footer.php')?>