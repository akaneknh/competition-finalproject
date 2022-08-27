<?php
//!important
  include './configfinal.php';
  session_start();
  $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }

  if(isset($_GET['idx'])){
    $_SESSION['idx'] = $_GET['idx'];

  }
?>

<?php
  $postCom = "SELECT * FROM post_tb";
  $result = $dbCon->query($postCom);
  if($result->num_rows > 0){
    $postData = $result->fetch_assoc();

    echo "<table><thead><tr>";
    foreach($postData as $fieldName => $value){
      echo "<th>".$fieldName."</th>";
    }
    echo "</tr><thead><tbody>";
    foreach($postData as $fieldName => $value){
      echo "<tr><th>".$value."</th></tr>";
      // how to edit delete depends on format of $postdata.if it's kinds of array using foreach, if it has index, use index to specify user
      echo "<a href='./deleteEdit.php?pname=$pname'>Delete</a>";
    }
    echo "</tbody></table>";
  }
?>