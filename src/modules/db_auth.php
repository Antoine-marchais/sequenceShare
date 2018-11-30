<?php
//connecting the db
function connect_db(){
    try
    {
        global $db;
        $db = new PDO('mysql:host=localhost;dbname=sequenceShare;charset=utf8', 'root', 'root',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_PERSISTENT => TRUE));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    return $db;
}

//disconnecting the db
function close_db($bdd){
    $bdd=null;
}
?>