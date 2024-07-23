import React, { useEffect, useState } from "react";
import AdsService from "../services/AdsService";

const AdsPage = () => {
  const [ads, setAds] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const getAds = async () => {
      try {
        const data = await AdsService();
        setAds(data);
      } catch (err) {
        setError(err);
      } finally {
        setLoading(false);
      }
    };

    getAds();
  }, [])

  if (loading) return <p>Loading...</p>;

  return (
    <div>
      <h1>All Ads</h1><br /><br />
      {ads.map((ad) => (
        <div key={ad.id}>
          <h1>Title: {ad.title}</h1>
          <img src="" alt={ad.title} />
          <p>Price: {ad.price}€</p>
          <p>Year: {ad.first_registration}</p>
          <p>Fuel: {ad.fuel_type}</p>
          <p>Description: {ad.description}</p>
          <a href="#">More</a>
          <br />
          <a href="#">Save</a>
          <br />
          <br />
        </div>
      ))}
    </div>
  )
};

export default AdsPage;