<?php
  include './websettig/config.php';
  include './websettig/routing.php';
  
  //header, dashbord
  if($page == 'login.php'){
    include './masterpages/logOutheader.php';
  }else{
    include './masterpages/loggedInHeader.php';
    if($_SESSION['atype']=='Admin'){
      include './masterpages/dashboard01admin.php';
    }else{
      include './masterpages/dashboard01.php';
    }
  }
  
  //main 
  include $pageCompo;  

  include './masterpages/dashboard02.php';
  //footer 
  include './masterpages/footer.php';
?>