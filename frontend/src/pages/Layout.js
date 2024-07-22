import React from 'react';
import { Outlet, Link } from 'react-router-dom';

const Layout = () => {

  return (
    <div>
      <nav>
        <ul>
          <li>
            <Link to="/register-user">Register</Link>
          </li>
          <li>
            <Link to="/login-user">Login</Link>
          </li>
        </ul>
      </nav>
      <Outlet />
    </div>
  );
};

export default Layout;