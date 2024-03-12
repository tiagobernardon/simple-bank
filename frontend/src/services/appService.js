import axios from 'axios';
import { useAppStore } from '@/store/app';

const AUTH_URL = import.meta.env.VITE_BACKEND_URL;

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const login = async (username, password) => {
  try {
    //Initialize CSRF protection
    await axios.get(`${AUTH_URL}/sanctum/csrf-cookie`);

    await axios.post(`${AUTH_URL}/login`, {
      username: username,
      password: password
    }).catch(error => {
      throw error;
    });

  } catch (error) {
      throw error;
  }
};

const logout = async () => {
  try {
    await axios.post(`${AUTH_URL}/logout`).then(() => {
      const store = useAppStore();
      store.setUser({});
    }).catch(error => {
      throw error;
    });
  } catch (error) {
      throw error;
  }
};

export default {
    login,
    logout
};