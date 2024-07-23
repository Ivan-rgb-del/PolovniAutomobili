import { BrowserRouter, Routes, Route } from "react-router-dom";
import Layout from "./pages/Layout";
import RegisterPage from "./pages/RegisterPage";
import LoginPage from "./pages/LoginPage";
import { UserProvider } from "./context/UserContext";
import AddNewAdPage from "./pages/AddNewAdPage";
import AdsPage from "./pages/AdsPage";

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
        </Routes>
      </BrowserRouter>
    </UserProvider>
  );
};

export default App;