<?php
session_start();

  session_unset();
  session_destroy();

  echo "ログアウトしました。";


  header('Location:login_tem.php');


  ?>