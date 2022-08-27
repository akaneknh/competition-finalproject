<!-- add two hidden forms,1's value badge1 +3 default: a:edit -->
<?php
  include './configfinal.php';
  session_start();
  $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignUp</title>
  <!-- Font awsome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="./css/signUp.css">
</head>

<body>
  <header>
    <!-- LOGO -->
    <div class="logo">
      <h1>WHS<i class="fa-solid fa-house"></i></h1>
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
    <div class="login-sign-up">
      <a href="#">Login</a>
      <a href="#">Sign Up</a>
    </div>
  </header>

  <main>
    <h1>Sign up</h1>
    <!-- should change inside of action -->
    <form method="POST" action="#" enctype="multipart/form-data">
      <h5>
        <div>*</div>is required
      </h5>
      <section class="name">
        <aside>
          <label for="fname">First Name <div>*</div></label>
          <input type="text" name="fname">
        </aside>
        <aside>
          <label for="lname">Last Name<div>*</div></label>
          <input type="text" name="lname">
        </aside>
      </section>
      <label for="atype">Select your account type<div>*</div></label>
      <select name="atype">
        <option selected disabled></option>
        <option>Landlord</option>
        <option>Student</option>
        <option>Admin</option>
      </select>
      <label for="dob">Date of birth<div>*</div></label>
      <input type="date" name="dob">
      <label for="email">Email<div>*</div></label>
      <input type="email" name="email" placeholder="example@woodhousing.com">
      <!-- should change pass and confirm -->
      <label for="pass">Password<div>*</div></label>
      <input type="password" name="pass">
      <label for="conPass">Password confirm<div>*</div></label>
      <input type="password" name="conPass">

      <section class="pic">
        <!-- test for accepting img -->
        <!-- required makes this input mandatory -->
        <label for="profImg">Profile Picture<div>*</div></label>
        <article>
   
          <input type="file" name="profImg" accept="image/*" required>
        </article>

        <label for="refImg">References(email confirmed)</label>
        <article>
          
          <input type="file" name="refImg">
          <input type="hidden" name="badge1" value="b">
        </article>
        <label for="tamImg">References(from Tamwood)</label>
        <article>
          <input type="file" name="tamImg">
          <input type="hidden" name="badge2" value="b">
        </article>
      </section>
      <section class="button">
        <button type="submit">Sign up</button>
      </section>
    </form>
  </main>
  <!-- FOOTER -->
  <footer>&copy; Wood housing solution</footer>

  <?php
if($_SERVER['REQUEST_METHOD']=='POST'){

  if($_POST['fname'] != '' && $_POST['lname'] != '' && $_POST['atype'] != '' && $_POST['dob'] != '' && $_POST['email'] != '' && $_POST['conPass'] != '' && $_POST['pass'] != '' && $_FILES['profImg'] != '' ){
    $fname = $_POST['fname'];
    $lname = $_POST['lname']; 
    $atype = $_POST['atype'];
    $dob = $_POST['dob']; 
    $email = $_POST['email'];
    
    $profImg = $_FILES['profImg']['name'];
    $refImg = $_FILES['refImg']['name'];
    $tamImg = $_FILES['tamImg']['name'];
    
    $_SESSION['timeout'] = time()+900;
    if($_POST['pass'] == $_POST['conPass']){
        $pass = password_hash($_POST['pass'],PASSWORD_BCRYPT); 
        // I hash pass here,is it correct?or after like when you store value
      }else{
        echo 'password confirmation is not valid';
      }
      
      // to check if there are values in $refImg & $tamImg to give user badge
      if($refImg !=" " && $tamImg != ""){
        //user can get 2 pending badge(value=b)
        $badge1 = $_POST['badge1'];
        $badge2 = $_POST['badge2'];
      }elseif($refImg !=" " && $tamImg == ""){
        //user can get 1 panding badge(value=b)
        $badge1 = $_POST['badge1'];
        $badge2 = "a";
      }elseif($refImg ==" " && $tamImg != ""){
        $badge1 = "a";
        $badge2 = $_POST['badge2'];
        //user can get 1 panding badge(value=b)
      }
      
      $insertCmd = "INSERT INTO user_tb(firstName, lastName, atype, dob, email, pass, profImg, refImg, badge1, tamImg, badge2,profileContent) VALUES ('$fname','$lname','$atype','$dob','$email','$pass','$profImg','$refImg','$badge1','$tamImg','$badge2','no posted')"; 
      if($dbCon->query($insertCmd)){
        echo ">Succesfully</h1>"; //checkmark icon 

        $_SESSION['user'] = $email;

        $userCmd = "SELECT * FROM user_tb WHERE fname=$fname";
        $result = $dbCon->query($userCmd);
        // $_session['user'] has all info of login user
        $_SESSION['user'] = $result->fetch_assoc();
        print_r($_SESSION['user']);
        if($atype == 'admin'){
          $dbCon->close();
          // header("Location: #");// adminHP
        }else{
          $dbCon->close();
          // header("Location: #"); //userHp
        }
      }else{
        echo "<h1>database error</h1>";
      }
      $dbcon->close();
    } 
}
  ?>
  </body>
  
  </html>