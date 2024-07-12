<?php

  interface IAdvertisementRepository {
    public function createAdvertisement(Advertisement $advertisement);
    public function countOfCreatedAdsByUser($userId);
    public function getLastInsertId();
    public function deleteAdvertisement($adId);
    public function editAdvertisement(Advertisement $advertisement);
  }

?>