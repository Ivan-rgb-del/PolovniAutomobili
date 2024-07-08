<?php

  interface IUserRepository {
    public function registerUser(User $user);
    public function emailExist($email);
  }

?>