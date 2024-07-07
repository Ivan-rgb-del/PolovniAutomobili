<?php

  require_once "database/Base.php";
  require_once "models/User.php";
  require_once "interfaces/IUserRepository.php";

  class UserRepository implements IUserRepository {
    private Base $conn;

    public function __construct(Base $base)
    {
      $this->conn = $base;
    }

    public function registerUser(User $user) {
      $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, password, role, profile_image, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
      if (!$stmt) {
        die("Error preparing statement!");
      }

      $stmt->bind_param("ssssssi", $user->firstName, $user->lastName, $user->email, $user->password, $user->role, $user->profileImage, $user->phoneNumber);

      if ($stmt->execute() === false) {
        die("Error executing statement: " . $stmt->error);
      }

      $stmt->close();
    }
  }

?>