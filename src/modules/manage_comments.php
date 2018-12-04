<?php
require_once("db_auth.php");

//getting comments of a sequence
function get_comments($sequence_name){
    $bdd = connect_db();
    $req = $bdd->prepare(
        "SELECT c.* FROM comments c INNER JOIN sequences s
        ON c.sequence_id = s.id WHERE s.name = ?"
    );
    $req->execute(array($sequence_name));
    $comments = array();
    while ($comment = $req->fetch()){
        $comments[] = $comment;
    }
    close_db($bdd);
    return $comments;
}

//adding a comment on a sequence
function add_comment($text,$member_pseudo,$sequence_name){
    $bdd = connect_db();
    $req = $bdd->prepare(
        "SELECT id FROM sequences WHERE name = ?"
    );
    $req->execute(array($sequence_name));
    $sequence_id = ($req->fetch())["id"];
    $req = $bdd->prepare(
        "SELECT id FROM members WHERE pseudo = ?"
    );
    $req->execute(array($member_pseudo));
    $member_id = ($req->fetch())["id"];
    $req = $bdd->prepare(
        "INSERT INTO comments(sequence_id,member_id,content)
        VALUES(?,?,?)"
    );
    $req->execute(array($sequence_id,$member_id,$text));
    close_db($bdd);
}