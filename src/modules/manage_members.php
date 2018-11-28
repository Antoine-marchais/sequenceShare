<?php
//creating a new member
function create_member($mail,$pseudo,$first_name,$last_name,$pwd){
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=sequenceShare;charset=utf8', 'root', 'root',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_PERSISTENT => TRUE));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $req = $bdd->prepare(
        "INSERT INTO members(mail,pseudo,first_name,last_name,pwd_hash)
        VALUES(?,?,?,?,?)"
    );
    $req->execute(array($mail,$pseudo,$first_name,$last_name,password_hash($pwd,PASSWORD_DEFAULT)));
}
?>