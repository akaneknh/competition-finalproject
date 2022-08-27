<?php
  include './configfinal.php';
  session_start();
  $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }

  if(!isset($_SESSION['user'])){
    header("Location: "); //loginpage
  }else{
    $user = $_SESSION['user'];
    print_r($user);
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/profileDashbord.css">
</head>
<body>
    <main>
        <form method="POST" action="#" enctype="multipart/form-data">
            <label for="profImg">Profile image</label>
              <article>
                <label for="profImg">select your file<i class="fa-solid fa-file-arrow-up"></i></label>
                <input type="file"  name="profImg" required>
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
  if(uploadfile()=='true'){
    $profImg = $_FILES['profImg']['name'];
    $content = htmlspecialchars($_POST['content']);
    
    $profCmd = "UPDATE user_tb SET profImg='".$profImg."', profileContent='".$content." WHERE email=".$user['email'];
    if($dbcon->query($profCmd) === true){
      $dbcon->close();
      // session_unset();
      // session_destroy();
      header("Location: hp");
    }
  }else{
    echo 'false';
  }
}

?>

</body>

</html>