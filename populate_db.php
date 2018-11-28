<?php
include(dirname(__FILE__)."/src/modules/manage_sequence.php");
include(dirname(__FILE__)."/src/modules/manage_members.php");

//inserting two new members
create_member('dumb@gmail.com','george33','Georges','Fabius','123456');
create_member('rand@hotmail.fr','johndoe','John','Doe','azertyuiop');

//creating a new sequence for John Doe
create_sequence("Prime numbers","johndoe","This is a list of prime numbers");

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
add_numbers("Prime numbers",$primes);

echo "done";
?>