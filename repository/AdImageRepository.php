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

    public function getImageOfAd($adId)
    {
      $stmt = $this->conn->prepare("SELECT URL from ad_images where ads_id = ?");
      $stmt->bind_param("i", $adId);
      $stmt->execute();
      $result = $stmt->get_result();
      $imageUrl = $result->fetch_assoc();

      if ($result->num_rows == 0) {
        return null;
      }

      return $imageUrl["URL"];

    }
  }

?>