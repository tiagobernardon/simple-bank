import axios from 'axios';

const API_URL = import.meta.env.VITE_BACKEND_URL + '/api';

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const create = async ({ decription, amount }) => {
  let response = await axios.get(`${API_URL}/transactions`);

  await axios.post(`${API_URL}/transactions`, {
    decription: decription,
    amount: amount
  })
  return response?.data || [];
};

const get = async () => {
  let response = await axios.get(`${API_URL}/transactions`);

  return response?.data || [];
};

export default {
  get
};