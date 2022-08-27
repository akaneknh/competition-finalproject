<?php
echo 'hello';
  //dashbord a tag has to have query string 
  if(isset($_GET['action'])){
    $action = $_GET['action'];
    switch($action){ 
  
      // each action should reset timecounter with func
      // case "exit" :
      //   session_unset();
      //   session_destroy();
      //   header("Location: http://localhost/php/session1.php");
      //   break;
  
        case "yourpost":
          include 'yourpost.php';
          //get info from database and display as a table
          // prev and next works with numbers 
  
          
        case "profile":
          include 'profile.php';
           //if( == post), if it is a img(check with extention), upload img and display. don't forget to encrypt 
          // store datebase with func insert
  
          //! prof sentences edit datebase
          // should use specialchara function for secure ↓
          //htmlspecialchars(string,flags,character-set,double_encode)
        
        case "post":
          include 'post.php';
  
          //if( == post), if it is a img(check with extention), get img and display. 
          // store in datebase 
  
          //! post sentences edit datebase
          // should use specialchara function for secure ↓
          //htmlspecialchars(string,flags,character-set,double_encode)
  
        case "setting":
          include 'setting.php';
          // display prev info (like coursework) 
        break;
    }
  }
?>