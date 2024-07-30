import React, { useEffect, useState } from "react";
import GetSavedAdsService from "../services/GetSavedAdsService";
import RemoveSavedAdService from "../services/RemoveSavedAdService";

const SavedAdsPage = () => {
  const [savedAds, setSavedAds] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const userId = localStorage.getItem('userId');

  useEffect(() => {
    const fetchSavedAds = async () => {
      try {
        const data = await GetSavedAdsService(userId);
        setSavedAds(data);
      } catch (err) {
        setError("Failed to fetch saved ads!");
      } finally {
        setLoading(false);
      }
    };

    fetchSavedAds();
  }, []);

  const handleRemove = async (adId) => {
    try {
      const result = await RemoveSavedAdService(adId, userId);

      if (result.message === "Ad removed successfully.") {
        setSavedAds(savedAds.filter(ad => ad.id !== adId));
      } else {
        alert('An error occurred while removing the ad');
      }
    } catch (error) {
      alert('An error occurred while removing the ad');
    }
  };

  if (loading) return <p>Loading...</p>;

  return (
    <div className="min-h-screen bg-gray-100 p-4">
      <div className="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 className="text-3xl text-center font-bold text-gray-800 mb-4">Saved Ads</h1>
        {savedAds.length === 0 ? (
          <p className="text-center text-gray-600">No saved ads found.</p>
        ) : (
          savedAds.map((ad) => (
            <div key={ad.id} className="mb-6 p-4 border-b border-gray-200">
              <h2 className="text-xl font-semibold text-gray-800">{ad.title}</h2>
              <p className="text-lg text-gray-600">Price: ${ad.price}</p>
              <p className="text-lg text-gray-600">Description: {ad.description}</p>
              <p className="text-lg text-gray-600">First Registration: {ad.first_registration}</p>
              <p className="text-lg text-gray-600">Fuel Type: {ad.fuel_type}</p>
              <button 
                onClick={() => handleRemove(ad.id)} 
                className="mt-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
              >
                Remove
              </button>
            </div>
          ))
        )}
      </div>
    </div>
  );
};

export default SavedAdsPage;