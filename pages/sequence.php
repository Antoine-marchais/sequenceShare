<?php
require(dirname(__FILE__).'/../src/modules/manage_comments.php');
require(dirname(__FILE__).'/../src/modules/manage_sequence.php');
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
        <div id="content">
            <div id="sequence">
                <?php $sequence = get_sequence($_GET["name"]); ?>
                <div id="sequenceDescription">
                </div>
                <div id="sequenceBody">
                    <?php foreach($sequence["numbers"] as $number){echo '<ul class="number">'.$number.'</ul>';}?>
                </div>
            </div>
            <div id="comments">
                <p>I wrote somthing in the comments</p>
            </div>
        </div>
        <?php include("../assets/footer.php"); ?>
    </body>
</html>