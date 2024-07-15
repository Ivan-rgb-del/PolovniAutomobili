<?php

  interface ISavedAdsRepository {
    public function saveAdvertisement($userId, $adId);
    public function showAllSavedAdsByUser($userId);
  }

?>