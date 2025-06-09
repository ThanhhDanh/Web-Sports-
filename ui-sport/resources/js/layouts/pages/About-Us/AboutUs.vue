<template>
    <Main>
        <template v-slot:content>
            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg"
                style="background-image: url(/front_home/img/bg/breadcrumb_bg01.png);">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-content custom-color">
                                <h2>Cửa hàng chúng tôi</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Cửa hàng</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

            <!-- shop-area -->
            <section class="shop-area pt-95 pb-100">
                <div class="container">
                    <div class="shop-top-meta mb-35">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="shop-top-left">
                                    <ul>
                                        <li><a href="#"><i class="flaticon-menu"></i> Lọc</a></li>
                                        <li v-if="products.from && products.to && products.total">
                                            Hiển thị {{ products.from }}–{{ products.to }} trên {{ products.total }}
                                            kết quả
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="shop-top-right">
                                    <form action="#">
                                        <select v-model="sortOption" @change="onSortChange">
                                            <option value="desc">Mới nhất </option>
                                            <option value="asc">Cũ nhất </option>
                                        </select>
                                    </form>
                                    <div class="shop-search"><a href="#"><i class="flaticon-search"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-center" v-if="loading">
                        Đang tải...
                        <div class="spinner-border text-info" role="status"></div>
                    </div>
                    <div class="row">
                        <div v-for="product in products.data" :key="product.id" class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="new-arrival-item text-center mb-50">
                                <div class="thumb mb-25">
                                    <div class="discount-tag new">New</div>
                                    <router-link :to="`/shop-details/${product.id}`">
                                        <img :src="product.image" :alt="product.name" />
                                    </router-link>
                                    <div class="product-overlay-action">
                                        <ul>
                                            <li>
                                                <a href="cart.html">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <router-link :to="`/shop-details/${product.id}`">
                                                    <i class="far fa-eye"></i>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5>
                                        <router-link :to="`/shop-details/${product.id}`">
                                            {{ product.name }}
                                        </router-link>
                                    </h5>
                                    <span class="price">{{ product.price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="products.next_page_url">
                        <div class="col-12">
                            <div class="shop-more-btn text-center">
                                <button @click="loadMore" class="btn" :disabled="loading">
                                    {{ loading ? "Đang tải..." : "Tải Thêm" }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- shop-area-end -->
        </template>
    </Main>
</template>

<script>
import APIs, { endpoints } from '../../../configs/APIs';
import Main from '../../Main.vue';

export default {
    name: 'About-us',
    components: {
        Main
    },
    data() {
        return {
            products: {
                data: []
            },
            nextPage: 1,
            sortOption: 'desc',
            loading: false,
        };
    },
    created() {
        this.fetchProducts();
    },
    methods: {
        async fetchProducts() {
            this.loading = true;
            try {
                const res = await APIs.get(`${endpoints.products}?page=${this.nextPage}&sort=${this.sortOption}`);

                if (this.nextPage === 1) {
                    this.products = res.data.products;
                } else {
                    this.products.data.push(...res.data.products.data);
                    this.products.next_page_url = res.data.products.next_page_url;
                }
                this.nextPage++;
            } catch (error) {
                console.error("Lỗi khi tải sản phẩm: ", error);
            } finally {
                this.loading = false;
            }
        },
        onSortChange() {
            this.nextPage = 1;
            this.products = { data: [] };
            this.fetchProducts();
        },
        loadMore() {
            if (this.products.next_page_url) {
                this.fetchProducts();
            }
        }
    }
};
</script>

<style scoped lang="scss">
.breadcrumb-bg {
    position: relative;
    z-index: 1;
    overflow: hidden;

    &::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6) 0%, transparent 50%);
        z-index: 2;
    }

    .custom-color {
        position: relative;
        z-index: 3;

        h2,
        li,
        a {
            color: var(--white);
        }

        .breadcrumb {
            align-items: center;

            .breadcrumb-item {
                font-size: 1.8rem;
                align-items: center;

                &::before {
                    color: var(--white);
                }
            }
        }
    }
}

.new-arrival-item .thumb img {
    width: auto;
}
</style>