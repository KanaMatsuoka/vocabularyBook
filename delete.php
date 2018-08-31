<!DOCTYPE html>
<html>

<body>



<?php
  include 'dbconnect.php';
  session_start();


  $id=$_GET['id'];
  $sql = "DELETE FROM word WHERE id=$id";

  if ($conn->query($sql)=== TRUE){
  	header('Location:userhome.php');
    // echo "Record is deleted successfully";
  } else{
    echo "Error during deleting record: " .$conn->error;
  }
?>

</body>
</html>
