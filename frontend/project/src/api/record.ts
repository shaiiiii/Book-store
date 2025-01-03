import axios from 'axios';

const API_BASE_URL = 'http://127.0.0.1:8000/api/admin';

// Retrieve token from localStorage (or another source)
const getAuthToken = () => {
    return localStorage.getItem('token'); // or your preferred method of storage
};

export interface BookIssuance {
    id: number;
    book_id: number;
    book_title: string;
    user_name: string;
    issued_date: string;
    received_date: string;
    status: 'issued' | 'returned' | 'overdue';
}

// Fetch book issuances for a user with token authentication
export const fetchBookIssuances = async (userId: string) => {
    const token = getAuthToken();
    const response = await axios.get(`${API_BASE_URL}/book-issuances/${userId}`, {
        headers: {
            'Authorization': `Bearer ${token}`,
        },
    });
    console.log(response.data);
    return response.data.data;
};

// Update book issuance status with token authentication
export const updateStatus = async (id: number, status: string) => {
    const token = getAuthToken();
    const response = await axios.put(`${API_BASE_URL}/book-issuances/${id}/receive`,
        { status },
        {
            headers: {
                'Authorization': `Bearer ${token}`,
            },
        });
    return response.data;
};

export interface CreateIssuanceData {
    book_id: number;
    user_id: number;
    issued_date: string;
}

// Create book issuance with token authentication
export const createIssuance = async (data: CreateIssuanceData) => {
    const token = getAuthToken();
    const response = await axios.post(`${API_BASE_URL}/book-issuances`, data, {
        headers: {
            'Authorization': `Bearer ${token}`,
        },
    });
    return response.data;
};

// Fetch book issuances for a specific user with token authentication
export const fetchUserBookIssuances = async (userId: number) => {
    const token = getAuthToken();
    const response = await axios.get(`${API_BASE_URL}/user/${userId}`, {
        headers: {
            'Authorization': `Bearer ${token}`,
        },
    });
    return response.data.data;
};
