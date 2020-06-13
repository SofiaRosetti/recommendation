<?php
include 'db_connect.php';
if (isset($_POST["id_utente"])) {
  $input_user = $_POST['id_utente'];
  $input_user = intval($input_user);
  $item_target = $_POST['id_servizio'];
  $use_knowledge = $_POST['knowledge'];

  // carico i voti di ogni utente per ogni servizio
  $query_users = $dbCon->prepare('SELECT id_utente FROM user100');
  $query_users->execute(array());
  $users_id = $query_users->fetchAll(PDO::FETCH_ASSOC);

  $user_ratings = [];
  foreach ($users_id as $idu) {

    $query_services = $dbCon->prepare('SELECT id_servizio FROM service500');
    $query_services->execute(array());
    $services_id = $query_services->fetchAll(PDO::FETCH_ASSOC);
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

  $NN = [];
  for ($i = 1; $i <= count($similarity); $i++) {
    arsort($similarity[$i]);
    $NN[$i] = array_slice($similarity[$i], 0, 5, true);
    // echo "NN di "; echo json_encode($i); echo " => "; echo json_encode($NN[$i]);echo "\n";
  }
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

      echo "Predizione per servizio "; echo json_encode(intval($item_target));
      echo " e utente "; echo json_encode($input_user); echo " => ";
      echo json_encode($prediction);echo "\n";
    } else {
      if ($use_knowledge == 1) {
        include 'get_knowledge_based.php';
      } else {
        echo "L'utente selezionato non ha votato nessun servizio simile";echo "\n";
      }
    }
  } else {
    // knowledge based
    if ($use_knowledge == 1) {
      include 'get_knowledge_based.php';
    } else {
      echo "Il servizio selezionato non ha nessun servizio simile (NN)";echo "\n";
    }
  }
}
