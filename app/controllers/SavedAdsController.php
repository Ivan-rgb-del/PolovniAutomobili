<?php

  require_once __DIR__ . '/../repository/SavedAdsRepository.php';
  require_once __DIR__ . '/../models/SavedAds.php';

  class SavedAdsController {
    private readonly SavedAdsContract $savedAdsContract;

    public function __construct(SavedAdsRepository $savedAdsRepo)
    {
      $this->savedAdsContract = $savedAdsRepo;
    }

    public function saveAdvertisement($userId, $adId) {
      return $this->savedAdsContract->saveAdvertisement($userId, $adId);
    }

    public function getAllSavedAdsByUser($userId) {
      return $this->savedAdsContract->getAllSavedAdsByUser($userId);
    }

    public function deleteSavedAd($adId) {
      $userIds = $this->savedAdsContract->getUserWhoSavedAd($adId);
      foreach ($userIds as $userId) {
        $this->savedAdsContract->deleteSavedAd($userId, $adId);
      }
    }
  }

?>