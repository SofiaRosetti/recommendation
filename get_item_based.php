<?php
include 'db_connect.php';
if (isset($_POST["id_utente"])) {
  $input_user = $_POST['id_utente'];
  $input_user = intval($input_user);

  // carico i voti di ogni utente per ogni servizio
  $query_users = $dbCon->prepare('SELECT id_utente FROM user');
  $query_users->execute(array());
  $users_id = $query_users->fetchAll(PDO::FETCH_ASSOC);

  $user_ratings = [];
  foreach ($users_id as $idu) {

    $query_services = $dbCon->prepare('SELECT id_servizio FROM service');
    $query_services->execute(array());
    $services_id = $query_services->fetchAll(PDO::FETCH_ASSOC);
    // echo json_encode($services_id);
    $user = [];
    foreach ($services_id as $ids) {
      $query_ratings = $dbCon->prepare('SELECT rating FROM rating WHERE id_servizio = ? AND id_utente = ?');
      $query_ratings->execute(array($ids['id_servizio'], $idu['id_utente']));
      $rating = $query_ratings->fetch(PDO::FETCH_ASSOC);
      if ($rating['rating'] != null) {
        // echo json_encode($rating);echo "\n";
        $user[$ids['id_servizio']] = $rating['rating'];
        // $user_ratings[$ids['id_servizio']][$idu['id_utente']] = $rating['rating'];
      } else {
        $user[$ids['id_servizio']] = 0;
        // $user_ratings[$ids['id_servizio']][$idu['id_utente']] = 0;
      }
    }
    $user_ratings[$idu['id_utente']] = $user;
  }

  // echo json_encode($user_ratings);echo "\n";
  // echo json_encode($services_id);

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
    // echo json_encode($avg); echo "\n";
    $avg_ratings[$service['id_servizio']] = $avg;
  }

  // echo json_encode($avg_ratings);echo "\n";echo "\n";

  $similarity = [];

  foreach ($services_id as $service1) {
    foreach ($services_id as $service2) {
      // echo json_encode($service1['id_servizio']);
      // echo json_encode($service2['id_servizio']);echo "\n";
      // echo "servizio "; echo json_encode($service1['id_servizio']); echo " e ";
      // echo "servizio "; echo json_encode($service2['id_servizio']); echo "\n";
      $both_users = [];
      foreach ($users_id as $u) {
        $rating1 = $user_ratings[$u['id_utente']][$service1['id_servizio']];
        $rating2 = $user_ratings[$u['id_utente']][$service2['id_servizio']];
        if ($rating1 != 0 && $rating2 != 0 && $service1['id_servizio'] != $service2['id_servizio']) {
          //  se entro qui significa che l'utente corrente ha votato entrambi i servizi
          array_push($both_users, $u);

          // echo json_encode($u);echo "\n";
          // echo "servizio "; echo json_encode($service1); echo "  "; echo json_encode($rating1);echo "\n";
          // echo "servizio "; echo json_encode($service2); echo "  "; echo json_encode($rating2);echo "\n";echo "\n";

        }
      }
      // echo json_encode($both_users);

      // if (!isset($similarity[$service1['id_servizio']][$service2['id_servizio']]) ||
      // !isset($similarity[$service2['id_servizio']][$service1['id_servizio']])) {
        // echo "ciao\n";

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
          // echo json_encode($numerator);echo "\n";
        }

        $denominator = sqrt($denominator1) * sqrt($denominator2);
        if ($denominator == 0) {
          $final_res = 0;
        } else {
          $final_res = $numerator / $denominator;
        }

        $similarity[$service1['id_servizio']][$service2['id_servizio']] = $final_res;
        // echo json_encode($final_res);echo "\n";
        // if ($service1['id_servizio'] == 1 && $service2['id_servizio'] == 5) {
        //   echo json_encode($final_res);echo "\n";echo "\n";
        // }
      // }
    }
  }

  // echo json_encode($similarity);echo "\n";echo "\n";
  // foreach ($similarity as $sim) {
  //   echo json_encode($sim);echo "\n";echo "\n";
  // }
  // for ($i = 1; $i <= count($similarity); $i++) {
  //   for ($j = 1; $j <= count($similarity); $j++) {
  //     echo json_encode($similarity[$i][$j]);echo "\n";
  //   }
  // }
  // $i = 1; $j = 4;
  // echo json_encode($similarity[$i][$j]);echo "\n";
  // echo json_encode($similarity[1][5]);echo "\n";
  // echo json_encode($similarity[5][1]);echo "\n";
  // echo json_encode($similarity[40][7]);echo "\n";
  // echo json_encode($similarity[7][5]);echo "\n";
  // echo json_encode($similarity[31][17]);echo "\n";
  // echo json_encode($similarity[17][31]);echo "\n";
  // echo json_encode(count($similarity));echo "\n";

  // foreach ($services_id as $s1) {
  //   foreach ($services_id as $s2) {
  //     echo json_encode($similarity[$s1['id_servizio']][$s2['id_servizio']]);echo "\n";
  //   }
  // }

  $NN = [];
  for ($i = 1; $i <= count($similarity); $i++) {
    // echo json_encode($similarity[$i]);echo "\n";echo "\n";
    arsort($similarity[$i]);
    // echo json_encode($similarity[$i]);echo "\n";echo "\n";echo "\n";echo "\n";
    $NN[$i] = array_slice($similarity[$i], 0, 5, true);
    // echo json_encode($NN[$i]);echo "\n";echo "\n";
  }

  $item_target = 6;
  $prediction_numerator = 0;
  $prediction_denominator = 0;
  $prediction = 0;
  foreach ($NN[$item_target] as $neighbour => $value) {
    // echo "id servizio => ";echo json_encode($neighbour);echo "\n"; // ID servizio
    // echo "similarità con item 1 => ";echo json_encode($value);echo "\n"; // similarità
    // echo "rating utente per servizio corrente => ";echo json_encode($user_ratings[$input_user][$neighbour]);echo "\n";

    $current_rating = $user_ratings[$input_user][$neighbour];
    $prediction_numerator += $value * $current_rating;
    $prediction_denominator += $value;
  }

  if ($prediction_denominator != 0) {
    $prediction = $prediction_numerator / $prediction_denominator;
    $prediction = round($prediction);
  }


  echo "prediction per item 1 - utente 1 => ";echo json_encode($prediction);echo "\n";




  // faccio un ciclo in cui scorro tutti i servizi in modo da considerare
  // ogni coppia di servizi, e controllo per ogni utente se i voti nella
  // posizione dell'array corrispondente sono != 0 -> se sì significa
  // che l'utente in questione li ha votati entrambi
  // in questo caso allora faccio 2 cicli:
  // 1) nel primo calcolo la media dei voti per la
  // 2) nel secondo calcolo la media dei voti per lb
  // faccio un ciclo per tutti gli utenti per calcolare la formula:
  //    -> 1) voto utente per la - media voti per la
  //       2) voto utente per lb - media voti per lb
  //       3) numeratore += 1) x 2)
  //       4) potenza numeratore la
  //       5) potenza numeratore lb
  // fuori dal ciclo calcolo denominatore con radici quadrate
  // calcolo risultato finale della frazione

  // rispetto all'item target, prendo i 5 item più simili ordinando7
  // l'array ottenuto in precedenza e troncandolo a 5

  // calcolo la predizione per l'utente target e l'item target
  // per ogni item che fa parte dei NN:
  //    1) prendo la similarità (person) dei 2 item
  //    2) prendo il voto che l'utente target ha dato all'item corrente del ciclo
  //    3) moltiplico 1) x 2)
  //    4) calcolo risultato come frazione tra 3) e 1)
}
