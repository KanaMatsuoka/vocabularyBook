<!-- edit2.php -->

<?php
session_start();

include 'dbconnect.php';

$errorcode = 0;

  $english = '';
  $japanese = '';
  $memo = '';
  $check = '';
  $category = '';
  
if(!empty($_GET['submit'])){
  if(strlen($_GET['english']) > 16){
     $error['english'] = 'lenght';
     $errorcode = 1;
    } else {
      $error['english'] = '';
      $english = $_GET['english'];

    }
    
    if (strlen($_GET['japanese']) > 81) {
     $error['japanese'] = 'lenght';
     $errorcode = 1;
     
    }else {
     $error['japanese']='';
     $japanese = $_GET['japanese'];

    }
    
    

    if(strlen($_GET['memo']) > 401){
    $error['memo'] = 'lenght';
    $errorcode = 1;
    } else {
      $error['memo'] = '';
      $memo = $_GET['memo'];

    }
}

    if ($errorcode == 0){

  $english = $_GET['english'];
  $japanese = $_GET['japanese'];
  $category = $_GET['category'];
  $check = $_GET['check'];
  $memo = $_GET['memo'];
  $id = $_GET['id'];

    var_dump($id);


$sql = "UPDATE word SET english='$english',japanese='$japanese',category='$category',memo='$memo',remember='$check' WHERE id='$id'";

// mysqli_query($conn, $sql) or die(mysqli_error($conn));
    // header('Location:userhome.php');
  if ($conn->query($sql) === TRUE) {
  echo "Record is updated successfully <br>";
} else {
  echo "Error during updating record: " . $conn->error;



}
} else {
  $error['english'] = '';
  $error['japanese'] = '';
  $error['memo'] = '';

}





?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Page</title>
  <link rel="stylesheet" href="edit.css">
</head>
<body>
  <div class="container">
    <div class="head">
      <br>
      <br>
      <img src="Project.css/star.jpg" width="90px;" height="90px;">
      <h1>Edit Page</h1>
    </div>
     <form action="" method="GET" >
      <div class="list">

       <table class='list'>
        
<?php
       echo "<tr>";
       echo "<td>English</td>";
       echo "<td><input type='text' pattern='^[0-9A-Za-z]+$'  name='english' value='$english' style='width:200px;' required></td>";
       echo "</tr>";

        echo "<tr>";
        echo "<td>Japanese</td>";
        echo "<td><input type='text' name='japanese' value='$japanese' style='width:200px;' required></td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Category</td>";
        echo "<td>";
        echo "<select name='category' style='width:200px; font-size:20px;' required>";
        echo "<option value='noun'";if($category=="noun"){echo "selected";}
          echo ">Noun</option>";
        echo "<option value='verb'";if($category=="verb"){echo "selected";}
          echo ">Verb</option>";
        echo "<option value='adjective'";if($category=="adjective"){
          echo "selected";}
          echo ">Adjective</option>";
        echo "<option value='adverb'";if($category=="adverb"){
          echo "selected";}
          echo ">Adverb</option>";
        echo "<option value='phrase'";if($category=="phrase"){
          echo "selected";}
          echo ">Phrase</option>";
        echo "<option value='other'";if($category=="other"){echo "selected";}
          echo ">Other</option>";
        echo "</select>";
        echo "</td>";
        echo "</tr>";


        
        echo "<tr>";
        echo "<td>Check</td>";
        echo "<td>";

        if($check == 'remember'){
        echo "<input type='checkbox' name='check'
               value='remember' checked>remember";
        
        echo "</td>";
      }else{
        echo "<input type='checkbox' name='check'
               value='remember'>remember";
        
        echo "</td>";
        

      }
        echo "</tr>";

        echo "<tr>";
        echo "<td>Memo</td>";
        echo "<td><textarea rows='10' cols='50' name='memo' value='$memo'>$memo</textarea></td>";
        echo "</tr>";?>
    </table>

       <?php if ($error['english'] == 'lenght'): ?> 
       <p class="error">Please input within 15 half-pitch alphanumeric characters</p>
       <?php endif; ?>

       <?php if ($error['memo'] == 'lenght'): ?> 
       <p class="error">Please input within 100 characters</p>
       <?php endif; ?>

        <?php if ($error['japanese'] == 'lenght'): ?> 
        <p class="error">Please input within 40 characters</p>
        <?php endif; ?>


      </div>
       <br>
       <img src="Project.css/lace.jpg">
       <br>
       <input class="close" type="submit" name="submit" value="Edit">
       <input type='hidden' name='id' value='<?php echo $id ;?>'>

     </form>
  </div>

