<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register User</title>
</head>
<body>

  <h1>Register User</h1>
  <form action="../../processRegisterUser.php" method="POST">
    <label for="firstName">First Name:</label>
    <input type="text" name="firstName" id="firstName" required><br><br>

    <label for="lastName">Last Name:</label>
    <input type="text" name="lastName" id="lastName" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>

    <label for="role">Role:</label>
    <input type="text" name="role" id="role" required><br><br>

    <label for="profileImage">Profile Image:</label>
    <input type="text" name="profileImage" id="profileImage" required><br><br>

    <label for="phoneNumber">Phone Number:</label>
    <input type="int" name="phoneNumber" id="phoneNumber" required><br><br>

    <button>Register New User</button>
  </form>

</body>
</html>