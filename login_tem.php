<?php
 session_start();

 include 'dbconnect.php';

 $error['login'] = '';

 if(isset($_POST['submit'])){

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM userlist WHERE username='$username' AND PASSWORD='$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0){
  while ($rows=$result->fetch_assoc()) {
  $ID = $rows['infoID'];
  $_SESSION["id"]=$ID;
  $_SESSION['username']=$username;
  header('Location:user_tem.php');

 }
}else{
  $error['login'] = 'failed';
}
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" href="login.css">
  <link rel="shortcut icon" href="Project.css/list .png" >

</head>
<body>
  <div class="container">
    <div class="head">
<br>
<br>
<br>
      <img src="Project.css/star.jpg" width="90px;" height="90px;">
      <h1>Login Form</h1>
    </div>
     <form action="login_tem.php" method="POST" >
      <div class="list">
       <table>
        <tr>
           <td>User Name</td>
           <td><input type="text" name="username"></td>
        </tr>

        <tr>
           <td>Password</td>
           <td><input type="password" name="password"></td>
        </tr>

       </table>
      </div>
      
       <?php if ($error['login'] == 'failed'):?> 
       <p class="error">Please check User Name or Password</p>
       <?php endif; ?>
      
       
      <input class="submit" type="submit" name="submit" value="Login">
<br>
<br>
       <img src="Project.css/lace.jpg">
<br>
<br>
       <p>If you forgot password, Click <a href="Forgot.php">here!</a></p>

     </form>
<br>
<br>
  </div>

</body>
</html>
