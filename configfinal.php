<?php
$dbUserName = "root";
$dbSeverName = "localhost";
$dbpass = "";
$dbname = "final_db"; //dbname connects to specific 

function specify($value){
  if(!isset($value)){
    header("Location: http://localhost/fproject/loginCon.php"); //loginpage
  }else{
    $user = $value;
  }
}


 //place should be like './files/img'
 function uploadfile($destDir,$pName){
  
    // $destDir = './img/post_img/';
    $sourceFile = $_FILES[$pName];
    $sourceFileDetails = pathinfo($sourceFile['name']);
    $imgArray = (" jpg,png,jpeg,gif,tiff,psd,pdf,eps");
    if(strpos($imgArray,$sourceFileDetails['extension']) !=0 && getimagesize($sourceFile['tmp_name'])){
      if($sourceFile['size']<4000000){
          if(move_uploaded_file($sourceFile['tmp_name'],$destDir.$sourceFile['name'])){
            return 'true';
          }else{
            echo 'Error';
          }
        }
      }
    }
  //FETCH_ASSOC : READ ONE BY ONE
  function Connect($serverName,$userName,$pass,$name){
    $dbCon = new mysqli($serverName,$userName,$pass,$name);
    if($dbCon->connect_error){
      die('connection error');
    }else{
      return 'TRUE';
    }
  }
?>