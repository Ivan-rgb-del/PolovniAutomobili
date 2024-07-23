const API_URL = "http://localhost/PolovniAutomobili/backend/api/saveAd.php";

const SaveAdService = async (adData) => {
  try {
    const response = await fetch(API_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(adData),
    });

    if (!response.ok) {
      const errorText = await response.text();
      throw new Error(`Network response was not ok: ${errorText}`);
    }

    return await response.json();
  } catch (error) {
    console.error('An error occurred while saving the ad:', error);
    throw error;
  }
};

export default SaveAdService;