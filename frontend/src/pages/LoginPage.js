import React, { useState, useContext } from 'react';
import LoginUserService from '../services/LoginUserService';
import { UserContext } from '../context/UserContext';
import { Link } from 'react-router-dom';

function LoginPage() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const { handleLogin } = useContext(UserContext);

  const handleLoginClick = async () => {
    const data = await LoginUserService(email, password);

    if (data.success) {
      handleLogin(data.userId, data.userRole);
    } else {
      alert('Invalid credentials');
    }
  };

  return (
    <div className="flex items-center justify-center min-h-screen bg-gray-100">
      <div className="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 className="text-2xl font-bold mb-6 text-center">Login</h2>
        <input
          type="email"
          placeholder="Email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          className="w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <input
          type="password"
          placeholder="Password"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          className="w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <button
          onClick={handleLoginClick}
          className="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200"
        >
          Login
        </button>
        <div className="text-center mt-4">
          <Link to="/reset-password" className="text-blue-500 hover:underline">
            Forgot password?
          </Link>
        </div>
      </div>
    </div>
  );
}

export default LoginPage;