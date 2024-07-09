<?php

  interface IAdvertisementRepository {
    public function createAdvertisement(Advertisement $advertisement);
    public function countOfCreatedAdsByUser($userId);
  }

?>