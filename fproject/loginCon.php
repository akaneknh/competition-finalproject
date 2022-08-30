<?php
include './configfinal.php';

$dbCon = new mysqli($dbServerName,$dbUserName,$dbpass,$dbname);
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
    <title>Log-In</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/logIn.css">
</head>
<body>
    <main>
        <article>
            <h1>
                login
            </h1>
        </article>
        <article>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="title">Email</label>
                <input type="email" name="email" placeholder="  example@woodhousing.com">
                <label for="pass">Password</label>
                <input type="password" name="pass">
                <button type="submit">LogIn</button>
                <a href="#">Create an account</a>
            </form>
        </article>
    </main>
    
    <?php
      if($_SERVER['REQUEST_METHOD']=='POST'){
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

            if($userDetails['atype']=="Admin"){
              header("Location: http://localhost/fproject/adminuser.php"); //adminHP
            }elseif($userDetails['atype']=="Student" || $userDetails['atype']=="Landlord"){ 
              header("Location: http://localhost/fproject/yourpost.php");
            }
          }else{
            echo 'invalid';
         }
        }    
      }
    ?>
</body>
</html>