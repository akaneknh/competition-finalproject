<?php
  include './configfinal.php';
  $dbCon = new mysqli($dbServerName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }

  if(!isset($_SESSION['user'])){
    header("Location: http://localhost/fproject/loginCon.php"); //loginpage
  }else{
    $email = $_SESSION['user'];
    $logCmd = "SELECT * FROM user_tb WHERE email='$email'";
    $useresult = $dbCon->query($logCmd);
    if($useresult->num_rows > 0){
      $user = $useresult->fetch_assoc();
    }
  }
  // timeout(time(),$dbCon);
  // to reset timeout is it correct?
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
  <link rel="stylesheet" href="./CSS/addNewPost.css">
  <title>add new post</title>
</head>
<body>
  <header>
    <!-- LOGO -->
      <div class="logo"><h1>WHS<i class="fa-solid fa-house"></i></h1><p>Wood Housing Solution</p></div>

    <!-- NAV -->
    <nav>
      <ul>
        <li><a href="#">Find Shared room/house</a></li>
        <li><a href="#">Comunity</a></li>
        <li><a href="#">Your Profile</a></li>
      </ul>
    </nav>
    <!-- LOGIN USER NAME -->
    <?php
         echo '<aside>Hello,'.$user['firstName'].'</aside>';
       ?>
    <!-- SETTING -->
    <a class="setting-icn" href="#"><i class="fa-solid fa-gear"></i></a>
  </header>

  <main>
  <div class="side">
      <ul>
        <li><a href="./yourpost.php"><i class="fa-solid fa-file-lines"></i>Your Post</a></li>
        <li><a href="./yourProfile.php"><i class="fa-solid fa-user"></i>Your Profile</a></li>
        <li><a href="./addNewPost.php"><i class="fa-solid fa-pen"></i>Add new post</a></li>
        <li><a href="./accountSetting.php"><i class="fa-solid fa-gear"></i>Accoutn setting</a></li>
      </ul>
  </div>
    <!-- should change action -->
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <label for="postImg">Image</label>
        <article>
          <label for="postImg">select your file<i class="fa-solid fa-file-arrow-up"></i></label>
          <input type="file"  name="postImg" required>
        </article>
      <label for="title">Title</label>
      <input type="text" name="title" required>
      <label for="date">Date</label>
      <input type="date" name="date" required>
      <label for="content">Content</label>
      <textarea name="content" required></textarea>

      <div class="button">
        <button type="submit">Save</button>
      </div>
  </form>
</main>
  
  
<?php 
  // if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['title']!='' && $date = $_POST['date']!= '' && $_POST['content']!=''){
      if($_SERVER['REQUEST_METHOD']=="POST"){
        if(uploadfile('./img/post_img/','postImg')==='true'){

          $title = $_POST['title'];
          $date = $_POST['date'];
          $postImg = $_FILES['postImg']['name'];
          $content = htmlspecialchars($_POST['content']);
          $userid = $user['user_id'];
 
          $postCmd = "INSERT INTO post_tb(title, postContent,user_id, p_date, imgName) VALUES ('".$title."','".$content."','".$userid."','".$date."','".$postImg."')"; 
          if($dbCon->query($postCmd)){
             echo "Posted";
            $_SESSION['user'] = $email;
            $dbCon->close();
          }else{
              echo "<h1>Image is too big</h1>";
          }
        }else{
          echo "<h1>Please Upload an Image</h1>";
        }
      }   
?>

</body>
</html>