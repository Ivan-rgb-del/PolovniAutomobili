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
      await SaveAdService({ advertisement_id: adId, user_id: userId });
      navigate("/saved-ads", { replace: true });
    } catch (err) {
      setError('An error occurred while saving the ad');
    }
  };

  const handleFilter = () => {
    navigate(`/filter-ads?query=${filterQuery}`);
  };

  if (loading) return <p>Loading...</p>;

  return (
    <div className="min-h-screen bg-gray-100 p-4">
      <h1 className="text-3xl font-semibold mb-6 text-gray-800 text-center">All Ads</h1>
      <div className="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div className="flex mb-4">
          <input
            type="text"
            value={filterQuery}
            onChange={(e) => setFilterQuery(e.target.value)}
            placeholder="Filter by title"
            className="flex-1 px-4 py-2 border border-gray-300 rounded-md"
          />
          <button
            onClick={handleFilter}
            className="ml-4 px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
          >
            Filter
          </button>
        </div>
        {ads.map((ad) => (
          <div key={ad.id} className="border border-gray-300 rounded-lg p-4 shadow-sm bg-white mb-4">
            <h2 className="text-xl font-bold text-gray-800">{ad.title}</h2>
            <p className="text-gray-600">Price: {ad.price}€</p>
            <p className="text-gray-600">Year: {ad.first_registration}</p>
            <p className="text-gray-600">Fuel: {ad.fuel_type}</p>
            <p className="text-gray-600">Description: {ad.description}</p>
            <div className="mt-4 flex space-x-4">
              <Link to={`/ad/${ad.id}`}>
                <button className="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                  More
                </button>
              </Link>
              <button
                onClick={() => handleSave(ad.id)}
                className="px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
              >
                Save
              </button>
            </div>
          </div>
        ))}
      </div>
    </div>
  )
};

export default AdsPage;