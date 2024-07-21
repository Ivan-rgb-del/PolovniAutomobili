import React from "react";

const API_URL = "http://localhost/PolovniAutomobili/backend/api/registerUser.php";

const RegisterUserService = async (userData) => {
  try {
    const response = await fetch(API_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(userData),
    });

    if (!response.ok) {
      throw new Error('Network response was not ok ' + response.statusText);
    }

    return await response.json();
  } catch (error) {
    throw new Error('Error registering user: ' + error.message);
  }
}

export default RegisterUserService;