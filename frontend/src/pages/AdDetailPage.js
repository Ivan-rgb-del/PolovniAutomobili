import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';

const AdDetailsPage = () => {
  const { id } = useParams();
  const [adDetails, setAdDetails] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

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

  if (loading) return <p>Loading...</p>;
  if (error) return <p>{error}</p>;
  if (!adDetails) return <p>No ad details available.</p>;

  return (
    <div>
      <h1>{adDetails.title}</h1>
      <p><strong>Price:</strong> ${adDetails.price}</p>
      <p><strong>Description:</strong> {adDetails.description}</p>
      <p><strong>First Registration:</strong> {adDetails.first_registration}</p>
      <p><strong>Fuel Type:</strong> {adDetails.fuel_type}</p>
    </div>
  );
};

export default AdDetailsPage;
