

<?php


include('layouts/header.php');
include("server/connection.php");

if(isset($_POST['order_details_btn']) && isset($_POST['order_id']))
{
    $order_id=$_POST['order_id'];
    $order_status=$_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id=? ");

    $stmt->bind_param('i',$order_id);

    $stmt->execute();

    $_SESSION['order_details'] = true; 

    $order_details= $stmt->get_result();

    $total_past_order_price=CalculateTotalPlacedOrder($order_details);
    
}

else
{
    header('location: account.php');
    exit;
}

function CalculateTotalPlacedOrder($order_details)
{
    $total=0;
    //while($row =$order_details->fetch_assoc()) or use foreach
    foreach($order_details as $row)
    {

        $price=$row['product_price'];
        $quantity=$row['product_quantity'];

        $total=$total+ ($price *  $quantity) ;
    }

    return $total;
}

?>









<section id=orders class="orders container my-5 py-5">

    <div class="container mt-5">
    <h2 class="font-weight-bold text-center"> Order Details</h2>
    <hr class="hr-Home"> 
    </div>

    <table  class="mt-5 pt-5 mx-auto ">

    <tr>
        <th>Product Name </th>
        <th>Quantity</th>
        <th>Price</th>
      
    </tr>


    <?php foreach($order_details as $row){ ?>

        <tr>
        
            <td>
               <div class="product-info">
                  <img src="assets/img/<?php echo $row['product_image'];?>" alt="">
                  <div>
                    <p class="mt-4"><?php echo $row['product_name']; ?></p>
                  </div>
               </div>
            </td>


            <td>
                <span><?php echo $row['product_quantity']; ?></span>
            </td>

            <td>
                <span>$<?php echo $row['product_price']; ?></span>
            </td>

        
        </tr>

    <?php }?>  

    </table>

    <?php if($order_status =='not paid'){ ?>
        <form method="POST" action="payment.php" style="float: right;">
           <input type="hidden" value="<?php echo  $total_past_order_price;  ?>" name='total_past_order_price' />
           <input type="hidden" value="<?php echo  $order_status;  ?>" name='order_status' />
           <input type="submit" class="btn btn-primary" value="Pay Now" name="pay_past_btn">
        </form>
    <?php } ?>

</section>






<?php include('layouts/footer.php')?>