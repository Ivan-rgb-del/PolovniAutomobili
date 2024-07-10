<?php

  require_once "database/Base.php";
  require_once "models/AdImage.php";
  require_once "interfaces/IAdImageRepository.php";

  class AdImageRepository extends Base implements IAdImageRepository {
    public function addImageForAd(AdImage $adImage)
    {
      $stmt = $this->conn->prepare("INSERT INTO ad_images (URL, ads_id) VALUES (?, ?)");
      $stmt->bind_param("si", $adImage->imageUrl, $adImage->advertisementId);
      $stmt->execute();
      $stmt->close();
    }
  }

?>