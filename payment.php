
<?php include('layouts/header.php');?>
<?php


if(!isset($_SESSION['logged_in'] ))
{
  header('location: login.php');
  exit;
}




if (!isset($_SESSION['order_placed']) && !isset($_SESSION['order_details'])) {
  header('location: index.php'); 
  exit;
}
// If the user is coming from placeorder.php, unset the order_placed flag after accessing payment page
if (isset($_SESSION['order_placed'])) {
  unset($_SESSION['order_placed']);
}


if (isset($_SESSION['order_details'])) {
  unset($_SESSION['order_details']);
}

if (isset($_GET['order_id'])) {
  $order_id = $_GET['order_id'];
  echo "<p>Order placed successfully! Your order ID is: " . $order_id . "</p>";
} else {
  echo "<p>There was a problem retrieving the order ID.</p>";
}


if(isset($_POST['pay_past_btn']))
{
$order_status=$_POST['order_status'];
$total_past_order_price=$_POST['total_past_order_price'];


}

?>

    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 >Payment</h2>
       
        </div>
        <div class="container mx-auto text-center">

          <?php 
          // Check if there's an unpaid order
          if (isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { 
              // Display the past order price regardless of cart content
              echo '<p>Total Payment : $' . $_POST['total_past_order_price'] . '</p>';
              echo '<input type="submit" class="shop-now" value="Pay Now" />';

          // Check if the cart has items
          } else if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { 
              // Display the current cart total
              echo '<p>Total Payment : $' . $_SESSION['total'] . '</p>';
              echo '<input type="submit" class="btn btn-primary" value="Pay Now" />';

          } else { 
              // If nothing in the cart or no past unpaid order
              echo '<p>You don\'t have anything in your cart yet</p>';
          }
          ?>
        </div>


    </section>




    <?php include('layouts/footer.php')?>