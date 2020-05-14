<?php
include 'db_connect.php';

if (isset($_POST["id_utente"])) {
  $input_user = $_POST['id_utente'];
  $input_user = intval($input_user);
  // printf("%s\n\n\n", $input_user);
  $sql = "SELECT id_utente FROM user";

  $result = mysqli_query($mysqli, $sql);
  $myObj = new \stdClass();
  $users_id = new \stdClass();
  $services_id = [];
  $ratings = [];
  $full_users_services = [];
  $users_id = $result->fetch_all(MYSQLI_ASSOC); // ID DEGLI UTENTI

  foreach ($users_id as $idu) {
    $user_services = [];
    $sql = "SELECT id_servizio FROM service40";
    $result = mysqli_query($mysqli, $sql);
    $services_id = $result->fetch_all(MYSQLI_ASSOC); // ID DEI SERVIZI

    foreach ($services_id as $ids) {
      $sql = "SELECT rating FROM rating1000 WHERE id_servizio = '$ids[id_servizio]' AND id_utente = '$idu[id_utente]'";
      $result = mysqli_query($mysqli, $sql);
      $ratings = $result->fetch_array(MYSQLI_ASSOC);  // RATINGS
      if ($ratings['rating'] != null) {
        $user_services[$ids['id_servizio']] = intval($ratings['rating']);
      } else {
        $user_services[$ids['id_servizio']] = 0;
      }
    }

    $full_users_services[$idu['id_utente']] = $user_services;
  }

  $pearson = [];
  foreach (array_keys($full_users_services) as $user) {
    if ($user != $input_user) {
      $pearson[$user] = pearsonCorr($full_users_services[$input_user], $full_users_services[$user]);
    }
  }
  // echo "PEARSON =>";echo json_encode($pearson);echo "\n";echo "\n";

  foreach (array_keys($pearson) as $possible_neighbour) {
    if ($pearson[$possible_neighbour] < 0 || !$pearson[$possible_neighbour]) {
      unset($pearson[$possible_neighbour]);
    }
  }


  arsort($pearson);
  $NN = array_slice($pearson, 0, 5,true);

  // echo "PEARSON =>";echo json_encode($pearson);echo "\n";echo "\n";

  $itemsToRecommend = [];

  if (count($NN) > 0) {
    $itemsToPredict = getItemsToPredict($input_user, $NN, $mysqli, $dbCon);
    foreach ($itemsToPredict as $item) {
      $id = $item['id_servizio'];
      $itemsToRecommend[$id] = prediction($full_users_services, $pearson, $input_user, $id);
    }
    arsort($itemsToRecommend);
    echo "itemsToRecommend -> "; echo json_encode($itemsToRecommend);echo "\n";
  } else {
    echo "Nessun NN";
  }

}

function pearsonCorr($userinput_ratings, $newuser_ratings) {
  if (count($userinput_ratings) !== count($newuser_ratings)) {
    return -1;
  }

  // utente selezionato in input
  $sumRatingsInputUser = 0;
  $countRatingsInputUser = 0;
  foreach ($userinput_ratings as $u) {
    if ($u != 0) {
      $sumRatingsInputUser += $u;
      $countRatingsInputUser++;
    }
  }

  // ogni altro utente
  $sumRatingsUser = 0;
  $countRatingsUser = 0;
  foreach ($newuser_ratings as $u) {
    if ($u != 0) {
      $sumRatingsUser += $u;
      $countRatingsUser++;
    }
  }

  // echo "sumRatingsUser -> "; echo json_encode($sumRatingsUser);echo "\n";
  // echo "countRatingsUser -> "; echo json_encode($countRatingsUser);echo "\n";

  $avgRatingInputUser = $sumRatingsInputUser / $countRatingsInputUser;
  $avgRatingUser = $sumRatingsUser / $countRatingsUser;

  // echo "avgRatingInputUser -> "; echo json_encode($avgRatingInputUser);echo "\n";
  // echo "avgRatingUser -> "; echo json_encode($avgRatingUser);echo "\n";echo "\n";

  $numerator = 0;
  $inputUserDenominator = 0;
  $userDenominator = 0;
  $denominator = 0;

  for ($i = 1; $i <= count($userinput_ratings); $i++) {
    if ($userinput_ratings[$i] != 0 && $newuser_ratings[$i] != 0) {
      $inputUserNumerator = $userinput_ratings[$i] - $avgRatingInputUser;
      $userNumerator = $newuser_ratings[$i] - $avgRatingUser;
      $numerator += $inputUserNumerator * $userNumerator;
      $inputUserDenominator += pow($inputUserNumerator, 2);
      $userDenominator += pow($userNumerator, 2);
    }
  }

  // echo "inputUserDenominator -> "; echo json_encode($inputUserDenominator);echo "\n";
  // echo "userDenominator -> "; echo json_encode($userDenominator);echo "\n";

  $denominator = sqrt($inputUserDenominator) * sqrt($userDenominator);
  // echo "denominator -> "; echo json_encode($denominator);echo "\n";echo "\n";echo "\n";
  // echo "numerator/denominator -> "; echo json_encode($numerator / $denominator);echo "\n";echo "\n";

  if ($denominator == 0) {
    $final_res = 0;
  } else {
    $final_res = $numerator / $denominator;
  }

  return $final_res;
}

function getItemsToPredict($input_user, $NN, $mysqli, $dbCon) {
  $placeholders = array_fill(0, count($NN), '?');

  $stm = $dbCon->prepare('SELECT id_servizio FROM rating1000 WHERE id_utente IN ('.implode(',', $placeholders).') AND
  id_servizio NOT IN (SELECT id_servizio FROM rating1000 WHERE id_utente = ?)
  GROUP BY id_servizio;');

  $string = [];
  foreach (array_keys($NN) as $id) {
    array_push($string, $id);
  }
  array_push($string, $input_user);
  $stm->execute($string);
  $services_list = $stm->fetchAll(PDO::FETCH_ASSOC);
  // echo "services_list -> "; echo json_encode($services_list);echo "\n";
  return $services_list;
}

function prediction($full_users_services, $pearson, $input_user, $id) {
  $sumRatings = 0;
  $countRatings = 0;
  foreach ($full_users_services[$input_user] as $r) {
    if ($r != 0) {
      $sumRatings += $r;
      $countRatings++;
    }
  }
  $avgRatings = $sumRatings / $countRatings;

  $numerator = 0;
  $denominator = 0;

  foreach (array_keys($pearson) as $neighbour) {
    $similarity = $pearson[$neighbour];
    $sumRatingsNeighbour = 0;
    $avgCount = 0;
    foreach ($full_users_services[$neighbour] as $rating) {
      if ($rating != 0) {
        $sumRatingsNeighbour += $rating;
        $avgCount++;
      }
    }
    $numerator += $similarity * ($full_users_services[$neighbour][$id] - ($sumRatingsNeighbour / $avgCount));
    $denominator += $similarity;
  }
  $prediction = $avgRatings += ($numerator / $denominator);
  // echo "prediction -> "; echo json_encode($prediction);echo "\n";
  return $prediction;
}
