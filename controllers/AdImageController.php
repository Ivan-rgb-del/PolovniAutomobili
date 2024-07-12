<?php

  require_once "repository/AdvertisementRepository.php";
  require_once "repository/AdImageRepository.php";
  require_once "models/AdImage.php";

  class AdImageController {
    private $adImageRepository;

    public function __construct(IAdImageRepository $adImageRepository)
    {
      $this->adImageRepository = $adImageRepository;
    }

    public function getImageOfAd($adId) {
      return $this->adImageRepository->getImageOfAd($adId);
    }
  }

?>