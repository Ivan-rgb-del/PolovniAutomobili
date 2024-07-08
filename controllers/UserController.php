<?php

  require_once "repository/UserRepository.php";
  require_once "models/User.php";

  class UserController {
    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
      $this->userRepository = $userRepository;
    }

    // REGISTER
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

    // LOGIN
    public function loginUser($email, $password) {
      return $this->userRepository->loginUser($email, $password);
    }

    // EDIT USER
    public function editUser($email, $password) {
      return $this->userRepository->editUser($email, $password);
    }
  }

?>