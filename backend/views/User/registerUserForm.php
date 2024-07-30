<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Register User</title>
</head>
<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="../index.php">Polovni Automobili</a>
    </div>
  </nav>

  <main class="container flex-grow-1">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <h1 class="text-center mb-4">Register User</h1>
        <form action="../../app/handlers/processRegisterUser.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="firstName" class="form-label">First Name:</label>
            <input type="text" name="firstName" id="firstName" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="lastName" class="form-label">Last Name:</label>
            <input type="text" name="lastName" id="lastName" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role:</label>
            <select name="role" id="role" class="form-select">
              <option value="seller">Seller</option>
              <option value="user">User</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="fileToUpload" class="form-label">Select image to upload:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
          </div>
          <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number:</label>
            <input type="tel" name="phoneNumber" id="phoneNumber" class="form-control" required>
          </div>
          <div class="d-grid">
            <input type="submit" value="Register User" name="submit" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </main>

  <footer class="bg-dark text-white py-3 text-center mt-auto">
    <div class="container">
      © 2024 Polovni Automobili
    </div>
  </footer>

</body>
</html>