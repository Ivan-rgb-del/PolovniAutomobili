import React, { useEffect, useState } from "react";
import GetSavedAdsService from "../services/GetSavedAdsService";

const SavedAdsPage = () => {
  const [savedAds, setSavedAds] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchSavedAds = async () => {
      const userId = localStorage.getItem('userId');
      try {
        const data = await GetSavedAdsService(userId);
        setSavedAds(data);
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };

    fetchSavedAds();
  }, []);

  if (loading) return <p>Loading...</p>;
  if (error) return <p>{error}</p>;

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
            <br /><br />
          </div>
        ))
      )}
    </div>
  );
};

export default SavedAdsPage;