<?php
  include './configfinal.php';
  session_start();
  $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }

  if(!isset($_SESSION['user'])){
    header("Location: http://localhost/fproject/login.php"); //loginpage
  }else{
    $email = $_SESSION['user'];
    $logCmd = "SELECT * FROM user_tb WHERE email='$email'";
    $useresult = $dbCon->query($logCmd);
    if($useresult->num_rows > 0){
      $user = $useresult->fetch_assoc();
    }
    // print_r($user);
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
  <title>add New Post</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link rel="stylesheet" href="./CSS/addNewPost.css">
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

      <div>
        <button type="submit">Save</button>
      </div>
    </form>
  </main>
  
  
  <?php 
  // if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['title']!='' && $date = $_POST['date']!= '' && $_POST['content']!=''){
    // if(uploadfile('postImg','./img')=='true'){
      if($_SERVER['REQUEST_METHOD']=="POST"){
        $destDir = './img/post_img';
        $sourceFile = $_FILES['postImg'];
        $sourceFileDetails = pathinfo($sourceFile['name']);
        $imgArray = (" jpg,png,jpeg,gif,tiff,psd,pdf,eps");
        if(strpos($imgArray,$sourceFileDetails['extension']) !=0 && getimagesize($sourceFile['tmp_name'])){
            if($sourceFile['size']<400000){
              if(move_uploaded_file($sourceFile['tmp_name'],$destDir.$sourceFile['name'])){
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
    }
  }
    
?>

</body>
</html>