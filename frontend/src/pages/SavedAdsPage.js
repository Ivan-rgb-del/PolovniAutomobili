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
    <div>
      <h1>Saved Ads</h1><br />
      {savedAds.length === 0 ? (
        <p>No saved ads found.</p>
      ) : (
        savedAds.map((ad) => (
          <div key={ad.id}>
            <h2>{ad.title}</h2>
            <p>Price: ${ad.price}</p>
            <p>Description: {ad.description}</p>
            <p>First Registration: {ad.first_registration}</p>
            <p>Fuel Type: {ad.fuel_type}</p>
            <button onClick={() => handleRemove(ad.id)}>Remove</button>
            <br /><br />
          </div>
        ))
      )}
    </div>
  );
};

export default SavedAdsPage;