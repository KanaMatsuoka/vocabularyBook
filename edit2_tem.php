<?php
session_start();

include 'dbconnect.php';

$ID = $_SESSION["id"];

$errorcode = 0;

  $english = '';
  $japanese = '';
  $memo = '';
  $check = '';
  $category = '';

  $error['english'] = '';
  $error['japanese'] = '';
  $error['memo'] = '';


if(!empty($_GET['submit'])){
  if(strlen($_GET['english']) > 15){
     $error['english'] = 'lenght';
     $errorcode = 1;
    } else {
      $error['english'] = '';
      $english = $_GET['english'];

    }
    
    if (mb_strlen($_GET['japanese']) > 40) {
     $error['japanese'] = 'lenght';
     $errorcode = 1;
     
    }else {
     $error['japanese']='';
     $japanese = $_GET['japanese'];

    }
    
    

    if(mb_strlen($_GET['memo'],'UTF-8') > 100){
    $error['memo'] = 'lenght';
    $errorcode = 1;
    } else {
      $error['memo'] = '';
      $memo = $_GET['memo'];

    }
}



    if ($errorcode == 0){

  $english = htmlspecialchars($_GET['english'], ENT_QUOTES, 'UTF-8');
  $japanese = htmlspecialchars($_GET['japanese'], ENT_QUOTES, 'UTF-8');
  $category = htmlspecialchars($_GET['category'], ENT_QUOTES, 'UTF-8');
  if (isset($_GET['check'])){
    $check = $_GET['check'];
  }

  $memo = htmlspecialchars($_GET['memo'], ENT_QUOTES, 'UTF-8');
  $id = $_GET['id'];



if(isset($_GET["submit"])){

  $sql = "UPDATE word SET infoID='$ID',english='$english',japanese='$japanese',category='$category',memo='$memo',remember='$check' WHERE id='$id'";

  // mysqli_query($conn, $sql) or die(mysqli_error($conn));
      // 
    if ($conn->query($sql) === TRUE) {
    echo "Record is updated successfully <br>";
  header('Location:user_tem.php');
  } else {
    echo "Error during updating record: " . $conn->error;

  }
}

}



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Is this OK?</title>
  <link rel="stylesheet" href="edit.css">
  <link rel="shortcut icon" href="Project.css/list .png" >

</head>
<body>
  <div class="container">
<br>
    <div class="logo">
          <a href="add2.php"><img src="Project.css/writing.jpg" width="40" height="40"></a>
          <a href="user_tem.php"><img src="Project.css/home.jpg" width="40" height="40"></a>
          <a href="https://translate.google.com/?hl=ja" target="_blank"><img src="Project.css/google.jpg" width="40" height="40"></a>
          <a href="logout.php"><img src="Project.css/logout.jpg" width="40" height="40"></a>
    </div>
<br>
<br>
<br>
    <div class="head">
      <img src="Project.css/star.jpg" width="90px;" height="90px;">
      <h1>Is this OK?</h1>
    </div>
<br>
     <form action="" method="GET" >
      <div class="list">

       <table class='list'>

<?php
       echo "<tr>";
       echo "<td>English</td>";
       echo "<td><input type='text' pattern='^[A-Za-z\s]+$'  name='english' value='$english' style='width:200px;' required></td>";
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


      if ($check=="remember") {
          $checked = "checked";
        }else{
          $checked = "";
        }
        echo "<tr>";
        echo "<td>Check</td>";
        echo "<td>";
        echo "<input type='checkbox' name='check'
               value='remember' $checked>remember";
        
        echo "</td>";
        echo "</tr>";
      //   echo "<tr>";
      //   echo "<td>Check</td>";
      //   echo "<td>";

      //   if($check == 'remember'){
      //   echo "<input type='checkbox' name='check'
      //          value='on' checked>remember";
        
      //   echo "</td>";
      // }else{
      //   echo "<input type='hidden' name='check'
      //          value='off'>remember";
        
      //   echo "</td>";
        
      // }
        

      
        // echo "</tr>";

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
<br>
  </div>

</body>
</html>


