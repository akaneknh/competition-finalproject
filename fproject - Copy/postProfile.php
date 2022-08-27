<?php
  include './configfinal.php';
  session_start();
  $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }
  ?>

<?php
  $user = $_SESSION['user']; //['user_id'];

  if($_POST['REQUEST_METHOD']=='POST'){
    $profImg = $_FILES['profImg'];
    $content = $_POST['content'];

    //empty to update is ok?
    $profCmd = "UPDATE user_tb SET profImg='".$profImg."', profileContent='".$_POST['content']." WHERE fname=".$user['fname'];
    if($dbcon->query($profCmd) === true){
      $dbcon->close();
      unset($_SESSION['user']);
      header("Location: hp");
    }
  }