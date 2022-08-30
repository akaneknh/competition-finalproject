<?php
  include './configfinal.php';

  $dbCon = new mysqli($dbServerName,$dbUserName,$dbpass,$dbname);
if($dbCon->connect_error){
  die("connection error");
}
  if(!isset($_SESSION['user'])){
    header("Location: http://localhost/fproject/loginCon.php"); //loginpage
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
  


    //should change
  if(isset($_GET['action'])){
    $userid = $user['user_id'];
    $editCmd = "SELECT * FROM post_tb WHERE user_id= '$userid'";
    $result = $dbCon->query($editCmd);
    $postData = $result->fetch_assoc();
    $_SESSION['post_id']=$postData['post_id'];

    switch($_GET['action']){
      case 'edit': 
        header("Location: http://localhost/fproject/postEdit.php");
      break;

      case 'delete':
        $postid = $postData['post_id'];
        $deleteCmd = "DELETE FROM post_tb WHERE post_id = '$postid'";
        if($dbCon->query($deleteCmd)===true){
          header("Location: http://localhost/fproject/yourpost.php");
        }
        echo $dbCon->error;
      break;
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- font-awsome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <!-- google-font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="./CSS/yourPost.css">
  <title>your post</title>
</head>

<body>
  <header>
    <!-- LOGO -->
    <div class="logo">
      <h1>WHS<i class="fa-solid fa-house"></i>
      </h1>
      <p>Wood Housing Solution</p>
    </div>

    <!-- NAV -->
    <nav>
      <ul>
        <li><a href="#">Find Shared room/house</a></li>
        <li><a href="#">Comunity</a></li>
        <li><a href="#">Your Profile</a></li>
      </ul>
    </nav>
    <!-- LOGIN USER NAME -->
    <?php echo "<aside>Hello, ".$user['firstName']."</aside>"; ?>
    <!-- SETTING -->
    <a href="#"><i class="fa-solid fa-gear"></i></a>
  </header>

  <!-- DASHBOARD -->
  <main>
    <div class="side">
      <ul>
        <li><a href="./yourpost.php"><i class="fa-solid fa-file-lines"></i>Your Post</a></li>
        <li><a href="./yourProfile.php"><i class="fa-solid fa-user"></i>Your Profile</a></li>
        <li><a href="./addNewPost.php"><i class="fa-solid fa-pen"></i>Add new post</a></li>
        <li><a href="./accountSetting.php"><i class="fa-solid fa-gear"></i>Accoutn setting</a></li>
      </ul>

    </div>
    <div class="content">
  <?php
      foreach($postArray as $postDetail){
      echo '<article><div class="your-post-wrap">';
      echo '<img src="./img/post_img/'.$postDetail['imgName'].'">';
      echo '<div class="your-post-article"><h4>'.$postDetail['title'].'</h4><div><time>'.$postDetail['p_date'].'</time><aside><a class="edit" href="http://localhost/fproject/yourpost.php?action=edit">Edit</a><a class= "delete" href="http://localhost/fproject/yourpost.php?action=delete">Delete</a></aside></div><p>'.$postDetail['postContent'].'</p>';
      //html changed span to a
      echo '</div></div></article>';
    } 
  ?>

    </div>  
  </main>

  <!-- FOOTER -->
  <footer>&copy; Wood housing solution</footer>


</body>
</html>