<?php
require_once("db_auth.php");
//creating a new sequence in the db, linked to a member
function create_sequence($name,$pseudo,$description){
    $bdd = connect_db();
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
    close_db($bdd);
}

//adding an array of numbers to an existing sequence
function add_numbers($sequence_name,$numbers){
    $bdd = connect_db();
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
    close_db($bdd);
}

//returning numbers of a sequence
function get_sequence($name){
    $bdd = connect_db();
    $req = $bdd->prepare(
        "SELECT * FROM sequences WHERE name = ?"
    );
    $req->execute(array($name));
    $res = $req->fetch();
    $sequence = array(
        "name"=> $res["name"],
        "description"=> $res["description"],
        "numbers"=> array());
    $req = $bdd->prepare(
        "SELECT * FROM numbers WHERE sequence_id = ?"
    );
    $req->execute(array($res["id"]));
    while ($res=$req->fetch()){
        $sequence["numbers"][] = $res['value'];
    }
    $req = $bdd->prepare(
        "SELECT pseudo FROM members WHERE id=?"
    );
    $req->execute(array($res["member_id"]));
    $sequence["author"] = ($req->fetch())["pseudo"];
    close_db($bdd);
    return $sequence;
}
?>