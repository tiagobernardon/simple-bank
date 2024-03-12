export const required = value => {
    return !!value || 'Required field!';
};

export const password = value => {
    return (value?.length > 7) || 'Password must be at least 8 characters!';
};

export const username = value => {
    return (value === value?.toLowerCase()) || 'Username must be lowercase!';
};