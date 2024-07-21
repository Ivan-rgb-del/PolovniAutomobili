import React from 'react';

const RegisterUser = () => {
  return (
    <div>
      <form>
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName" required></input>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName" required></input>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required></input>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required></input>

        <label for="role">Role:</label>
        <select name="role" id="role">
          <option value="seller">Seller</option>
          <option value="user">User</option>
        </select>

        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload"></input>

        <label for="phoneNumber">Phone Number:</label>
        <input type="int" name="phoneNumber" id="phoneNumber" required></input>

        <input type="submit" value="Register User" name="submit"></input>
      </form>
    </div>
  );
};

export default RegisterUser;