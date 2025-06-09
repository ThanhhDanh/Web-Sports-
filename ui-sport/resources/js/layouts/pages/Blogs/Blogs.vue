<template>
    <Main>
        <template v-slot:content>

            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg"
                style="background-image: url(/front_home/img/bg/breadcrumb_bg02.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-content custom-color">
                                <h2>Thế Giới Thể Thao</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Thể thao</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

            <!-- blog-area -->
            <section class="blog-area pt-100 pb-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="blog--post--item text-center" v-for="event in events" :key="event.id">
                                <div class="blog-post-thumb mb-35">
                                    <router-link :to="`/blog-details/${event.id}`">
                                        <img class="w-auto" :src="event.image" :alt="event.author">
                                    </router-link>
                                </div>
                                <div class="blog-post-content">
                                    <div class="tag"><a href="#">Xem video</a></div>
                                    <h3><router-link :to="`/blog-details/${event.id}`">{{ event.name }}</router-link>
                                    </h3>
                                    <div class="blog-post-meta">
                                        <ul>
                                            <li><i class="far fa-user"></i>Đăng bởi <a href="#">{{ event.author }}</a>
                                            </li>
                                            <li><i class="far fa-calendar-alt"></i> {{ formattedDate(event.post_date) }}
                                            </li>
                                        </ul>
                                    </div>
                                    <p>{{ event.description.split('\n')[0] }}</p>
                                    <p>....</p>
                                    <router-link :to="`/blog-details/${event.id}`">Đọc Thêm</router-link>
                                </div>
                            </div>
                            <div class="pagination-wrap">
                                <ul>
                                    <li class="prev" :class="{ 'disabled': currentPage === 1 }">
                                        <a href="#" @click.prevent="changePage(currentPage - 1)">Trước</a>
                                    </li>

                                    <li v-for="page in totalPages" :key="page"
                                        :class="{ 'active': page === currentPage }">
                                        <a href="#" @click.prevent="changePage(page)">{{ page }}</a>
                                    </li>

                                    <li class="next" :class="{ 'disabled': currentPage === totalPages }">
                                        <a href="#" @click.prevent="changePage(currentPage + 1)">Sau</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-8">
                            <aside class="blog-sidebar">
                                <div class="widget blog-sidebar-widget mb-45">
                                    <h5 class="widget-title">GIỚI THIỆU</h5>
                                    <div class="sidebar-about">
                                        <div class="thumb"><img src="/front_home/img/slider/third_slider_img01.png"
                                                alt=""></div>
                                        <div class="content">
                                            <p>Chúng tôi là hệ thống cửa hàng thể thao được chính thức thành lập và hoạt
                                                động vào năm 2017. Cửa hàng chúng tôi chuyên cung cấp, cập nhật nhanh
                                                nhất các mẫu Quần Áo Bóng Đá, Đồ Đá Banh, Giày Đá Banh, Đồ Thể Thao nổi
                                                tiếng ở trong nước và quốc tế.</p>
                                            <a href="#">Xem thêm thông tin <i class="fas fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget blog-sidebar-widget mb-45">
                                    <div class="oc-newsletter">
                                        <h4 class="title">BẢN TIN</h4>
                                        <p>Điền email của bạn bên dưới để đăng ký nhận bản tin của tôi</p>
                                        <form action="#">
                                            <input type="email" placeholder="Email...">
                                            <button class="btn">Đăng ký</button>
                                        </form>
                                        <div class="oc-social">
                                            <h4 class="title">THEO DÕI CHÚNG TÔI</h4>
                                            <ul>
                                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="#"><i class="fab fa-google"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget blog-sidebar-widget mb-45">
                                    <h5 class="widget-title">Bài Viết Mới Nhất</h5>
                                    <div class="blog-rc-post">
                                        <ul>
                                            <li v-for="eventNew in eventNews" :key="eventNew.id">
                                                <div class="rc-post-thumb">
                                                    <router-link :to="`/blog-details/${eventNew.id}`">
                                                        <img :src="eventNew.image" :alt="eventNew.author">
                                                    </router-link>
                                                </div>
                                                <div class="rc-post-content">
                                                    <h5><router-link :to="`/blog-details/${eventNew.id}`">{{
                                                        eventNew.name }}</router-link></h5>
                                                    <span><i class="far fa-calendar"></i>
                                                        {{ formattedDate(eventNew.post_date) }}
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="widget blog-sidebar-widget mb-45">
                                    <h5 class="widget-title">Danh mục</h5>
                                    <div class="blog-cat-list">
                                        <ul>
                                            <li v-for="category in categories" :key="category.id">
                                                <a href="#">{{ category.name }}</a>{{ productCounts[category.id] || 0 }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="widget blog-sidebar-widget mb-45">
                                    <div class="sidebar-add">
                                        <a href="#"><img src="/front_home/img/instagram/s_insta_post05.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="widget blog-sidebar-widget">
                                    <h5 class="widget-title">GỢI Ý BÀI VIẾT</h5>
                                    <div class="blog-sidebar-tag">
                                        <ul>
                                            <li v-for="author in uniqueAuthors" :key="author">
                                                <a href="#">{{ author }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </section>
            <!-- blog-area-end -->
        </template>
    </Main>
</template>

<script>
import APIs, { endpoints } from '../../../configs/APIs';
import Main from '../../Main.vue';
import moment from 'moment';

export default {
    name: 'Blog',
    components: {
        Main
    },
    data() {
        return {
            events: [],
            eventNews: [],
            products: [],
            categories: [],
            productCounts: {},
            loading: false,
            currentPage: 1,
            totalPages: 1,
        }
    },
    created() {
        this.fetchEvents();
        this.fetchCategories();
    },
    computed: {
        uniqueAuthors() {
            const authors = this.events.map(event => event.author);
            return [...new Set(authors)];
        }
    },
    methods: {
        async fetchEvents(page = 1) {
            this.loading = true;
            try {
                const res = await APIs.get(`${endpoints.events}?page=${page}`);
                const result = res.data.events;
                this.events = result.data;
                this.currentPage = result.current_page;
                this.totalPages = result.last_page;
                this.eventNews = result.data.slice(0, 3);
            } catch (error) {
                console.log("Lỗi tải sự kiện: ", error);
            } finally {
                this.loading = false;
            }
        },
        async fetchCategories() {
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

                const res = await APIs.get(endpoints.categories)
                this.categories = res.data.data;
            } catch (error) {
                console.error("Lỗi tải danh mục: ", error);
            } finally {
                this.loading = false;
            }
        },
        changePage(page) {
            if (page < 1 || page > this.totalPages) return;
            this.fetchEvents(page);
        },
        formattedDate(date) {
            moment.locale('vi');
            return moment(date).format('LL');
        }
    },
    mounted() {
        this.fetchEvents();
    },
}
</script>

<style scoped lang="scss">
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

            a {
                color: var(--white);
            }

            &::before {
                color: var(--white);
            }
        }
    }
}
</style>