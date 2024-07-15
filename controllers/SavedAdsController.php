<?php

  require_once "repository/SavedAdsRepository.php";

  class SavedAdsController {
    private $savedAdsRepo;

    public function __construct(ISavedAdsRepository $savedAdsRepo)
    {
      $this->savedAdsRepo = $savedAdsRepo;
    }

    public function saveAdvertisement($userId, $adId) {
      return $this->savedAdsRepo->saveAdvertisement($userId, $adId);
    }

    public function showAllSavedAdsByUser($userId) {
      return $this->savedAdsRepo->showAllSavedAdsByUser($userId);
    }
  }

?>