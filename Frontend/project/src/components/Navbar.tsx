import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { LogOut, BookOpen, ClipboardList } from 'lucide-react';

export const Navbar: React.FC = () => {
  const navigate = useNavigate();

  // Get user role from localStorage
  const user = JSON.parse(localStorage.getItem('user') || '{}');
  const role = user.role;

  const handleLogout = () => {
    // Clear any stored auth tokens
    localStorage.removeItem('token');
    navigate('/login');
  };

  return (
      <nav className="bg-white shadow-lg">
        <div className="max-w-7xl mx-auto px-4">
          <div className="flex justify-between h-16">
            <div className="flex space-x-8">
              {/* Render Books and Records links only for role 1 (admin) */}
              {role === 1 && (
                  <>
                    <Link
                        to="/dashboard"
                        className="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600"
                    >
                      <BookOpen className="w-5 h-5 mr-2" />
                      Books
                    </Link>
                    <Link
                        to="/records"
                        className="inline-flex items-center px-1 pt-1 text-gray-900 hover:text-indigo-600"
                    >
                      <ClipboardList className="w-5 h-5 mr-2" />
                      Records
                    </Link>
                  </>
              )}
            </div>
            <button
                onClick={handleLogout}
                className="inline-flex items-center px-4 py-2 text-red-600 hover:text-red-800"
            >
              <LogOut className="w-5 h-5 mr-2" />
              Logout
            </button>
          </div>
        </div>
      </nav>
  );
};
