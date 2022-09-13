<?php
$dbUserName = "root";
$dbServerName = "localhost";
$dbpass = "";
$dbname = "final_db"; 

session_start();
$dbCon = new mysqli($dbServerName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }

if(isset($_GET['action']) && $_GET['action'] == 'exit'){
      $dbCon->close;
      session_unset();
      session_destroy();
      header("Location: ".parse_url($_SERVER['REQUEST_URI'],PHP_URL_HOST)."/login.php");
}

//function part
//&destDir should be like './files/img'
function uploadfile($destDir,$pName){
  $sourceFile = $_FILES[$pName];
  $sourceFileDetails = pathinfo($sourceFile['name']);
  $imgArray = ("_jpg,png,jpeg,gif,tiff,psd,pdf,eps");
  $extension = $sourceFileDetails['extension'];
  if(strpos($imgArray,$extension) !=0 && getimagesize($sourceFile['tmp_name'])){
    if($sourceFile['size']<400000000){
        if(move_uploaded_file($sourceFile['tmp_name'],$destDir.$sourceFile['name'])){
          return 'true';
        }else{
          echo 'Error';
        }
      }
    }
  }

?>
