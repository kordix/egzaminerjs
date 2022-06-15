<?php
if($_SERVER['REQUEST_METHOD'] != 'POST') return;

require_once('db.php');

//replace
$dane = json_decode(file_get_contents('php://input'));

$counter = $dane->counter;
$questionid = $dane->questionid;
$userid = $dane->userid;

//$query = "UPDATE results SET counter = $counter WHERE question_id = $questionid and `user_id` = $userid";
$query = "UPDATE questions SET counter = $counter WHERE id = $questionid";

echo $query;

$sth = $dbh->prepare($query);

//replace
if($sth->execute() ==false ){
      echo 'nie udało się';
    }
?>



