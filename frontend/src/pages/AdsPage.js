import React, { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import AdsService from "../services/AdsService";
import SaveAdService from "../services/SaveAdService";

const AdsPage = () => {
  const [ads, setAds] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [filterQuery, setFilterQuery] = useState("");
  const navigate = useNavigate();

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

  const handleSave = async (adId) => {
    const userId = localStorage.getItem('userId');

    try {
      const response = await SaveAdService({ advertisement_id: adId, user_id: userId });
      alert(response.message);
    } catch (err) {
      setError('An error occurred while saving the ad');
    }
  };

  const handleFilter = () => {
    navigate(`/filter-ads?query=${filterQuery}`);
  };

  if (loading) return <p>Loading...</p>;

  return (
    <div>
      <h1>All Ads</h1><br />
      <input
        type="text"
        value={filterQuery}
        onChange={(e) => setFilterQuery(e.target.value)}
        placeholder="Filter by title"
      />
      <button onClick={handleFilter}>Filter</button>
      <br />
      <br />
      {ads.map((ad) => (
        <div key={ad.id}>
          <h1>Title: {ad.title}</h1>
          <img src="" alt={ad.title} />
          <p>Price: {ad.price}€</p>
          <p>Year: {ad.first_registration}</p>
          <p>Fuel: {ad.fuel_type}</p>
          <p>Description: {ad.description}</p>
          <Link to={`/ad/${ad.id}`}>
            <button>More</button>
          </Link>
          <br />
          <button onClick={() => handleSave(ad.id)}>Save</button>
          <br />
          <br />
        </div>
      ))}
    </div>
  )
};

export default AdsPage;