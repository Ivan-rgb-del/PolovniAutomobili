import { BrowserRouter, Routes, Route } from "react-router-dom";
import Layout from "./pages/Layout";
import RegisterPage from "./pages/RegisterPage";
import LoginPage from "./pages/LoginPage";
import { UserProvider } from "./context/UserContext";
import AddNewAdPage from "./pages/AddNewAdPage";
import AdsPage from "./pages/AdsPage";
import AdDetailsPage from "./pages/AdDetailPage";
import SavedAdsPage from "./pages/SavedAdsPage";
import SellerAdsPage from "./pages/SellerAdsPage";
import EditAdPage from "./pages/EditAdPage";

const App = () => {
  return (
    <UserProvider>
      <BrowserRouter>
        <Routes>
          <Route index element={<Layout />} />
          <Route path="/register-user" element={<RegisterPage />} />
          <Route path="/login-user" element={<LoginPage />} />
          <Route path="/add-new-ad" element={<AddNewAdPage />} />
          <Route path="/look-for-new-ads" element={<AdsPage />} />
          <Route path="/ad/:id" element={<AdDetailsPage />} />
          <Route path="/saved-ads" element={<SavedAdsPage />} />
          <Route path="/my-ads" element={<SellerAdsPage />} />
          <Route path="/edit-ad/:id" element={<EditAdPage />} />
        </Routes>
      </BrowserRouter>
    </UserProvider>
  );
};

export default App;