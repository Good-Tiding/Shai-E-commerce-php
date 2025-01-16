<?php

include("connection.php");
$stmt = $conn->prepare("SELECT * FROM products LIMIT 4");
if ($stmt) 
{
   $stmt->execute();
   $featured_products=$stmt->get_result();

   /*  if ($featured_products->num_rows == 0) 
    {
        echo "No products found.";
    } */
} 
   /*  else 
    {
    echo "Error preparing statement: " . $conn->error;
    } */

?>


