
<?php include('layouts/header.php');?>
<?php

include("server/connection.php"); //to insert things to database we have to make a connection

//if the user logged in so not allow him to go to the registeration page
//we have to make a logout button to register another user if we want
if(isset($_SESSION['logged_in']))
{
  header('location: account.php');
  exit;
} 

if(isset($_POST['register'])) //check if the user click the register button with the name register
{
  //get the user info
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirmPassword=$_POST['confirmPassword'];


    if($password !== $confirmPassword)
    //error is a get parameter
    {
     header('location: register.php?error=passwords not match');
    }

    else if(strlen($password)<6)
    {
     header('location: register.php?error=password must be at least 6 charachters');
    }

    else //there are no errors
    {
        // check if there is a user with this email or not
        //we put user_email not email because we are dealing with the sql tables here
        //connect to the database
        $stmt1 = $conn->prepare("SELECT count(*) FROM users where user_email=?");
        //count how many rows exist in the users table where the user_email column matches the value provided by the user.

        $stmt1->bind_param('s',$email); 
        //binds a value to the placeholder (?) in the prepared statement. The value for the placeholder will come from the variable $email. for example: SELECT count(*) FROM users WHERE user_email='example@example.com'

        $stmt1->execute();
        //executes the prepared SQL query. After binding the parameter,

        $stmt1->bind_result($num_rows);
        //binds the result of the query (the number of rows returned) to the variable $num_rows. The result of the query (i.e., the value returned by count(*)) will be stored in this variable.

        $stmt1->store_result();
        //stores the result of the query into the memory so that it can be fetched and processed later. This step is often required if you're using functions like bind_result(), as it prepares the result set for retrieval.

        $stmt1->fetch();
        //retrieves a row from the result set and populates the variables bound via bind_result(). In this case, it will fill $num_rows with the actual number of rows returned by the query.


        // check if there is a user already registered with this email
        if($num_rows !=0)
        {
          header('location: register.php?error= user with this email has already existed');
        }

        else
        {
          //create a new user
          $stmt = $conn->prepare("INSERT INTO users (	user_name,	user_email,	user_password)
          VALUES (?,?,?);");

          $stmt->bind_param('sss',$name,$email,md5($password)); 
          if($stmt->execute())//if the account is created successfully we have to store user info in the database
          {
            //Storing passwords in the session or any client-side storage (like cookies or local storage) is not recommended for security reasons
            //There’s no need to store the password in the session because the user is already authenticated. Instead, you can store non-sensitive data like the user's email, name, and a flag indicating the login state (logged_in)
           // Sessions allow you to store user data temporarily while the user interacts with your website. By storing the user's email and name in the session, you ensure that the user's details are available across multiple pages without needing to repeatedly fetch them from the database. Without this, the user would have to log in again or provide their email and name on every page, which would be inconvenient.
            $_SESSION['user_id']=$stmt->insert_id;
            $_SESSION['user_email']=$email;
            $_SESSION['user_name']=$name;
            //variable is not explicitly declared in the code before it's used. It is simply created and assigned a value when the user successfully registers or logs in.
            $_SESSION['logged_in']=true;
            //you can pass the register parameter in the account page to see this message ,else the message will be pass in the URL
            header('location: account.php?register_success= Your account has created successfully!');
          }
          else
          {
            header('location: register.php?error= Failed to create your account');
          }
        }
    }
}

 


?>






    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 >Register</h2>
            <hr class="hr-Home">
        </div>
        <div class="container mx-auto ">
            <form id="register-form" method="POST" action="register.php">

        <!--    this line of code won't executed unless there is an error message -->
                <p style="color:red;"><?php if (isset($_GET['error'])){echo $_GET['error'];} ?></p>
                <div class="form-group">
                    <label >Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required/>
                </div>

                <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Email" required/>
                </div>


                <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="password" required/>
                </div>

              
                <div class="form-group">
                    <label >Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm password" required/>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register" />
                </div>

                <div class="form-group">
                 <a id="login-url" class="btn" href="login.php">Do you have an account? Login</a>
                </div>

            </form>
        </div>
    </section>




    <?php include('layouts/footer.php')?>

