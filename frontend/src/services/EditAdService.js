export const EditAdService = async ({adId}) => {
  if (adId) {
    throw new Error('Missing ad ID');
  }

  const response = await fetch(`http://localhost/PolovniAutomobili/backend/api/editAd.php?adId=${adId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(adId),
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error('Error response:', errorText);
    throw new Error('Failed to update ad');
  }

  return await response.json();
};