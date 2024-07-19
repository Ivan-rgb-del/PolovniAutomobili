<?php

  interface AdImageContract {
    public function addImageForAd(AdImage $adImage);
    public function getImageOfAd(int $adId);
    public function deleteAdvertisementImage(int $adId);
    public function editAdvertisementImage(AdImage $adImage);
  }

?>