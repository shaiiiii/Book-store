import React, { useState, useEffect } from 'react';
import { Plus } from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import { Navbar } from '../components/Navbar';
import { BookCard } from '../components/BookCard';
import { fetchBooks, Book } from '../api/books';
import axios from "axios";

export const Dashboard: React.FC = () => {
  const navigate = useNavigate();
  const [books, setBooks] = useState<Book[]>([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    loadBooks();
  }, []);

  const loadBooks = async () => {
    try {
      const data = await fetchBooks();
      console.log("books are : ",data);
      setBooks(data);
    } catch (err) {
      setError('Failed to load books');
    } finally {
      setIsLoading(false);
    }
  };

  const handleEdit = (id: number) => {
    navigate(`/books/edit/${id}`);
  };

  const API_BASE_URL = 'http://127.0.0.1:8000/api/admin';

  const handleDelete = async (id: number) => {
    if (window.confirm('Are you sure you want to delete this book?')) {
      try {
        const token = localStorage.getItem('token'); // Retrieve token from local storage
        if (!token) {
          throw new Error('Unauthorized: No token found');
        }

        await axios.delete(`${API_BASE_URL}/books/${id}`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        console.log('Book deleted successfully:', id);
        alert('Book deleted successfully!');
        await loadBooks();
        // Optionally, refresh the book list or handle UI changes
      } catch (error) {
        console.error('Error deleting book:', error);
        alert('Failed to delete the book. Please try again.');
      }
    }
  };

  if (isLoading) {
    return (
        <div className="min-h-screen bg-gray-50">
          <Navbar />
          <div className="max-w-7xl mx-auto px-4 py-8 flex justify-center items-center">
            <p className="text-gray-500">Loading books...</p>
          </div>
        </div>
    );
  }

  return (
      <div className="min-h-screen bg-gray-50">
        <Navbar />
        <div className="max-w-7xl mx-auto px-4 py-8">
          <div className="flex justify-between items-center mb-8">
            <h1 className="text-3xl font-bold text-gray-900">Books Collection</h1>
            <button
                onClick={() => navigate('/books/create')}
                className="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
            >
              <Plus className="w-5 h-5 mr-2" />
              Add New Book
            </button>
          </div>

          {error && (
              <div className="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                {error}
              </div>
          )}

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {books.map((book) => (
                <BookCard
                    key={book.id}
                    {...book}
                    onEdit={handleEdit}
                    onDelete={handleDelete}
                />
            ))}
          </div>
        </div>
      </div>
  );
};
