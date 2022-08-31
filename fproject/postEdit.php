<?php
  include './configfinal.php';

  if(!isset($_SESSION['post_id'])){
    header("Location: http://localhost/fproject/loginCon.php"); //loginpage
  }else{
    $post = $_SESSION['post_id'];
    $logCmd = "SELECT * FROM post_tb WHERE post_id='$post'";
    $postresult = $dbCon->query($logCmd);
    if($postresult->num_rows > 0){
      $userPost = $postresult->fetch_assoc();
    }else{
      echo $dbCon->error;
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>yourpost-Post Edit</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link rel="stylesheet" href="./CSS/postEdit.css">
</head>
<body>
  <main class='postedit'>
    <!-- should change action -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <img src="<?php echo './img/post_img/'.
          $userPost['imgName'];?>">
      <label for="postImg">Image</label>
        <article>
          <label for="postImg">select your file<i class="fa-solid fa-file-arrow-up"></i></label>
          <input type="file"  name="postImg" required>
        </article>
      <label for="title">Title</label>
      <input type="text" name="title" value="<?php echo $userPost['title']; ?>">
      <label for="date">Date</label>
      <input type="date" name="date"  value="<?php echo date("Y-m-d"); ?>"> 

      <label for="content">Content</label>
      <textarea name="content" ><?php echo $userPost['postContent']; ?></textarea>

      <!-- check -->

      <div>
        <button type="submit">Save</button>
      </div>
    </form>
  </main>
  
</body>
</html>

<?php
 if($_SERVER['REQUEST_METHOD']=='POST'){
  if(uploadfile('./img/post_img/','postImg')==='true'){
    $postImg = $_FILES['postImg']['name'];
    $updateCmd = "UPDATE post_tb SET title='".$_POST['title']."',postContent='".$_POST['content']."',p_date='".$_POST['date']."',imgName='".$postImg."'  WHERE post_id = '$post'";
  
    if($dbCon->query($updateCmd) === true){
      $dbCon->close();
      echo "<h5>saved<h5>"; 
    }else{
      echo $dbCon->error;
    }
  }
 }
?>