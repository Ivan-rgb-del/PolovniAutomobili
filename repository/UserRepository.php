<?php

  require_once "database/Base.php";
  require_once "models/User.php";
  require_once "interfaces/IUserRepository.php";

  class UserRepository extends Base implements IUserRepository {
    // register new user
    public function registerUser(User $user) {
      $firstName = $this->conn->real_escape_string($user->firstName);
      $lastName = $this->conn->real_escape_string($user->lastName);
      $email = $this->conn->real_escape_string($user->email);
      $password = $this->conn->real_escape_string($user->password);
      $role = $this->conn->real_escape_string($user->role);
      $profileImage = $this->conn->real_escape_string($user->profileImage);
      $phoneNumber = $this->conn->real_escape_string($user->phoneNumber);

      $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, password, role, profile_image, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
      if (!$stmt) {
        die("Error preparing statement!");
      }

      $user = $this->emailExist($email);
      if (!$user) {
        die("This email already exist!");
      }

      $stmt->bind_param("ssssssi", $firstName, $lastName, $email, $password, $role, $profileImage, $phoneNumber);

      if ($stmt->execute() === false) {
        die("Error executing statement: " . $stmt->error);
      }

      $stmt->close();
    }

    // check if email exist
    public function emailExist($email)
    {
      $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->bind_param("s", $email);
      $user = $stmt->execute();

      return $user;
    }

    //login user
    public function loginUser($email, $password)
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

    // edit for new password
    public function editUser($email, $password)
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
  }

?>