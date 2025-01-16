<?php

include("connection.php");
$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='bags' LIMIT 4");
if ($stmt) 
{
   $stmt->execute();
   $bags_products=$stmt->get_result();
} 

?>


