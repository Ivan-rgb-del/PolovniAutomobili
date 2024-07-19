<?php

  interface UserContract {
    public function registerUser(User $user);
    public function emailExist(string $email);
    public function loginUser(string $email, string $password);
    public function editUser(string $email, string $password);
    public function getUserAds(int $userId);
  }

?>