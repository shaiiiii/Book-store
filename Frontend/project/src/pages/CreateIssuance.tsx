import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { Navbar } from '../components/Navbar';
import { fetchBooks, Book } from '../api/books';
import { fetchUsers, User } from '../api/users';
import { createIssuance } from '../api/record';
import { UserSelect } from '../components/UserSelect';

export const CreateIssuance: React.FC = () => {
    const navigate = useNavigate();
    const [books, setBooks] = useState<Book[]>([]);
    const [users, setUsers] = useState<User[]>([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState('');
    const [formData, setFormData] = useState({
        book_id: '',
        user_id: '',
        issued_date: new Date().toISOString().split('T')[0]
    });

    useEffect(() => {
        loadData();
    }, []);

    const loadData = async () => {
        try {
            const [booksData, usersData] = await Promise.all([
                fetchBooks(),
                fetchUsers()
            ]);
            setBooks(booksData);
            setUsers(usersData);
        } catch (err) {
            setError('Failed to load data');
        }
    };

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setError('');
        setIsLoading(true);

        try {
            await createIssuance({
                book_id: Number(formData.book_id),
                user_id: Number(formData.user_id),
                issued_date: formData.issued_date
            });
            navigate('/records');
        } catch (err) {
            setError('Failed to create issuance record');
        } finally {
            setIsLoading(false);
        }
    };

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
        setFormData(prev => ({
            ...prev,
            [e.target.name]: e.target.value
        }));
    };

    return (
        <div className="min-h-screen bg-gray-50">
            <Navbar />
            <div className="flex">
                <div className="flex-1 max-w-2xl mx-auto px-4 py-8">
                    <h1 className="text-3xl font-bold text-gray-900 mb-8">Create Book Issuance</h1>

                    {error && (
                        <div className="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                            {error}
                        </div>
                    )}

                    <form onSubmit={handleSubmit} className="space-y-6 bg-white p-6 rounded-lg shadow">
                        <div>
                            <label className="block text-sm font-medium text-gray-700">Select Book</label>
                            <select
                                name="book_id"
                                required
                                value={formData.book_id}
                                onChange={handleChange}
                                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="">Select a book</option>
                                {books.map((book) => (
                                    <option key={book.id} value={book.id}>
                                        {book.title} by {book.author}
                                    </option>
                                ))}
                            </select>
                        </div>

                        <UserSelect
                            users={users}
                            value={formData.user_id}
                            onChange={handleChange}
                        />

                        <div>
                            <label className="block text-sm font-medium text-gray-700">Issue Date</label>
                            <input
                                type="date"
                                name="issued_date"
                                required
                                value={formData.issued_date}
                                onChange={handleChange}
                                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />
                        </div>

                        <div className="flex justify-end space-x-4">
                            <button
                                type="button"
                                onClick={() => navigate('/records')}
                                className="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                disabled={isLoading}
                                className="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 disabled:opacity-50"
                            >
                                {isLoading ? 'Creating...' : 'Create Issuance'}
                            </button>
                        </div>
                    </form>
                </div>

                <div className="hidden lg:block w-1/2">
                    <img
                        className="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=228&q=80"
                        alt="Library"
                    />
                </div>
            </div>
        </div>
    );
};
