<?php
require(dirname(__FILE__).'/../src/modules/manage_comments.php');
require(dirname(__FILE__).'/../src/modules/manage_sequence.php');
$sequence = get_sequence($_GET["name"]);
$comments = get_comments($_GET["name"]);
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
            <div id="sequence">
                <div id="sequenceDescription">
                    <h2 class = "block-title"><?php echo $sequence["name"] ?></h2>
                    <p><?php echo $sequence["description"] ?></p>
                </div>
                <div id="sequenceBody">
                    <?php foreach($sequence["numbers"] as $number){echo '<ul class="number">'.$number.'</ul>';}?>
                </div>
            </div>
            <div id="comments">
                <h2>Comments</h2>
                <?php foreach($comments as $comment){
                    echo '<div class="comment"><h3>'.$comment["author"].'<span class="date">'.' - '.$comment["date"].'</span></h3>';
                    echo '<p>'.$comment["text"].'</p></div>';
                }?>
                <form method="POST" action="../src/modules/send_comment.php">
                    <textarea placeholder="Your comment here..." id="new-comment" name="new-comment"></textarea>
                    <input type="submit" value="commenter" id="send-comment" />
                </form>
            </div>
        </div>
        <?php include("../assets/footer.php"); ?>
    </body>
</html>