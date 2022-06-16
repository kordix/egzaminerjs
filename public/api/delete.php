<?php
require_once 'db.php';

$data = json_decode(file_get_contents("php://input"));
$tabela = $data->tabela;
$id = $data->id;


$sth = $dbh->prepare("DELETE FROM $tabela WHERE id=$id");
$sth->execute();




 ?>
