<template>
    <section class="trending-product-area trending-product-two gray-bg pt-95 pb-100">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6">
                    <div class="section-title title-style-two text-center mb-50">
                        <h3 class="title">Xu hướng sản phẩm</h3>
                    </div>
                </div>
            </div>
            <div class="row no-gutters trending-product-grid">
                <div class="col-2">
                    <div class="trending-products-list">
                        <h5>Danh mục giày</h5>
                        <ul class="nav nav-tabs" id="trendingTab" role="tablist">
                            <li class="nav-item" role="presentation" v-for="(category, index) in categories"
                                :key="category.id">
                                <a class="nav-link" :class="{ active: activeCategory === category.id }"
                                    @click.prevent="selectCategory(category.id)" data-toggle="tab"
                                    :href="`#category-${category.id}`" role="tab"
                                    :aria-controls="`category-${category.id}`" :aria-selected="index === 0">
                                    {{ category.name }}
                                </a>
                            </li>
                        </ul>
                        <p class="offer"><a href="#">Ưu đãi thời gian giới hạn!</a></p>
                    </div>
                </div>
                <div class="col-10">
                    <div class="tab-content tp-tab-content" id="trendingTabContent">
                        <div class="tab-pane" v-for="(category, index) in categories" :key="category.id"
                            :class="{ 'show active': activeCategory === category.id }" :id="`category-${category.id}`">
                            <div class="trending-products-banner banner-animation">
                                <a href="shop-sidebar.html">
                                    <img src="/front_home/img/images/trending_banner03.png" alt="">
                                </a>
                            </div>

                            <div class="trending-product-active row">
                                <div v-for="product in filteredProducts(category.id)" :key="product.id" class="col">
                                    <div class="features-product-item">
                                        <div class="features-product-thumb">
                                            <div class="discount-tag">-20%</div>
                                            <router-link :to="`/shop-details/${product.id}`">
                                                <img :src="product.image" :alt="product.name">
                                            </router-link>
                                            <div class="product-overlay-action">
                                                <ul>
                                                    <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                                    <li><router-link :to="`/shop-details/${product.id}`"><i
                                                                class="far fa-eye"></i></router-link></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="features-product-content">
                                            <div class="rating">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <h5><router-link :to="`/shop-details/${product.id}`">{{ product.name
                                                    }}</router-link></h5>
                                            <p class="price">{{ product.price }}</p>
                                            <div class="features-product-bottom">
                                                <ul>
                                                    <li class="color-option">
                                                        <span class="gray"></span>
                                                        <span class="cyan"></span>
                                                        <span class="orange"></span>
                                                    </li>
                                                    <li class="limited-time"><a href="#">Ưu đãi giới hạn!</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="features-product-cart">
                                            <a href="cart.html">Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>



<script>
import APIs, { endpoints } from "../../../configs/APIs";

export default {
    name: "TrendingProduct",
    data() {
        return {
            categories: [],
            products: [],
            activeCategory: null,
            loading: false,
        };
    },
    created() {
        this.fetchCategories();
    },
    methods: {
        async fetchCategories() {
            try {
                const res = await APIs.get(endpoints.categories);
                this.categories = res.data.data ?? res.data;
                if (this.categories.length > 0) {
                    this.selectCategory(this.categories[0].id);
                }
            } catch (err) {
                console.error("Lỗi khi tải danh mục:", err);
            }
        },
        async selectCategory(categoryId) {
            this.activeCategory = categoryId;
            await this.fetchProducts(categoryId);
        },
        async fetchProducts(categoryId) {
            this.loading = true;
            try {
                const res = await APIs.get(endpoints.products, {
                    params: {
                        category_id: categoryId,
                    },
                });
                this.products = res.data.products.data;
            } catch (err) {
                console.error("Lỗi khi tải sản phẩm:", err);
                this.products = [];
            } finally {
                this.loading = false;
            }
        },

        filteredProducts(categoryId) {
            return this.products.filter(product => product.category_id === categoryId);
        },
    },
};
</script>