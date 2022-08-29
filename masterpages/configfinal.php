<?php
$dbUserName = "root";
$dbSeverName = "localhost";
$dbpass = "";
$dbname = "student_db"; //dbname connects to specific 


function fileRead($adder){
  $filehandler = fopen($adder,'r');
  $Data = json_decode(fread($filehandler,filesize($adder)));
  fclose($filehandler);
  return $Data;
}


 //place should be like './files/img'
 function uploadfile($name,$dir){
  if($_SERVER['REQUEST_METHOD']=='TRUE'){
      $sourceImg = $_SERVER[$name];
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