import axios from 'axios';

const API_URL = import.meta.env.VITE_BACKEND_URL + '/api';

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const create = async ({ description, amount, type, check }) => {
  // format currency
  let formattedAmount 
  formattedAmount = amount.replace(/\$|,/g, '');
  formattedAmount = parseFloat(formattedAmount);
  formattedAmount = formattedAmount.toFixed(2);

  const data = new FormData();
  data.append('description', description);
  data.append('amount', formattedAmount);
  data.append('type', type);

  if (check) {
    data.append('check', check);
  }

  let response = await axios.post(`${API_URL}/transactions`, data);

  return response?.data || [];
};

const get = async () => {
  let response = await axios.get(`${API_URL}/transactions`);

  return response?.data || [];
};

export default {
  create,
  get
};