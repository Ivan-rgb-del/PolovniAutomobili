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
  if (filteredAds.length === 0) return <p className="text-center text-gray-600">No ads found.</p>;

  return (
    <div className="min-h-screen bg-gray-100 p-4">
      <div className="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 className="text-3xl text-center font-bold text-gray-800 mb-4">Filtered Ads</h1>
        {filteredAds.map((ad) => (
          <div key={ad.id} className="mb-6 p-4 border-b border-gray-200">
            <h2 className="text-xl font-semibold text-gray-800">{ad.title}</h2>
            <p className="text-lg text-gray-600">Price: {ad.price}€</p>
            <p className="text-lg text-gray-600">Year: {ad.first_registration}</p>
            <p className="text-lg text-gray-600">Fuel: {ad.fuel_type}</p>
            <p className="text-lg text-gray-600">Description: {ad.description}</p>
            <Link to={`/ad/${ad.id}`}>
              <button className="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                More
              </button>
            </Link>
            <br />
            <br />
          </div>
        ))}
      </div>
    </div>
  );
};

export default FilteredAdsPage;