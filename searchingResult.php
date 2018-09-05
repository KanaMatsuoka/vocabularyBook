<?php
  session_start();

  include 'dbconnect.php';



  if(isset($_GET['submit'])){
  $search=$_GET['search'];
  $sql_search = "SELECT * FROM word WHERE english LIKE '%$search%'";

  $result_search=$conn->query($sql_search);
}

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="searchingResult.css">

<body>

  <div class="container">
<br>
     <div class="logo">
        <a href="add1.php"><img src="Project.css/writing.jpg" width="40" height="40"></a>
        <a href="https://translate.google.com/?hl=ja"><img src="Project.css/google.jpg" width="40" height="40"></a>
        <a href=""><img src="Project.css/logout.jpg" width="40" height="40"></a>
     </div>
<br>
<br>
     <div class="head">
        <img src="Project.css/star.jpg" width="90px;" height="90px;">
        <h1>Searching Result</h1>
     </div>
<br>
<table class="list" >
<?php
if($result_search->num_rows > 0){
  while ($row = $result_search->fetch_assoc()) {
      $english = $row['english'];
      $japanese = $row['japanese'];
      $category = $row['category'];
      $memo = $row['memo'];
      $check = $row['remember'];

      $id = $row['id'];

        echo "<tr>";
        if($check == 'remember'){
              echo "<td><img src='Project.css/love.jpg'></td>";
        }else{
              echo "<td><img src='Project.css/love 2.jpg'></td>";
        }
        echo "<td>$english</td>";
        echo "<td>$japanese</td>";
        echo "<td>$category</td>";
        echo "<td>
                <a href='edit.php?id=$id'><img src='Project.css/edit.jpg' width='25' height='25'></a>
                <a href='deleteConfirm.php?id=$id'><img src='Project.css/delete.jpg' width='25' height='25'></a>";
        echo "<td>$memo</td>";

        echo "</tr>";
   }
}
?>
</table>
<br>
      <img src="Project.css/lace.jpg">
       <br>
       <br>
       <a class=close href="userhome.php" onclick="window.close()">Close</a>
<br>
<br>
</div>
</body>
</html>


