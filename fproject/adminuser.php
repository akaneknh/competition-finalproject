<?php
// hp for admin and display users data or move to postedit
  include './configfinal.php';
  session_start();
  $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }

  if(!isset($_SESSION['user'])){
    header("Location: http://localhost/fproject/loginCon.php"); //loginpage
  }else{
    $post = $_SESSION['post_id'];
  }

  if(isset($_GET['user'])){ 
    $_SESSION['user']= $_GET['user'];
    $dbCon->close();
    header("Location: http://localhost/fproject/adminEditUser.php");// change url
  }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>add new post</title>

</head>
<body>
  
</body>
</html>

<!-- a tag has link and query string -->
<?php

  $userArray = [];
  $detailCmd = "SELECT firstName FROM user_tb";

  $result = $dbCon->query($detailCmd);
  $userData = $result->fetch_assoc();
  while($row = $userData){
    array_push($userArray,$row);
  }
    echo "<table><thead><tr>";
    foreach($userArray as $fieldName => $value){
      echo "<th>".$fieldName."</th>";
    }
    echo "</tr><thead><tbody>";
    foreach($userData as $fieldName => $value){
      echo "<tr><th>".$value."</th></tr>";
      // add edit : redirect with query string
      echo "<a href='http://localhost/fproject/adminuser.php?action=delete?user=".$value['user_id']."'>Edit</a>"; 
    }
    echo "</tbody></table>";
  
?>