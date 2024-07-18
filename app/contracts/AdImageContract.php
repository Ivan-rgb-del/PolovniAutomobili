<?php

  interface AdImageContract {
    public function addImageForAd(AdImage $adImage);
    public function getImageOfAd($adId);
    public function deleteAdvertisementImage($adId);
    public function editAdvertisementImage(AdImage $adImage);
  }

?>