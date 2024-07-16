<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User</title>
</head>
<body>

  <h1>Reset password</h1>

  <form action="../../app/handlers/processEditUser.php" method="POST">
    <label for="email">Enter Your Email</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="password">Enter New Password</label>
    <input type="password" name="password" id="password" required><br><br>
    <button>Confirm</button>
  </form>

</body>
</html>