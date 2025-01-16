<?php
if(!isset($_SESSION['admin_logged_in']))
{
  header('location: login.php');
  exit;
}  
?>

