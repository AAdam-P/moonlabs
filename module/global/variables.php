<?php 
global $userData;
global $cookieData;
global $postData;
global $getData;

if(isset($_POST)){
    foreach($_POST as $postName => $postVal){
        $postData[$postName] = $postVal;
    }
}

if(isset($_GET)){
    foreach($_GET as $getName => $getVal){
        $getData[$getName] = $getVal;
    }
}

if(isset($_COOKIE)){
    foreach($_COOKIE as $cookieName => $cookieVal){
        switch($cookieName){
            case 'f56m451':
                $cookieData['email'] = $cookieVal;
                break;
            case 'b87bm21':
                $cookieData['password'] = $cookieVal;
                break;
        }
    }
}
?>