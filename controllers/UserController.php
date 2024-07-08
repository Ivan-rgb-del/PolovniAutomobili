<?php

  require_once "repository/UserRepository.php";
  require_once "models/User.php";

  class UserController {
    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
      $this->userRepository = $userRepository;
    }

    public function registerUser($firstName, $lastName, $email, $password, $role, $profileImage, $phoneNumber) {
      $newUser = new User();

      $newUser->firstName = $firstName;
      $newUser->lastName = $lastName;
      $newUser->email = $email;
      $newUser->password = password_hash($password, PASSWORD_BCRYPT);
      $newUser->role = $role;
      $newUser->profileImage = $profileImage;
      $newUser->phoneNumber = $phoneNumber;

      $this->userRepository->registerUser($newUser);

      return "User added successfully!";
    }

    public function loginUser($email, $password) {
      $this->userRepository->loginUser($email, $password);
      return "User login successfully!";
    }
  }

?>