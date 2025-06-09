import { createRouter, createWebHistory } from 'vue-router';
import Test from './test.vue';
import Index from './layouts/Index.vue';
import AboutUs from './layouts/pages/about-us/AboutUs.vue';
import Blogs from './layouts/pages/Blogs/Blogs.vue';
import BlogDetails from './layouts/pages/Blogs/BlogDetails.vue';
import Contact from './layouts/pages/contact/contact.vue';
import ShopDetails from './layouts/pages/Shop-Details/ShopDetails.vue';
import Carts from './layouts/pages/Carts/Carts.vue';
import Checkout from './layouts/pages/Checkout/Checkout.vue';

const routes = [
    {
        name: 'Index',
        path: '/',
        component: Index,
    },
    {
        name: 'About-us',
        path: '/about-us',
        component: AboutUs,
    },
    {
        name: 'Shop-details',
        path: '/shop-details/:id',
        component: ShopDetails,
    },
    {
        name: 'Blog',
        path: '/blogs',
        component: Blogs,
    },
    {
        name: 'Blog-details',
        path: '/blog-details/:id',
        component: BlogDetails,
    },
    {
        name: 'Contact',
        path: '/contact',
        component: Contact,
    },
    {
        name: 'Carts',
        path: '/carts',
        component: Carts,
        meta: { requiresAuth: true },
    },
    {
        name: 'Checkout',
        path: '/checkout',
        component: Checkout,
        meta: { requiresAuth: true },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    // Danh sách các route cần đăng nhập
    const requiresAuth = ['Carts']; // hoặc to.meta.requiresAuth

    // Kiểm tra nếu route cần đăng nhập
    if (requiresAuth.includes(to.name)) {
        const user = localStorage.getItem('user');
        if (!user) {
            // Chưa đăng nhập: hiện modal login
            // Gửi sự kiện để component cha (App.vue hoặc Main.vue) mở modal
            window.dispatchEvent(new CustomEvent('show-login-modal'));
            // Không chuyển trang
            return next(false);
        }
    }
    next();
});

export default router;
