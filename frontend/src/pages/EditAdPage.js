import React, { useState, useEffect } from 'react';
import { useParams  } from 'react-router-dom';
import { EditAdService } from '../services/EditAdService';

const EditAdPage = () => {
  const { adId } = useParams();
  const [formData, setFormData] = useState({
    id: adId,
    title: '',
    price: 0,
    description: '',
    first_registration: 0,
    fuel_type: "diesel",
    category_id: 0,
    sub_category: 0
  });

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await EditAdService(formData.id);
    } catch (error) {
      console.error('Failed to update ad', error);
    }
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
      <button type="submit">Edit ad</button>
    </form>
  );
};

export default EditAdPage;