<?php
// include 'db_connect.php';
include 'get_user_NN.php';

if (isset($_POST["id_utente"])) {
  $input_user = $_POST['id_utente'];
  $NN = getNN($input_user);
  echo json_encode($NN);
}
