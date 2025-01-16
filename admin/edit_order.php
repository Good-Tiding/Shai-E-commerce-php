
<?php
include('layouts/header.php');
include('pages_protector.php');
?>

<?php

include("../server/connection.php"); 

if(isset($_GET['order_id']))
{
  $order_id=$_GET['order_id'];

  $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=?");
  $stmt->bind_param('i',$order_id);
  $stmt->execute();
  $orders=$stmt->get_result();

}
else if(isset($_POST['edit_order_btn']))
{
    
    
    $order_id=$_POST['order_id'];// we pass it as hidden
    $order_status=$_POST['order_status'];
 
    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");

    $stmt->bind_param('si', $order_status, $order_id);
    
    if($stmt->execute())
    {
        header('location: orders.php?edit_order_success=Order updated successfully');
        exit;
    }
    else
    {
        
        header('location: orders.php?edit_order_failure=Failed to update the order');
        exit;
    }
}

else
{
    header('location: ordersphp');
    exit;
}


?>

<body>

<div class="container-fluid">
    <div class="row"  style="min-height: 1000px;">
        <?php include('layouts/sidebar.php');?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" >
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-0">
                <h1 class="h2" style="padding-top: 20px;"> Dashboard </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2"></div>  
                </div>
           </div>
        
            <h2>Edit Order</h2>
            <div class="table-responsive">
                <div class="container mx-auto ">
                    <form id="edit-form" action="edit_order.php" method="POST">
                       <!--  we are updating the product in the same page so it will be null when updating it so we have to store it in the form  -->
                        
                        <?php foreach ($orders as $order) {?>

                        <input type="hidden" name="order_id" value="<?php echo $order['order_id'];?>"/>

                        <div class="form-group my-3">
                            <label >Order ID</label>
                            <p class="my-4"><?php echo $order['order_id']; ?></p>
                    
                        </div>


                        <div class="form-group my-3">
                            <label >Order Price</label>
                            <p class="my-4">$<?php echo $order['order_cost']; ?></p>  
                        </div>

                        <div class="form-group my-3">
                            <label >Order Status</label>
                            <select id="status" class="form-select" name="order_status">
                                <option value="not paid" <?php if ($order['order_status']=='not paid'){echo 'selected';} ?>>Not Paid</option>
                                <option value="shipped" <?php if ($order['order_status']=='shipped'){echo 'selected';} ?>>Shipped</option>
                                <option value="paid" <?php if ($order['order_status']==' paid'){echo 'selected';} ?>>Paid</option>
                                <option value="delivered" <?php if ($order['order_status']=='delivered'){echo 'selected';} ?>>Delevired</option>
                            </select>
                        </div>
                        
                        <div class="form-group my-3">
                            <label >Order Date</label>
                            <p class="my-4"><?php echo $order['order_date']; ?></p>
                           
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" id="edit_order" name="edit_order_btn"   value="Edit" />
                        </div>

                        <?php }?>
                    </form>
                </div>       
            </div>
       </main>
    </div>
</div>

</body>
</html>

