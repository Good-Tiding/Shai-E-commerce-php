<?php 
include('layouts/header.php');
include('pages_protector.php');
?>



<?php

include("../server/connection.php"); 

if(isset($_POST['edit_images_btn']))
{

    $product_name=$_POST['product_name'];
    $product_id=$_POST['product_id'];
 

    // this is the file of the image it self
    $img1=$_FILES['image1']['tmp_name'];
    $img2=$_FILES['image2']['tmp_name'];
    $img3=$_FILES['image3']['tmp_name'];
    $img4=$_FILES['image4']['tmp_name'];

    //these are imgs names we have to store them in the database
    $img_name1=$product_name."1.jpeg";
    $img_name2=$product_name."2.jpeg";
    $img_name3=$product_name."3.jpeg";
    $img_name4=$product_name."4.jpeg";

    move_uploaded_file($img1,"../assets/img/".$img_name1);
    move_uploaded_file($img2,"../assets/img/".$img_name2);
    move_uploaded_file($img3,"../assets/img/".$img_name3);
    move_uploaded_file($img4,"../assets/img/".$img_name4);

    $stmt = $conn->prepare("UPDATE products SET  product_image=?,product_image2=?,
                                                  product_image3=?,product_image4=? WHERE product_id=?");
    $stmt->bind_param ('ssssi',$img_name1,$img_name2,$img_name3,$img_name4,$product_id);  
                                    
    if($stmt->execute())
    { 
        header('location: products.php?images_updated_success_message=Image(s) updated successfully');
        exit;
    }
    
    else
    {
        header('location: products.php?images_updated_failure_message=Failed to Update the Image(s)');
        exit;
    }

}

?>