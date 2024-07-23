import React, { useState } from 'react';
import AddNewAdService from '../services/AddNewAdService';

const CreateAdPage = () => {
  const [formData, setFormData] = useState({
    title: '',
    price: 0,
    description: '',
    first_registration: 0,
    fuel_type: "diesel",
    category_id: 0,
    user_id: localStorage.getItem('userId'),
    sub_category: 0
  });

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    await AddNewAdService(formData);
  };

  return (
    <form onSubmit={handleSubmit}>
      <div>
        <label>Title:</label>
        <input type="text" name="title" value={formData.title} onChange={handleChange} required />
      </div>
      <div>
        <label>Price:</label>
        <input type="number" name="price" value={formData.price} onChange={handleChange} required />
      </div>
      <div>
        <label>Description:</label>
        <textarea name="description" value={formData.description} onChange={handleChange} required />
      </div>
      <div>
        <label>First Registration:</label>
        <input type="number" name="first_registration" value={formData.first_registration} onChange={handleChange} required />
      </div>
      <div>
        <label>Fuel Type:</label>
        <select name="fuel_type" value={formData.fuel_type} onChange={handleChange}>
          <option value="diesel">Diesel</option>
          <option value="petrol">Petrol</option>
          <option value="hybrid">Hybrid</option>
          <option value="electric">Electric</option>
        </select>
      </div>
      <div>
        <label>Category:</label>
        <select name="category_id" value={formData.category_id} onChange={handleChange}>
          <option value="1">Car</option>
          <option value="2">Van</option>
        </select>
      </div>
      <div>
        <label>Sub Category:</label>
        <select name="sub_category" value={formData.sub_category} onChange={handleChange}>
          <option value="1">Combi</option>
          <option value="2">Limousine</option>
          <option value="3">Coupe</option>
          <option value="4">SUV</option>
        </select>
      </div>
      <div>
        <label>Images:</label>
        <input type="file" name="images" multiple />
      </div>
      <button type="submit">Create Ad</button>
    </form>
  );
};

export default CreateAdPage;