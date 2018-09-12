<?php
 session_start();

 include 'dbconnect.php';

  $id = $_GET['id'];
  $sql_detail = "SELECT * FROM word WHERE id=$id ";
  $result = $conn->query($sql_detail);

    ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Detail Information</title>
  <link rel="stylesheet" href="Detail.css">
  <link rel="shortcut icon" href="Project.css/list .png" >

</head>
<body>
  <div class="container">
    <div class="head">
      <br>
      <br>
      <img src="Project.css/star.jpg" width="90px;" height="90px;">
      <h1>Detail Information</h1>
    </div>
     <form action="login.php" method="POST" >
      <div class="list">
       <table>
<?php

    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){ 
      $english = $row['english'];
      $japanese = $row['japanese'];
      $category = $row['category'];
      $memo = $row['memo'];


        echo "<tr>";
        echo "<td>English</td>";
        echo "<td>$english</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Japanese</td>";
        echo "<td>$japanese</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Category</td>";
        echo "<td>$category</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>Memo</td>";
        echo "<td>$memo</td>";
        echo "</tr>";
 }
}


?>
       </table>
      </div>
<br>
       <img src="Project.css/lace.jpg">
<br>
<br>
<br>
       <a href="user_tem.php" onclick="window.close()">Close</a>
<br>
<br>
  </div>

</body>
</html>
