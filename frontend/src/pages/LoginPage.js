import React, { useState } from 'react';
import LoginUserService from '../services/LoginUserService';

const LoginPage = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState(null);
  const [success, setSuccess] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await LoginUserService(email, password);
      setSuccess(true);
      setError(null);
      console.log('Login successful', response);
    } catch (err) {
      setError(err.message);
      setSuccess(false);
    }
  };

  return (
    <div>
      <h1>Login</h1>
      {success && <p>Login successful! Welcome back.</p>}
      {error && <p>Error: {error}</p>}
      <form onSubmit={handleSubmit}>
        <div>
          <label>Email:</label>
          <input
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
          />
        </div>
        <div>
          <label>Password:</label>
          <input
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
          />
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
  );
};

export default LoginPage;
