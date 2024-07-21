import { BrowserRouter, Routes, Route } from "react-router-dom";
import Layout from "./pages/Layout";
import RegisterPage from "./pages/RegisterPage";
import LoginPage from "./pages/LoginPage";

const App = () => {
  return (
    <div>
      <BrowserRouter>
        <Routes>
          <Route index element={<Layout />} />
          <Route path="/register-user" element={<RegisterPage />} />
          <Route path="/login-user" element={<LoginPage />} />
        </Routes>
      </BrowserRouter>
    </div>
  );
};

export default App;