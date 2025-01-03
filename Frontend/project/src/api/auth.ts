import axios from 'axios';

const API_BASE_URL = 'http://127.0.0.1:8000/api';

interface LoginCredentials {
  email: string;
  password: string;
}

interface RegisterCredentials {
  name: string;
  email: string;
  password: string;
  password_confirmation: string;
}

export const login = async (credentials: LoginCredentials) => {
  try {
    const response = await axios.post(`${API_BASE_URL}/login`, credentials);

    // Store user data in localStorage or sessionStorage
    localStorage.setItem('user', JSON.stringify(response.data.user));
    localStorage.setItem('token', response.data.token);

    return response.data;
  } catch (error) {
    throw error;
  }
};

export const register = async (credentials: RegisterCredentials) => {
  try {
    const response = await axios.post(`${API_BASE_URL}/register`, credentials);

    // Store user data in localStorage or sessionStorage
    localStorage.setItem('user', JSON.stringify(response.data.user));
    localStorage.setItem('token', response.data.token);

    return response.data;
  } catch (error) {
    throw error;
  }
};
