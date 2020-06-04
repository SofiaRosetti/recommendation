<?php
include 'db_connect.php';
if (isset($_POST["id_utente"])) {
  $input_user = $_POST['id_utente'];
  $item_target = $_POST['id_servizio'];

  // carico le categorie preferite dall'utente
  $query_cat = $dbCon->prepare('SELECT id_categoria FROM user_category WHERE id_utente = ?');
  $query_cat->execute(array($input_user));
  $categories = $query_cat->fetchAll(PDO::FETCH_ASSOC);

  // echo json_encode($categories);
  $cat_values = [];
  foreach ($categories as $cat) {
    array_push($cat_values, (intval($cat['id_categoria'])));
  }

  // carico gli item da consigliare
  $placeholders = array_fill(0, count($cat_values), '?');
  $query_items = $dbCon->prepare('SELECT r.id_servizio, s.id_categoria FROM rating1000 as r
    INNER JOIN service40 as s ON s.id_servizio=r.id_servizio
    WHERE s.id_categoria IN ('.implode(',', $placeholders).') AND s.disabilita = 1
    AND r.id_servizio
    NOT IN (SELECT id_servizio FROM rating1000 WHERE id_utente = ?) GROUP BY r.id_servizio');
  $string = [];
  foreach ($cat_values as $c) {
    array_push($string, $c);
  }
  array_push($string, $input_user);
  $query_items->execute($string);
  $itemsToSuggest = $query_items->fetchAll(PDO::FETCH_ASSOC);
  $showing_list = [];
  foreach ($itemsToSuggest as $i) {
    array_push($showing_list, intval($i['id_servizio']));
  }

  if (empty($showing_list)) {
    echo "L'utente ha già votato tutti i servizi presenti nelle categorie preferite";
  } else {
    echo "Servizi consigliati per utente "; echo json_encode(intval($input_user));
    echo " => "; echo json_encode($showing_list);
  }

}
