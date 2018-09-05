<?php
  include 'dbconnect.php';

  $infoID = $_GET['infoID'];
  $error['password'] = '';

  if(isset($_POST['submit'])){
  $password = $_POST['password'];
  $password2 = $_POST['password2'];

  $sql_pass = "UPDATE userlist SET PASSWORD='$password' WHERE infoID=$infoID";

  if(strlen($password)==8 && $password === $password2){
    mysqli_query($conn, $sql_pass);
    header('Location:login.php');
  }else{
    $error['password'] = 'lenght';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password Form</title>
  <link rel="stylesheet" href="Register2.css">
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
         <td>New Password</td>
         <td><input type="password" name="password" pattern="^[0-9A-Za-z]+$" required></td>
         <?php if ($error['password'] == 'lenght'):?>
            <p class="error">Please input 8 characters or <br>Please check if password and confirm passoword are the same</p>
            <?php endif; ?>
         </tr>

         <tr>
         <td>Confirm Password</td>
         <td><input type="password" name="password2" pattern="^[0-9A-Za-z]+$"required></td>
         </tr>



       </table>
      </div>
<br>
<br>
<br>
       <img src="Project.css/lace.jpg">

<br>
       <input class="submit" type="submit" name="submit" value="Submit">
     </form>
  </div>

</body>
</html>
