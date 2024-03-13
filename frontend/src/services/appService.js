import axios from 'axios';
import { useAppStore } from '@/store/app';

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL;

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const login = async ({ username, password }) => {
  await axios.get(`${BACKEND_URL}/sanctum/csrf-cookie`);

  const data = new FormData();
  data.append('username', username);
  data.append('password', password);

  await axios.post(`${BACKEND_URL}/login`, data);
};

const logout = async () => {
  await axios.post(`${BACKEND_URL}/logout`).then(() => {
    const store = useAppStore();
    store.setUser({});
  })
};

export default {
    login,
    logout
};