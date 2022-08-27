<?php
include './configfinal.php';
session_start();
$dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
if($dbCon->connect_error){
  die("connection error");
}
?>

<?php
  //echo $_SESSION['user'] as form

  if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['pass']==$_POST['comPass']){// check order and edit
    $id = $_SESSION['user']['user_id'];

    $editCon = "UPDATE user_tb SET firstName='".$_POST['fame']."', lastName='".$_POST['lname']."', email='".$_POST['email']."', pass='".$_POST['pass']."', dob='".$_POST['dob']."', phone='".$_POST['phone']."', addr='".$_POST['addr']."', title='".$_POST['title']."' WHERE user_id ='".$id."';";
    // check the format
    if($dbcon->query($editCmd) === true){
      echo 'Updated';
    }else{
      echo 'Failed';
    }
    $dbcon->close();
    unset($_SESSION['user']);
    header("Location: adminhp");
  }

?>