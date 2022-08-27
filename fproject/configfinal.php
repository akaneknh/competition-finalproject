<?php
$dbUserName = "root";
$dbSeverName = "localhost";
$dbpass = "";
$dbname = "final_db"; //dbname connects to specific 



 //place should be like './files/img'
 function uploadfile(){
  if($_SERVER['REQUEST_METHOD']=="POST"){
      $sourceImg = $_FILES['profImg'];
      print_r($sourceImg);
      $imgExtension = pathinfo($sourceImg['name']);
      $imgDest = "./img/".$imgExtension['basename'];
      $imgArray = (' jpg, png, gif,jpeg');
      print_r($imgExtension['extension']);
      if(strpos($imgArray,$imgExtension['extension']) != 0 && getimagesize($sourceImg['tmp_name'])){
        if($sourceImg['size']<400000){
          if(move_uploaded_file($sourceImg,$imgDest)){
            return 'true';
          }
        }
      }
    }
    // return 'false';
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