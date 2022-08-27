<?php
  session_start();
  //after checking the user is redirected
//  header('location:login.php');
  //connecting to the database
  $con=mysqli_connect('localhost','root');
  //selecting miniproject database
  mysqli_select_db($con,'timer');
  $name=$_POST['username'];
  $pass=$_POST['password'];
  $cpass=$_POST['cpassword'];
  if(strlen($name)<4 || strlen($name)>15)
  {
    echo ("<script LANGUAGE='Javascript'>
    alert('Username must be 4 to 15 characters long.');
    window.location.href='home.php';</script>");
  }
  if(strlen($pass)<6 || strlen($pass)>12)
  {
    echo ("<script LANGUAGE='Javascript'>
    alert('Password must be 6 to 12 characters long.');
    window.location.href='home.php';</script>");
  }
  if($pass!=$cpass)
  {
    echo ("<script LANGUAGE='Javascript'>
    alert('Passwords do not match try again.');
    window.location.href='home.php';</script>");
  }
  //checking duplicacy
  $q="select * from user where name = '$name'";
  $result= mysqli_query($con,$q);
  $num= mysqli_num_rows($result);
  if($num==1)
  {
    echo ("<script LANGUAGE='Javascript'>
    alert('Username already exist. Try with a different username.');
    window.location.href='home.php';</script>");
  }

  else
  {
    $qy="insert into user(name,password) values('$name','$pass')";
    mysqli_query($con,$qy);
    echo ("<script LANGUAGE='Javascript'>
    alert('Sign Up complete.Login to continue.');
    window.location.href='login.php';</script>");

  }
 ?>
