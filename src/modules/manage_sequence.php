<?php

//creating a new sequence in the db, linked to a member
function create_sequence($name,$pseudo,$description){
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
        "SELECT id FROM members WHERE pseudo=?"
    );
    $req->execute(array($pseudo));
    $id_member = ($req->fetch())['id'];
    
    $req = $bdd->prepare(
        "INSERT INTO sequences(member_id,name,description)
        VALUES(?,?,?)"
    );
    $req->execute(array($id_member,$name,$description));
}

//adding an array of numbers to an existing sequence
function add_numbers($sequence_name,$numbers){
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=sequenceShare;charset=utf8', 'root', 'root',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_PERSISTENT => TRUE));
        echo "connected ";
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    $req = $bdd->prepare(
        "SELECT id FROM sequences WHERE name=?"
    );
    $req->execute(array($sequence_name));
    $id_sequence = ($req->fetch())['id'];
    $req = $bdd->prepare(
        "SELECT MAX(sequence_idx) FROM numbers WHERE sequence_id = ?"
    );
    $req->execute(array($id_sequence));
    $res = ($req->fetch())["MAX(sequence_idx)"];
    $idx = is_null($res)? 0 : $res;   
    foreach($numbers as $number){
        $req = $bdd->prepare(
            "INSERT INTO numbers(value,sequence_idx,sequence_id)
            VALUES(?,?,?)"
        );
        $req->execute(array($number,$idx,$id_sequence)); 
        $idx+=1;
    }
}
?>