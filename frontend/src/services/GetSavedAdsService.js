const API_URL = "http://localhost/PolovniAutomobili/backend/api/getSavedAds.php";

const GetSavedAdsService = async (userId) => {
  try {
    const response = await fetch(`${API_URL}?user_id=${userId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    return await response.json();
  } catch (error) {
    throw error;
  }
};

export default GetSavedAdsService;