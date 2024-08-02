export const EditAdService = async (formData) => {
  const response = await fetch(`http://localhost/PolovniAutomobili/backend/api/editAd.php?adId=${formData.adId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(formData),
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error('Error response:', errorText);
    throw new Error('Failed to update ad');
  }

  return await response.json();
};