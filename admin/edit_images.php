<?php
include('layouts/header.php');
include('pages_protector.php');
include('layouts/sidebar.php');

    if (isset($_GET['product_id']))
    {
        $product_id=$_GET['product_id'];
        $product_name=$_GET['product_name'];
    }
    else
    {
        header('location:products.php');
    }
?>

<body>

<div class="container-fluid">
    <div class="row" >

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" >
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-0">
           
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2"></div>  
                </div>
           </div>
        
            <h2>Edit Images</h2>
            <div class="table-responsive">
                <div class="container mx-auto ">
              
                    <form id="edit_images_form" enctype="multipart/form-data" action="update_images.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product_id;?>"/>
                    <input type="hidden" name="product_name" value="<?php echo $product_name;?>"/>
                     
                        <div class="form-group mt-2">
                            <label >Image 1</label>
                            <input type="file" class="form-control" id="image1" name="image1"  />
                        </div>

                        <div class="form-group mt-2">
                            <label >Image 2</label>
                            <input type="file" class="form-control" id="image2" name="image2"   />
                        </div>

                        <div class="form-group mt-2">
                            <label >Image 3</label>
                            <input type="file" class="form-control" id="image3" name="image3"   />
                        </div>

                        <div class="form-group mt-2">
                            <label >Image 4</label>
                            <input type="file" class="form-control" id="image4" name="image4"  />
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-warning w-100 mt-5" id="edit_images_product" name="edit_images_btn"   value="Edit Images" />
                        </div>
                        
                    </form>
                </div>       
            </div>
       </main>
    </div>
</div>

</body>
</html>
