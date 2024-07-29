import React, { useContext } from 'react';
import { Outlet, Link } from 'react-router-dom';
import { UserContext } from '../context/UserContext';

const Layout = () => {
  const { logged, userRole, handleLogout } = useContext(UserContext);

  return (
    <div className="min-h-screen flex flex-col">
      <nav className="bg-gray-800 p-4 text-white">
        <div className="container mx-auto flex justify-between items-center">
          <div className="flex items-center space-x-4">
            {!logged ? (
              <>
                <Link to="/login-user" className="hover:text-gray-400">Login</Link>
                <Link to="/register-user" className="hover:text-gray-400">Register</Link>
              </>
            ) : userRole === 'seller' ? (
              <>
                <button onClick={handleLogout} className="hover:text-gray-400">Logout</button>
                <Link to="/add-new-ad" className="hover:text-gray-400">Add New Ad</Link>
                <Link to="/my-ads" className="hover:text-gray-400">My Ads</Link>
              </>
            ) : userRole === 'user' ? (
              <>
                <button onClick={handleLogout} className="hover:text-gray-400">Logout</button>
                <Link to="/look-for-new-ads" className="hover:text-gray-400">Look for New Ads</Link>
                <Link to="/saved-ads" className="hover:text-gray-400">Saved Ads</Link>
              </>
            ) : null}
          </div>
        </div>
      </nav>
      <header className="bg-gray-100 p-6 text-center">
        <h1 className="text-4xl font-bold mb-2">Welcome to Polovni Automobili</h1>
        <p className="text-lg text-gray-700">Your one-stop destination for buying and selling used cars</p>
      </header>
      <main className="flex-grow container mx-auto p-4">
        <Outlet />
      </main>
      <footer className="bg-gray-800 p-4 text-white text-center">
        © 2024 Polovni Automobili
      </footer>
    </div>
  );
};

export default Layout;