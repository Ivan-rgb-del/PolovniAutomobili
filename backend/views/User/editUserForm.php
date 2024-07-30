<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Edit User</title>
</head>
<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="../index.php">Polovni Automobili</a>
    </div>
  </nav>

  <main class="container flex-grow-1">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            <h1>Reset Password</h1>
          </div>
          <div class="card-body">
            <form action="../../app/handlers/processEditUser.php" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Enter Your Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Enter New Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Confirm</button>
            </form>
          </div>
        </div>
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