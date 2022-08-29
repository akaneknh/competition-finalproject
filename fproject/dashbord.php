<?php
// show userdata for specific user and function of dashbord(move to another page)
include './configfinal.php';
session_start();

if(isset($_GET('action'))){

  switch($_GET('action')){
    case 'yourpost':
      header("Location: ");//yourpost url
    break;

    case 'profile':
      header("Location: ");//profile url
    break;

    case 'newpost':
      header("Location: ");//newpost url
    break;

    case 'setting':
      header("Location: ");//setting url
    break;
  }
}
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
<!-- dashbord has query string like this url:?action=yourpost,profile,post,setting'-->

<!-- between html -->
  <?php
    $_SESSION['user'] = $user;
    //userfname = $user['fname'];
    //userlname = $user['lname'];
    //useratype = $user['atype'];..
    
  ?>
</body>
</html>