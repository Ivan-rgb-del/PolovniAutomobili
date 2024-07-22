import React, { useContext } from 'react';
import { Outlet, Link } from 'react-router-dom';
import { UserContext } from '../context/UserContext';

const Layout = () => {
  const { logged, handleLogout } = useContext(UserContext);

  return (
    <div>
      <nav>
        {!logged ? (
          <div>
            <Link to="/login-user">Login</Link>
            <Link to="/register-user">Register</Link>
          </div>
        ) : (
          <button onClick={handleLogout}>Logout</button>
        )}
      </nav>
      <Outlet />
    </div>
  );
};

export default Layout;