<?php 
    include_once("../MoonLabs/module/global/dbconn.php");
    if(isset($_REQUEST['query'])){
        if(!empty($_REQUEST['query'])){
            if($_REQUEST['query'] == 'newUserJson'){
                $json = $_REQUEST['json'];
                if(!empty($json)){
                    if(!empty($json['first_name']) && !empty($json['last_name']) && !empty($json['password']) && !empty($json['email_address'])){
                        if(filter_var($json['email_address'], FILTER_VALIDATE_EMAIL) && strlen($json['password']) >= 8 && preg_match("/^[+]?[1-9][0-9]{9,14}$/", $json['phone_number'])){
                            $pw = password_hash($json['password'], PASSWORD_DEFAULT);
                            $query ='INSERT INTO `moonlabs`.`users` (`first_name`,`last_name`, `password`, `email_address`, `phone_number`) VALUES (?, ? , ?, ?, ?);';
                            $vals = array($json['first_name'], $json['last_name'], $pw, $json['email_address'], $json['phone_number']);
                            $err = manipulate_db_data($query, $vals);
                            if($err == ""){
                                $arr = get_db_data('SELECT `id`,`first_name`,`last_name`,`email_address`,`password` FROM moonlabs.users ORDER BY `id` desc;', array());
                                echo json_encode($arr[0],JSON_UNESCAPED_UNICODE);
                                //valamiért ha / jelet generál a hashnek a jelszó akkor beledob egy \ karaktert dunno why majd utána olvasok
                            }
                        }
                    }
                }

            }

        }
    }
?>