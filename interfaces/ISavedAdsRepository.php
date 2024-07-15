<?php

  interface ISavedAdsRepository {
    public function saveAdvertisement($userId, $adId);
  }

?>