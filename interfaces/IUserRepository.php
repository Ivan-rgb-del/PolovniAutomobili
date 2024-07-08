<?php

  interface IUserRepository {
    public function registerUser(User $user);
    public function emailExist($email);
    public function loginUser($email, $password);
  }

?>