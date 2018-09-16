<?php

session_start();

$ID = $_SESSION["id"];


include 'dbconnect.php';

$errorcode = 0;

  $english = '';
  $japanese = '';
  $memo = '';

if(!empty($_GET)){
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

    $english = $_GET['english'];
    $japanese = $_GET['japanese'];
    $category = $_GET['category'];
    $memo = $_GET['memo'];
    $sql_check = "SELECT COUNT(*) AS cnt FROM word WHERE infoID='$ID' AND english='$english'";
    $record = mysqli_query($conn,$sql_check) or die(mysqli_error($conn));
    $table = mysqli_fetch_assoc($record);

    if($table['cnt'] > 0){
      $error['english'] = 'duplicate';
      $errorcode = 1;
    }else{
      $error['english'] = '';
    }

    if ($errorcode == 0){

    $sql = "INSERT INTO word (infoID,english,japanese,category,memo) VALUES ('$ID','$english','$japanese','$category','$memo')";

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header('Location:user_tem.php');

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
  <title>Add New Vocabulary</title>
  <link rel="stylesheet" href="AddVocabulary.css">
  <link rel="shortcut icon" href="Project.css/list .png" >

</head>
<body>
  <div class="container">
    <div class="head">
<br>
      <div class="logo">
          <a href="https://translate.google.com/?hl=ja" target="_blank"><img src="Project.css/google.jpg" width="40" height="40"></a>
          <a href="user_tem.php"><img src="Project.css/home.jpg" width="40" height="40"></a>
      </div>
<br>
<br>
      <img src="Project.css/star.jpg" width="90px;" height="90px;">
      <h1>Add New Vocabulary</h1>
    </div>
     <form action="add2_tem.php" method="GET" >
      <div class="list">
       <table>
        <tr>
           <td>English</td>
           <td><input type="text" pattern="^[A-Za-z\s]+$" name="english" value="<?php echo $english;?>" style="width:200px;" required>

            <?php if ($error['english'] == 'lenght'): ?>
            <p class="error">Please input within 15 half-pitch alphanumeric characters</p>
            <?php endif; ?>
            <?php if ($error['english'] == 'duplicate'): ?>
            <p class="error">Please input another name</p>
            <?php endif; ?>

           </td>
        </tr>

        <tr>
           <td>Japanese</td>
           <td><input type="text"  name="japanese" value="<?php echo $japanese;?>"style="width:200px;" required>

            <?php if ($error['japanese'] == 'lenght'): ?>
            <p class="error">Please input within 40 characters</p>
            <?php endif; ?>

           </td>
        </tr>

        <tr>
          <td>Category</td>
          <td>
          <select name="category" style="width:200px; font-size:20px;" required>
            <option value="">Please select</option>
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
          <td><textarea rows="10" cols="50" name="memo"><?php echo $memo;?></textarea>

            <?php if ($error['memo'] == 'lenght'): ?>
            <p class="error">Please input within 100 characters</p>
            <?php endif; ?>

          </td>
        </tr>

       </table>
      </div>
       <br>
       <img src="Project.css/lace.jpg">

       <input class="submit" type="submit" name="submit" value="Submit">
     </form>
<br>
  </div>

</body>
</html>
