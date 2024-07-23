const API_URL = "http://localhost/PolovniAutomobili/backend/api/ads.php";

const AddNewAdService = async (adData) => {
  try {
    const response = await fetch(API_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: adData,
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    return await response.json();
  } catch (error) {
    throw error;
  }
};

export default AddNewAdService;