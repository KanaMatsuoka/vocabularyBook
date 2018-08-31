<?php
session_start();

include 'dbconnect.php';

$english = $_GET['english'];
$japanese = $_GET['japanese'];
$category = $_GET['category'];
$check = $_GET['check'];
$memo = $_GET['memo'];
$id = $_GET['id'];



$sql = "UPDATE word SET english='$english',japanese='$japanese',category='$category',memo='$memo',remember='$check' WHERE id='$id'";

if(mysqli_query($conn, $sql)){
 header("Location:userhome.php");
}else{
	mysqli_error($conn);
}
