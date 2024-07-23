const API_URL = "http://localhost/PolovniAutomobili/backend/api/ads.php";

const AdsService = async () => {
  try {
    const response = await fetch(API_URL);

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    return await response.json();
  } catch (error) {
    throw error;
  }
};

export default AdsService;