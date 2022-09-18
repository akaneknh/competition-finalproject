<?php
    include './config.php';
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['sid'])){
      session_id($_POST['sid']);
      session_start();
      $user = $_SESSION['user'];
      echo json_encode($user);
    }
?>