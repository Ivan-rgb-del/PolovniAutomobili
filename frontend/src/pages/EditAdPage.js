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
    <div className="flex items-center justify-center min-h-screen bg-gray-100 p-4">
      <div className="w-full max-w-3xl bg-white p-8 rounded-lg shadow-md">
        <h2 className="text-2xl font-semibold mb-6 text-gray-700 text-center">Edit Ad</h2>
        <form onSubmit={handleSubmit} className="space-y-6">
          <div>
            <label className="block text-sm font-medium text-gray-600">Title:</label>
            <input className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:border-indigo-500 sm:text-sm" type="text" name="title" value={formData.title} onChange={handleChange} required />
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-600">Price:</label>
            <input className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:border-indigo-500 sm:text-sm" type="number" name="price" value={formData.price} onChange={handleChange} required />
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-600">Description:</label>
            <textarea className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:border-indigo-500 sm:text-sm" name="description" value={formData.description} onChange={handleChange} required />
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-600">First Registration:</label>
            <input className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:border-indigo-500 sm:text-sm" type="number" name="first_registration" value={formData.first_registration} onChange={handleChange} required />
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-600">Fuel Type:</label>
            <select className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:border-indigo-500 sm:text-sm" name="fuel_type" value={formData.fuel_type} onChange={handleChange}>
              <option value="diesel">Diesel</option>
              <option value="petrol">Petrol</option>
              <option value="electric">Electric</option>
              <option value="hybrid">Hybrid</option>
              <option value="natural gas">Natural Gas</option>
            </select>
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-600">Category:</label>
            <select className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:border-indigo-500 sm:text-sm" name="category_id" value={formData.category_id} onChange={handleChange}>
              <option value="">Select</option>
              <option value="1">Car</option>
              <option value="2">Van</option>
            </select>
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-600">Sub Category:</label>
            <select className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:border-indigo-500 sm:text-sm" name="sub_category" value={formData.sub_category} onChange={handleChange}>
              <option value="">Select</option>
              <option value="1">Combi</option>
              <option value="2">Limousine</option>
              <option value="3">Convertible</option>
              <option value="4">Coupe</option>
              <option value="5">SUV</option>
              <option value="6">Minivan</option>
              <option value="7">Cargo</option>
            </select>
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-600">Images:</label>
            <input className="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded-md file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" type="file" name="images" multiple />
          </div>
          <button className="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" type="submit">Edit ad</button>
        </form>
      </div>
    </div>
  );
};

export default EditAdPage;