<?php

 include 'dbconnect.php';

 $error['error'] = '';


 if(isset($_POST['submit'])){

  $username = $_POST['username'];
  $email = $_POST['email'];



 $sql_user="SELECT * FROM userlist WHERE username='$username' AND email='$email'";

 $result = $conn->query($sql_user);
 $count = mysqli_num_rows($result);


 if($count == 1){
  if ($row = $result-> fetch_assoc()) {
     $infoID = $row["infoID"];
  header("Location:Forgot2.php?infoID=$infoID");
 }
} else{
    $error['error'] = 'incorrect';
 }
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Forgot Password Form</title>
  <link rel="stylesheet" href="Register2.css">
  <link rel="shortcut icon" href="Project.css/list .png" >

</head>
<body>
  <div class="container">
    <div class="head">
<br>
<br>
<br>
      <img src="Project.css/star.jpg" width="90px;" height="90px;">
      <h1>Forgot Password Form</h1>
    </div>
     <form action="" method="POST" >
      <div class="list">
       <table>
         <tr>
         <td>User Name</td>
         <td><input type="text" name="username"></td>
         </tr>

         <tr>
         <td>Email</td>
         <td><input type="text" name="email"></td>
         </tr>
            <?php if ($error['error'] == 'incorrect'):?> 
            <p class="error">Please check User Name or Email</p>
            <?php endif; ?>
       </table>
      </div>
<br>
<br>
<br>
       <img src="Project.css/lace.jpg">

<br>
       <input class="submit" type="submit" name="submit" value="Submit">

     </form>
<br>
<br>
  </div>

</body>
</html>
