import axios from 'axios';

const API_URL = import.meta.env.VITE_BACKEND_URL + '/api';

const get = async () => {
  let response = await axios.get(`${API_URL}/transactions`);

  return response?.data || [];
};

export default {
  get
};