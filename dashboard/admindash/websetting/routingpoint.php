<!-- ! we have collection of values : when you use array -->

<?
  $pageArray = []; //name of file
  $pagedir = scandir('./pages'); //this code will include by index, that's why only one dot here
  //scandir : list or make array of file name whatever files , create directory


  foreach($pagedir as $page){
    if($page = '.' || $page = '..'){
      array_push($pageArray,basename($page,'.php'));
    }
    $reqURL = strtolower( parse_url($_SERVER['REQUEST_ULI'],PHP_URL_PASS)) ; // not URL!
    if($reqURL = '' || $reqURL = '/'){
      $page = "home";
    }else{
      $page = basename($reqURL);
    }
  }
  foreach($pageArray as $pageName){
    if($pageName == $page){
      $pageCompo = "./pages/$page.php";
      break; // to stop when you find page name
    }
  }
  if(!$pageCompo){
    $pageCompo = "./pages/404.php";
  }
?>