<?php
require(dirname(__FILE__).'/../src/modules/manage_members.php');
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../src/css/style.css" />
        <title>Sequence</title>
    </head>
    <body>
        <?php include("../assets/header.php"); ?>
        <div class="content">
            <form method="POST" action="create_member.php">
                <h1>Please fill in these informations to create a new account</h1>
                <input type="text" id="firstname" name="firstname"><label for="firstname">First name</label>
                <input type="text" id="lastname" name="lastname"><label for="lastname">Last name</label>
                <input tupe="text" id="mail" name="mail"><label for="mail">Mail address</label>
                <input type="text" id="pseudo" name="pseudo"><label for="pseudo">Pseudo</label>
                <input type="text" id="pwd" name="pwd"><label for="pseudo">Pseudo</label>
            </form>
        </div>
        <?php include("../assets/footer.php"); ?>
    </body>
</html>