import axios from 'axios'

const API_URL = import.meta.env.VITE_API_URL

const get = async () => {
  try {
    let { data } = await axios.get(`${API_URL}/transactions`)

    return data
  } catch (error) {
      throw error;
  }
};

export default {
  get
};