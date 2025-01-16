<?php

include("connection.php");
$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='skirts' LIMIT 4");
if ($stmt) 
{
   $stmt->execute();
   $skirts_products=$stmt->get_result();
} 

?>


