<template>
    <div class="shoes-category-area pt-80 pb-30">
        <div class="container custom-container-two">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-9" v-for="category in categories" :key="category.id"
                    :id="`category-${category.id}`">
                    <div class="shoes-cat-item mb-50">
                        <div class="thumb mb-30">
                            <a href="shop-sidebar.html">
                                <img class="home-height-img" :src="category.image" :alt="category.name">
                            </a>
                        </div>
                        <div class="content">
                            <ul>
                                <li><a href="shop-sidebar.html">{{ category.name }}</a></li>
                                <li><span>{{ productCounts[category.id] || 0 }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import APIs, { endpoints } from '../../../configs/APIs';

export default {
    name: "ShoesCategoryArea",
    data() {
        return {
            categories: [],
            products: [],
            productCounts: {},
            loading: false,
        }
    },
    created() {
        this.fetchCategories();
        this.fetchProducts();
    },
    methods: {
        async fetchCategories() {
            this.loading = true;
            try {
                const res = await APIs.get(endpoints.categories);
                const dataCate = res.data.data.filter(cate => cate.name != 'Bamboo');
                this.categories = dataCate;
            } catch (error) {
                console.error("Lỗi khi tải danh mục: ", error);
            } finally {
                this.loading = false;
            }
        },
        async fetchProducts() {
            this.loading = true;
            try {
                let page = 1;
                let allProducts = [];
                let hasMore = true;

                while (hasMore) {
                    const res = await APIs.get(`${endpoints.products}?page=${page}`);
                    const pageProducts = res.data.products.data;
                    allProducts = allProducts.concat(pageProducts);

                    // Kiểm tra còn trang tiếp theo không
                    const pagination = res.data.products;
                    hasMore = pagination.current_page < pagination.last_page;
                    page++;
                }

                this.products = allProducts;
                // Đếm số sản phẩm theo category
                const counts = {};
                this.products.forEach(product => {
                    const catId = product.category_id;
                    counts[catId] = (counts[catId] || 0) + 1;
                });
                this.productCounts = counts;
            } catch (error) {
                console.error("Lỗi khi tải sản phẩm: ", error);

            } finally {
                this.loading = false;
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.shoes-category-area {
    .shoes-cat-item {
        .home-height-img {
            height: 200px;
            width: 200px;
        }
    }
}
</style>