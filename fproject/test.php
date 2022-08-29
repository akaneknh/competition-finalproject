<?php 
    include './configfinal.php'; 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input name="username" type="email"/>
        <input name="pass" type="password"/>
        <button type="submit">Login</button>
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $username = $_POST['username'];
            $pass = $_POST['pass'];
            $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
            if($dbCon->connect_error){
                die("Error: ".$dbCon->connect_error);
            }else{
                $selectCmd = "SELECT * FROM `user_tb` WHERE email='$username';";
                $result = $dbCon->query($selectCmd);
                if($result->num_rows > 0){
                    $user = $result->fetch_assoc();
                    $hashedPass = $user['pass'];
                    print_r($hashedPass);
                    if(password_verify($pass,$hashedPass)){
                        $_SESSION['user'] = $user;
                        $dbCon->close();
                        $_SESSION['timeout'] = time() + 10;
                        header("Location: http://localhost/PHP_G1/welcome.php");
                    }else{
                        echo "User not valid";
                    }
                }else{
                    echo "User not valid";
                }
                $dbCon->close();
            }
        }
    ?>
</body>
</html>
