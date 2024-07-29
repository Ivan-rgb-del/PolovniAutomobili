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
    <div>
      <input
        type="email"
        placeholder="Email"
        value={email}
        onChange={(e) => setEmail(e.target.value)}
      />
      <input
        type="password"
        placeholder="Password"
        value={password}
        onChange={(e) => setPassword(e.target.value)}
      />
      <button onClick={handleLoginClick}>Login</button>
      <Link to="/reset-password">Forgot password?</Link>
    </div>
  );
}

export default LoginPage;