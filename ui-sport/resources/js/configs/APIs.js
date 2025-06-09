import axios from 'axios';
import Cookies from 'js-cookie';

const BASE_URL = 'http://127.0.0.1:8000/';

export const endpoints = {
    categories: '/api/categories',
    products: '/api/products',
    productDetails: '/api/product/detail',
    categoryDetails: '/api/category/detail',
    comments: '/comments',
    events: '/events',
    eventDetails: '/event/detail',
    cartAdd: '/carts',
    carts: '/carts',
    checkout: '/api/checkout',
    login: '/login',
    logout: '/logout',
    'csrf-token': '/csrf-token',
    'csrf-cookie': 'sanctum/csrf-cookie',
};

export default axios.create({
    withCredentials: true,
    baseURL: BASE_URL,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        Accept: 'application/json',
    },
});
