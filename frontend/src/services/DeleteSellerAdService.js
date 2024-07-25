export const DeleteSellerAdService = async (adId) => {
  try {
    const response = await fetch(`http://localhost/PolovniAutomobili/backend/api/deleteSellerAd.php?adId=${adId}`, {
      method: 'DELETE',
    });
    if (!response.ok) {
      throw new Error('Failed to delete ad');
    }
  } catch (error) {
    throw new Error(error.message);
  }
};