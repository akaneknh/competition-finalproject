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
      <form class="login-form" method="POST" action="./login.php">
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
                $_SESSION['atype'] = $userDetails['atype'];
                $_SESSION['timeout'] = time()+900;
                $dbCon->close();

                switch($userDetails['atype']){
                  case 'Admin':
                    header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/adminUser.php"); 
                  break;
                  default :
                  header("Location: ".parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)."/yourPost.php"); 
                }
              }else{
                echo 'invalid';
          }
        }    
      }
  }
?>
