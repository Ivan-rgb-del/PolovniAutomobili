<?php

require_once __DIR__ . "/../app/repository/SavedAdsRepository.php";
require_once __DIR__ . "/../app/controllers/SavedAdsController.php";

$savedAdsRepo = new SavedAdsRepository();
$savedAdsController = new SavedAdsController($savedAdsRepo);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    http_response_code(200);
    exit;
}

$userId = $_GET['user_id'] ?? null;

if ($userId === null) {
    http_response_code(400);
    echo json_encode(["message" => "Bad Request. Missing user ID."]);
    exit;
}

$savedAds = $savedAdsController->getAllSavedAdsByUser((int)$userId);

if ($savedAds) {
    echo json_encode($savedAds);
} else {
    http_response_code(404);
    echo json_encode(["message" => "No saved ads found."]);
}
?>