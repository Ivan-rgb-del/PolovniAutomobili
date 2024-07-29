import React, { useEffect, useState } from "react";
import { useLocation, Link } from "react-router-dom";
import AdsService from "../services/AdsService";

const useQuery = () => {
  return new URLSearchParams(useLocation().search);
};

const FilteredAdsPage = () => {
  const [filteredAds, setFilteredAds] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const query = useQuery();
  const filterQuery = query.get("query");

  useEffect(() => {
    const getFilteredAds = async () => {
      try {
        const data = await AdsService();
        const filtered = data.filter(ad => ad.title.toLowerCase().includes(filterQuery.toLowerCase()));
        setFilteredAds(filtered);
      } catch (err) {
        setError(err);
      } finally {
        setLoading(false);
      }
    };

    getFilteredAds();
  }, [filterQuery]);

  if (loading) return <p>Loading...</p>;

  return (
    <div>
      <h1>Filtered Ads</h1><br /><br />
      {filteredAds.map((ad) => (
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
          <br />
        </div>
      ))}
    </div>
  );
};

export default FilteredAdsPage;