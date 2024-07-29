const EditUserService = async (email, password) => {
  const response = await fetch(`http://localhost/PolovniAutomobili/backend/api/editUser.php`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ email, password }),
  });

  if (!response.ok) {
    throw new Error('Failed to update user');
  }

  return await response.json();
};

export default EditUserService;