<?php include('layouts/header.php');?>
<?php


include("server/connection.php");

if(!isset($_SESSION['logged_in']))
{
    header('location: login.php');
    exit;
   
}

if(isset($_GET['logout'])) 
{
  if(isset($_SESSION['logged_in'])) 
  {
      unset($_SESSION['logged_in']);
      unset($_SESSION['user_name']);
      unset($_SESSION['user_email']);
      header('location: login.php');
      exit;
  }
}


if(isset($_POST['change_password']))
{
    $password=$_POST['password'];
    $confirmPassword=$_POST['confirmPassword'];
    $email=$_SESSION['user_email'];

    if($password !== $confirmPassword)
   
    {
     header('location: account.php?error=passwords not match');
    }

    
   

    else if(strlen($password)<6)
    {
     header('location: account.php?error=password must be at least 6 charachters');
    }

    


    else 
    {
    $stmt = $conn->prepare("UPDATE users SET user_password=?  where user_email=?");

    $stmt->bind_param('ss',  md5($password),$email); 

    if($stmt->execute())//if password has been updated then go to login page
    {
      header('location: account.php?updated_password= Password has been updated successfully');
      
    }

    else
    {
      header('location: account.php?error= Failed to update password');
    }

    }
}

if(isset($_SESSION['logged_in']))
{

  $user_id=$_SESSION['user_id'];

  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");
  $stmt->bind_param('i',$user_id);
  $stmt->execute();
  $orders=$stmt->get_result();
  
}




if(isset($_GET['order_id']))
{
  $order_id=$_GET['order_id'];

  $stmt = $conn->prepare("DELETE FROM orders WHERE order_id=?");
  $stmt->bind_param('i',$order_id);

 if($stmt->execute()) 
 {

    header('location:account.php ');
 }

 else
 {
    header('location:account.php');
 }


}



?>


    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class=" text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p style="color:green;"><?php if (isset($_GET['register_success'])){echo $_GET['register_success'];} ?></p>
            <p style="color:green;"><?php if (isset($_GET['login_success'])){echo $_GET['login_success'];} ?></p>
               <h3 >Account Info</h3>
               <hr class="hr-Home">
                <div class="account-info ">
                    <p>Name: <span><?php if (isset($_SESSION['user_name'])){  echo $_SESSION['user_name'];} ?></span></p>
                    <p>Email: <span><?php if (isset($_SESSION['user_email'])){  echo $_SESSION['user_email'];} ?></span></p>
                    <p><a href="#orders" id="orders-btn">Your Orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn" >Logout</a></p>
                 <!--    This allows the page to know that the user intends to log out, and the 1 could indicate that the action should be performed -->
                </div>
            </div>

            <div class=" col-lg-6 col-md-12 col-sm-12">
           
                <form id="account-form" method="POST" action="account.php">
                     <p style="color:green;"><?php if (isset($_GET['updated_password'])){echo $_GET['updated_password'];} ?></p>
                     <p style="color:red;"><?php if (isset($_GET['error'])){echo $_GET['error'];} ?></p>
                    <h3>Change Password</h3>
                    <hr class="hr-Home">
                    <div class="form-group">
                        <label >Password</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="password" required/>
                    </div>

                    <div class="form-group">
                        <label >Confirm Password</label>
                        <input type="password" class="form-control" id="account-confirm-password" name="confirmPassword" placeholder="Confirm password" required/>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn" id="change-password-btn" name="change_password"  value="Change Password" />
                    </div>

                </form>
            </div>
        </div>
    </section>


    <section id=orders class="orders container my-5 py-3">

      <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
        <hr class="hr-Home"> 
      </div>

      <table  class="mt-5 pt-5">

        <tr>
          <th>order id </th>
          <th>order cost</th>
          <th>order status</th>
          <th>order date</th>
          <th>order details</th>
          <th> Delete order</th>
        </tr>


        <?php while($row =$orders->fetch_assoc()){ ?>

          <tr>
            
            <td>
              <span><?php echo $row['order_id']; ?></span>
            </td>

            <td>
              <span><?php echo $row['order_cost']; ?></span>
            </td>

            <td>
              <span><?php echo $row['order_status']; ?></span>
            </td>

            <td>
              <span><?php echo $row['order_date']; ?></span>
            </td>

            <td>
              <form  action="order_details.php" method="POST">
                   <input type="hidden"  value="<?php echo $row['order_status']; ?>" name="order_status"/>
                   <input type="hidden"  value="<?php echo $row['order_id']; ?>" name="order_id"/>
                   <input  id=checkout-btn  type="submit" value="Details" name="order_details_btn"/>
              </form>
            </td>


              <td>
                <a class="btn btn-danger" href="account.php?order_id=<?php echo $row['order_id']; ?>">Delete</a></td>
            </td>

            
          </tr>

        <?php }?>  

      </table>

    </section>





 <?php include('layouts/footer.php')?>