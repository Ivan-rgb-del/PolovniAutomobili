<?php

  $adId = $_GET['advertisementId'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit advertisement</title>
</head>
<body>

  <h1>Edit your advertisement:</h1>

  <form action="../../processEditSellerAdvertisement.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $adId ?>">

    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required><br><br>

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" required><br><br>

    <label for="description">Description:</label>
    <textarea name="description" id="description"></textarea><br><br>

    <label for="firstRegistration">First Registration:</label>
    <input type="number" name="firstRegistration" id="firstRegistration" required><br><br>

    <label for="fuelType">Fuel type:</label>
    <select name="fuelType" id="fuelType">
      <option value="diesel">Diesel</option>
      <option value="petrol">Petrol</option>
      <option value="electric">Electric</option>
      <option value="hybrid">Hybrid</option>
      <option value="natural gas">Natural Gas</option>
    </select><br><br>

    <label for="categories">Categories:</label>
    <select name="categories" id="categories">
      <option value="">Select</option>
      <option value="1">Car</option>
      <option value="2">Van</option>
    </select><br><br>

    <label for="vehicleType">Sub Types:</label>
    <select name="vehicleType" id="vehicleType">
      <option value="">Select</option>
      <option value="1">Combi</option>
      <option value="2">Limousine</option>
      <option value="3">Convertible</option>
      <option value="4">Coupe</option>
      <option value="5">SUV</option>
      <option value="6">Minivan</option>
      <option value="7">Cargo</option>
    </select><br><br>

    <label for="adImageToUpload">Select image for ad (leave blank to keep current image):</label>
    <input type="file" name="adImageToUpload" id="adImageToUpload"><br><br>

    <button type="submit" name="update">Update ad</button>
  </form>

</body>
</html>