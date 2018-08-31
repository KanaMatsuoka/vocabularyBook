<?php


include 'dbconnect.php';

if(isset($_POST['submit'])){

$username = mb_convert_kana($_POST['username'], 'a', 'UTF-8');
$email = mb_convert_kana($_POST['email'], 'a', 'UTF-8');
$password = mb_convert_kana($_POST['password'], 'a', 'UTF-8');
$password2 = mb_convert_kana($_POST['password2'], 'a', 'UTF-8');



$sql = "INSERT INTO userlist (username,email,PASSWORD)
  VALUES ('$username','$email','$password')";

if(!empty($_POST)){
	if(strlen($username) < 2 || strlen($username) > 15){
     $error['username'] = 'lenght';
    }
    if(strlen($password) != 8){
	  $error['password'] = 'lenght';
	  }
    if($password !== $password2){
	  $error['password2'] = 'same';
	  }
  if (empty($error) && $conn->query($sql) === TRUE) {
    if (empty($error)){
    $_SESSION['username'] = $username;
    header('Location:login.php');
  }else{
    echo 'error';
  }
}
}
}



?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <div class="container">
    <div class="head">
<br>
<br>
      <img src="Project.css/star.jpg" width="90px;" height="90px;">
      <h1>Registration Form</h1>
  </div>
     <form action="" method="POST" >
      <div class="list">
       <table>
        <tr>
           <td>User Name</td>
           <td>
            <input type="text" name="username" required>
           </td>
        </tr>

        <tr>
           <td>Email</td>
           <td><input type="email" name="email"required>
           </td>

        </tr>

        <tr>
           <td>Password</td>
           <td>
            <input type="password" name="password" required>
           </td>
        </tr>

        <tr>
           <td>Confirm Password</td>
           <td>
            <input type="password" name="password2" required>
           </td>
        </tr>

        
       </table>
    
  </div>
<br>
<br>
       <img src="Project.css/lace.jpg">

<br>
       <input class="submit" type="submit" name="submit" value="Submit">
     </form>
  </div>

</body>
</html>



