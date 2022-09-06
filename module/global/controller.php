<?php 
if(!isset($cookieData['username']) && !isset($cookieData['password'])){
    include_once("../MoonLabs/module/subsets/login.php");
    if(!isset($_REQUEST['umail'])){
        include_once("../MoonLabs/module/global/header.php");
        include_once("../MoonLabs/view//login.php");
        include_once("../MoonLabs/module/global/footer.php");
        include_once("../MoonLabs/module/global/dbconn.php");
    }
}
else /*if(!isset($postData['request']))*/{
    if(isset($_REQUEST['query'])){
        if($_REQUEST['query']  == 'logout'){
            setcookie('f56m451', '', time() - 1);
            setcookie('b87bm21', '', time() - 1);
            echo 'Hasta la vista, baby!';
            exit;
        }
    }
    if(!isset($_REQUEST['query'])){
        include_once("../MoonLabs/module/global/header.php");
        include_once("../MoonLabs/module/global/nav.php");
        if(!isset($getData['menu'])){
            include_once("../MoonLabs/view/list/homepage.php");
        }
    }
    if(isset($getData['menu'])){
        switch($getData['menu']){
            case 'parcel':
                if(isset($_REQUEST['query'])){include_once("../MoonLabs/module/subsets/list/parcel.php");}
                if(!isset($_REQUEST['query'])){include_once("../MoonLabs/view/list/parcel.php");}
                break;
            case 'parcels':
                if(isset($_REQUEST['query'])){include_once("../MoonLabs/module/subsets/form/addparcel.php");}
                if(!isset($_REQUEST['query'])){include_once("../MoonLabs/view/list/addparcel.php");}
                break;
            case 'users':
                if(isset($_REQUEST['query'])){include_once("../MoonLabs/module/subsets/list/users.php");}
                if(!isset($_REQUEST['query'])){include_once("../MoonLabs/view/list/users.php");}
                break;
            case 'newuser':
                if(isset($_REQUEST['query'])){include_once("../MoonLabs/module/subsets/form/newuser.php");}
                if(!isset($_REQUEST['query'])){include_once("../MoonLabs/view/list/newuser.php");}
                break;
            default:
                include_once("../MoonLabs/view/list/404.php");
                break;
        }
    }
    /*else if(isset($getData) && $getData != 'menu' && $getData != 'query'){
        include_once("../MoonLabs/view/list/404.php");
    }*/
}

?>