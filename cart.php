<?php include('layouts/header.php');?>
<?php

if(!isset($_SESSION['logged_in']))
{
  header('location: login.php');
  exit;
}
// Ensure 'cart' is initialized as an empty array if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

//does the user come to this page using the form or not
if (isset($_POST['add_to_cart']))
{
    //if user  has already added a product to the cart (the cart not empty)
    if (isset($_SESSION['cart']))
    {
          // we have to make sure that the product_id is unique and not in the cart before because if it is in the cart we just have to add a quantity if we want more of it
      $product_array_ids= array_column($_SESSION['cart'],'product_id');
      //return array with all products ids

      //check if this product_id is in the product_array_ids or not
      if( !in_array($_POST['product_id'], $product_array_ids))
      {
        $product_array=array(
                              'product_id'=>$_POST['product_id'],
                              'product_name'=>$_POST['product_name'],
                              'product_price'=>$_POST['product_price'],
                              'product_image'=>$_POST['product_image'],
                              'product_quantity'=>$_POST['product_quantity'],
                            );
 
         // add the array to the session
 
         $_SESSION['cart'][$_POST['product_id']]=$product_array;
      }

      else
      {
          echo '<script>alert("product has already added to the cart")</script>';
         // echo '<script>window.location="index.php"</script>';
      }
    }
    //else it is the first time the user added sth to the cart
    else
    {
        //fetch the data from the post form in the single-product page
       $product_id= $_POST['product_id'];
       $product_name= $_POST['product_name'];
       $product_price= $_POST['product_price'];
       $product_image= $_POST['product_image'];
       $product_quantity= $_POST['product_quantity'];

       //collect them in one array
       $product_array=array(
                             'product_id'=>$product_id,
                             'product_name'=>$product_name,
                             'product_price'=>$product_price,
                             'product_image'=>$product_image,
                             'product_quantity'=>$product_quantity,
                           );

        // add the array to the session

        $_SESSION['cart'][$product_id]=$product_array;
        //cart is the  session big array contains key and value [  2=>[] , 7=>[] ]
        //product id  key     لازم لحتى نعرف كل  مرة عم يطلب فيها الشخص رح نستعملا لانو كل مرة عم حط فيها منتج بالسلة المنج عم يكون اله اسم وسعر وصورة وكميةو رقم يميزها عن كل مرة عم حط فيها المنتج بالسلة 
        //product_array the value of the product
    }
    CalculateTotalCart();
}

elseif(isset($_POST['remove_product']))
{
    $product_id= $_POST['product_id'];

    //remove the product from the session when click on the remove_product btn
    unset($_SESSION['cart'][ $product_id]);

    CalculateTotalCart();

}

elseif(isset($_POST['edit_quantity']))
{
    //new quantity
    $product_quantity= $_POST['product_quantity'];
    $product_id= $_POST['product_id'];

    //get the product array from the session because ther might be other products
    $product_array= $_SESSION['cart'][ $product_id];

    //update product quantity we assign the new quantity to the old quantity
    $product_array['product_quantity']=$product_quantity;

    //return the session that contains the new array updates
    //put the product_array with new updates again in the session
    $_SESSION['cart'][ $product_id]= $product_array;

    CalculateTotalCart();
}

else  //the user get to the cart page from some where else rather than the if statement which is click on the add to cart button
{ 
    //if you want the user to come to see the cart from only the add_to _cart button uncomment this
    //but if you want the user to come to see the cart from anywhere when he press the cart icon then comment this
    //header('location: index.php');
}


function CalculateTotalCart()
{
    $total_price=0;
    $total_quantity=0;
    foreach( $_SESSION['cart'] as  $key=>$value )
    {
        //get the array of every product
        $product = $_SESSION['cart'][$key];

        $price=$product['product_price'];
        $quantity=$product['product_quantity'];

        $total_price=$total_price+ ($price *  $quantity) ;
        $total_quantity =$total_quantity + $quantity;

    }

    $_SESSION['total']=$total_price;
    $_SESSION['quantity']=$total_quantity;
}


?>





    <section class="cart container my-5 py-5">
        <div class="container mt-5">
           <h2 class="">Your Cart</h2>
           <hr class="hr-Shop">
        </div>

        <table  class="mt-5 pt-5">

          <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
          </tr>
           <!-- loop over the session array to get the value related to the product_id -->
          <?php foreach( $_SESSION['cart'] as  $key=>$value ){ ?>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/img/<?php echo $value['product_image']?>" alt="">
                        <div>
                            <p><?php echo $value['product_name']?></p>
                            <small><span>$</span><?php echo $value['product_price']?></small>
                            <br>
                            <form method="POST" action="cart.php">
                              <input type="hidden" name="product_id" value="<?php echo $value['product_id']?>" />
                              <input type="submit" name="remove_product" class="remove-btn" value="remove" />
                           </form>
                         
                        </div>
                    </div>
                </td>

                <td>
                    <form method="POST" action="cart.php">
                              <input type="hidden" name="product_id"        value="<?php echo $value['product_id']?>" />
                              <input type="number" name="product_quantity"  value="<?php echo $value['product_quantity']?>" />
                              <input type="submit" name="edit_quantity" class="edit-btn" value="Edit" />
                    </form>
                </td>

                <td>
                    <span>$</span>
                    <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']?></span>
                </td>
            </tr>
            <?php }?>
        </table>

        <div class="cart-total">
            <table>
                <tr>
                    <td>Total</td>
                    <td>$<?php  if (isset($_SESSION['total'])){ echo $_SESSION['total'];} ?></td>
                </tr>    
            </table>  
        </div>

        <div class="checkout-container">
            <form method="POST" action="placeorder.php">
                 <input  type="submit"  id="checkout-btn" value="Checkout" name="checkout" />

            </form>
         
        </div>

     
        
    </section>



    
 <?php include('layouts/footer.php')?>