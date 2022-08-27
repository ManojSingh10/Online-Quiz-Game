<?php
  session_start();
  $con=mysqli_connect('localhost','root');
  mysqli_select_db($con,'timer');


  $q=$_POST["scorePerCent"];
  $n=$_SESSION["uname"];
  

  //$qy="insert into user(store) values('$q') where name=$n";
 //now $qy="insert into user(store) values('$n')";
 $qy="update user set score='$q' where name='$n'";
  mysqli_query($con,$qy);

 ?>
