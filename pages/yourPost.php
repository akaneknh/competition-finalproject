<?php
  if(!isset($_SESSION['user']) || $_SESSION['timeout'] < time()){
    header("Location: ".parse_url($_SERVER['REQUEST_URI'],PHP_URL_HOST)."/login");
  }
    $email = $_SESSION['user'];
    $logCmd = "SELECT * FROM user_tb WHERE email='$email'";
    $useresult = $dbCon->query($logCmd);
    if($useresult->num_rows > 0){
      $user = $useresult->fetch_assoc();
    }

    $postArray = [];
    $userid = $user['user_id'];
    $postCmd = "SELECT * FROM post_tb WHERE user_id = '$userid'";
    $result = $dbCon->query($postCmd);
    while($row = $result->fetch_assoc()){
      array_push($postArray,$row);
    }


  if(isset($_GET['action'])){
    $userid = $user['user_id'];
    $editCmd = "SELECT * FROM post_tb WHERE user_id= '$userid'";
    $result = $dbCon->query($editCmd);
    $postData = $result->fetch_assoc();
    $_SESSION['post_id']=$postData['post_id'];
    switch($_GET['action']){
      case 'edit': 
        $_SESSION['timeout'] = time()+900;
        $_SESSION['user'] = $email;
        header("Location: ".parse_url($_SERVER['REQUEST_URI'],PHP_URL_HOST)."/postEdit");
      break;

      case 'delete':
        $postid = $postData['post_id'];
        $selectCmd = "SELECT * FROM post_tb WHERE post_id = '$postid'";
        $delresult = $dbCon->query($selectCmd);
        $delImg = $delresult->fetch_assoc();
        unlink("./img/post_id/".$delImg['imgName']);
        
        $deleteCmd = "DELETE FROM post_tb WHERE post_id = '$postid'";
        if($dbCon->query($deleteCmd)===true){
          $_SESSION['timeout'] = time()+900;
          header("Location: ".parse_url($_SERVER['REQUEST_URI'],PHP_URL_HOST)."/yourPost");
        }
        echo $dbCon->error;
      break;
    }
  }

?>

  <?php
    if(!empty($postArray)){ // to check if the array is empty or not
      foreach($postArray as $postDetail){
        echo '<article class="postList-article"><div class="your-post-wrap">';
        echo '<img src="./pages/img/post_img/'.$postDetail['imgName'].'">';
        echo '<div class="your-post-article"><h4>'.$postDetail['title'].'</h4><div><time>'.$postDetail['p_date'].'</time><aside><a class="edit" href="/yourpost?action=edit">Edit</a><a class= "delete" href="/yourpost?action=delete">Delete</a></aside></div><div class="yourPost-p"><p>'.$postDetail['postContent'].'</p>';
        echo '</div></div></div></article>';
      }
    }else{
      echo " <h4 class='yourposth4'>You haven't posted yet!</h4>";
    }
?>

  </div>  
    


