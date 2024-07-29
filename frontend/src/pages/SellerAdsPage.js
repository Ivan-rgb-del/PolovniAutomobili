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
            <button onClick={() => handleDelete(ad.id)}>Delete</button><br />
            <Link to={`/edit-ad/${ad.id}`}>
              <button>Edit</button>
            </Link>
            <br /><br />
          </li>
        ))}
      </ul>
    </div>
  );
};

export default SellerAdspage;