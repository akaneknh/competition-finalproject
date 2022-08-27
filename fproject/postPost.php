<?php
  include './configfinal.php';
  session_start();
  $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }
  // timeout(time(),$dbCon);
  // to reset timeout is it correct?
  ?>

<?php
  $user = $_SESSION['user']; //['user_id'];
  
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $pname = $_POST['pname'];
    
    $content = htmlspecialchars($_POST['content']);

    $postCmd = "INSERT INTO post_tb(`postName`, `postContent`, `user_id`) VALUES ('".$pname."','".$content."','".$user."')"; 
    if($dbCon->query($postCmd)){
      echo "Posted";
      
    }else{
      echo "failed";
    }
    //session close
    $dbCon->close();
  }// after that how to design our website
?>
