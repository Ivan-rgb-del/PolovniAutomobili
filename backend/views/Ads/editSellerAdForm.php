<?php

  $adId = $_GET['advertisementId'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Edit advertisement</title>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="../index.php">Polovni Automobili</a>
    </div>
  </nav>

  <main class="container flex-grow-1">
    <h1 class="text-center mb-4">Edit Your Advertisement</h1>

    <form action="../../app/handlers/processEditSellerAdvertisement.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $adId ?>">

      <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" name="title" id="title" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Price:</label>
        <input type="number" name="price" id="price" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea name="description" id="description" class="form-control"></textarea>
      </div>

      <div class="mb-3">
        <label for="firstRegistration" class="form-label">First Registration:</label>
        <input type="number" name="firstRegistration" id="firstRegistration" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="fuelType" class="form-label">Fuel type:</label>
        <select name="fuelType" id="fuelType" class="form-select">
          <option value="diesel">Diesel</option>
          <option value="petrol">Petrol</option>
          <option value="electric">Electric</option>
          <option value="hybrid">Hybrid</option>
          <option value="natural gas">Natural Gas</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="categories" class="form-label">Categories:</label>
        <select name="categories" id="categories" class="form-select">
          <option value="">Select</option>
          <option value="1">Car</option>
          <option value="2">Van</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="vehicleType" class="form-label">Sub Types:</label>
        <select name="vehicleType" id="vehicleType" class="form-select">
          <option value="">Select</option>
          <option value="1">Combi</option>
          <option value="2">Limousine</option>
          <option value="3">Convertible</option>
          <option value="4">Coupe</option>
          <option value="5">SUV</option>
          <option value="6">Minivan</option>
          <option value="7">Cargo</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="adImageToUpload" class="form-label">Select image for ad (leave blank to keep current image):</label>
        <input type="file" name="adImageToUpload" id="adImageToUpload" class="form-control">
      </div>

      <button type="submit" name="update" class="btn btn-primary mb-4">Update Ad</button>
    </form>
  </main>

  <footer class="bg-dark text-white py-3 text-center mt-auto">
    <div class="container">
      © 2024 Polovni Automobili
    </div>
  </footer>

</body>
</html>