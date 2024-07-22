import { BrowserRouter, Routes, Route } from "react-router-dom";
import Layout from "./pages/Layout";
import RegisterPage from "./pages/RegisterPage";
import LoginPage from "./pages/LoginPage";
import { UserProvider } from "./context/UserContext";

const App = () => {
  return (
    <UserProvider>
      <BrowserRouter>
        <Routes>
          <Route index element={<Layout />} />
          <Route path="/register-user" element={<RegisterPage />} />
          <Route path="/login-user" element={<LoginPage />} />
        </Routes>
      </BrowserRouter>
    </UserProvider>
  );
};

export default App;