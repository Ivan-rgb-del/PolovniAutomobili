<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register User</title>
</head>
<body>

  <h1>Register User</h1>
  <form action="../../app/handlers/processRegisterUser.php" method="POST" enctype="multipart/form-data">
    <label for="firstName">First Name:</label>
    <input type="text" name="firstName" id="firstName" required><br><br>

    <label for="lastName">Last Name:</label>
    <input type="text" name="lastName" id="lastName" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>

    <label for="role">Role:</label>
    <select name="role" id="role">
      <option value="seller">Seller</option>
      <option value="user">User</option>
    </select><br><br>

    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>

    <label for="phoneNumber">Phone Number:</label>
    <input type="int" name="phoneNumber" id="phoneNumber" required><br><br>

    <input type="submit" value="Register User" name="submit">
  </form>

</body>
</html>