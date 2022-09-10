<?php
    $pageArray = [];
    $pageDir = scandir("./pages/");

    foreach($pageDir as $page){
        if($page!='.' && $page!=".."){
            // array_push($pageArray, $page);
            array_push($pageArray, basename($page));
        }
    }

    $reqURL = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    // print_r($reqURL);
    //return URL path

    if($reqURL == "/" || $reqURL == ""){
        $page = "login.php";
    }else{
        $page = basename($reqURL);
    }
    

    foreach($pageArray as $pageName){
        if($pageName == $page){
            $pageCompo = "./pages/$page";
            break;
        }
    } 
    
    if(!isset($pageCompo)){
        $pageCompo = './pages/404.php';
    }
?>