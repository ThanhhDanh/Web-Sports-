<template>
    <header class="header-style-three">
        <div class="header-top-wrap">
            <div class="container custom-container-two">
                <div class="row align-items-center justify-content-center">
                    <!-- <div class="col-sm-6">
                            <div class="header-top-link">
                                <ul>
                                    <li><a href="about-us.html">About US</a></li>
                                    <li><a href="#">FAQS</a></li>
                                    <li><a href="tel:123456789">PH +1 325 362 3521</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="header-top-right">
                                <div class="lang">
                                    <select name="select">
                                        <option value="">English</option>
                                        <option value="">Spanish</option>
                                        <option value="">Turkish</option>
                                        <option value="">Russian</option>
                                        <option value="">Chinese</option>
                                    </select>
                                </div>
                                <div class="currency">
                                    <form action="#">
                                        <select name="select">
                                            <option value="">USD</option>
                                            <option value="">AUE</option>
                                            <option value="">SAR</option>
                                            <option value="">INR</option>
                                            <option value="">BDT</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
        <div id="sticky-header" class="main-header menu-area">
            <div class="container custom-container-two">
                <div class="row">
                    <div class="col-12">
                        <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                        <div class="menu-wrap">
                            <nav class="menu-nav show">
                                <div class="logo">
                                    <router-link :to="`/`">
                                        <img src="/front_home/img/logo/logo.png" alt="Logo">
                                    </router-link>
                                </div>
                                <div class="navbar-wrap main-menu d-none d-lg-flex">
                                    <ul class="navigation">
                                        <li class="menu-item-has-children has--mega--menu"
                                            :class="{ active: $route.path === '/' }">
                                            <router-link to="/">Trang chủ</router-link>
                                        </li>
                                        <li class="has--mega--menu"><a href="#">Dịch vụ</a>
                                            <ul class="mega-menu">
                                                <li class="mega-menu-wrap">
                                                    <ul class="mega-menu-col">
                                                        <li class="mega-title"><a href="shop.html">SHOP PAGES</a></li>
                                                        <li><a href="shop-sidebar.html">Right Sidebar</a></li>
                                                        <li><a href="shop-sidebar.html">Left Sidebar</a></li>
                                                        <li><a href="shop.html">Hidden sidebar</a></li>
                                                        <li><a href="shop.html">Filters area</a></li>
                                                        <li><a href="shop-details.html">Shop Details</a></li>
                                                        <li><a href="cart.html">Cart Page</a></li>
                                                        <li><a href="checkout.html">Checkout Page</a></li>
                                                    </ul>
                                                    <ul class="mega-menu-col">
                                                        <li class="mega-title"><a href="#">FEATURES</a></li>
                                                        <li><a href="shop-sidebar.html">Variable Product</a></li>
                                                        <li><a href="shop-sidebar.html">External Product</a></li>
                                                        <li><a href="shop-sidebar.html">Other Shop Pages</a></li>
                                                        <li><a href="shop-sidebar.html">Categories</a></li>
                                                        <li><a href="shop-sidebar.html">Collection</a></li>
                                                        <li><a href="shop-sidebar.html">LookBook</a></li>
                                                        <li><a href="cart.html">Shopping Cart</a></li>
                                                    </ul>
                                                    <ul class="mega-menu-col sub-cat-post">
                                                        <li>
                                                            <a href="shop-sidebar.html">
                                                                <img src="/front_home/img/product/sub_menu_img01.jpg"
                                                                    alt="">
                                                                <span class="btn">Man Shop</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <ul class="mega-menu-col sub-cat-post">
                                                        <li>
                                                            <a href="shop-sidebar.html">
                                                                <img src="/front_home/img/product/sub_menu_img02.jpg"
                                                                    alt="">
                                                                <span class="btn">Women’s Shop</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children has--mega--menu"
                                            :class="{ active: $route.path === '/about-us' }">
                                            <router-link to="/about-us">Về chúng tôi</router-link>
                                        </li>

                                        <li class="menu-item-has-children"
                                            :class="{ active: $route.path === '/blogs' }"><a href="#">Sự kiện</a>
                                            <ul class="submenu">
                                                <li
                                                    :class="{ active: $route.path === ('/blogs' || '/blog-detail/:id') }">
                                                    <router-link :to="`/blogs`">Thể thao</router-link>
                                                </li>
                                            </ul>
                                        </li>
                                        <li :class="{ active: $route.path === '/contact' }"><router-link
                                                :to="`/contact`">Liên hệ</router-link></li>
                                    </ul>
                                </div>
                                <div class="header-action d-none d-md-block">
                                    <ul>
                                        <li class="header-search">
                                            <a href="#" data-toggle="modal" data-target="#search-modal">
                                                <i class="flaticon-search"></i>
                                            </a>
                                        </li>
                                        <li class="header-shop-cart">
                                            <router-link :to="`/carts`">
                                                <i class="flaticon-shopping-bag"></i> <span>{{ cartCount ?? 0 }}</span>
                                            </router-link>
                                            <ul class="minicart" v-if="cartItems.length">
                                                <li class="d-flex align-items-start"
                                                    v-for="item in cartItems.slice(0, 2)" :key="item.id">
                                                    <div class="cart-img">
                                                        <router-link :to="`/shop-details/${item.product?.id}`">
                                                            <img :src="item.product.image" :alt="item.product.name">
                                                        </router-link>
                                                    </div>
                                                    <div class="cart-content">
                                                        <h4><router-link class="cart-name"
                                                                :to="`/shop-details/${item.product?.id}`">
                                                                {{ item.product.name }}</router-link></h4>
                                                        <div class="cart-price">
                                                            <span class="new">
                                                                {{ formatCurrency(item.product?.price * item.quantity)
                                                                }}
                                                            </span>
                                                            <span>
                                                                SL: {{ item.quantity }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="del-icon">
                                                        <a href="#" @click.prevent="removeCartItem(item)">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="total-price">
                                                        <span class="f-left">Tổng cộng:</span>
                                                        <span class="f-right">
                                                            {{ formatCurrency(totalCartPrice) }}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="checkout-link">
                                                        <router-link :to="`/carts`">
                                                            Vỏ hàng của {{ user.name }}
                                                        </router-link>
                                                        <a class="black-color" href="#">Thanh toán</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="header-wishlist">
                                            <a href="#">
                                                <i class="flaticon-heart-shape-outline"></i>
                                            </a>
                                        </li>
                                        <li class="header-profile" :class="user ? 'has-avatar' : ''">
                                            <div class="user-avatar-dropdown" v-if="user">
                                                <img :src="user.avatar" :alt="user.name" class="user-avatar" />
                                                <ul class="dropdown-menu">
                                                    <li><router-link to="/profile">Hồ sơ</router-link></li>
                                                    <li><router-link to="/orders">Đơn hàng</router-link></li>
                                                    <li><a href="#" @click="logout">Đăng xuất</a></li>
                                                </ul>
                                            </div>
                                            <a v-else="user" href="#" type="button" data-toggle="modal"
                                                data-target="#openModalAuth">
                                                <i class="flaticon-user-profile"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <!-- Mobile Menu  -->
                        <div class="mobile-menu">
                            <div class="close-btn"><i class="flaticon-targeting-cross"></i></div>
                            <nav class="menu-box">
                                <div class="nav-logo"><router-link :to="`/`"><img src="/front_home/img/logo/logo.png"
                                            alt="" title=""></router-link>
                                </div>
                                <div class="menu-outer">
                                    <ul class="navigation">
                                        <li class="active menu-item-has-children"><a href="#">Home</a>
                                            <ul class="submenu">
                                                <li><router-link :to="`/`">Home One</router-link></li>
                                                <li><a href="index-2.html">Home Two</a></li>
                                                <li class="active"><a href="index-3.html">Home Three</a></li>
                                                <li><a href="index-4.html">Home Four</a></li>
                                                <li><a href="index-5.html">Home Five</a></li>
                                                <li><a href="index-6.html">Home Six</a></li>
                                                <li><a href="index-7.html">Home Seven</a></li>
                                                <li><a href="index-8.html">Home Eight</a></li>
                                                <li><a href="index-9.html">Home Nine</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Shop</a>
                                            <ul class="submenu">
                                                <li><a href="shop.html">Shop Page</a></li>
                                                <li><a href="shop-sidebar.html">Shop Sidebar</a></li>
                                                <li><a href="shop-details.html">Shop Details</a></li>
                                                <li><a href="cart.html">Cart Page</a></li>
                                                <li><a href="cart.html">Checkout Page</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li class="menu-item-has-children"><a href="#">blog</a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">Our Blog</a></li>
                                                <li><a href="blog-details.html">Blog Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact Us</a></li>
                                    </ul>
                                </div>
                                <div class="social-links">
                                    <ul class="clearfix">
                                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                        <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                        <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                        <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                        <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="menu-backdrop"></div>
                        <!-- End Mobile Menu -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Search -->
        <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form>
                        <input type="text" placeholder="Search here...">
                        <button><i class="flaticon-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Search-end -->

        <!-- Modal Login -->
        <Login />
        <!-- Modal Login-end -->

        <!-- off-canvas-start -->
        <div class="sidebar-off-canvas info-group">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-widget scroll">
                <div class="sidebar-widget-container">
                    <div class="off-canvas-heading">
                        <a href="#" class="close-side-widget">
                            <span class="flaticon-targeting-cross"></span>
                        </a>
                    </div>
                    <div class="sidebar-textwidget">
                        <div class="sidebar-info-contents">
                            <div class="content-inner">
                                <div class="logo mb-30">
                                    <router-link :to="`/`"><img src="/front_home/img/logo/logo.png"
                                            alt=""></router-link>
                                </div>
                                <div class="content-box">
                                    <p>WooCommerce and WordPress are both free, open source software reasons many ...
                                    </p>
                                </div>
                                <div class="contact-info">
                                    <h4 class="title">CONTACT US</h4>
                                    <ul>
                                        <li><span class="flaticon-phone-call"></span><a href="tel:123456789">+9 325 444
                                                0000</a></li>
                                        <li><span class="flaticon-email"></span><a
                                                href="mailto:adara@info.com">adara@info.com</a></li>
                                        <li><span class="flaticon-place"></span>71 Park Lan Street 2355 NY</li>
                                    </ul>
                                </div>
                                <div class="oc-newsletter">
                                    <h4 class="title">NEWSLETTER</h4>
                                    <p>Fill your email below to subscribe to my newsletter</p>
                                    <form action="#">
                                        <input type="email" placeholder="Email...">
                                        <button class="btn">Subscribe</button>
                                    </form>
                                </div>
                                <div class="oc-social">
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google"></i></a></li>
                                    </ul>
                                </div>
                                <div class="oc-bottom">
                                    <div class="currency">
                                        <form action="#">
                                            <label>Currency</label>
                                            <select name="select">
                                                <option value="">USD</option>
                                                <option value="">AUE</option>
                                                <option value="">SAR</option>
                                                <option value="">INR</option>
                                                <option value="">BDT</option>
                                            </select>
                                        </form>
                                    </div>
                                    <div class="language">
                                        <form action="#">
                                            <label>Language</label>
                                            <select name="select">
                                                <option value="">English</option>
                                                <option value="">Spanish</option>
                                                <option value="">Turkish</option>
                                                <option value="">Russian</option>
                                                <option value="">Chinese</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- off-canvas-end -->

    </header>
</template>

<script>
import APIs, { endpoints } from '../../configs/APIs';
import { formatCurrency } from '../../formatCurrency';
import Login from '../auths/Auth.vue';
import Cookies from 'js-cookie'


export default {
    name: "Header",
    components: {
        Login
    },
    data() {
        return {
            shouldShowBackground: false,
            user: null,
            cartCount: 0,
            cartItems: [],
            totalCartPrice: 0,
        };
    },
    mounted() {
        this.updateBackground();
        window.addEventListener('scroll', this.updateBackground);

        const userData = localStorage.getItem('user');
        if (userData) {
            this.user = JSON.parse(userData);
            this.fetchCartCount();
        }


        // Lắng nghe sự kiện cập nhật giỏ hàng từ các component khác
        window.addEventListener('cart-updated', this.fetchCartCount);
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.updateBackground);
        window.removeEventListener('cart-updated', this.fetchCartCount);
    },
    watch: {
        $route() {
            this.$nextTick(() => {
                this.updateBackground();
            });
        }
    },
    methods: {
        updateBackground() {
            const header = document.getElementById('sticky-header');
            const isSticky = header.classList.contains('sticky-menu');
            this.shouldShowBackground = this.$route.name === 'Shop-details' && !isSticky;
        },

        formatCurrency,

        async fetchCartCount() {
            if (!this.user) {
                this.cartCount = 0;
                return;
            }
            try {
                const response = await APIs.get(endpoints.carts);
                this.cartItems = response.data;
                this.cartCount = response.data.length;
                this.totalCartPrice = response.data.reduce((sum, item) => sum + item.product.price * item.quantity, 0);
            } catch (error) {
                this.cartCount = 0;
                this.cartItems = [];
                this.totalCartPrice = 0;
            }
        },

        async removeCartItem(item) {
            try {
                await APIs.get(endpoints['csrf-cookie'], { withCredentials: true });
                await APIs.delete(`${endpoints.carts}/${item.id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN'),
                    },
                });
                this.cartItems = this.cartItems.filter(ci => ci.id !== item.id);

                window.dispatchEvent(new Event('cart-updated'));

                window.showSuccessToast('Đã xóa sản phẩm khỏi giỏ hàng!');
            } catch (error) {
                window.showErrorToast('Xóa sản phẩm thất bại!');
            }
        },


        logout() {
            APIs.post(endpoints.logout, {}, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN'),
                },
                withCredentials: true,
            }).then(() => {
                // Xóa localStorage
                localStorage.removeItem('user');
                this.user = null;
                // Chuyển hướng về trang chính
                this.$router.go();
            }).catch(error => {
                console.error('Logout thất bại:', error);
            });
        }

    }
};
</script>

<style lang="scss" scoped>
.main-header {
    z-index: 2;
}

.header-style-three .header-action>ul>li.header-profile.has-avatar::before {
    font-size: 24px;
    font-weight: 200;
}

.user-avatar-dropdown {
    position: relative;
    display: inline-block;

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
    }

    .dropdown-menu {
        position: absolute;
        top: 58px;
        left: -94px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        list-style: none;
        padding: 10px;
        display: none;
        z-index: 1000;
        width: 144px;

        &::before {
            content: "";
            position: absolute;
            top: -30px;
            right: 0px;
            width: 100%;
            height: 30px;
            background: transparent;
        }
    }

    &:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu li {
        padding: 8px 16px;
        margin-left: 0;
        font-size: 1.4rem;
        cursor: pointer;

        a {
            color: #333;
            text-decoration: none;

        }

        &:hover a {
            color: var(--text-primary);
        }
    }
}

.cart-content {
    .cart-name {
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        display: -webkit-box;
    }
}
</style>