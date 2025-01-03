import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { Login } from './pages/Login';
import { Register } from './pages/Register';
import { Dashboard } from './pages/Dashboard';
import { Records } from './pages/Records';
import {CreateBook} from "./pages/CreateBook.tsx";
import {EditBook} from "./pages/EditBook.tsx";
import {CreateIssuance} from "./pages/CreateIssuance.tsx";

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/dashboard" element={<Dashboard />} />
          <Route path="/records" element={<Records />} />
          <Route path="/books/create" element={<CreateBook />} />
          <Route path="/" element={<Navigate to="/login" replace />} />
        <Route path="/books/edit/:id" element={<EditBook />} />
        <Route path="/records/create" element={<CreateIssuance />} />
        <Route path="/" element={<Navigate to="/login" replace />} />
      </Routes>
    </Router>
  );
}

export default App;
