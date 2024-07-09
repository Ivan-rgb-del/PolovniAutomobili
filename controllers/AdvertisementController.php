<?php

  require_once "models/Advertisement.php";
  require_once "repository/AdvertisementRepository.php";

  class AdvertisementController {
    private $advertisementRepository;

    public function __construct(IAdvertisementRepository $advertisementRepository)
    {
      $this->advertisementRepository = $advertisementRepository;
    }

    // CREATE AD
    public function createAdvertisement($title, $price, $description, $firstRegistration, $fuelType, $categoryId, $userId, $subCategory) {
      $newAdvertisement = new Advertisement();

      $newAdvertisement->title = $title;
      $newAdvertisement->price = $price;
      $newAdvertisement->description = $description;
      $newAdvertisement->firstRegistration = $firstRegistration;
      $newAdvertisement->fuelType = $fuelType;
      $newAdvertisement->categoryId = $categoryId;
      $newAdvertisement->userId = $userId;
      $newAdvertisement->subCategory = $subCategory;

      $this->advertisementRepository->createAdvertisement($newAdvertisement);
    }
  }

?>