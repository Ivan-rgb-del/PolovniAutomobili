<?php

  require_once __DIR__ . "/../database/Base.php";
  require_once __DIR__ . "/../contracts/UserContract.php";
  require_once __DIR__ . "/../models/User.php";

  class UserRepository extends Base implements UserContract {
    public function registerUser(User $user) {
      $firstName = $this->conn->real_escape_string($user->firstName);
      $lastName = $this->conn->real_escape_string($user->lastName);
      $email = $this->conn->real_escape_string($user->email);
      $password = $this->conn->real_escape_string($user->password);
      $role = $this->conn->real_escape_string($user->role);
      $profileImage = $this->conn->real_escape_string($user->profileImage);
      $phoneNumber = $this->conn->real_escape_string($user->phoneNumber);

      $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, password, role, profile_image, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)");

      $user = $this->emailExist($email);
      if (!$user) {
        die("This email already exist!");
      }

      $stmt->bind_param("ssssssi", $firstName, $lastName, $email, $password, $role, $profileImage, $phoneNumber);

      $stmt->execute();
      $stmt->close();
    }

    public function emailExist(string $email)
    {
      $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->bind_param("s", $email);
      $user = $stmt->execute();

      return $user;
    }

    public function loginUser(string $email, string $password)
    {
      $email = $this->conn->real_escape_string($email);
      $password = $this->conn->real_escape_string($password);

      $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
          return $user;
        }
      }

      return null;
    }

    public function editUser(string $email, string $password)
    {
      $email = $this->conn->real_escape_string($email);
      $password = $this->conn->real_escape_string($password);

      $hashPassword = password_hash($password, PASSWORD_BCRYPT);

      $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($user) {
          return $this->conn->query("UPDATE users SET password = '$hashPassword' WHERE email = '$email'");
        }
      }

      return null;
    }

    public function getUserAds(int $userId)
    {
      $stmt = $this->conn->prepare("SELECT * FROM ads WHERE user_id = ?");
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows == 0) {
        return null;
      }

      return $result->fetch_all(MYSQLI_ASSOC);
    }
  }

?>