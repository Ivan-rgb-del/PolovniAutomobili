const API_URL = "http://localhost/PolovniAutomobili/backend/api/removeSavedAd.php";

const RemoveSavedAdService = async (adId, userId) => {
  try {
    const response = await fetch(API_URL, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ advertisement_id: adId, user_id: userId }),
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    return await response.json();
  } catch (error) {
    throw error;
  }
};

export default RemoveSavedAdService;