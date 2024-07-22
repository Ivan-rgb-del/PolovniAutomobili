import React, { createContext, useState, useEffect } from 'react';

export const UserContext = createContext();

export const UserProvider = ({ children }) => {
  const [logged, setLogged] = useState(false);
  const [userId, setUserId] = useState(null);
  const [userRole, setUserRole] = useState('');

  useEffect(() => {
    const isLogged = localStorage.getItem('logged') === 'true';
    const storedUserId = localStorage.getItem('userId');
    const storedUserRole = localStorage.getItem('userRole');

    if (isLogged) {
      setLogged(true);
      setUserId(storedUserId);
      setUserRole(storedUserRole);
    }
  }, []);

  const handleLogin = (userId, userRole) => {
    setLogged(true);
    setUserId(userId);
    setUserRole(userRole);
    localStorage.setItem('logged', true);
    localStorage.setItem('userId', userId);
    localStorage.setItem('userRole', userRole);
  };

  const handleLogout = () => {
    setLogged(false);
    setUserId(null);
    setUserRole('');
    localStorage.removeItem('logged');
    localStorage.removeItem('userId');
    localStorage.removeItem('userRole');
  };

  return (
    <UserContext.Provider value={{ logged, userId, userRole, handleLogin, handleLogout }}>
      {children}
    </UserContext.Provider>
  );
};