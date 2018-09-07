<?php

session_start();

include 'dbconnect.php';

$errorcode = 0;


if(!empty($_POST)){
	if(strlen($_POST['username']) < 2 || strlen($_POST['username']) > 15){
     $error['username2'] = 'lenght';
     $errorcode = 1;
    } else {
      $error['username2'] = '';
    }

    if (strlen($_POST['username']) !== strlen(utf8_decode($_POST['username']))) {
     $error['username1'] = 'character';
     $errorcode = 1;
     
    }else {
     $error['username1']='';
    }
    
    

    if(strlen($_POST['password']) !== 8){
	  $error['password'] = 'lenght';
	  $errorcode = 1;
    } else {
      $error['password'] = '';
    }


    if($_POST['password'] !== $_POST['password2']){
	  $error['password2'] = 'same';
    $errorcode = 1;
	  } else {
      $error['password2'] = '';
    }


    $username = $_POST['username'];
    $email = $_POST['email'];
    $sql = "SELECT COUNT(*) AS cnt FROM userlist WHERE username='$username'";
    $record = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $table = mysqli_fetch_assoc($record);

    $sql2 = "SELECT COUNT(*) AS cnt2 FROM userlist WHERE email='$email'";
    $record2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    $table2 = mysqli_fetch_assoc($record2);

    if ($table['cnt'] > 0) {
    $error['username'] = 'duplicate';
    $errorcode = 1;
    }else{
    $error['username'] = '';
    }
    if($table2['cnt2'] > 0){
    $error['email'] = 'duplicate';
    $errorcode = 1;
    }else {
    $error['email'] = '';
    }

    if ($errorcode == 0){
    $_SESSION['join'] = $_POST;
    header('Location: ConfirmRegister.php');
    exit();
  }


  }else {
    $error['username'] = '';
    $error['username1'] = '';
    $error['username2'] = '';
    $error['password'] = '';
    $error['password2'] = '';
    $error['email'] = '';
    $_POST['username'] = '';
    $_POST['email'] = '';
    $_POST['password'] = '';
    $_POST['password2'] = '';
  }



if(isset($_REQUEST['action']))
{
if ($_REQUEST['action'] == 'rewrite') { 
$_POST = $_SESSION['join'];
}
}



?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <link rel="stylesheet" href="Register2.css">
</head>
<body>
  <div class="container">
    <div class="head">
<br>
<br>
      <img src="Project.css/star.jpg" width="90px;" height="90px;">
      <h1>Registration Form</h1>
  </div>
     <form action="Register2.php" method="POST" >
      <div class="list">
       <table>
        <tr>
           <td>User Name</td>
           <td><input type="text" name="username" pattern="^[A-Za-z\s]+$" value="<?php echo htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <?php if ($error['username2'] == 'lenght'): ?> 
            <p class="error">Please input with 2 to 15 half-pitch alphanumeric characters</p>
            <?php endif; ?>
            <?php if ($error['username'] == 'duplicate'): ?> 
            <p class="error">Please input another name</p>
            <?php endif; ?>
            <?php if ($error['username1'] == 'character'): ?> 
            <p class="error">Please input half-pitch alphanumeric characters</p>
            <?php endif; ?>
           </td>

        </tr>

        <tr>
           <td>Email</td>
           <td><input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'); ?>"required>
            <?php if ($error['email'] == 'duplicate'): ?> 
            <p class="error">Please input another email</p>
            <?php endif; ?>
           </td>

        </tr>

        <tr>
           <td>Password</td>
           <td><input type="password" name="password" pattern="^[0-9A-Za-z]+$" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'); ?>" required>

           <?php if ($error['password'] == 'lenght'): ?>
           <p class="error">Please input 8 characters</p>
           <?php endif; ?>

           </td>
        </tr>

        <tr>
           <td>Confirm Password</td>
           <td><input type="password" name="password2" value="<?php echo htmlspecialchars($_POST['password2'], ENT_QUOTES, 'UTF-8'); ?>"required>

             <?php if ($error['password'] == 'same'): ?>
             <p class="error">Please input same password</p>
             <?php endif; ?>

           </td>
        </tr>

        
       </table>
    
  </div>
<br>
<br>
       <img src="Project.css/lace.jpg">

<br>
       <input class="submit" type="submit" name="submit" value="Check">
     </form>
<br>
  </div>

</body>
</html>