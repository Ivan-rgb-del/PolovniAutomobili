<?php

  interface SavedAdsContract {
    public function saveAdvertisement(int $userId, int $adId);
    public function getAllSavedAdsByUser(int $userId);
    public function deleteSavedAd(int $userId, int $adId);
    public function getUserWhoSavedAd(int $adId);
  }

?>