</body>
</html>




<!-- Forgot.php -->
<?php

 include 'dbconnect.php';



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
 }else{
  echo 'error';
 }
}
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Form</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <div class="container">
    <div class="head">
      <br>
      <img src="Project.css/star.jpg" width="90px;" height="90px;">
      <h1>Forgot Form</h1>
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
       </table>
      </div>
       <br>
       <img src="Project.css/lace.jpg">

       <br>
       <input class="submit" type="submit" name="submit" value="Submit">
       
     </form>
  </div>

</body>
</html>


<!-- temporaryRegister.php -->


<?php

session_start();

include 'dbconnect.php';

$errorcode = 0;

if(!empty($_POST)){
  if(strlen($_POST['username']) < 2 || strlen($_POST['username']) > 15){
     $error['username'] = 'lenght';
     $errorcode = 1;
    } else {
      $error['username'] = '';
    }
    
    if (strlen($_POST['username']) != strlen(utf8_decode($_POST['username']))) {
     $error['username1'] = 'character';
     $errorcode = 1;
     
    }else {
     $error['username1']='';
    }
    // if (preg_match("/^[a-zA-Z]+$/", $_POST['username'])) {
    //   $error['username']='';
    // }else{
    //   $error['username'] = 'character';
    //   $errorcode = 1;      
    // }
    

    if(strlen($_POST['password']) != 8){
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
    $sql = "SELECT COUNT(*) AS cnt FROM userlist WHERE username='$username' OR email='$email'";
    $record = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $table = mysqli_fetch_assoc($record);

    if ($table['cnt'] > 0) {
    $error['username'] = 'duplicate';
    $error['email'] = 'duplicate';
    $errorcode = 1;
    } else {
    $error['username'] = '';      
      $error['email'] = '';
    }

    if ($errorcode == 0){
    $_SESSION['join'] = $_POST;
    header('Location: ConfirmRegister.php');
    exit();
  }
} else {
  $error['username'] = '';
  $error['username1'] = '';
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

// var_dump($errorcode);


?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <link rel="stylesheet" href="temporaryRegister.css">
</head>
<body>
  <div class="container">
    <div class="head">
<br>
<br>
      <img src="Project.css/star.jpg" width="90px;" height="90px;">
      <h1>Registration Form</h1>
  </div>
     <form action="temporaryRegister.php" method="POST" >
      <div class="list">
       <table>
        <tr>
           <td>User Name</td>
           <td><input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <?php if ($error['username'] == 'lenght'): ?> 
            <p class="error">Please input with 2 to 15 half-pitch alphanumeric characters</p>
            <?php endif; ?>
            <?php if ($error['username'] == 'duplicate'): ?> 
            <p class="error">duplicate</p>
            <?php endif; ?>
            <?php if ($error['username1'] == 'character'): ?> 
            <p class="error">Please input half-pitch alphanumeric characters</p>
            <?php endif; ?>            
           </td>
        </tr>

        <tr>
           <td>Email</td>
           <td><input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'); ?>"required>
            <?php if ($error['email'] == 'duplicate'): ?> 
            <p class="error">Please input another email</p>
            <?php endif; ?>
           </td>

        </tr>

        <tr>
           <td>Password</td>
           <td><input type="password" name="password" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'); ?>" required>

           <?php if ($error['password'] == 'lenght'): ?>
           <p class="error">Please enter 8 letters</p>
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
  </div>

</body>
</html>

<!-- temporaryRegister.php -->

<?php echo htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8'); ?>

<!-- register -->
<?php
include 'dbconnect.php';

if(isset($_POST['POST'])){

$username = mb_convert_kana($_POST['userName'], 'a', 'UTF-8');
$email = mb_convert_kana($_POST['email'], 'a', 'UTF-8');
$password = mb_convert_kana($_POST['password'], 'a', 'UTF-8');
$password2 = mb_convert_kana($_POST['password2'], 'a', 'UTF-8');
$color = mb_convert_kana($_POST['color'], 'a', 'UTF-8');



$sql = "INSERT INTO userlist (username,email,PASSWORD,color)
  VALUES ('$username','$email','$password','$color')";

if(!empty($_POST)){
  if(strlen($username) < 2){
     $error['username'] ='lenght';
    }if(strlen($username) > 15){
     $error['username1'] ='lenght';
  }if(strlen($password) != 8){
   $error['password'] ='lenght';
  }if($password ==!$password2){
   $error['password2'] ='lenght';
  }if(strlen($color) < 3){
   $error['color'] ='lenght';
  }if(strlen($color) > 10){
   $error['color2'] ='lenght';
  }if (empty($error) && $conn->query($sql) === TRUE) {
  echo 'success';
  header('Location: userhome.php');
}else {
  echo 'Error'. $conn->error;
}
}
}

 ?>

<!-- register error -->
<?php if ($error['password'] = 'lenght'): ?>
<span class="error">* パスワードを入力してください</span><?php endif; ?>

value="<?php echo htmlspecialchars($_POST['password']); ?>"
<?php
function setColor($english) {
   switch ($english) {
      case $result_noun:
         echo "<td><span style='color: red;'>$english</span></td>";
         break;
      case $result_verb:
         echo "<td><span style='color: blue;'>$english</span></td>";
         break;
      case $result_adjective:
         echo "<td><span style='color: green;'>$english</span></td>";
         break;
      case $result_adverb:
         echo "<td><span style='color: pink;'>$english</span></td>";
         break;
      case $result_phrase:
         echo "<td><span style='color: pink;'>$english</span></td>";
         break;
      case $result_other:
         echo "<td><span style='color: pink;'>$english</span></td>";
         break;
      default:
         echo "<td><span style='color: orange;'>$english</span></td>";
   }
}

setColor($english);

?>

<!-- function setColor($english) {
   switch ($english) {
      case $result_noun:
         echo "<td><span style='color: red;'>$english</span></td>";
         break;
   }
}

setColor($english); -->


        <!-- echo "<td>$english</td>"; -->
function setColor($english) {
   switch ($english) {
      case $english:
         echo "<td><span style='color: red;'>$english</span></td>";
         break;
      default:
         echo "<td><span style='color: orange;'>$english</span></td>";
         break;
   }
}

userhome

<?php
 session_start();


 include 'dbconnect.php';

 $sql_word="SELECT * FROM word";
 
 $result_word=$conn->query($sql_word);

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="userhome.css">

<body>

  <div class="container">
<br>
    <div class="head">
       <div class="search">
         <form id="form1 action="searchingResult.php" method="get" >
            <input id="sbox1" type="text" name="search" placeholder="Searching words">
            <p><input type="image" src="Project.css/loupe.jpg" width="40" height="40"></button></p>
         </form>
       </div>

       <div class="logo">
          <a href="AddVocabulary.php"><img src="Project.css/writing.jpg" width="40" height="40"></a>
          <a href="https://translate.google.com/?hl=ja"><img src="Project.css/google.jpg" width="40" height="40"></a>
          <a href="logout.php"><img src="Project.css/logout.jpg" width="40" height="40"></a>
        </div>
    </div>
    <h3></h3>
<br>
    <table class='list' >
<?php
 if ($result_word->num_rows > 0){
  while ($row = $result_word->fetch_assoc()) {
      $english = $row['english'];
      $japanese = $row['japanese'];
      $category = $row['category'];
      $memo = $row['memo'];
      $id = $row['id'];

        echo "<tr>";
        echo "<td><input type='checkbox' name='check'></td>";
        echo "<td><span style='color: red;'>$english</span></td>";
        echo "<td>$japanese</td>";
        echo "<td>$category</td>";
        echo "<td>$memo</td>";        
        echo "<td>
                <a href='edit.php?id=$id'><img src='Project.css/edit.jpg' width='25' height='25'></a>
                <a href='delete.php?id=$id'><img src='Project.css/delete.jpg' width='25' height='25'></a>
              </td>";
        echo "</tr>";
  }
 }if($result_verb->num_rows > 0){
  while ($row = $result_verb->fetch_assoc()) {
      $english = $row['english'];
      $japanese = $row['japanese'];
      $category = $row['category'];
      $memo = $row['memo'];
          
        echo "<tr>";
        echo "<td><input type='checkbox' name='check'></td>";
        echo "<td><span style='color: blue;'>$english</span></td>";
        echo "<td>$japanese</td>";
        echo "<td>$category</td>";
        echo "<td>$memo</td>";        
        echo "<td>
                <a href='delete.php?id=$id'><img src='Project.css/edit.jpg' width='25' height='25'></a>
                <a href='delete.php?id=$id'><img src='Project.css/delete.jpg' width='25' height='25'></a>
              </td>";
        echo "</tr>";
  }
 }if($result_adjective->num_rows > 0){
  while ($row = $result_adjective->fetch_assoc()) {
      $english = $row['english'];
      $japanese = $row['japanese'];
      $category = $row['category'];
      $memo = $row['memo'];
          
        echo "<tr>";
        echo "<td><input type='checkbox' name='check'></td>";
        echo "<td><span style='color: green;'>$english</span></td>";
        echo "<td>$japanese</td>";
        echo "<td>$category</td>";
        echo "<td>$memo</td>";        
        echo "<td>
                <a href='delete.php?id=$id'><img src='Project.css/edit.jpg' width='25' height='25'></a>
                <a href='delete.php?id=$id'><img src='Project.css/delete.jpg' width='25' height='25'></a>
              </td>";
        echo "</tr>";
  }
 }if($result_adverb->num_rows > 0){
  while ($row = $result_adverb->fetch_assoc()) {
      $english = $row['english'];
      $japanese = $row['japanese'];
      $category = $row['category'];
      $memo = $row['memo'];
          
        echo "<tr>";
        echo "<td><input type='checkbox' name='check'></td>";
        echo "<td><span style='color: yellow;'>$english</span></td>";
        echo "<td>$japanese</td>";
        echo "<td>$category</td>";
        echo "<td>$memo</td>";        
        echo "<td>
                <a href='delete.php?id=$id'><img src='Project.css/edit.jpg' width='25' height='25'></a>
                <a href='delete.php?id=$id'><img src='Project.css/delete.jpg' width='25' height='25'></a>
              </td>";
        echo "</tr>";
  }
 }if($result_phrase->num_rows > 0){
  while ($row = $result_phrase->fetch_assoc()) {
      $english = $row['english'];
      $japanese = $row['japanese'];
      $category = $row['category'];
      $memo = $row['memo'];
          
        echo "<tr>";
        echo "<td><input type='checkbox' name='check'></td>";
        echo "<td><span style='color: purple;'>$english</span></td>";
        echo "<td>$japanese</td>";
        echo "<td>$category</td>";
        echo "<td>$memo</td>";        
        echo "<td>
                <a href='delete.php?id=$id'><img src='Project.css/edit.jpg' width='25' height='25'></a>
                <a href='delete.php?id=$id'><img src='Project.css/delete.jpg' width='25' height='25'></a>
              </td>";
        echo "</tr>";
  }
 }if($result_other->num_rows > 0){
  while ($row = $result_other->fetch_assoc()) {
      $english = $row['english'];
      $japanese = $row['japanese'];
      $category = $row['category'];
      $memo = $row['memo'];
          
        echo "<tr>";
        echo "<td><input type='checkbox' name='check'></td>";
        echo "<td><span style='color: black;'>$english</span></td>";
        echo "<td>$japanese</td>";
        echo "<td>$category</td>";
        echo "<td>$memo</td>";        
        echo "<td>
                <a href='delete.php?id=$id'><img src='Project.css/edit.jpg' width='25' height='25'></a>
                <a href='delete.php?id=$id'><img src='Project.css/delete.jpg' width='25' height='25'></a>
              </td>";
        echo "</tr>";
  }
 }

 ?>


          </table>
<br>
    <div class="arrow">
      <img src="Project.css/arrow.jpg" width="45" height="45">
    </div>
</div>
</body>
</html>




add vocabulary

<?php
session_start();

include 'dbconnect.php';

if(isset($_GET['submit'])){

$english=$_GET['english'];
$japanese=$_GET['japanese'];
$category=$_GET['category'];
$memo=$_GET['memo'];

$sql_noun = "INSERT INTO noun (english,japanese,category,memo) VALUES ('$english','$japanese','$category','$memo')";
$sql_verb = "INSERT INTO verb (english,japanese,category,memo) VALUES ('$english','$japanese','$category','$memo')";
$sql_adjective = "INSERT INTO adjective (english,japanese,category,memo) VALUES ('$english','$japanese','$category','$memo')";
$sql_adverb = "INSERT INTO adverb (english,japanese,category,memo) VALUES ('$english','$japanese','$category','$memo')";
$sql_phrase = "INSERT INTO phrase (english,japanese,category,memo) VALUES ('$english','$japanese','$category','$memo')";
$sql_other = "INSERT INTO other (english,japanese,category,memo) VALUES ('$english','$japanese','$category','$memo')";

if($category == 'noun'){
  if($conn->query($sql_noun) == TRUE){
    echo 'sent to list';
    header('Location:userhome.php');
  }else{
    echo 'error - noun';

  }
  }elseif($category == 'verb'){
  if($conn->query($sql_verb) == TRUE){
    echo 'sent to list';
    header('Location:userhome.php');
  }else{
    echo 'error - v';
  }
  }elseif($category == 'adjective'){
  if($conn->query($sql_adjective) == TRUE){
    echo 'sent to list';
    header('Location:userhome.php');
  }else{
    echo 'error -ad';
  }
  }elseif($category == 'adverb'){
  if($conn->query($sql_adverb) == TRUE){
    echo 'sent to list';
    header('Location:userhome.php');
  }else{
    echo 'error -av';
  }
  }elseif($category == 'phrase'){
  if($conn->query($sql_phrase) == TRUE){
    echo 'sent to list';
    header('Location:userhome.php');
  }else{
    echo 'error -p';
  }
  }elseif($category == 'other'){
  if($conn->query($sql_other) == TRUE){
    echo 'sent to list';
    header('Location:userhome.php');
  }else{
    echo 'error -o';
  }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add New Vocabulary</title>
  <link rel="stylesheet" href="AddVocabulary.css">
</head>
<body>
  <div class="container">
    <div class="head">
      <br>
      <br>
      <img src="Project.css/star.jpg" width="90px;" height="90px;">
      <h1>Add New Vocabulary</h1>
    </div>
     <form action="" method="GET" >
      <div class="list">
       <table>
        <tr>
           <td>English</td>
           <td><input type="text" size="35" name="english" style="width:200px;" required></td>
        </tr>

        <tr>
           <td>Japanese</td>
           <td><input type="text" size="35" name="japanese" style="width:200px;" required></td>
        </tr>

        <tr>
          <td>Category</td>
          <td>
          <select name="category" style="width:200px; font-size:20px;" required>
            <option value="noun">Noun</option>
            <option value="verb">Verb</option>
            <option value="adjective">Adjective</option>
            <option value="adverb">Adverb</option>
            <option value="phrase">Phrase</option>
            <option value="other">Other</option>
          </select>
          </td>
        </tr>

        <tr>
          <td>Memo</td>
          <td><textarea rows="10" cols="50" name="memo"></textarea></td>
        </tr>

       </table>
      </div>
       <br>
       <img src="Project.css/lace.jpg">
       <br>
       <input class="submit" type="submit" name="submit" value="Submit">
     </form>
  </div>

</body>
</html>
