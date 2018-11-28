<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=sequenceShare;charset=utf8', 'root', 'root',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    echo "connected ";
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$bdd->exec(
    "INSERT INTO members(mail,pseudo,first_name,last_name,pwd_hash)
    VALUES('dumby@gmail.com','george33','Georges','Fabius','lkjqhsldkjbvkqjhsgvbqsf')"
);
echo "done"
?>