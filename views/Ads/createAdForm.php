<?php

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  $userId = $_SESSION['userId']

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add vehicle</title>
  <style>
    .hidden {
      display: none;
    }
    </style>
</head>
<body>

  <h1>Post an ad</h1>

  <form action="#" method="POST">
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

    <!-- category_id, sub_vategory da bude option -->
    <label for="categories">Categories:</label>
    <select name="categories" id="categories" onchange="showSubCategories()">
      <option value="">Select</option>
      <option value="1">Car</option>
      <option value="2">Van</option>
    </select><br><br>

    <div class="carSubcategories hidden">
        <label for="carTypes">Car Types:</label>
        <select name="carTypes" id="carTypes">
            <option value="1">Combi</option>
            <option value="2">Limousine</option>
            <option value="3">Convertible</option>
            <option value="4">Coupe</option>
            <option value="5">SUV</option>
        </select><br><br>
    </div>

    <div class="vanSubcategories hidden">
        <label for="vanTypes">Van Types:</label>
        <select name="vanTypes" id="vanTypes">
            <option value="6">Minivan</option>
            <option value="7">Cargo Van</option>
        </select><br><br>
    </div>

    <!-- user_id -->
    <input type="hidden" name="userId" value="<?= $userId ?>">

    <button>Add ad</button>
  </form>

  <script src="../../assets/js/main.js"></script>

</body>
</html>