<?php
//if($_SERVER['REQUEST_METHOD'] != 'POST') return;

require_once 'db.php';


$dane = json_decode(file_get_contents('php://input'));

#$tabela = $dane->tabela;

class dummy {

}

//REPLACE
try{
$sth = $dbh->prepare("SELECT * FROM questions q");
}catch(Exception $e){
    echo $e->getMessage();
    return http_response_code(500);
}finally{
    $sth->execute();
    $rows = $sth->fetchAll(PDO::FETCH_CLASS, "dummy");
    echo json_encode($rows);

}



 ?>


