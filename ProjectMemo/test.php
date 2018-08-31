<?php
function setColor($word, $type) {
   switch ($type) {
      case "noun":
         echo "<span style='color: red;'>$word</span>";
         break;
      case "verb":
         echo "<span style='color: blue;'>$word</span>";
         break;
      case "adjective":
         echo "<span style='color: green;'>$word</span>";
         break;
      case "others":
         echo "<span style='color: pink;'>$word</span>";
         break; 
      default:
         echo "<span style='color: orange;'>$word</span>";
   }
}

setColor("run","noun");

?>

echo "<td><a href='detail.php?id=$id'>$english</a></td>";

if ($conn->query($sql_user) === TRUE){
  
     header('Location:Forgot2.php');
   }else{
    echo 'Please check your name of email';
    var_dump($conn->query($sql_user));
   }
}