<?php 
    include_once("../MoonLabs/module/global/dbconn.php");
    if(isset($_REQUEST['query'])){
        if(!empty($_REQUEST['query'])){
            if($_REQUEST['query'] == 'getParcel'){
                if(strlen($_REQUEST['parcel']) == 10){
                    $getQuery = "SELECT * FROM `moonlabs`.`parcels`;";
                    $getVars = array();
                    $parcels = get_db_data($getQuery,$getVars);
                    $getQueryU = "SELECT `id`,`first_name`,`last_name`,`email_address`,`phone_number` FROM `moonlabs`.`users`;";
                    $getVarsU = array();
                    $users = get_db_data($getQueryU,$getVarsU);
                    $dataFound = false;
                    $user = "";
                    foreach($parcels as $parcel){
                        if($parcel['parcel_number'] == $_REQUEST['parcel']){
                            $dataFound = true;
                            $json = $parcel;
                            $id = $parcel['user_id'];
                            unset($json['user_id']);
                            foreach($users as $user){
                                if($user['id'] == $id){
                                    $json['user'] = $user;
                                }
                            }
                        }
                    }
                    if(!$dataFound){
                        echo 'Nem találtunk ilyen csomagot.';
                    }
                    else{
                        echo json_encode($json, JSON_UNESCAPED_UNICODE);
                    }
                }
                else{
                    echo 'Nem megfelelő a csomaghossz!';
                }
            }
        }
    }
?>