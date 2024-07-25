export const GeTSellerAds = async (userId) => {
  try {
    const response = await fetch(`http://localhost/PolovniAutomobili/backend/api/getSellerAds.php?user_id=${userId}`);
    if (!response.ok) {
      throw new Error('Failed to fetch ads');
    }
    return await response.json();
  } catch (error) {
    throw new Error(error.message);
  }
};