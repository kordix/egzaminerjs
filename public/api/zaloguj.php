<?php
if($_SERVER['REQUEST_METHOD'] != 'POST') return;
session_start();

require_once 'db.php';

// $dbh = null;

$dane = json_decode(file_get_contents('php://input'));

$login = $dane->login;
$password = md5($dane->password);

if(!isset($dbh)){
    return;
}

$query_run = $dbh->prepare("SELECT * FROM users where login = '$login' and password = '$password'");
$query_run->execute();

class dummy {}

$rows = $query_run->fetchAll(PDO::FETCH_CLASS, "dummy");


//print_r($rows);
if(count($rows)>0){
    $_SESSION['zalogowany'] = true;
    $_SESSION['login'] = $rows[0]->login;
    echo 'ZALOGOWANY';
}else{
    echo 'BADLOGIN';
}


//echo json_encode($rows[0]);





?>