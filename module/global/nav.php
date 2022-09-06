<?php 
    include_once("../MoonLabs/module/global/dbconn.php");
    $matchedUser = false;
    $matchedUserId = 0;
    $cookieUmail = "";
    $cookieUpasswd = "";
    // Ha átírnák a sütit, így egyből kidobja őket, jogosultság hamisítás ellen, lehetne benne alapból ipban is ha túl sok fail login erről az eszközről
    if(isset($postData) || isset($cookieData)){
        if(!empty($cookieData)){
            if(isset($cookieData['email']) && isset($cookieData['password'])){
                $getQuery = "SELECT * FROM `moonlabs`.`users`;";
                $getVars = array();
                $users = get_db_data($getQuery,$getVars);
                if(!empty($users)){
                    if(is_array($users)){
                        foreach($users as $user){
                            if($cookieData['email'] == md5($user['email_address']) && $cookieData['password'] == $user['password']){
                                $matchedUser = true;
                                $cookieData['userid'] = $user['id'];
                                $cookieData['email'] = md5($user['email_address']);
                                $cookieData['password'] = $user['password'];
                                break;
                            }
                        }
                    }
                }
            }
        }
    }
    if(!$matchedUser){
        setcookie('f56m451', null, time()-3600); 
        setcookie('b87bm21', null, time()-3600); 
        echo '<script>location.reload();</script>';
    }
?>
<?php if($matchedUser):?>
<div id="navigation">
    <table class="infoT">
        <tr>
            <th id="logOut" title="Kilépéshez kattintson ide.">Kilépés<th>
        </tr>
    </table>
</div>
<?php endif; ?>