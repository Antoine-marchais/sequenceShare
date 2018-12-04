<?php
require(dirname(__FILE__)."/src/modules/manage_sequence.php");
require(dirname(__FILE__)."/src/modules/manage_members.php");
require(dirname(__FILE__)."/src/modules/manage_comments.php");

$primes = get_sequence("Prime numbers");
?>
<pre><?php print_r($primes); ?></pre>