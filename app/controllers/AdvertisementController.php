<?php

  require_once "./app/models/Advertisement.php";
  require_once "./app/repository/AdvertisementRepository.php";
  require_once "./app/repository/AdImageRepository.php";
  require_once "./app/models/AdImage.php";

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
    }

    public function deleteAdvertisement($idAd) {
      $this->advertisementRepository->deleteAdvertisement($idAd);
    }

    public function editAdvertisement($id, $title, $price, $description, $firstRegistration, $fuelType, $categoryId, $subCategory, $url = null) {
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

      $this->advertisementRepository->editAdvertisement($newAd);

      if ($url !== null) {
        $adImage = new AdImage();
        $adImage->imageUrl = $url;
        $adImage->advertisementId = $id;
        $this->adImageRepository->addImageForAd($adImage);
      }
    }

    public function getAdId($adId) {
      return $this->advertisementRepository->getAdvertisementId($adId);
    }

    public function getAllAdvertisement() {
      return $this->advertisementRepository->getAllAdvertisement();
    }

    public function filterAdsByTitle($input) {
      return $this->advertisementRepository->filterAdsByTitle($input);
    }
  }

?>