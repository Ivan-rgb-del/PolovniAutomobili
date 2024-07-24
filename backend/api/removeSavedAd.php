<?php

  require_once __DIR__ . '/../app/repository/SavedAdsRepository.php';
  require_once __DIR__ . '/../app/controllers/SavedAdsController.php';

  $saveAdRepo = new SavedAdsRepository();
  $saveAdController = new SavedAdsController($saveAdRepo);

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Methods: DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    http_response_code(200);
    exit;
  }

  $data = json_decode(file_get_contents("php://input"), true);

  if (!$data || !isset($data['advertisement_id'])) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid input."]);
    exit;
  }

  $adId = $data['advertisement_id'];
  $result = $saveAdController->deleteSavedAd($adId);

  if ($result) {
    http_response_code(200);
    echo json_encode(["message" => "Ad removed successfully."]);
  } else {
    http_response_code(500);
    echo json_encode(["message" => "Unable to remove ad."]);
  }

?>