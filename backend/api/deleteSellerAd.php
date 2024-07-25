<?php

require_once __DIR__ . "/../app/repository/AdvertisementRepository.php";
require_once __DIR__ . '/../app/repository/AdImageRepository.php';
require_once __DIR__ . '/../app/repository/SavedAdsRepository.php';

require_once __DIR__ . '/../app/controllers/AdvertisementController.php';
require_once __DIR__ . '/../app/controllers/AdImageController.php';
require_once __DIR__ . '/../app/controllers/SavedAdsController.php';

$adsRepo = new AdvertisementRepository();
$adImageRepo = new AdImageRepository();
$savedAdRepo = new SavedAdsRepository();

$adsController = new AdvertisementController($adsRepo, $adImageRepo);
$adImageController = new AdImageController($adImageRepo);
$savedAdController = new SavedAdsController($savedAdRepo);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Methods: DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    http_response_code(200);
    exit;
}

$adId = $_GET['adId'] ?? null;

if ($adId === null) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid ad ID."]);
    exit;
}

try {
    $savedAdController->deleteSavedAd($adId);
    $adImageController->deleteAdvertisementImage($adId);
    $adsController->deleteAdvertisement($adId);
    echo json_encode(["message" => "Ad deleted successfully."]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["message" => "Unable to delete ad. Error: " . $e->getMessage()]);
}
?>