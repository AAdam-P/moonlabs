<?php 
    include_once("../MoonLabs/module/global/dbconn.php");
    if(isset($_REQUEST['query'])){
        if(!empty($_REQUEST['query'])){
            if($_REQUEST['query'] == 'getUsers'){
                $arr = get_db_data('SELECT `id`,`first_name`,`last_name`,`email_address` FROM moonlabs.users;', array());
                echo json_encode($arr, JSON_UNESCAPED_UNICODE);
            }
        }
    }
?>