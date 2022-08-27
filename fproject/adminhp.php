<?php
// hp for admin and display users data or move to postedit
  include './configfinal.php';
  session_start();
  $dbCon = new mysqli($dbSeverName,$dbUserName,$dbpass,$dbname);
  if($dbCon->connect_error){
    die("connection error");
  }

//   if(isset($_GET('user'))){ //or index to specify users
//     $_SESSION['user'][] = $_GET['user'];// inside of session[user], there is all info of specific user
//     $dbCon->close();
//     header("Location: editUser");// change url
//   }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin HP</title>

</head>
<body>
  
</body>
</html>

<!-- a tag has link and query string -->
<?php
//check query string to decide which page should go
  // if(isset($_GET['action'])){
  //   switch($_GET['action']){
  //     case 'student':
  //     $atype = 'student';
  //     break;

  //     case 'landlord':
  //     $atype = 'landlord';
  //     break;

  //     case 'post' :
  //       $dbCon->close();
  //     header("Location: postEdit.php"); // postedit url
  //   }

  $userArray = [];
  $detailCmd = "SELECT * FROM user_tb";
  $result = $dbCon->query($detailCmd);
  $userData = $result->fetch_assoc();
  while($row = $userData){
    array_push($userArray,$row);
  }

  

    // echo "<table><thead><tr>";
    // foreach($userData as $fieldName => $value){
    //   echo "<th>".$fieldName."</th>";
    // }
    // echo "</tr><thead><tbody>";
    // foreach($userData as $fieldName => $value){
    //   echo "<tr><th>".$value."</th></tr>";
    //   // add edit : redirect with query string
    //   echo "<a href='redirect url?user='>Edit</a>"; 
    // }
    // echo "</tbody></table>";
  
?>