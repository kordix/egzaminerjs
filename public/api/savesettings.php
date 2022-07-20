<?php
//if($_SERVER['REQUEST_METHOD'] != 'POST') return;

require_once('db.php');

//replace
$dane = json_decode(file_get_contents('php://input'));

$tabela = $dane->tabela;
//$id = $dane->id;

$kwerenda='';

if ($dane->random == '') {
    $dane->random = 0;
}

foreach ($dane->dane as $key => $value) {
    $kwerenda .= $key;
    $kwerenda .= '=';
    $kwerenda .= "'".$value."'";
    $kwerenda .= ',';
}

$kwerenda = substr($kwerenda, 0, -1);
$query = "UPDATE settings SET $kwerenda WHERE id=1";
$sth = $dbh->prepare($query);

if ($sth->execute() ==false) {
    echo 'nie udało się';
}


$query = "UPDATE settings SET random  = $dane->random";
$sth = $dbh->prepare($query);

if ($sth->execute() ==false) {
    echo 'nie udało się';
}

//replace

?>



