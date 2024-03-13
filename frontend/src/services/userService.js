import axios from 'axios';
import { useAppStore } from '@/store/app';

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL;

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const create = async ({ username, password }) => {
  await axios.get(`${BACKEND_URL}/sanctum/csrf-cookie`);

  const data = new FormData();
  data.append('username', username);
  data.append('password', password);

  await axios.post(`${BACKEND_URL}/register`, data);
};

const get = async () => {
  await axios.get(`${BACKEND_URL}/api/user`).then(async (res) => {
    const store = useAppStore();
    store.setUser(res.data);
  });
};

export default {
    create,
    get
};