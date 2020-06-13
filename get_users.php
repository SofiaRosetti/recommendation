<?php
include 'db_connect.php';

$sql = $dbCon->prepare("SELECT id_utente FROM user100");
$sql->execute(array());
$users = $sql->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($users);
