<?php
session_start();

include 'dbconnect.php';

if(isset($_GET['submit'])){

$english = mb_convert_kana($_GET['english'], "as");

// $english=$_GET['english'];
$japanese=$_GET['japanese'];
$category=$_GET['category'];
$memo=$_GET['memo'];

$sql_word = "INSERT INTO word (english,japanese,category,memo) VALUES ('$english','$japanese','$category','$memo')";


  if($conn->query($sql_word) === TRUE){
    echo 'sent to list';
    header('Location:userhome.php');
  }else{
    echo 'error - noun';

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
           <td><input type="text" pattern="^[0-9A-Za-z]+$" name="english" style="width:200px;" required></td>
        </tr>

        <tr>
           <td>Japanese</td>
           <td><input type="text"  name="japanese" style="width:200px;" required></td>
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
