<template>
    <Main>
        <template v-slot:content>

            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg"
                style="background-image: url(/front_home/img/bg/breadcrumb_bg03.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-content custom-color">
                                <div class="tag"><a href="#">Shopping</a></div>
                                <h3 class="title">The Greatest Thing World Belong Excepted</h3>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Fashion is a Popular
                                            Aesthetic Expression Particular</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

            <!-- blog-area -->
            <section class="blog-details-area pt-100 pb-100">
                <div class="container" v-if="event">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="blog--post--item blog-details-content">
                                <div class="blog-post-thumb mb-25 text-center">
                                    <img class="w-auto" :src="event.image" :alt="event.author">
                                </div>
                                <div class="blog-post-content">
                                    <div class="blog-post-meta">
                                        <ul>
                                            <li><i class="far fa-user"></i>Đăng bởi <a href="#">{{ event.author }}</a>
                                            </li>
                                            <li><i class="far fa-calendar-alt"></i> {{ formattedDate(event.post_date) }}
                                            </li>
                                            <li><i class="far fa-comments"></i> 0 Comments</li>
                                        </ul>
                                    </div>
                                    <p>{{ event.description.split('\n')[0] }}</p>
                                    <p>{{ event.description.split('\n')[1] }}</p>
                                    <div class="blog-details-img-wrap">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="text-center blog-details-img">
                                                    <img class="w-auto" :src="event.image" :alt="event.author">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="text-center blog-details-img">
                                                    <iframe :src="`https://www.youtube.com/embed/${event.video_id}`"
                                                        frameborder="0" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p v-for="(paragraph, index) in event.description.split('\n')" :key="index">
                                        {{ paragraph }}
                                    </p>
                                    <div class="blog-details-meta">
                                        <div class="blog-bottom-meta">
                                            <ul>
                                                <li><i class="far fa-heart"></i><a href="#">0 Likes</a></li>
                                                <li><i class="far fa-comment"></i>3 Comments</li>
                                                <li>
                                                    <i class="fas fa-tag"></i>
                                                    <a href="#">{{ event.author }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="classic-blog-share">
                                            <a href="#"><i class="fab fa-facebook-square"></i></a>
                                            <a href="#"><i class="fab fa-twitter-square"></i></a>
                                            <a href="#"><i class="fab fa-pinterest-square"></i></a>
                                        </div>
                                    </div>
                                    <div class="avatar-post mt-50 mb-70">
                                        <div class="post-avatar-img">
                                            <img src="/front_home/img/logo/h9_logo.png" alt="img">
                                        </div>
                                        <div class="post-avatar-content">
                                            <h5>Adara Shop</h5>
                                            <p>Chúng tôi là hệ thống cửa hàng thể thao được chính thức thành lập và hoạt
                                                động vào năm 2017. Cửa hàng chúng tôi chuyên cung cấp, cập nhật nhanh
                                                nhất các mẫu Quần Áo Bóng Đá, Đồ Đá Banh, Giày Đá Banh, Đồ Thể Thao nổi
                                                tiếng ở trong nước và quốc tế.</p>
                                            <div class="post-avatar-social">
                                                <ul>
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="blog-comment mb-60">
                                        <h5 class="b-details-title mb-35">3 Comments</h5>
                                        <ul>
                                            <li>
                                                <div class="single-comment">
                                                    <div class="comment-avatar-img">
                                                        <img src="/front_home/img/blog/comment_avatar01.jpg" alt="img">
                                                    </div>
                                                    <div class="comment-text">
                                                        <div class="comment-avatar-info">
                                                            <h5>Daisy Waterstone <span class="comment-date">November 13,
                                                                    2021</span></h5>
                                                            <a href="#" class="comment-reply-link">Reply _</a>
                                                        </div>
                                                        <p>The purpose Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit, sed do eiusmod tempor incididunt ut labore
                                                            et
                                                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud .
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="comment-reply">
                                                <div class="single-comment">
                                                    <div class="comment-avatar-img">
                                                        <img src="/front_home/img/blog/comment_avatar02.jpg" alt="img">
                                                    </div>
                                                    <div class="comment-text">
                                                        <div class="comment-avatar-info">
                                                            <h5>Hazal Kaya <span class="comment-date">November 13,
                                                                    2021</span></h5>
                                                            <a href="#" class="comment-reply-link">Reply _</a>
                                                        </div>
                                                        <p>Purpose Lorem ipsum dolor sit amet, consectetur adipiscing
                                                            elit eiusmod tempr incididunt ut labore et dolore magna
                                                            aliqua. Ut enim ad minim</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="single-comment">
                                                    <div class="comment-avatar-img">
                                                        <img src="/front_home/img/blog/comment_avatar03.jpg" alt="img">
                                                    </div>
                                                    <div class="comment-text">
                                                        <div class="comment-avatar-info">
                                                            <h5>Thomas Alexander <span class="comment-date">November 13,
                                                                    2021</span></h5>
                                                            <a href="#" class="comment-reply-link">Reply _</a>
                                                        </div>
                                                        <p>The purpose Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit, sed do eiusmod tempor incididunt ut labore
                                                            et
                                                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud .
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="comment-reply-box">
                                        <h5 class="b-details-title mb-35">Leave a comment</h5>
                                        <form action="#" class="comment-form">
                                            <textarea name="message" id="comment-message"
                                                placeholder="Your Comment"></textarea>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" placeholder="Your Name*">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="email" placeholder="Your Email*">
                                                </div>
                                            </div>
                                            <div class="comment-check-box">
                                                <input type="checkbox" id="comment-check">
                                                <label for="comment-check">Save my name and email in this browser for
                                                    the next time I comment.</label>
                                            </div>
                                            <button class="btn">Submit</button>
                                        </form>
                                    </div> -->
                                </div>
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
                                        <a href="#"><img src="/front_home/img/instagram/s_insta_post07.jpg" alt=""></a>
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
import moment from 'moment';
import APIs, { endpoints } from '../../../configs/APIs';
import Main from '../../Main.vue';

export default {
    name: 'Blog-details',
    components: {
        Main
    },
    data() {
        return {
            event: null,
            events: [],
            eventNews: [],
            categories: [],
            loading: false,
        }
    },
    created() {
        this.fetchEvent();
        this.fetchCategories();
    },
    computed: {
        uniqueAuthors() {
            const authors = this.events.map(event => event.author);
            return [...new Set(authors)];
        }
    },
    watch: {
        '$route.params.id': {
            immediate: true,
            handler(newId) {
                this.fetchEvent();
                this.fetchCategories();
            }
        }
    },
    methods: {
        async fetchEvent() {
            const eventId = this.$route.params.id;
            this.loading = true;
            try {
                const res = await APIs.get(`${endpoints.eventDetails}/${eventId}`);
                this.event = res.data.event;

                const page = 1;
                const resAll = await APIs.get(`${endpoints.events}?page=${page}`);
                const result = resAll.data.events;
                this.events = result.data;
                this.currentPage = result.current_page;
                this.totalPages = result.last_page;
                const dataFilter = result.data.filter(data => data.id != eventId);
                this.eventNews = dataFilter.slice(0, 3);
            } catch (error) {
                console.error("Lỗi tải chi tiết sự kiện: ", error);
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
        formattedDate(date) {
            moment.locale('vi');
            return moment(date).format('LL');
        }
    }

}
</script>

<style scoped lang="scss">
.custom-color {
    position: relative;
    z-index: 3;

    h2,
    li,
    a,
    .title {
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