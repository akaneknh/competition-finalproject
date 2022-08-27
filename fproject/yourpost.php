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
  <title>Document</title>
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
        <li><a><i class="fa-solid fa-file-lines"></i>Your Post</a></li>
        <li><a><i class="fa-solid fa-user"></i>Your Profile</a></li>
        <li><a><i class="fa-solid fa-pen"></i>Add new post</a></li>
        <li><a><i class="fa-solid fa-gear"></i>Accoutn setting</a></li>
      </ul>

    </div>
    <div class="content">
      <article>
        <div class="your-post-wrap">
          <img src="/img/house.png" alt="">
          <div class="your-post-article">
            <h4> Ipsum, dolor sit amet consectetur</h4>
            <div>
              <time>April 18, 2022</time>
              <aside><span class="edit">Edit</span><span class="delete">Delete</span></aside>
            </div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illo, voluptate provident odit voluptas culpavelit sunt
            </p>
          </div>
        </div>
    
      </article>
      <article>
        <div class="your-post-wrap">
          <img src="/img/house.png" alt="">
          <div class="your-post-article">
            <h4> Ipsum, dolor sit amet consectetur</h4>
            <div>
              <time>April 18, 2022</time>
              <aside><span class="edit">Edit</span><span class="delete">Delete</span></aside>
            </div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illo, voluptate provident odit voluptas culpavelit sunt
            </p>
          </div>
        </div>
    
      </article>
      <article>
        <div class="your-post-wrap">
          <img src="/img/house.png" alt="">
          <div class="your-post-article">
            <h4> Ipsum, dolor sit amet consectetur</h4>
            <div>
              <time>April 18, 2022</time>
              <aside><span class="edit">Edit</span><span class="delete">Delete</span></aside>
            </div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illo, voluptate provident odit voluptas culpavelit sunt
            </p>
          </div>
        </div>
    
      </article>
    </div>


  </main>

  <!-- FOOTER -->
  <footer>&copy; Wood housing solution</footer>

</body>

</html>

<?php
  echo "you haven't eny posted yet";
  $postCon = "SELECT "
?>