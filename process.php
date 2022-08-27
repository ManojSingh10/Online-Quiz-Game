
<?php
  //make sure post request contains value

  $con=mysqli_connect('localhost','root');
  mysqli_select_db($con,'timer');
  ;

  $q="select * from questions where id='".$_POST["runningQuestion"]."'";
  $query=mysqli_query($con,$q);
  while($rows=mysqli_fetch_array($query))
  {
    $data['ques']=$rows['ques'];
    $data['a']=$rows['a'];
    $data['b']=$rows['b'];
    $data['c']=$rows['c'];
    $data['rightans']=$rows['rightans'];
  }
  echo json_encode($data);


 ?>
