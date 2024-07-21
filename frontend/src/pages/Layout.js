import React, { useContext } from 'react';
import { Outlet, Link } from 'react-router-dom';
import UserContext from '../context/UserContext';

const Layout = () => {
  const { user, logout } = useContext(UserContext);

  return (
    <div>
      <nav>
        <ul>
          {user ? (
            <>
              <li>Welcome, {user.email}</li>
              <li>
                <button onClick={logout}>Logout</button>
              </li>
            </>
          ): (
            <>
              <li>
                <Link to="/register-user">Register</Link>
              </li>
              <li>
                <Link to="/login-user">Login</Link>
              </li>
            </>
          )}
        </ul>
      </nav>
      <Outlet />
    </div>
  );
};

export default Layout;