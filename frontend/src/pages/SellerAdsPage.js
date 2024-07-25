import React, { useEffect, useState } from 'react';
import { GeTSellerAds } from '../services/GetSellerAds';

const SellerAdspage = () => {
  const [ads, setAds] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchMyAds = async () => {
      const userId = localStorage.getItem('userId');
      try {
        const data = await GeTSellerAds(userId);
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
      const response = await fetch(`http://localhost/PolovniAutomobili/backend/api/deleteSellerAd.php?adId=${adId}`, {
        method: 'DELETE',
      });
      if (!response.ok) {
        throw new Error('Failed to delete ad');
      }
      setAds(ads.filter(ad => ad.id !== adId));
    } catch (err) {
      setError(err.message);
    }
  };

  if (loading) return <p>Loading...</p>;
  if (error) return <p>{error}</p>;

  return (
    <div>
      <h1>My Ads</h1><br />
      <ul>
        {ads.map(ad => (
          <li key={ad.id}>
            <h2>{ad.title}</h2>
            <p>Price: ${ad.price}</p>
            <p>Description: {ad.description}</p>
            <p>First Registration: {ad.first_registration}</p>
            <p>Fuel Type: {ad.fuel_type}</p>
            <button onClick={() => handleDelete(ad.id)}>Delete</button>
            <br /><br />
          </li>
        ))}
      </ul>
    </div>
  );
};

export default SellerAdspage;
