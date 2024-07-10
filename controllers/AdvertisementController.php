<?php

  require_once "models/Advertisement.php";
  require_once "repository/AdvertisementRepository.php";
  require_once "repository/AdImageRepository.php";
  require_once "models/AdImage.php";

  class AdvertisementController {
    private $advertisementRepository;
    private $adImageRepository;

    public function __construct(
      IAdvertisementRepository $advertisementRepository,
      IAdImageRepository $adImageRepository
    )
    {
      $this->advertisementRepository = $advertisementRepository;
      $this->adImageRepository = $adImageRepository;
    }

    // CREATE AD
    public function createAdvertisement(
      string $title, string $price, string $description,
      string $firstRegistration, string $fuelType, int $categoryId,
      int $userId, int $subCategory, string $url
    ) {
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

      $lastAdvertisementId = $this->advertisementRepository->getLastInsertId();

      $adImage = new AdImage();
      $adImage->imageUrl = $url;
      $adImage->advertisementId = $lastAdvertisementId;
      $this->adImageRepository->addImageForAd($adImage);

      echo "Uspesno kreiran oglas sa slikom";
    }
  }

?>