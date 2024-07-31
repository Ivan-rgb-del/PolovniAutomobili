import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import SaveAdService from '../services/SaveAdService';
import { useNavigate } from 'react-router-dom';

const AdDetailsPage = () => {
  const { id } = useParams();
  const [adDetails, setAdDetails] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    const fetchAdDetails = async () => {
      try {
        const response = await fetch(`http://localhost/PolovniAutomobili/backend/api/adDetail.php?id=${id}`);
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        const data = await response.json();
        setAdDetails(data);
      } catch (err) {
        setError('An error occurred while fetching ad details');
      } finally {
        setLoading(false);
      }
    };

    fetchAdDetails();
  }, [id]);

  const handleSave = async (adId) => {
    const userId = localStorage.getItem('userId');

    try {
      const response = await SaveAdService({ advertisement_id: adId, user_id: userId });
      navigate("/saved-ads", { replace: true });
    } catch (err) {
      setError('An error occurred while saving the ad');
    }
  };

  if (loading) return <p>Loading...</p>;
  if (error) return <p>{error}</p>;
  if (!adDetails) return <p>No ad details available.</p>;

  return (
    <div className="min-h-screen bg-gray-100 p-4">
      <div className="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 className="text-3xl font-bold text-gray-800 mb-4">{adDetails.title}</h1>
        <p className="text-lg text-gray-600 mb-2">
          <strong>Price: </strong>
          ${adDetails.price}
        </p>
        <p className="text-lg text-gray-600 mb-2">
          <strong>Description: </strong>
          {adDetails.description}
        </p>
        <p className="text-lg text-gray-600 mb-2">
          <strong>First Registration: </strong>
          {adDetails.first_registration}
        </p>
        <p className="text-lg text-gray-600 mb-2">
          <strong>Fuel Type: </strong>
          {adDetails.fuel_type}
        </p>
        <button
          onClick={() => handleSave(adDetails.id)}
          className="px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
        >
          Save
        </button>
      </div>
    </div>
  );
};

export default AdDetailsPage;
