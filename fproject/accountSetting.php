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
    $user = $_SESSION['user'];
  }

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Setting</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  
  <link rel="stylesheet" href="./css/accountSetting.css">
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
    <!-- Side Nav on dashboard -->
    <article>
      <div class="side">
      <ul>
        <li><a href="./yourpost.php"><i class="fa-solid fa-file-lines"></i>Your Post</a></li>
        <li><a href="./yourProfile.php"><i class="fa-solid fa-user"></i>Your Profile</a></li>
        <li><a href="./addNewPost.php"><i class="fa-solid fa-pen"></i>Add new post</a></li>
        <li><a href="./accountSetting.php"><i class="fa-solid fa-gear"></i>Accoutn setting</a></li>
      </ul>
  
      </div> 
      <div class="content">
  <!-- should change inside of action -->
  <form method="POST" action="#" enctype="multipart/form-data">
    <h5><div>*</div>is required</h5>
    <section class="name">
      <aside>
        <label for="fname">First Name</label>
       <?php
         echo '<input type="text" name="fname" value="'.$user['firstName'].'">';
       ?>
      </aside>
      <aside>
        <label for="lname">Last Name</label>
        <?php
         echo '<input type="text" name="lname" value="'.$user['lastName'].'">';
       ?>
      </aside>
    </section>
    <label for="atype">Select your account type<div>*</div></label>
    <select name="atype" required>
      <option selected disabled></option>
      <option>Landord</option>
      <option>Student</option>
    </select>
    <label for="dob">Date of birth</label>
    <?php
         echo '<input type="text" name="dob" value="'.$user['dob'].'">';
       ?>
    <label for="email">Email</label>
    <?php
         echo '<input type="email" name="email" value="'.$user['email'].'" placeholder ="example@tamhousing.jp">';
       ?>
    <!-- should change pass and confirm -->
    <label for="pass">Password<div>*</div></label>
    <?php
         echo '<input type="password" name="pass"  required>';
       ?>

    <section class="pic">
      <label for="profImg">Profile Picture</label>
      <article>

      <?php
         echo '<input type="file" name="profImg" value="'.$user['profImg'].'">';
       ?>
      </article>
      
      <label for="refImg">References(email confirmed)</label>
      <article>
      <?php
         echo '<input type="file" name="refImg" value="'.$user['refImg'].'">';
       ?>
      </article>
      <label for="tamImg">References(from Tamwood)</label>
      <article>
      <?php
         echo '<input type="file" name="tamImg" value="'.$user['tamImg'].'">';
       ?>
      </article>
    </section>
    <section class="button">
      <button type="submit">Sign up</button>
    </section>
  </form>
      </div>
    </article>


  </main>
<!-- FOOTER -->
<footer>&copy; Wood housing solution</footer>

<?php 
  if($_SERVER['REQUEST_METHOD']=='POST'){// check order and edit
    $updateCmd = "UPDATE user_tb SET firstName='".$_POST['fname']."',lastName='".$_POST['lname']."',atype='".$_POST['atype']."',dob='".$_POST['dob']."',email='".$_POST['email']."',pass='".$_POST['pass']."',profImg='".$_FILES['profImg']['name']."',refImg='".$_FILES['profImg']['name']."',tamImg='".$_FILES['tamImg']['name']."' WHERE user_id='".$user['user_id']."'";

    if($_FILES['refImg'] !=" " && $_FILES['tamImg'] != ""){
      $badge1 = 'b';
      $badge2 = 'b';
    }elseif($_FILES['refImg'] !=" " && $_FILES['tamImg'] == ""){
      $badge1 = 'b';
      $badge2 = "a";
    }elseif($_FILES['refImg'] ==" " && $_FILES['tamImg'] != ""){
      $badge1 = "a";
      $badge1 = 'b';
    }

    if($dbCon->query($updateCmd) === true){
      $dbCon->close();
      echo "<h5>saved<h5>"; 
    }else{
      echo "failed";
    }
  }
  ?>

  </body>
  </html>