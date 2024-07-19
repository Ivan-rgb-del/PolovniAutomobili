import { BrowserRouter, Routes, Route } from "react-router-dom";
import Layout from "./pages/Layout";
import RegisterUser from "./components/UserComponents/RegisterUser";
import LoginUser from "./components/UserComponents/LoginUser";

const App = () => {
  return (
    <div>
      <BrowserRouter>
        <Routes>
          <Route index element={<Layout />} />
          <Route path="/register-user" element={<RegisterUser />} />
          <Route path="/login-user" element={<LoginUser />} />
        </Routes>
      </BrowserRouter>
    </div>
  );
};

export default App;