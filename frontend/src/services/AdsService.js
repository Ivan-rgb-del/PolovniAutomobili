import React, { useState, useEffect } from 'react';

const API_URL = "http://localhost/PolovniAutomobili/backend/api/ads.php";

const AdsService = () => {
  const [ads, setAds] = useState([]);

  useEffect(() => {
    fetch(API_URL)
      .then(response => response.json())
      .then(data => setAds(data))
      .catch(error => console.error('Error fetching ads:', error));
  }, []);

  return (
    <div>
      <h1>Ads List</h1>
      <ul>
        {ads.map(ad => (
          <li key={ad.id}>{ad.title}</li>
        ))}
      </ul>
    </div>
  );
};

export default AdsService;