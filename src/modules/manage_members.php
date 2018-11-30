<?php
require_once("db_auth.php");
//creating a new member
function create_member($mail,$pseudo,$first_name,$last_name,$pwd){
    $bdd = connect_db();
    $req = $bdd->prepare(
        "INSERT INTO members(mail,pseudo,first_name,last_name,pwd_hash)
        VALUES(?,?,?,?,?)"
    );
    $req->execute(array($mail,$pseudo,$first_name,$last_name,password_hash($pwd,PASSWORD_DEFAULT)));
    close_db($bdd);
}
?>