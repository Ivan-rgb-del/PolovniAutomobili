<?php

  require_once __DIR__ . '/../models/AdImage.php';
  require_once __DIR__ . '/../repository/AdImageRepository.php';
  require_once __DIR__ . '/../repository/AdvertisementRepository.php';

  class AdImageController {
    private readonly AdImageContract $adImageRepository;

    public function __construct(AdImageRepository $adImageRepository)
    {
      $this->adImageRepository = $adImageRepository;
    }

    public function getImageOfAd($adId) {
      return $this->adImageRepository->getImageOfAd($adId);
    }

    public function deleteAdvertisementImage($adId) {
      return $this->adImageRepository->deleteAdvertisementImage($adId);
    }

    public function editAdImage($url, $adId) {
      $newAdImage = new AdImage();

      $newAdImage->imageUrl = $url;
      $newAdImage->advertisementId = $adId;

      $this->adImageRepository->editAdvertisementImage($newAdImage);
    }
  }

?>