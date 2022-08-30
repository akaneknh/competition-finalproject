<?php
  include './configfinal.php';
  
  $dbCon = new mysqli($dbServerName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }

  if(!isset($_SESSION['user'])){
    header("Location: "); //loginpage
  }else{
    $email = $_SESSION['user'];
    $logCmd = "SELECT * FROM user_tb WHERE email='$email'";
    $useresult = $dbCon->query($logCmd);
    if($useresult->num_rows > 0){
      $user = $useresult->fetch_assoc();
    }
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>your Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/profileDashbord.css">
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
        <form method="POST" action="#" enctype="multipart/form-data">
            <label for="profImg">Profile image</label>
              <article>
                <label for="profImg">select your file<i class="fa-solid fa-file-arrow-up"></i></label>
                <input type="file"  name="profImg" value="<?php echo $user['profImg']; ?>">
                <!-- value or required -->
              </article>
            <label for="content">Content</label>
            <textarea name="content"></textarea>
            <div>
              <button type="submit">Save</button>
            </div>
          </form>
    </main>

  <!-- FOOTER -->
  <footer>&copy; Wood housing solution</footer>
  
  <?php

if($_SERVER['REQUEST_METHOD']=='POST'){
  if(uploadfile('./img/profile_img/','profImg')==='true'){
    $profImg = $_FILES['profImg']['name'];
    $content = htmlspecialchars($_POST['content'], ENT_QUOTES);
  }
  
  $useremail = $user['email'];
  
  $profCmd = "UPDATE user_tb SET profImg='".$profImg."', profileContent='".$content."' WHERE email='$useremail'";
  if($dbCon->query($profCmd) === true){
    $dbCon->close();
    // session_unset();
    // session_destroy();
    header("Location: http://localhost/fproject/yourpost.php");
  }
  echo $dbCon->error;
}


// $destDir = './img/profile_img';
// $sourceFile = $_FILES['profImg'];
// $sourceFileDetails = pathinfo($sourceFile['name']);
// print_r($sourceFileDetails);
// $imgArray = (" jpg,png,jpeg,gif,tiff,psd,pdf,eps");
// if(strpos($imgArray,$sourceFileDetails['extension']) !=0 && getimagesize($sourceFile['tmp_name'])){
//     if($sourceFile['size']<400000){
//         if(move_uploaded_file($sourceFile['tmp_name'],$destDir.$sourceFile['name'])){
?>

</body>

</html>