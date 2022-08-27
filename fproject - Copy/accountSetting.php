<?php
  include './configfinal.php';
  session_start();
  $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }

  if(isset($_GET('action'))){
    switch($_GET('action')){
      case 'back':
        header("Location: hp url");
      break;

      case 'exit' :
        session_unset();
        session_destroy();
        header("login url");
        break;
    }
  }
  ?>

  <?php 
  if($_SERVER['REQUEST_METHOD']=='POST'){// check order and edit
    $editCon = "UPDATE user_tb SET fname='".$_POST['fname']."', lname='".$_POST['lname']."', email='".$_POST['email']."', pass='".$_POST['pass']."', dob='".$_POST['dob']."', phone='".$_POST['phone']."', addr='".$_POST['addr']."', title='".$_POST['title']."' WHERE user_id=".$_POST['user_id'];
    if($dbcon->query($editCmd) === true){
      $dbcon->close();
      echo "<h5>saved<h5>";
      
    }
  }
  ?>