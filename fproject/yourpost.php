<?php
  $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }
?>

<?php
  echo "you haven't eny posted yet";
  $postCon = "SELECT "
?>