<?php

  require_once __DIR__ . "/../app/repository/SavedAdsRepository.php";
  require_once __DIR__ . "/../app/controllers/SavedAdsController.php";

  $saveAdRepo = new SavedAdsRepository();
  $saveAdController = new SavedAdsController($saveAdRepo);

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  header("Content-Type: application/json; charset=UTF-8");

  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
  }

  $data = json_decode(file_get_contents("php://input"), true);

  $adId = $data['advertisement_id'] ?? null;
  $userId = $data['user_id'] ?? null;

  if ($adId === null || $userId === null) {
    http_response_code(400);
    echo json_encode(["message" => "Bad Request. Missing ad_id or user_id."]);
    error_log("Bad Request: Missing ad_id or user_id. Data received: " . json_encode($data));
    exit;
  }

  if ($saveAdController->saveAdvertisement($userId, $adId)) {
    http_response_code(201);
    echo json_encode(["message" => "Ad saved successfully."]);
  } else {
    http_response_code(500);
    echo json_encode(["message" => "Unable to save ad."]);
    error_log("Unable to save ad for user_id: $userId, ad_id: $adId");
  }

?>