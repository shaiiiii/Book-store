import axios from 'axios';

export interface User {
    id: number;
    name: string;
    email: string;
    role: number;
}
// Retrieve token from localStorage (or another source)
const getAuthToken = () => {
    return localStorage.getItem('token'); // or your preferred method of storage
};
export const fetchUsers = async () => {
    const token=getAuthToken();
    const response = await axios.get('http://127.0.0.1:8000/api/users',{
        headers: {
            'Authorization': `Bearer ${token}`,
        },
    });
    return response.data.data;
};
