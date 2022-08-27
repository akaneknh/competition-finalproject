<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
    if($dbCon->connect_error){
      die("connection error");
    }else{
      $start_date = " ";
      $insertcmd = "INSERT INTO user_tb (`class_id`, `start_date`, `end_date`) VALUES ('2','$start_date','')";
      if($dbcon->query($insertcmd)){
        echo "<h1>registered</h1>";
      }else{
        echo "<h1>database error</h1>";
      }
      $dbcon->close();
    }
  ?>
  
</body>
</html>