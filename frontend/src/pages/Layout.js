import React, { useContext } from 'react';
import { Outlet, Link } from 'react-router-dom';
import { UserContext } from '../context/UserContext';

const Layout = () => {
  const { logged, userRole, handleLogout } = useContext(UserContext);

  return (
    <div>
      <nav>
        {!logged ? (
          <div>
            <Link to="/login-user">Login</Link>
            <Link to="/register-user">Register</Link>
          </div>
        ) : userRole === 'seller' ? (
          <div>
            <button onClick={handleLogout}>Logout</button>
            <Link to="/add-new-ad">Add New Ad</Link>
            <Link to="/my-ads">My Ads</Link>
          </div>
        ) : userRole === 'user' ? (
          <div>
            <button onClick={handleLogout}>Logout</button>
            <Link to="/look-for-new-ads">Look for New Ads</Link>
            <Link to="/saved-ads">Saved Ads</Link>
          </div>
        ) : null}
      </nav>
      <Outlet />
    </div>
  );
};

export default Layout;