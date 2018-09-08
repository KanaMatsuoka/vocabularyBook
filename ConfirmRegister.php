<?php
session_start();
include 'dbconnect.php';


if (!isset($_SESSION['join'])){
	header('Location:Register2.php');
	exit();
}

if(!empty($_POST)){

$username = $_SESSION['join']['username'];
$email =  $_SESSION['join']['email']; 
$password = $_SESSION['join']['password'];

$sql = "INSERT INTO userlist (username,email,PASSWORD) VALUES ('$username','$email','$password')";

mysqli_query($conn, $sql) or die(mysqli_error($conn)); unset($_SESSION['join']);
header('Location:ThanksRegister.html');
exit(); 
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Confirm Registration Contents</title>
	<link rel="stylesheet" href="ConfirmRegister.css">
    <link rel="shortcut icon" href="Project.css/list .png" >

</head>
<body>
  <div class="container">
    <div class="head">
<br>
<br>
       <img src="Project.css/star.jpg" width="90px;" height="90px;">
<br>
<br>
      <h2>Please check the contents of regstration</h2>
<br>
     
    </div>
	   <form action="" method="POST">
		<input type="hidden" name="action" value="submit" > 

	   <div class="list">
	  	  <table>
		       <tr>
		      	<td>User Name</td>
		      	<td>
		      	<?php echo htmlspecialchars($_SESSION['join']['username'], ENT_QUOTES, 'UTF-8'); ?>
		      	 </td>
		       </tr>

		      <tr>
		      	<td>Email</td>
		      	<td>
		      	<?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES, 'UTF-8'); ?>
		      	</td>
		      </tr>

		      <tr>
		      	<td>Password</td>
		      	<td>Can not be displayed</td>
		      </tr>

		  	</table>
 	 	
 	 	  <input class="submit" type="submit" name="register" value="Register">

		  <button class="submit2"><a href="Register2.php?action=rewrite">Rewrite</a></button>
		  </div>


   </form>
<br>
  </div>
</body>
</html>