<?php 
include_once("../MoonLabs/module/global/dbconn.php");
$matchedUser=false;
$matchedUserId = 0;
$cookieUmail = "";
$cookieUpasswd = "";

if(isset($postData) || isset($cookieData)){ 
    if(!empty($postData) || !empty($cookieData)){
        if(isset($postData['umail']) && isset($postData['upass'])){
            $getQuery = "SELECT * FROM `moonlabs`.`users`;";
            $getVars = array();
            $users = get_db_data($getQuery,$getVars);
            if(!empty($users)){
                if(is_array($users)){
                    foreach($users as $user){
                        if($postData['umail'] == $user['email_address'] && password_verify($postData['upass'],$user['password'])){
                            $matchedUser = true;
                            $matchedUserId = $user['id'];
                            $cookieUmail = md5($user['email_address']);
                            //$cookieUpasswd = $postData['upass'];
                            $cookieUpasswd = $user['password'];
                            break;
                        }
                    }
                    if($matchedUser){
                        setcookie('f56m451', $cookieUmail, time() + 43200);
                        setcookie('b87bm21', $cookieUpasswd, time() + 43200);
                        echo 'OK';
                    }
                    else{
                        $msg = array('type' => 'error', "text"=> "Hibás felhasználó vagy jelszó!");
                        echo $msg['text'];
                        exit;
                    }
                }
            }
        }
    }
}
?>
