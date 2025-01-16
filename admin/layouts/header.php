<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_GET['logout'])) { 
    if(isset($_SESSION['admin_logged_in'])) {
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_name']);
        unset($_SESSION['admin_email']);
        header('location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eroka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css" />
</head>
<body>
    <header>
        <!-- Navbar Section -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="#">
                    <img class="logo" src="../assets/img/logo.png" alt="logo" width="30" height="30"> Eroka
                </a>

                <!-- Navbar Toggler (For Mobile) -->
                <?php if(isset($_SESSION['admin_logged_in'])){ ?>
                 

                   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#horizontal-sidebar" aria-controls="#horizontal-sidebar" aria-expanded="false" aria-label="Toggle sidebar">
                      <span class="navbar-toggler-icon"></span>
                   </button>
                  
                <?php } ?> 
                <div class="collapse navbar-collapse" id="horizontal-sidebar">
            
                    <ul class="navbar-nav ms-auto ">
                        <!-- Other Sidebar Items can go here -->
                        <?php if(isset($_SESSION['admin_logged_in'])){ ?>
                            <!-- Logout button inside the sidebar -->
                            <li class="nav-item"><a href="login.php?logout=1" class="nav-link text-white">Logout</a></li>
                        <?php } ?>
                    </ul>
               </div>   
            </div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


   



</body>
</html>



