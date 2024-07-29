export const EditAdService = async (ad) => {
  const response = await fetch(`http://localhost/PolovniAutomobili/backend/api/editAd.php?adId=${ad.id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(ad),
  });

  if (!response.ok) {
    throw new Error('Failed to update ad');
  }

  return await response.json();
};