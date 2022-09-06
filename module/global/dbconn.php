<?php 
function connect_db(){
    global $warning_msg;
    global $db_link;

    $dbhost = "127.0.0.1";
    $dbname = "moonlabs";
    $dbUserName = "root";
    $dbpasswd = "";
    try{
        $db_link = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbUserName, $dbpasswd);
    }
    catch(PDOException $e){
        $warning_msg .= 'Connection failed' . $e->getMessage() . '<br>';
        return false;
    }
    return true;
}


function close_db_connection(){
    $db_link = NULL;
}

function get_db_data($query, $vars = array(),$pdoReturnMode = PDO::FETCH_ASSOC){
    global $db_link;
    global $warning_msg;
    if(connect_db()){
        try{
            $statement = $db_link -> prepare($query);
            $statement->execute($vars);
            $warning_msg = $statement ->fetchAll($pdoReturnMode);
        }
        catch(PDOException $e){
            $warning_msg .= 'PDOException: '.$e->getMassage().',<br>';
        }
        close_db_connection();
        return $warning_msg;
    }
    else{
        $warning_msg .= 'Adatbázis kapcsolódási hiba: <br>';
    }
    return $warning_msg;
}

function manipulate_db_data($query, $vars = array(), $counterRequired = false, $connectionIsDefined = false) {
    global $db_link;
    global $warning_msg;
    $respone = NULL;

    if(empty($vars)){
        for($i = 0; substr_count($query, '?'); $i++){
            $vars[] = '';
        }
    }
    if($connectionIsDefined){
        try{
            $statement = $db_link -> prepare($query);
            $statement -> execute($vars);
        }
        catch(PDOException $e){
           $warning_msg .= 'PDOe: '. $e->getMassage() . '<br>';
        }
        close_db_connection();
        if($counterRequired){
            $respone = !empty($warning_msg) ? $warning_msg : $statement ->rowCount();
        }
        return !empty($warning_msg) ? $warning_msg : $respone;
    }
    else{
        if(connect_db()){
            try{
                $statement = $db_link -> prepare($query);
                $statement -> execute($vars);
            }
            catch(PDOException $e){
                $warning_msg .= 'PDOe: '. $e->getMassage() . '<br>';
            }
            close_db_connection();
        if($counterRequired){
            $respone = !empty($warning_msg) ? $warning_msg : $statement ->rowCount(); 
        }
        return !empty($warning_msg) ? $warning_msg : $respone;
        }
        else{
            $warning_msg .= 'Adatbázis kapcsolódási hiba: <br>';
        }
    }
    return $warning_msg;
}


?>