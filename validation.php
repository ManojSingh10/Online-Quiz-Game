<?php
  session_start();

  //connecting to the database
  $con=mysqli_connect('localhost','root');
  //selecting miniproject database
  mysqli_select_db($con,'timer');
  $name=$_POST['username'];
  $pass=$_POST['password'];
  //checking duplicacy
  $q="select * from user where name = '$name' && password='$pass'";
  $result= mysqli_query($con,$q);
  $num= mysqli_num_rows($result);
  if($num==1)
  {
    //making a session variable
    $_SESSION['uname']=$name;
    header('location:again.php');
  }

  else
  {
    echo ("<script LANGUAGE='Javascript'>
    alert('Wrong Username or Password!');
    window.location.href='login.php';</script>");
  }
 ?>
