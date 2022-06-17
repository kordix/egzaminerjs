<?php
require_once 'db.php';

class dummy {

}

try{
$sth = $dbh->prepare("SELECT * FROM settings where id = 1");
}catch(Exception $e){
    echo $e->getMessage();
    return http_response_code(500);
}finally{
    $sth->execute();
    $rows = $sth->fetchAll(PDO::FETCH_CLASS, "dummy");
    echo json_encode($rows);

}



 ?>


