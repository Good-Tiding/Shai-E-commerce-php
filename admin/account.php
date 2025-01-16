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
        
            <h2>Admin Account</h2>
            <hr>
            <div class="table-responsive">
                <div class="container mx-auto ">
                    <p>ID: <?php echo $_SESSION['admin_id'];?></p>
                    <p>Name: <?php echo $_SESSION['admin_name'];?></p>
                    <p>Email: <?php echo $_SESSION['admin_email'];?></p>
                </div>      
            </div>
       </main>
    </div>
</div>

</body>
</html>
