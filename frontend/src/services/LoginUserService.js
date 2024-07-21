import React from "react";

const API_URL = "http://localhost/PolovniAutomobili/backend/api/loginUser.php";

const LoginUserService = async (email, password) => {
  try {
    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);

    const response = await fetch(API_URL, {
      method: 'POST',
      body: formData,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      credentials: 'include'
    });

    if (!response.ok) {
      throw new Error('Network response was not ok ' + response.statusText);
    }

    return await response.json();
  } catch (error) {
    console.error('Error logging in user:', error);
    throw new Error('Error logging in user: ' + error.message);
  }
}

export default LoginUserService;