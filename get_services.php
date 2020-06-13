<?php
include 'db_connect.php';

$sql = $dbCon->prepare("SELECT id_servizio FROM service500 WHERE disabilita = true");
$sql->execute(array());
$items = $sql->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($items);
