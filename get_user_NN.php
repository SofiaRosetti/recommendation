<?php

$pearson = [];
function getNN($input_user) {
  include 'db_connect.php';

  // $input_user = $_POST['id_utente'];
  // $input_user = intval($input_user);
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
    $sql = "SELECT id_servizio FROM service";
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
  // echo json_encode($full_users_services[16]);

  foreach (array_keys($full_users_services) as $user) {
    if ($user != $input_user) {
      $pearson[$user] = pearsonCorr($full_users_services[$input_user], $full_users_services[$user]);
      // echo json_encode($pearson[$user]);echo "\n";
    }
  }
  // echo json_encode($pearson);echo "\n";

  foreach (array_keys($pearson) as $possible_neighbour) {
    if ($pearson[$possible_neighbour] <= 0 || !$pearson[$possible_neighbour]) {
      unset($pearson[$possible_neighbour]);
    }
  }


  arsort($pearson);
  $NN = array_slice($pearson, 0, 5,true);

  echo "NN calcolati da get_user_NN.php => "; echo json_encode($NN);echo "\n";

  return $NN;

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

  if ($countRatingsInputUser != 0) {

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


  } else {
    return 0;
  }


}

function getPearson() {
  return $pearson;
}
