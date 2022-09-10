<?php
  if(!isset($_SESSION['user']) || $_SESSION['timeout'] < time()){
    header("Location: ".parse_url($_SERVER['REQUEST_URI'],PHP_URL_HOST)."/login.php");
  }else{
    $email = $_SESSION['user'];
    $logCmd = "SELECT * FROM user_tb WHERE email='$email'";
    $useresult = $dbCon->query($logCmd);
    if($useresult->num_rows > 0){
      $user = $useresult->fetch_assoc();
    }
  }

  if(isset($_GET['user'])){
    $deleteCmd = "DELETE FROM post_tb WHERE post_id ='".$_GET['user']."'";
    if($dbCon->query($deleteCmd)===true){
      $_SESSION['timeout'] = time()+900;
      header("Location: ".parse_url($_SERVER['REQUEST_URI'],PHP_URL_HOST)."/adminPost.php");
    }
    echo $dbCon->error;
  }

  $postArray = [];
  $postCmd = "SELECT * FROM post_tb";
  $result = $dbCon->query($postCmd);
  if($result->num_rows > 0){
    $postData = $result->fetch_assoc();
    while($row = $result->fetch_assoc()){
      array_push($postArray,$row);
    }
  }

?>

<main class="adminUser-post">
  <?php
    echo "<table class='horizontal-list-post'><thead class='iteme'><tr>";
    foreach($postData as $fieldName => $value){
      echo "<th class='filedName' 
      style='color: #fff;'>".$fieldName."</th>";
    }
    echo "<th class='filedName' >Delete</th>";
    echo "</tr></thead><tbody class='item'>";

    foreach($postArray as $post){
      echo "<tr>";
      foreach($post as $postDetail){
        echo "<td>".$postDetail."</td>";
      }
      echo "<td><a href='./adminPost.php?user=".$post['post_id']."'><p class='delete'>Delete</p></a></td>";
    }
      echo "</tr>";
      echo "</tbody></table>";
  ?>