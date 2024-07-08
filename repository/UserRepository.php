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

    // register new user
    public function registerUser(User $user) {
      $firstName = $this->conn->realEscapeString($user->firstName);
      $lastName = $this->conn->realEscapeString($user->lastName);
      $email = $this->conn->realEscapeString($user->email);
      $password = $this->conn->realEscapeString($user->password);
      $role = $this->conn->realEscapeString($user->role);
      $profileImage = $this->conn->realEscapeString($user->profileImage);
      $phoneNumber = $this->conn->realEscapeString($user->phoneNumber);

      $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, password, role, profile_image, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
      if (!$stmt) {
        die("Error preparing statement!");
      }

      if ($this->emailExist($email)) {
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
      $result = $this->conn->query("SELECT * FROM users WHERE email = '$email'");

      if (!$result) {
        return true;
      } else {
        return false;
      }
    }

    //login user
    public function loginUser($email, $password)
    {
      $email = $this->conn->realEscapeString($email);
      $password = $this->conn->realEscapeString($password);

      $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
          echo "You are successfully loged in!";
        } else {
          die("Plese enter your password!");
        }
      } else {
        die("This user does not exist!");
      }
    }
  }

?>