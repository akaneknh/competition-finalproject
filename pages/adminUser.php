<?php
//$_SESSION['user'] always has user email, and $_SESSION['admin'] is user_id
  if(!isset($_SESSION['user']) || $_SESSION['timeout'] < time()){
    header("Location: ".parse_url($_SERVER['REQUEST_URI'],PHP_URL_HOST)."/login");
  }else{
    $email = $_SESSION['user'];
    $logCmd = "SELECT * FROM user_tb WHERE email='$email'";
    $useresult = $dbCon->query($logCmd);
    if($useresult->num_rows > 0){
      $user = $useresult->fetch_assoc();
    }
  }

  
  if(isset($_GET['user'])){ 
    if($_GET['action'] == 'edit'){
      $_SESSION['user']=$user['email'];
      $_SESSION['admin']= $_GET['user'];
      $_SESSION['timeout'] = time()+900;
      $dbCon->close();
      header("Location: ".parse_url($_SERVER['REQUEST_URI'],PHP_URL_HOST)."/adminEditUser.php");
    }else{
      $deleteCmd = "DELETE FROM user_tb WHERE user_id ='".$_GET['user']."'";
      if($dbCon->query($deleteCmd)===true){
        $_SESSION['timeout'] = time()+900;
        header("Location: ".parse_url($_SERVER['REQUEST_URI'],PHP_URL_HOST)."/adminUser.php");
      }
      echo $dbCon->error;
    }
  }

  $userArray = [];
  $postCmd = "SELECT user_id, firstName, lastName, atype, dob, email, profImg, refImg, badge1, tamImg, badge2, profileContent FROM user_tb";
  $result = $dbCon->query($postCmd);
  if($result->num_rows > 0){
    $userData = $result->fetch_assoc();
    while($row = $result->fetch_assoc()){
      array_push($userArray,$row);
    }
  }
 ?>

<main class="adminUser-main">

<?php
    echo "<table class='horizontal-list'><thead class='item'><tr>";
    foreach($userData as $fieldName => $value){
      echo "<th class='filedName'>".$fieldName."</th>";
    }
    echo "<th class='filedName'>Edit</th>";
    echo "<th class='filedName'>Delete</th>";
    echo "</tr></thead><tbody class='item'>";

    foreach($userArray as $user){
      echo "<tr>";
      foreach($user as $userDetail){
          echo "<td>".$userDetail."</td>";
      }
      echo "<td><p class='admin-user-edit'><a href='/adminUser.php?user=".$user['user_id']."&action=edit'>Edit</a></p></td>";
      echo "<td><p class='admin-user-edit'><a href='/adminUser.php?user=".$user['user_id']."&action=delete'>Delete</a></p></td>";
    }
      echo "</tr>";
      echo "</tbody></table>";
?>