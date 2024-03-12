import axios from 'axios';
import { useAppStore } from '@/store/app';

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL;

const create = async (username, password) => {
  try {
    await axios.post(`${BACKEND_URL}/register`, {
        username: username,
        password: password
    })
    .catch(error => {
        throw error;
    });
  } catch (error) {
      throw error;
  }
};

const get = async () => {
  try {   
    axios.defaults.withCredentials = true;
    axios.defaults.withXSRFToken = true;

    await axios.get(`${BACKEND_URL}/api/user`).then(async (res) => {
      const store = useAppStore();
      store.setUser(res.data);
    }).catch(error => {
      throw error;
    });
  } catch (error) {
      throw error;
  }
};

export default {
    create,
    get
};