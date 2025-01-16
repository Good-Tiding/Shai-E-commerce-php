<?php
include('layouts/header.php');
include('pages_protector.php');
include('layouts/sidebar.php');
?>

<body>

<div class="container-fluid">
    <div class="row"  style="min-height: 1000px;">
   
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" >
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-0">
              
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2"></div>  
                </div>
           </div>
        
            <h2 class="text-center">Add Product</h2>
            <hr>
            <div class="table-responsive">
                <div class="container mx-auto ">
               <!--  enctype="multipart/form-data" because i want to upload files that is iamges here -->
                    <form id="create-form" enctype="multipart/form-data" action="create_product.php" method="POST">
                       <!--  we are updating the product in the same page so it will be null when updating it so we have to store it in the form  -->
                        
                     


                        <div class="form-group mt-2">
                            <label >Product name</label>
                            <input type="text" class="form-control" id="product-name" name="title"  placeholder="name" required/>
                        </div>

                        <div class="form-group mt-2">
                            <label >Description</label>
                            <input type="text" class="form-control" id="product-desc" name="description"  placeholder="Description" required/>
                        </div>

                        <div class="form-group mt-2">
                            <label >Price</label>
                            <input type="text" class="form-control" id="product-price" name="price" placeholder="Price" required/>
                        </div>


                        <div class="form-group mt-2">
                            <label >Category</label>
                            <select class="form-select" name="category" required>
                                <option value="bags" >Bags</option>
                                <option value="shoes" >Shoes</option>
                                <option value="skirts" >Skirts</option>
                                <option value="coats" >Coats</option>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label >Color</label>
                            <input type="text" class="form-control" id="product-color" name="color"  placeholder="Color" required/>
                        </div>

                        <div class="form-group mt-2">
                            <label >Special Offer/Sale</label>
                            <input type="number" class="form-control" id="product-sale" name="sale"  placeholder="Sale%" required/>
                        </div>

                        <div class="form-group mt-2">
                            <label >Image 1</label>
                            <input type="file" class="form-control" id="image1" name="image1"  required/>
                        </div>

                        <div class="form-group mt-2">
                            <label >Image 2</label>
                            <input type="file" class="form-control" id="image2" name="image2"   required/>
                        </div>

                        <div class="form-group mt-2">
                            <label >Image 3</label>
                            <input type="file" class="form-control" id="image3" name="image3"   required/>
                        </div>

                        <div class="form-group mt-2">
                            <label >Image 4</label>
                            <input type="file" class="form-control" id="image4" name="image4"   required/>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary w-100 mt-4" id="create_product" name="create_product_btn"   value="Create" />
                        </div>
                        
                    </form>
                </div>       
            </div>
       </main>
    </div>
</div>

</body>
</html>
