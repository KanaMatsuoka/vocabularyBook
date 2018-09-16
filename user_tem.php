<?php
 session_start();

 include 'dbconnect.php';

 $ID = $_SESSION["id"];

if ($_GET){
  $page = $_REQUEST['page'];
} else {
  $page = 1;
}


 $page = max($page, 1);
 $sql = "SELECT COUNT(*) AS cnt FROM word WHERE infoID=$ID";


 $recordSet = mysqli_query($conn, $sql);
 $table = mysqli_fetch_assoc($recordSet);
 $maxPage = ceil($table['cnt'] / 7);
 $page = min($page, $maxPage);
 $start = ($page - 1) * 7;

 $recordSet = mysqli_query($conn,"SELECT * FROM word WHERE infoID=$ID LIMIT $start,7");

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Main page</title>
  <link rel="stylesheet" href="userhome.css">
  <link rel="shortcut icon" href="Project.css/list .png" >
</head>

<body>

  <div class="container">
<br>
    <div class="head">
       <div class="search">
         <form id="form1" action="searchingResult_tem.php" method="get" >
            <input id="sbox1" type="text" name="search" placeholder="Searching words">
            <button id="sbox2" type="submit" name="submit"><img src="Project.css/loupe.jpg" width="40" height="40"></button>
         </form>
       </div>

       <div class="logo">
          <a href="add2_tem.php"><img src="Project.css/writing.jpg" width="40" height="40"></a>
          <a href="https://translate.google.com/?hl=ja" target="_blank"><img src="Project.css/google.jpg" width="40" height="40"></a>
          <a href="logout_tem.php"><img src="Project.css/logout.jpg" width="40" height="40"></a>
        </div>
    </div>
    <h3></h3>
<br>
    <table class='list' >
<?php
if(!empty($recordSet)){
 if ($recordSet->num_rows > 0){
  while ($row = $recordSet->fetch_assoc()) {

      $english = $row['english'];
      $japanese = $row['japanese'];
      $category = $row['category'];
      $memo = $row['memo'];
      $check = $row['remember'];
      $id = $row['id'];
      $ID = $row['infoID'];

  $kind = array(
    'kind' => 'noun',
    'kind2' => 'verb',
    'kind3' => 'adjective',
    'kind4' => 'adverb',
    'kind5' => 'phrase',
    'kind6' => 'other',
    );

        echo "<tr>";

    if($check == 'remember'){
        echo "<td><img src='Project.css/love.jpg'></td>";
    }else{
        echo "<td><img src='Project.css/love 2.jpg'></td>";
    }

    if($category == $kind['kind']){
         echo "<td><a href='detail_tem.php?id=$id'><span style='color: red;'>$english</span></a></td>";
  }elseif($category == $kind['kind2']) {

         echo "<td><a href='detail_tem.php?id=$id'><span style='color: blue;'>$english</span></a></td>";
  }elseif($category == $kind['kind3']) {

         echo "<td><a href='detail_tem.php?id=$id'><span style='color: green;'>$english</span></a></td>";
  }elseif($category == $kind['kind4']) {
         echo "<td><a href='detail_tem.php?id=$id'><span style='color: pink;'>$english</span></a></td>";
  }elseif($category == $kind['kind5']) {

         echo "<td><a href='detail_tem.php?id=$id'><span style='color: #ff9900;'>$english</span></a></td>";
  }elseif($category == $kind['kind6']) {

         echo "<td><a href='detail_tem.php?id=$id'><span style='color: black;'>$english</span></a></td>";
  }




        echo "<td>$japanese</td>";
        echo "<td>$category</td>";
        echo "<td>$memo</td>";
        echo "<td>
                <a href='edit_tem.php?id=$id'><img src='Project.css/edit.jpg' width='25' height='25'></a>
                <a href='deleteConfirm_tem.php?id=$id'><img src='Project.css/delete.jpg' width='25' height='25'></a>
              </td>";
        echo "</tr>";
  }
 }
 }else{
  $recordSet = "";
 }

 ?>


          </table>
<br>

 <?php
 if ($page > 1) {
 ?>
 <a href="user_tem.php?page=<?php print($page - 1); ?>"><img class="arrow" src="Project.css/arrowleft.jpg" width="45" height="45">
</a>
 <?php
 } else {
 ?>
 <?php
 }
 ?>
 <?php
 if ($page < $maxPage) {
 ?>
 <a href="user_tem.php?page=<?php print($page + 1); ?>"><img class="arrow" src="Project.css/arrow.jpg" width="45" height="45">
  </a>
 <?php
 } else {
 ?>
 <?php
 }
 ?>
<br>
<br>
</div>
</body>
</html>


