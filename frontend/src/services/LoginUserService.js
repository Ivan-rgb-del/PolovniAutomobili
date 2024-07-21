import React from "react";

const API_URL = "http://localhost/PolovniAutomobili/backend/api/loginUser.php";

const LoginUserService = async (email, password) => {
  try {
    const response = await fetch(API_URL, {
      method: 'POST',
      body: [email, password]
    });

    if (!response.ok) {
      throw new Error('Network response was not ok ' + response.statusText);
    }

    return await response.json();
  } catch (error) {
    throw new Error('Error logging in user: ' + error.message);
  }
}

export default LoginUserService;