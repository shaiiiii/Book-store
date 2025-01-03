import axios from 'axios';

const API_BASE_URL = 'http://127.0.0.1:8000/api/admin';

// Retrieve token from localStorage (or another source)
const getAuthToken = () => {
    return localStorage.getItem('token');
};

export interface Book {
    id: number;
    title: string;
    author: string;
    price: number;
    stock: number;
    image?: string;
}

export interface CreateBookData {
    title: string;
    author: string;
    price: number;
    stock: number;
    image?: File;
}

// Fetch books with token authentication
export const fetchBooks = async () => {
    const token = getAuthToken();
    const response = await axios.get(`${API_BASE_URL}/books`, {
        headers: {
            'Authorization': `Bearer ${token}`,
        },
    });
    return response.data.data;
};

// Create book with token authentication
export const createBook = async (bookData: CreateBookData) => {
    const token = getAuthToken();
    const formData = new FormData();
    Object.entries(bookData).forEach(([key, value]) => {
        if (value !== undefined) {
            formData.append(key, value);
        }
    });

    const response = await axios.post(`${API_BASE_URL}/books/store`, formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
            'Authorization': `Bearer ${token}`,
        },
    });
    return response.data;
};
// Fetch a single book by its ID
export const fetchSingleBook = async (id: number) => {
    const token = getAuthToken();
    const response = await axios.get(`${API_BASE_URL}/books/${id}`, {
        headers: {
            'Authorization': `Bearer ${token}`,
        },
    });
    return response.data.data;
};
// Update book with token authentication
export const updateBook = async (id: number, bookData: CreateBookData) => {
    const token = getAuthToken();
    const formData = new FormData();
    Object.entries(bookData).forEach(([key, value]) => {
        if (value !== undefined) {
            formData.append(key, value);
        }
    });
    formData.append('_method', 'PUT'); // For Laravel PUT request

    const response = await axios.post(`${API_BASE_URL}/books/${id}`, formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
            'Authorization': `Bearer ${token}`,
        },
    });
    return response.data;
};
