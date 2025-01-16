<?php
include('layouts/header.php');
include('pages_protector.php');
?>

<?php

include("../server/connection.php"); 

if(isset($_GET['product_id']))
{
  $product_id=$_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
  $stmt->bind_param('i',$product_id);
  $stmt->execute();
  $products=$stmt->get_result();

}
else if(isset($_POST['edit_product_btn']))
{
    echo "Form submitted successfully";
    
    $product_id=$_POST['product_id'];// we pass it as hidden
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $color=$_POST['color'];
    $sale=$_POST['sale'];

    $stmt = $conn->prepare("UPDATE products SET product_name=?,product_description=?,product_price=?,
                                                product_category=?,product_color=?,product_special_offer=?
                            WHERE product_id=?");

    $stmt->bind_param('sssssii',$title, $description, $price, $category, $color, $sale, $product_id);
    
    if($stmt->execute())
    {
        header('location: products.php?edit_success_message=Product updated successfully');
        exit;
    }
    else
    {
        
        header('location: products.php?edit_failure_message=Failed to update the product');
        exit;
    }
}

else
{
    header('location: products.php');
    exit;
}


?>

<body>

<div class="container-fluid">
    <div class="row">
        <?php include('layouts/sidebar.php');?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" >
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-0">
            
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2"></div>  
                </div>
           </div>
        
            <h2>Edit Product</h2>
            <div class="table-responsive">
                <div class="container mx-auto ">
                    <form id="edit-form" action="edit_product.php" method="POST">
                       <!--  we are updating the product in the same page so it will be null when updating it so we have to store it in the form  -->
                        
                        <?php foreach ($products as $product) {?>

                        <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>"/>

                        <div class="form-group mt-2">
                            <label >Product Name</label>
                            <input type="text" class="form-control" id="product-name" name="title" value="<?php echo $product['product_name']; ?>" placeholder="Name" required/>
                        </div>

                        <div class="form-group mt-2">
                            <label >Description</label>
                            <input type="text" class="form-control" id="product-desc" name="description" value="<?php echo $product['product_description']; ?>" placeholder="Description" required/>
                        </div>

                        <div class="form-group mt-2">
                            <label >Price</label>
                            <input type="text" class="form-control" id="product-price" name="price" value="<?php echo $product['product_price']; ?>" placeholder="Price" required/>
                        </div>


                        <div class="form-group mt-2">
                            <label >Category</label>
                            <select class="form-select" name="category" required>
                                <option value="bags" <?php if ($product['product_category']=='bags'){echo 'selected';} ?>>Bags</option>
                                <option value="shoes" <?php if ($product['product_category']=='shoes'){echo 'selected';} ?>>Shoes</option>
                                <option value="skirts" <?php if ($product['product_category']=='skirts'){echo 'selected';} ?>>Skirts</option>
                                <option value="coats" <?php if ($product['product_category']=='coats'){echo 'selected';} ?>>Coats</option>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label >Color</label>
                            <input type="text" class="form-control" id="product-color" name="color" value="<?php echo $product['product_color']; ?>" placeholder="Color" required/>
                        </div>

                        <div class="form-group mt-2">
                            <label >Special Offer/Sale</label>
                            <input type="number" class="form-control" id="product-sale" name="sale" value="<?php echo $product['product_special_offer']; ?>" placeholder="Sale%" required/>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary w-100 mt-5" id="edit_product" name="edit_product_btn"   value="Edit" />
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
