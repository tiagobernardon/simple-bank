const buildQueryString = async (filters) => {
  let returnString = ''

  if (filters) {
    let i = 0;

    for (const [key, value] of Object.entries(filters)) {
      if (value !== '' && value !== null) {
        returnString += `&${key}=${value}`
      }
    }
  }
  return returnString
};

export default {
    buildQueryString
};