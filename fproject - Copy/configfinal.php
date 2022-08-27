<?php
$dbUserName = "root";
$dbSeverName = "localhost";
$dbpass = "";
$dbname = "final_db"; //dbname connects to specific 



 //place should be like './files/img'
 function uploadfile($name,$dir){
  if($_POST['REQUEST_METHOD']=='POST'){
      $sourceImg = $_POST[$name];
      $imgExtension = pathinfo($sourceImg['name'])['extension'];
      $imgDest = $dir.pathinfo($sourceImg['name']);
      $imgArray = (' jpg, png, gif,jpeg');
      if(strpos($imgArray,$imgExtension)==0 && getimagesize($sourceImg['tmp_name'])){
        if($sourceImg['size']<400000){
          if(move_uploaded_file($sourceImg,$imgDest)){
            return 'true';
          }
        }
      }
    }
    return 'false';
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