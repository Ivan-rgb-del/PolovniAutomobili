const API_URL = "http://localhost/PolovniAutomobili/backend/api/loginUser.php";

const LoginUserService = async (email, password) => {
  try {
    const response = await fetch(API_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ email, password }),
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();
    return data;
  } catch (error) {
    console.error('There was an error with the login request:', error);
    return { success: false, message: 'Login failed. Please try again later.' };
  }
};

export default LoginUserService;