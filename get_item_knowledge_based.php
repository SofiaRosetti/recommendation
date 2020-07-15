<?php
include 'db_connect.php';
if (isset($_POST["id_utente"])) {
  $input_user = $_POST['id_utente'];
  $input_user = intval($input_user);
  $input_disability = 2;
  // $item_target = $_POST['id_servizio'];
  $use_knowledge = $_POST['knowledge'];

  // carico la disabilità dell'utente
  $query_dis = $dbCon->prepare('SELECT disabilita FROM user100 WHERE id_utente = ?');
  $query_dis->execute(array($input_user));
  $res = $query_dis->fetchAll(PDO::FETCH_ASSOC);

  $input_disability = $res[0]['disabilita'];


  // carico i voti di ogni utente per ogni servizio
  $query_users = $dbCon->prepare('SELECT id_utente FROM user100');
  $query_users->execute(array());
  $users_id = $query_users->fetchAll(PDO::FETCH_ASSOC);

  $user_ratings = [];
  $query_services = $dbCon->prepare('SELECT id_servizio FROM service500');
  $query_services->execute(array());
  $services_id = $query_services->fetchAll(PDO::FETCH_ASSOC);
  foreach ($users_id as $idu) {

    $user = [];
    foreach ($services_id as $ids) {
      $query_ratings = $dbCon->prepare('SELECT rating FROM rating1000 WHERE id_servizio = ? AND id_utente = ?');
      $query_ratings->execute(array($ids['id_servizio'], $idu['id_utente']));
      $rating = $query_ratings->fetch(PDO::FETCH_ASSOC);
      if ($rating['rating'] != null) {
        $user[$ids['id_servizio']] = $rating['rating'];
      } else {
        $user[$ids['id_servizio']] = 0;
      }
    }
    $user_ratings[$idu['id_utente']] = $user;
  }

  $sum_ratings_service1 = 0;
  $count_ratings_service1 = 0;
  $sum_ratings_service2 = 0;
  $count_ratings_service2 = 0;

  $avg_ratings = [];
  $sum_ratings_service = 0;
  $count_ratings_service = 0;
  foreach ($services_id as $service) {
    foreach ($users_id as $usr) {
      $rating = $user_ratings[$usr['id_utente']][$service['id_servizio']];
      if ($rating != 0) {
        $sum_ratings_service += $rating;
        $count_ratings_service++;
      }
    }
    $avg = $sum_ratings_service / $count_ratings_service;
    $avg_ratings[$service['id_servizio']] = $avg;
  }

  $similarity = [];

  foreach ($services_id as $service1) {
    foreach ($services_id as $service2) {
      $both_users = [];
      foreach ($users_id as $u) {
        $rating1 = $user_ratings[$u['id_utente']][$service1['id_servizio']];
        $rating2 = $user_ratings[$u['id_utente']][$service2['id_servizio']];
        if ($rating1 != 0 && $rating2 != 0 && $service1['id_servizio'] != $service2['id_servizio']) {
          //  se entro qui significa che l'utente corrente ha votato entrambi i servizi
          array_push($both_users, $u);
        }
      }

      $numerator = 0;
      $denominator1 = 0;
      $denominator2 = 0;
      $denominator = 0;

      foreach ($both_users as $both) {
        $ru1 = $user_ratings[$both['id_utente']][$service1['id_servizio']];
        $ru2 = $user_ratings[$both['id_utente']][$service2['id_servizio']];
        $numerator1 = $ru1 - $avg_ratings[$service1['id_servizio']];
        $numerator2 = $ru2 - $avg_ratings[$service2['id_servizio']];
        $numerator += $numerator1 * $numerator2;
        $denominator1 += pow($numerator1, 2);
        $denominator2 += pow($numerator2, 2);
      }

      $denominator = sqrt($denominator1) * sqrt($denominator2);
      if ($denominator == 0) {
        $final_res = 0;
      } else {
        $final_res = $numerator / $denominator;
      }

      $similarity[$service1['id_servizio']][$service2['id_servizio']] = $final_res;

    }
  }

  // echo json_encode($similarity);

  $NN = [];
  for ($i = 1; $i <= count($similarity); $i++) {
    arsort($similarity[$i]);
    $NN[$i] = array_slice($similarity[$i], 0, 5, true);
    // echo "NN di "; echo json_encode($i); echo " => "; echo json_encode($NN[$i]);echo "\n";
  }


// DA QUI INIZIO CICLO SU TUTTI GLI ITEMS ANCORA NON VOTATI DALL'UTENTE TARGET

$stm = $dbCon->prepare('SELECT r.id_servizio FROM rating1000 as r
  INNER JOIN service500 as s ON s.id_servizio=r.id_servizio
  WHERE (s.tipo_disabilita = ? OR s.tipo_disabilita = 3) AND
s.id_servizio NOT IN (SELECT id_servizio FROM rating1000 WHERE id_utente = ?)
GROUP BY r.id_servizio;');
$string = [];
array_push($string, $input_disability);
array_push($string, $input_user);
$stm->execute($string);
$services_list = $stm->fetchAll(PDO::FETCH_ASSOC);

$list = [];
foreach($services_list as $i) {
  $item_target = $i['id_servizio'];
  // echo "<br />";echo json_encode($item_target);echo "<br />";
  if (count($NN[$item_target]) > 0) {
    $prediction_numerator = 0;
    $prediction_denominator = 0;
    $prediction = 0;
    $sum_current_ratings = 0;
    foreach ($NN[$item_target] as $neighbour => $value) {
      // echo "id servizio => ";echo json_encode($neighbour);echo "\n"; // ID servizio
      // echo "similarità con item 1 => ";echo json_encode($value);echo "\n"; // similarità
      // echo "rating utente per servizio corrente => ";echo json_encode($user_ratings[$input_user][$neighbour]);echo "\n";

      $current_rating = $user_ratings[$input_user][$neighbour];
      // echo "current rating => "; echo json_encode($current_rating);
      $sum_current_ratings += $current_rating;
      $prediction_numerator += $value * $current_rating;
      $prediction_denominator += $value;
    }

    if ($sum_current_ratings > 0) {
      if ($prediction_denominator != 0) {
        $prediction = $prediction_numerator / $prediction_denominator;
        $prediction = round($prediction);
      }

      // echo "<br />";echo "Predizione per servizio "; echo json_encode(intval($item_target));
      // echo " e utente "; echo json_encode($input_user); echo " => ";
      // echo json_encode($prediction);echo "<br />";

      $list[intval($item_target)] = $prediction;

    } else {
      if ($use_knowledge == 1) {
        // include 'get_knowledge_based.php';
      } else {
        // $empty = [];
        // echo json_encode($empty);
        // echo "<br />";echo "L'utente selezionato non ha votato nessun servizio simile";echo "<br />";
      }
    }
  } else {
    // knowledge based
    if ($use_knowledge == 1) {
      // include 'get_knowledge_based.php';
    } else {
      // $empty = [];
      // echo json_encode($empty);
      // echo "<br />";echo "Il servizio selezionato non ha nessun servizio simile (NN)";echo "<br />";
    }
  }
}
arsort($list);
// echo json_encode(array_keys($list));echo "<br />";
$list = array_slice($list, 0, 10, true);
if (empty($list) && $use_knowledge == 1) {
  include 'get_knowledge_based.php';
} else {
  echo json_encode(array_keys($list));
}


$stm = $dbCon->prepare('SELECT id_servizio, AVG(rating) as a FROM rating1000 GROUP BY id_servizio');
$stm->execute();
$avg = $stm->fetchAll(PDO::FETCH_ASSOC);

// echo json_encode(array_values($avg));
$services_avg_ratings = [];
foreach($avg as $a) {
  // echo json_encode($a['a']);
  $services_avg_ratings[$a['id_servizio']] = $a['a'];
}

// stampa dei rating medi
// echo json_encode($services_avg_ratings);echo "<br />";
// foreach(array_keys($list) as $l) {
//   $str = $services_avg_ratings[intval($l)];
  // echo (int)$str;echo ",";
  // echo json_encode(str_replace('"','',$str));
// }

// echo json_encode($avg['id_servizio']['a']);
}
