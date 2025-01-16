<?php


 include('layouts/header.php');
include("server/connection.php");


if(isset($_SESSION['logged_in']))
{
  header('location: account.php');
  exit;
} 

if(isset($_POST['login_btn']))
{

    $email=$_POST['email'];
    $password = md5($_POST['password']);//compare the password with the hashed password in the database


    // every select query means that you wnt to fetch sth
    //While you technically only need the email and password to authenticate a user, selecting additional user information (like user_id and user_name) in the initial query helps ensure that you have everything you need for the user session and avoids the need for multiple queries
    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users where user_email=? AND user_password=? LIMIT 1 ");

    $stmt->bind_param('ss',$email,$password); 

    if($stmt->execute())
    {
      $stmt->bind_result($user_id, $user_name, $user_email,$user_password);
      $stmt->store_result();

      if($stmt->num_rows()==1) //if you see a result in the database that is binding wuth the email and password the user entered (the result has to be 1 because we don't have to have the same email and password twice)
      {
         $stmt->fetch();

         $_SESSION['user_id']=$user_id;
         $_SESSION['user_name']=$user_name;
         $_SESSION['user_email']=$user_email;
         $_SESSION['logged_in']=true;

         header('location: account.php?login_success= You Logged in  successfully!');
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

    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 >Login</h2>
            <hr class="hr-Home">
        </div>
        <div class="container mx-auto ">
            <form id="login-form" action="login.php" method="POST" autocomplete="off">
            <p style="color:red;"><?php if (isset($_GET['error'])){echo $_GET['error'];} ?></p>
                <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required/>
                </div>

                <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="password" required/>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login_btn"   value="login" />
                </div>

                <div class="form-group">
                 <a id="register-url" class="btn" href="register.php">Don't have an account? Register</a>
                </div>

            </form>
        </div>
    </section>




 <?php include('layouts/footer.php')?>