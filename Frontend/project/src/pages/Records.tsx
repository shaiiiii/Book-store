import React, { useState, useEffect } from 'react';
import { Plus } from 'lucide-react';
import { Navbar } from '../components/Navbar';
import { StatusBadge } from '../components/StatusBadge';
import { fetchBookIssuances, BookIssuance, updateStatus } from '../api/record';
import { useNavigate } from 'react-router-dom';

export const Records: React.FC = () => {
    const [issuances, setIssuances] = useState<BookIssuance[]>([]);
    const [isLoading, setIsLoading] = useState(true);
    const [error, setError] = useState('');
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    const userId = user.id;
    const userRole = user.role; // 0 for user, 1 for admin
    const navigate = useNavigate();

    useEffect(() => {
        loadIssuances();
    }, []);

    const handleStatusChange = async (id: number, newStatus: string) => {
        try {
            const updatedRecord = await updateStatus(id, newStatus);
            setIssuances((prev) =>
                prev.map((issuance) =>
                    issuance.id === id ? { ...issuance, ...updatedRecord.data } : issuance
                )
            );
        } catch (err) {
            setError('Failed to update status');
        }
    };

    const loadIssuances = async () => {
        try {
            const data = await fetchBookIssuances(userId);
            setIssuances(data);
        } catch (err) {
            setError('Failed to load book issuances');
        } finally {
            setIsLoading(false);
        }
    };

    if (isLoading) {
        return (
            <div className="min-h-screen bg-gray-50">
                <Navbar />
                <div className="max-w-7xl mx-auto px-4 py-8 flex justify-center items-center">
                    <p className="text-gray-500">Loading records...</p>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-gray-50">
            <Navbar />
            <div className="max-w-7xl mx-auto px-4 py-8">
                <div className="flex justify-between items-center mb-8">
                    <h1 className="text-3xl font-bold text-gray-900">Book Issuance Records</h1>
                    {userRole === 1 && (
                        <button
                            onClick={() => navigate('/records/create')}
                            className="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                        >
                            <Plus className="w-5 h-5 mr-2" />
                            New Record
                        </button>
                    )}
                </div>

                {error && (
                    <div className="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                        {error}
                    </div>
                )}

                <div className="bg-white shadow-md rounded-lg overflow-hidden">
                    <table className="min-w-full divide-y divide-gray-200">
                        <thead className="bg-gray-50">
                        <tr>
                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Book Title
                            </th>
                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Student Name
                            </th>
                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Issued Date
                            </th>
                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Returned Date
                            </th>
                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody className="bg-white divide-y divide-gray-200">
                        {issuances.map((issuance) => (
                            <tr key={issuance.id}>
                                <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {issuance.book_title}
                                </td>
                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {issuance.user_name}
                                </td>
                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {issuance.issued_date}
                                </td>
                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {issuance.received_date || 'Pending'}
                                </td>
                                <td className="px-6 py-4 whitespace-nowrap">
                                    <StatusBadge status={issuance.status} />
                                </td>
                                <td className="px-6 py-4 whitespace-nowrap">
                                    {issuance.status === 'issued' && userRole === 1 ? (
                                        <button
                                            onClick={() => handleStatusChange(issuance.id, 'received')}
                                            className="text-green-600 hover:text-green-900"
                                        >
                                            Mark as Received
                                        </button>
                                    ) : (
                                        <span className="text-gray-500">No Action</span>
                                    )}
                                </td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
};
