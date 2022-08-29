<?php
//need check
  include './configfinal.php';
  session_start();
  $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }


  if(!isset($_SESSION['post_id'])){
    header("Location: http://localhost/fproject/loginCon.php"); //loginpage
  }else{
    $post = $_SESSION['post_id'];
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
  
  <link rel="stylesheet" href="./CSS/addNewPost.css">
</head>
<body>
  <main>
    <!-- should change action -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <label for="postImg">Image</label>
        <article>
          <label for="postImg">select your file<i class="fa-solid fa-file-arrow-up"></i></label>
          <input type="file"  name="postImg" required>
        </article>
      <label for="title">Title</label>
      <input type="text" name="title" value="<?php echo $post['title']; ?>">
      <label for="date">Date</label>
      <input type="date" name="date"  value="<?php echo time(); ?>"> 
      <!-- should change format of time -->
      <label for="content">Content</label>
      <textarea name="content" value="<?php echo $post['content']; ?>" ></textarea>

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
  $updateCmd = "UPDATE post_tb SET title='".$_POST['title']."',postContent='".$_POST['content']."',p_date='".$_POST['p_date']."'";

  if($dbCon->query($updateCmd) === true){
    $dbCon->close();
    echo "<h5>saved<h5>"; 
  }else{
    echo "failed";
  }
 }
?>