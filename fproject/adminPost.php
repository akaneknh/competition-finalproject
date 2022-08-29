<?php
//!important
  include './configfinal.php';
  session_start();
  $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }

  // if(!isset($_SESSION['user'])){
  //   header("Location: http://localhost/fproject/loginCon.php"); //loginpage
  // }else{
  //   $user = $_SESSION['user'];
  // }

  $postArray = [];
  $postCmd = "SELECT * FROM post_tb";
  $result = $dbCon->query($postCmd);
  while($row = $result->fetch_assoc()){
  array_push($postArray,$row);
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
print_r($postArray);
  //should change file place
    foreach($postArray as $post){
      for($i=0;$i>5;$i++){  //just once
        foreach($post as $filedname=>$postDetail){
        print_r($postDetail);
        echo '<article><div class="your-post-wrap">';
        echo '<h1>'.$filedname.'</h1>';
        }
      }
      echo '<img src="'.$post['imgName'].'">';
      echo '<div class="your-post-article"><h4>'.$post['title'].'</h4><div><time>'.$post['p_date'].'</time><aside><a class="edit" href="http://localhost/fproject/yourpost.php?action=edit">Edit</a><a  class= "delete" href="./yourpost.php?action=delete">Delete</a></aside></div><p>'.$post['postContent'].'</p>';
      //html changed span to a
      echo '</div></div></article>';
    } 
  ?>
  <a  class= "delete" href="./yourpost.php?action=delete">Delete</a>

  <?php

  $postCom = "SELECT * FROM post_tb";
  $result = $dbCon->query($postCom);
  if($result->num_rows > 0){
    $postData = $result->fetch_assoc();
    print_r($postData);

    echo "<table><thead><tr>";
    foreach($postData as $fieldName => $value){
      echo "<th>".$fieldName."</th>";
    }
    echo "</tr><thead><tbody><tr>";
    foreach($postData as $fieldName => $value){
      echo "<td>".$value."</td>";
      // how to edit delete depends on format of $postdata.if it's kinds of array using foreach, if it has index, use index to specify user
      // echo "<td></td>";
    }
    echo "<a href='./deleteEdit.php'>Delete</a></th></tbody></table>";
  }
?>
