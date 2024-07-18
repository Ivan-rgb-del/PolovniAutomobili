<?php

  require_once __DIR__ . '/../models/AdImage.php';
  require_once __DIR__ . '/../models/Advertisement.php';
  require_once __DIR__ . '/../repository/AdvertisementRepository.php';
  require_once __DIR__ . '/../repository/AdImageRepository.php';

  class AdvertisementController {
    private readonly AdvertisementContract $advertisementContract;
    private readonly AdImageContract $adImageContract;

    public function __construct(
      AdvertisementRepository $advertisementRepository,
      AdImageRepository $adImageRepository
    )
    {
      $this->advertisementContract = $advertisementRepository;
      $this->adImageContract = $adImageRepository;
    }

    // CREATE AD
    public function createAdvertisement(
      string $title, $price, string $description,
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

      $this->advertisementContract->createAdvertisement($newAdvertisement);

      $lastAdvertisementId = $this->advertisementContract->getLastInsertId();

      $adImage = new AdImage();
      $adImage->imageUrl = $url;
      $adImage->advertisementId = $lastAdvertisementId;
      $this->adImageContract->addImageForAd($adImage);
    }

    public function deleteAdvertisement(int $idAd) {
      $this->advertisementContract->deleteAdvertisement($idAd);
    }

    public function editAdvertisement(
      int $id, string $title, $price, string $description,
      int $firstRegistration, string $fuelType, int $categoryId,
      int $subCategory, $url = null
    ) {
      $newAd = new Advertisement();
      $adImage = new AdImage();

      $newAd->id = $id;
      $newAd->title = $title;
      $newAd->price = $price;
      $newAd->description = $description;
      $newAd->firstRegistration = $firstRegistration;
      $newAd->fuelType = $fuelType;
      $newAd->categoryId = $categoryId;
      $newAd->subCategory = $subCategory;

      $this->advertisementContract->editAdvertisement($newAd);

      if ($url !== null) {
        $adImage = new AdImage();
        $adImage->imageUrl = $url;
        $adImage->advertisementId = $id;
        $this->adImageContract->addImageForAd($adImage);
      }
    }

    public function getAdId(int $adId) {
      return $this->advertisementContract->getAdvertisementId($adId);
    }

    public function getAllAdvertisement() {
      return $this->advertisementContract->getAllAdvertisement();
    }

    public function filterAdsByTitle(string $input) {
      return $this->advertisementContract->filterAdsByTitle($input);
    }
  }

?>