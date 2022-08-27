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
  <main>
    <!-- should change action -->
    <form method="POST" action="#" enctype="multipart/form-data">
      <label for="postImg">Image</label>
        <article>
          <label for="postImg">select your file<i class="fa-solid fa-file-arrow-up"></i></label>
          <input type="file"  name="postImg" accept="image/*" required>
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
  
</body>
</html>

<?php 
  if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['title']!='' && $date = $_POST['date']!= '' && $_POST['content']!=''){
    if(uploadfile('postImg','./img')=='true'){
      $title = $_POST['title'];
      $date = $_POST['date'];
      $postImg = $_FILES['postImg']['name'];
      $content = htmlspecialchars($_POST['content']);

      $postCmd = "INSERT INTO post_tb(title, postContent,user_id, p_date) VALUES ('".$title."','".$content."','".$user['user_id']."','".$date."')"; 
      if($dbCon->query($postCmd)){
       echo "Posted";
      }else{
        echo "failed";
      }
        // session_unset();
        // session_destroy();
        $dbCon->close();
      }
    }
?>
