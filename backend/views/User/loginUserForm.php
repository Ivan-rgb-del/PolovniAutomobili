<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login User</title>
</head>
<body>

  <h1>Login User</h1>
  <form action="../../app/handlers/processLoginUser.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>

    <button>Login</button>
    <a href="editUserForm.php">Forgot Password</a>
  </form>

</body>
</html>