<!-- we don't have to make register page we can add other admins in the database and provide them with email and password -->


<?php include('layouts/header.php')?>

<?php

 include("../server/connection.php");
 
 if(isset($_SESSION['admin_logged_in']))
{
  header('location: index.php');
  exit;
}  

if(isset($_POST['login_btn']))
{

    $email=$_POST['email'];
    $password = md5($_POST['password']);//compare the password with the hashed password in the database


    // every select query means that you wnt to fetch sth
    //While you technically only need the email and password to authenticate a user, selecting additional user information (like user_id and user_name) in the initial query helps ensure that you have everything you need for the user session and avoids the need for multiple queries
    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins where admin_email=? AND admin_password=? LIMIT 1 ");

    $stmt->bind_param('ss',$email,$password); 

    if($stmt->execute())
    {
      $stmt->bind_result($admin_id, $admin_name, $admin_email,$admin_password);
      $stmt->store_result();

      if($stmt->num_rows()==1) //if you see a result in the database that is binding wuth the email and password the user entered (the result has to be 1 because we don't have to have the same email and password twice)
      {
         $stmt->fetch();

         $_SESSION['admin_id']=$admin_id;
         $_SESSION['admin_name']=$admin_name;
         $_SESSION['admin_email']=$admin_email;
         $_SESSION['admin_logged_in']=true;

         header('location: index.php?login_success= You Logged in  successfully!');
      }

      else
      {
        header('location: login.php?error=  Email or Password is wrong !');
      }

    }
    else
     {
      header('location: login.php?error= Login Faild');
    }
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>



    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-sm p-4" style="width: 300px;">
        <h2 class="text-center mb-4">Admin Login</h2>
        <form action="login.php" method="POST" autocomplete="off">
            <div class="mb-3">
              
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">

                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-success w-100" name="login_btn">Login</button>
        </form>
    </div>
</div>


</body>
</html>
