<?php
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
  ?>

<main>
  <form class="addNewPost-form" method="POST" action="./addNewPost.php" enctype="multipart/form-data">
      <label for="postImg">Image</label>
      <article class="addNewPost-article">
          <input type="file"  name="postImg" required>
        </article>
      <label for="title">Title</label>
      <input type="text" name="title" required>
      <label for="date">Date</label>
      <input type="date" name="date" value="<?php strtotime(time()); ?>" required>
      <label for="content">Content</label>
      <textarea name="content" required></textarea>

      <div class="addNewPost-btn">
        <button type="submit">Save</button>
      </div>

<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $_SESSION['timeout'] = time()+900;
      if(uploadfile('./img/post_img/','postImg')=='true'){
          $title = $_POST['title'];
          $date = $_POST['date'];
          $postImg = $_FILES['postImg']['name'];
          $content = htmlspecialchars($_POST['content']);
          $userid = $user['user_id'];
 
          $postCmd = "INSERT INTO post_tb(title, postContent,user_id, p_date, imgName) VALUES ('".$title."','".$content."','".$userid."','".$date."','".$postImg."')"; 
          if($dbCon->query($postCmd)){
             echo "<h4>Posted!</h4>";
            $_SESSION['user'] = $email;
            $dbCon->close();
          }else{
              echo "<h3>Image is too big</h3>";
          }
        }else{
          echo "<h3>Please Upload an Image</h3>";
        }
      }   
?>
</form>
