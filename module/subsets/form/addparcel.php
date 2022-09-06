<?php 
    include_once("../MoonLabs/module/global/dbconn.php");
    if(isset($_REQUEST['query'])){
        if(!empty($_REQUEST['query'])){
            if($_REQUEST['query'] == 'parcels'){
                $json = $_REQUEST['json'];
                $validid= false;
                $users = get_db_data('SELECT `id`,`first_name`,`last_name`,`email_address` FROM moonlabs.users ORDER BY `id` desc;', array());
                $parcels = get_db_data('SELECT * FROM moonlabs.parcels;', array());
                if($json['size'] == 'S' || $json['size'] == 'M' || $json['size'] == 'L'){
                    foreach($users as $user){
                        if($json['user_id'] == $user['id']){
                            $validid = true;
                        }
                    }
                    if($validid){
                        $packageNumber = bin2hex(openssl_random_pseudo_bytes(10));
                        foreach($parcels as $parcel){
                            if($parcel['parcel_number'] == $packageNumber){
                                $packageNumber = bin2hex(openssl_random_pseudo_bytes(10));
                                //sokkal jobban is le lehetne ezt kezelni, csak annyit szerettem volna, hogy biztos ami biztos ne lehessen két ugyanolyan hexa packagenm
                                //lehetne egy while vagy valami ciklus ami addig pörög amíg nem generál egy jó hasht
                            }
                        }
                        $query ='INSERT INTO `moonlabs`.`parcels` (`parcel_number`, `size`, `user_id`) VALUES (?, ? , ?);';
                        $vals = array($packageNumber, $json['size'], $json['user_id']);
                        $err = manipulate_db_data($query, $vals);
                        $arr = get_db_data('SELECT `id`,`parcel_number`,`size` FROM `moonlabs`.`parcels` ORDER BY `id` desc;', array());
                        $returnJson = $arr[0]; 
                        foreach($users as $user){
                            if($user['id'] == $json['user_id']){
                                $returnJson['user'] = $user;
                            }
                        }
                        echo json_encode($returnJson, JSON_UNESCAPED_UNICODE);
                    }
                    else{
                        echo 'Nem létezik ilyen felhasználó.';
                    }
                }
                else{
                    echo 'Rossz méret.';
                }
            }
        }
    }
?>