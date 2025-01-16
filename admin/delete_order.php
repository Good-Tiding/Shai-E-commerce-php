<?php
include('layouts/header.php');
include('pages_protector.php');
?>

<?php

include("../server/connection.php"); 


if(isset($_GET['order_id']))
{
  $order_id=$_GET['order_id'];

  $stmt = $conn->prepare("DELETE FROM orders WHERE order_id=?");
  $stmt->bind_param('i',$order_id);

 if($stmt->execute()) 
 {

    header('location:orders.php?deleted_successfully= order has been deleted_successfully ');
 }

 else
 {
    header('location:orders.php?deleted_failure= Deleting Failed ');
 }


}
?>

