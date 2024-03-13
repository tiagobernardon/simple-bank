import axios from 'axios';

const API_URL = import.meta.env.VITE_BACKEND_URL + '/api';

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const getBalance = async () => {
  let response = await axios.get(`${API_URL}/balance`);

  return response.data || 0.00;
};

export default {  
  getBalance
};