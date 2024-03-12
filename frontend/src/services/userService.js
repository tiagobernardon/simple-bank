import axios from 'axios';
import { useAppStore } from '@/store/app';

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL;

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const create = async ({ username, password }) => {
  await axios.get(`${BACKEND_URL}/sanctum/csrf-cookie`);

  await axios.post(`${BACKEND_URL}/register`, {
      username: username,
      password: password
  });
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