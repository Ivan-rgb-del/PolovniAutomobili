import React, { useState } from 'react';
import EditUserService from '../services/EditUserService';

const EditUserPage = () => {
  const [email, setEmail] = useState('');
  const [newPassword, setNewPassword] = useState('');

  const handleEditUser = async (e) => {
    e.preventDefault();
    try {
      await EditUserService(email, newPassword);
    } catch (err) {
      console.error(err.message);
    }
  };

  return (
    <div>
      <h2>Reset Password</h2>
      <form onSubmit={handleEditUser}>
        <div>
          <label>Email:</label>
          <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} required />
        </div>
        <div>
          <label>New Password:</label>
          <input type="password" value={newPassword} onChange={(e) => setNewPassword(e.target.value)} required />
        </div>
        <button type="submit">Confirm</button>
      </form>
    </div>
  );
};

export default EditUserPage;
