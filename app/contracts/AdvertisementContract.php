<?php

  interface AdvertisementContract {
    public function createAdvertisement(Advertisement $advertisement);
    public function countOfCreatedAdsByUser(int $userId);
    public function getLastInsertId();
    public function deleteAdvertisement(int $adId);
    public function editAdvertisement(Advertisement $advertisement);
    public function getAdvertisementId(int $adId);
    public function getAllAdvertisement();
    public function filterAdsByTitle(string $input);
  }

?>