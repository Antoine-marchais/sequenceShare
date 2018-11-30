<?php
require_once(dirname(__FILE__)."/src/modules/manage_sequence.php");
require_once(dirname(__FILE__)."/src/modules/manage_members.php");

$primes = get_sequence("Prime numbers");
print_r($primes);
?>