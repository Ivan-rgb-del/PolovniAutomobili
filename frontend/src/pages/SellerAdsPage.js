import React, { useEffect, useState } from 'react';
import { GeTSellerAdsService } from '../services/GetSellerAdsService';
import { DeleteSellerAdService } from '../services/DeleteSellerAdService';
import { Link } from 'react-router-dom';

const SellerAdspage = () => {
  const [ads, setAds] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchMyAds = async () => {
      const userId = localStorage.getItem('userId');
      try {
        const data = await GeTSellerAdsService(userId);
        setAds(data);
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };

    fetchMyAds();
  }, []);

  const handleDelete = async (adId) => {
    try {
      await DeleteSellerAdService(adId);
      setAds(ads.filter(ad => ad.id !== adId));
    } catch (err) {
      setError(err.message);
    }
  };


  if (loading) return <p>Loading...</p>;

  return (
    <div className="min-h-screen bg-gray-100 p-4">
      <h1 className="text-3xl font-semibold mb-6 text-gray-800 text-center">My Ads</h1>
      <div className="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <ul className="space-y-4">
          {ads.map(ad => (
            <li key={ad.id} className="border border-gray-300 rounded-lg p-4 shadow-sm bg-white">
              <h2 className="text-xl font-bold text-gray-800">{ad.title}</h2>
              <p className="text-gray-600">Price: ${ad.price}</p>
              <p className="text-gray-600">Description: {ad.description}</p>
              <p className="text-gray-600">First Registration: {ad.first_registration}</p>
              <p className="text-gray-600">Fuel Type: {ad.fuel_type}</p>
              <div className="mt-4 flex space-x-4">
                <button
                  onClick={() => handleDelete(ad.id)}
                  className="px-4 py-2 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                >
                  Delete
                </button>
                <Link to={`/edit-ad/${ad.id}`}>
                  <button className="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Edit
                  </button>
                </Link>
              </div>
            </li>
          ))}
        </ul>
      </div>
    </div>
  );
};

export default SellerAdspage;