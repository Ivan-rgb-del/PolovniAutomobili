import React, { useState, useEffect } from "react";
import LoginPage from "../../pages/LoginPage";

const AuthenticationComponent = () => {
  const [logged, setLogged] = useState(false);
  const [userId, setUserId] = useState(null);
  const [userRole, setUserRole] = useState('');

  useEffect(() => {
    const isLogged = localStorage.getItem('logged');
    const storedUserId = localStorage.getItem('userId');
    const storedUserRole = localStorage.getItem('userRole');

    if (isLogged) {
      setLogged(true);
      setUserId(storedUserId);
      setUserRole(storedUserRole);
    }
  }, []);

  const handleLogout = () => {
    setLogged(false);
    setUserId(null);
    setUserRole('');

    localStorage.removeItem('logged');
    localStorage.removeItem('userId');
    localStorage.removeItem('userRole');
  };

  const handleLogin = (userId, userRole) => {
    setLogged(true);
    setUserId(userId);
    setUserRole(userRole);
  };

  return (
    <div>
      {logged ? (
        <button onClick={handleLogout}>Logout</button>
      ) : (
        <LoginPage onLogin={handleLogin} />
      )}
    </div>
  );
}

export default AuthenticationComponent;