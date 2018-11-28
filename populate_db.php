<?php
//connecting to the db
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
//inserting two new members
$req = $bdd->prepare(
    "INSERT INTO members(mail,pseudo,first_name,last_name,pwd_hash)
    VALUES('dumb@gmail.com','george33','Georges','Fabius',?)"
);
$req->execute(array(password_hash("123456",PASSWORD_DEFAULT)));

$req = $bdd->prepare(
    "INSERT INTO members(mail,pseudo,first_name,last_name,pwd_hash)
    VALUES('rand@hotmail.fr','johndoe','John','Doe',?)"
);
$req->execute(array(password_hash("azertyiop",PASSWORD_DEFAULT)));

//creating a new sequence for John Doe
$res = $bdd->query(
    "SELECT id FROM members WHERE pseudo='johndoe'"
);
$id = ($res->fetch())['id'];

$req = $bdd->prepare(
    "INSERT INTO sequences(member_id,name,description)
    VALUES(?,'Prime numbers','A list of prime numbers')"
);
$req->execute(array($id));

//declaring helper functions for generating prime numbers
function anyDivides($testedNumber,$testNumbers){
    $divides = FALSE;
    foreach($testNumbers as $test){
        if($testedNumber%$test == 0){
            $divides = TRUE;
        }
    }
    return $divides;
}

function nextPrime($primes){
    $current = $primes[count($primes)-1]+2;
    while (anyDivides($current,$primes)) {
        $current += 2;
    }
    return $current;
}

//generating the list of primes
$primes = array(2,3);
$lastPrime = nextPrime($primes);

$roof = 10000;
while ($lastPrime<$roof){
    $primes[] = $lastPrime;
    $lastPrime = nextPrime($primes);
}

//inserting those primes in the db
$idx=0;
$res = $bdd->query(
    "SELECT id FROM sequences WHERE name='Prime numbers'"
);
$id = ($res->fetch())['id'];

foreach($primes as $prime){
    $req = $bdd->prepare(
        "INSERT INTO numbers(value,sequence_idx,sequence_id)
        VALUES(?,?,?)"
    );
    $req->execute(array($prime,$idx,$id)); 
    $idx+=1;
}
echo "done";
?>