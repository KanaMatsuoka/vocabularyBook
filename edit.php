<?php
session_start();

include 'dbconnect.php';

$id = $_GET['id'];

$sql_word = "SELECT * FROM word WHERE id=$id";

$result_word=$conn->query($sql_word);


?>


<!DOCTYPE html>
<html>
<link rel="stylesheet" href="edit.css">

<body>
	<div class="container">
<br>
      <div class="logo">
          <a href="add2.php"><img src="Project.css/writing.jpg" width="40" height="40"></a>
          <a href="https://translate.google.com/?hl=ja"><img src="Project.css/google.jpg" width="40" height="40"></a>
          <a href="logout.php"><img src="Project.css/logout.jpg" width="40" height="40"></a>
      </div>
<br>
<br>
<br>
      <div class="head">
        <img src="Project.css/star.jpg" width="90px;" height="90px;">
        <h1>Edit Page</h1>
     </div>

<form action="edit2.php" method="get">

<table class='list' >
<?php
 if ($result_word->num_rows > 0){
  while ($row = $result_word->fetch_assoc()) {
      $english = $row['english'];
      $japanese = $row['japanese'];
      $category = $row['category'];
      $memo = $row['memo'];
      $check = $row['remember'];

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

        echo "<tr>";
        echo "<td>Memo</td>";
        echo "<td><textarea rows='10' cols='50' name='memo' value='$memo'>$memo</textarea></td>";
        echo "</tr>";
  }
 }

 ?>
 <br>
 <br>
</table>
<br>
       <img src="Project.css/lace.jpg">
<br>
<input class="close" type="submit" value="Check">
<input type='hidden' name='id' value='<?php echo $id ;?>'>

</form>


<br>
<br>
    
</div>
</body>
</html>


