<?php
include('layouts/header.php');
include('pages_protector.php');
?>

<?php

include("../server/connection.php"); 


if(isset($_GET['product_id']))
{
  $product_id=$_GET['product_id'];

  $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
  $stmt->bind_param('i',$product_id);
 if($stmt->execute()) 
 {
    header('location:products.php?deleted_successfully= product has been deleted_successfully ');
 }

 else
 {
    header('location:products.php?deleted_failure= Deleting Failed ');
 }


}
?>

