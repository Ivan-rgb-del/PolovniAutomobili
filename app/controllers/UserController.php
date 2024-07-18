<?php

  require_once __DIR__ . '/../repository/UserRepository.php';
  require_once __DIR__ . '/../models/User.php';

  class UserController {
    private readonly UserContract $userContract;

    public function __construct(UserRepository $userRepository)
    {
      $this->userContract = $userRepository;
    }

    // REGISTER
    public function registerUser(
      string $firstName, string $lastName, string $email,
      string $password, string $role, string $profileImage,
      int $phoneNumber
    ) {
      $newUser = new User();

      $newUser->firstName = $firstName;
      $newUser->lastName = $lastName;
      $newUser->email = $email;
      $newUser->password = password_hash($password, PASSWORD_BCRYPT);
      $newUser->role = $role;
      $newUser->profileImage = $profileImage;
      $newUser->phoneNumber = $phoneNumber;

      return $this->userContract->registerUser($newUser);
    }

    // LOGIN
    public function loginUser(string $email, string $password) {
      return $this->userContract->loginUser($email, $password);
    }

    // EDIT USER
    public function editUser(string $email, string $password) {
      return $this->userContract->editUser($email, $password);
    }

    public function getUserAds(int $userId) {
      return $this->userContract->getUserAds($userId);
    }
  }

?>