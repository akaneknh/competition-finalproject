
<!DOCTYPE html>
<html class="navFooter-html" lang="en">

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
  <link rel="stylesheet" href="./masterpages/CSS/navFooter.css">
  <link rel="stylesheet" href="./masterpages/CSS/logOutHeader.css">
  <link rel="stylesheet" href="./masterpages/CSS/dashBoard.css">
  <link rel="stylesheet" href="./masterpages/CSS/accountSetting.css">
  <link rel="stylesheet" href="./masterpages/CSS/addNewPost.css">
  <link rel="stylesheet" href="./masterpages/CSS/yourPost.css">
  <link rel="stylesheet" href="./masterpages/css/profileDashboard.css">
  <link rel="stylesheet" href="./masterpages/css/logIn.css">
  <link rel="stylesheet" href="./masterpages/css/signUp.css">

  <title>Document</title>
</head>

<body class="logoutNavFooter-body">
  <header class="logoutNavFooter-header">
    <!-- LOGO -->
    <div class="logo">
      <h1>WHS<i class="fa-solid fa-house"></i></h1>
      <p>Wood Housing Solution</p>
    </div>

    <!-- NAV -->
    <nav class="logoutNavFooter-nav">
      <ul class="navMenu">
        <li><a href="#">Find Shared room/house</a></li>
        <li><a href="#">Comunity</a></li>
        <li><a href="#">Your Profile</a></li>
      </ul>
    </nav>
    <!-- LOGIN SIGNUP -->
    <div class="login-signup-wrap">
      <div class="logOutHeader-login-btn">
        <a href="./login.php"><span>Login</span></a>
      </div>
      <div class="logOutHeader-signUp-btn">
        <a href="./signUp.php"><span>SignUp</span></a>
      </div>
    </div>
  </header>

  <?php
// to make random binary and convert it into a hexadecimal string representation
if(!isset($_SESSION['token'])){
  $token_rondom = openssl_random_pseudo_bytes(16);
  $token = bin2hex($token_rondom);
  $_SESSION['token'] = $token;
}
?>

<main class="login-main">
    <article class="login-article01">
        <h1>
             login
        </h1>
    </article>
    <article class="login-article02">
      <form class="login-form" method="POST" action="<?php echo $reqURL; ?>">
        <!-- to make token in hidden input -->
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
            <label for="title">Email</label>
            <input type="email" name="email" placeholder=" example@woodhousing.com">
            <label for="pass">Password</label>
            <input type="password" name="pass">
            <div class='login-btn' >
              <button class='login-btn' type="submit">LogIn</button>
            </div>
            <a href="/signUp">Create an account</a>
      </form>
    </article>
  </main>

  <?php
      if($_SERVER['REQUEST_METHOD']=='POST'){
        //check token to verify 
        if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
            echo 'invalid';
        }else
          if(!isset($_POST['email']) || !isset($_POST['pass'])){
            echo 'input all sections';
          }else
            if(!filter_var(filter_var($_POST["email"],FILTER_SANITIZE_EMAIL),FILTER_VALIDATE_EMAIL)){
            echo 'Invalid';
            }else{
            $username = $_POST['email'];
            $pass = $_POST['pass'];
          
            $logCmd = "SELECT * FROM user_tb WHERE email= '$username'";
            $result = $dbCon->query($logCmd);
            if($result->num_rows > 0){
            $userDetails = $result->fetch_assoc();
            $hashpass = $userDetails['pass'];
            if(password_verify($pass,$hashpass)){
                $_SESSION['user'] = $username;
                $dbCon->close();
                $_SESSION['timeout'] = time()+900;

                switch($userDetails['atype']){
                  case 'Admin':
                    header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/adminUser"); 
                  break;
                  default :
                  header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/yourPost"); 
                }
              }else{
                echo 'invalid';
          }
        }    
      }
  }
?>


</main>
<!-- FOOTER -->
<footer>&copy; Wood housing solution</footer>

</body>
</html>
