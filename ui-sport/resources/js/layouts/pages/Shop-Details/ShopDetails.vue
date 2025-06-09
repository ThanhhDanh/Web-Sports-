<template>
    <Main>
        <template v-slot:content>

            <!-- breadcrumb-area -->
            <div class="breadcrumb-area breadcrumb-style-two"
                style="background-image: url(/front_home/img/bg/s_breadcrumb_bg01.jpg);">
                <div class="container" v-if="product">
                    <div class="row">
                        <div class="col-lg-3 d-none d-lg-block">
                            <div class="previous-product">
                                <router-link :to="previous ? `/shop-details/${previous.id}` : '#'"
                                    :class="{ 'disabled': !previous }">
                                    <i class="fas fa-angle-left"></i> Sản phẩm trước
                                </router-link>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="breadcrumb-content">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                        <li class="breadcrumb-item"><a href="shop.html">{{ categoryName }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ product.name }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-3 d-none d-lg-block">
                            <div class="next-product">
                                <router-link :to="next ? `/shop-details/${next.id}` : '#'"
                                    :class="{ 'disabled': !next }">Sản phẩm sau <i
                                        class="fas fa-angle-right"></i></router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb-area-end -->

            <!-- shop-details-area -->
            <section class="shop-details-area pt-100 pb-95">
                <div class="d-flex flex-column justify-content-center align-items-center" v-if="loading">
                    Đang tải...
                    <div class="spinner-border text-info" role="status"></div>
                </div>
                <div class="container" v-if="product">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="shop-details-flex-wrap">
                                <div class="shop-details-nav-wrap">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="item-one-tab" data-toggle="tab"
                                                href="#item-one" role="tab" aria-controls="item-one"
                                                aria-selected="true"> <img :src="product.image" :alt="product.name"></a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="item-two-tab" data-toggle="tab" href="#item-two"
                                                role="tab" aria-controls="item-two" aria-selected="false">
                                                <img :src="product.image" :alt="product.name"></a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="item-three-tab" data-toggle="tab" href="#item-three"
                                                role="tab" aria-controls="item-three" aria-selected="false">
                                                <img :src="product.image" :alt="product.name"></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="shop-details-img-wrap">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="item-one" role="tabpanel"
                                            aria-labelledby="item-one-tab">
                                            <div class="shop-details-img">
                                                <img :src="product.image" :alt="product.name" />
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="item-two" role="tabpanel"
                                            aria-labelledby="item-two-tab">
                                            <div class="shop-details-img">
                                                <img :src="product.image" :alt="product.name">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="item-three" role="tabpanel"
                                            aria-labelledby="item-three-tab">
                                            <div class="shop-details-img">
                                                <img :src="product.image" :alt="product.name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="shop-details-content">
                                <a href="#" class="product-cat">{{ categoryName }}</a>
                                <h3 class="title">{{ product.name }}</h3>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="style-name">Tên phong cách : {{ categoryName }}</p>
                                <div class="price">Giá : {{ product.price }}</div>
                                <div class="product-details-info">
                                    <span>Kích thước
                                        <a class="scroll-to-guide" href="#guide">Hướng dẫn</a>
                                    </span>
                                    <div class="sidebar-product-size mb-30">
                                        <h4 class="widget-title">Kích thước sản phẩm</h4>
                                        <div class="shop-size-list">
                                            <ul>
                                                <li v-for="size in product.sizes" :key="size.id">
                                                    <a @click.prevent="selectedSizeId = size.id"
                                                        :class="{ active: selectedSizeId === size.id }" href="#">{{
                                                            size.name }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="sidebar-product-color">
                                        <h4 class="widget-title">Màu</h4>
                                        <div class="shop-color-list">
                                            <ul>
                                                <li v-for="color in product.colors" :key="color.id" :title="color.name"
                                                    :style="{ backgroundColor: color.code }"
                                                    @click="selectedColorId = color.id"
                                                    :class="{ active: selectedColorId === color.id }">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="perched-info">
                                    <div class="cart-plus-minus">
                                        <form action="#" class="num-block">
                                            <input type="text" class="in-num" :value="quantity" readonly>

                                            <div class="qtybutton-box">
                                                <span class="plus" @click.prevent="increaseQuantity">
                                                    <img src="/front_home/img/icon/plus.png" alt="">
                                                </span>
                                                <span class="minus" :class="{ dis: quantity <= 1 }"
                                                    @click.prevent="decreaseQuantity">
                                                    <img src="/front_home/img/icon/minus.png" alt="">
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                    <a href="#" class="btn" @click.prevent="addToCart(product.id)">Thêm vào giỏ</a>
                                    <div class="wishlist-compare">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="far fa-heart"></i>
                                                    Yêu thích
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fas fa-retweet"></i>
                                                    So sánh
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-details-share">
                                    <ul>
                                        <li>Chia sẻ :</li>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product-desc-wrap">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="description-tab" data-toggle="tab"
                                            href="#description" role="tab" aria-controls="description"
                                            aria-selected="true">Hướng dẫn mô tả</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews"
                                            role="tab" aria-controls="reviews" aria-selected="false">Đánh giá</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="guide">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <div class="product-desc-title mb-30">
                                            <h4 class="title">Thông tin bổ sung :</h4>
                                        </div>
                                        <p v-for="(paragraph, index) in product.description.split('\n')" :key="index">
                                            {{ paragraph }}
                                        </p>
                                        <div class="color-size-info">
                                            <ul>
                                                <li>
                                                    <span>MÀU :</span>
                                                    <span class="mx-2" v-for="color in product.colors" :key="color.id">
                                                        {{ color.name }}
                                                    </span>
                                                </li>
                                                <li>
                                                    <span>KÍCH THƯỚC :</span>
                                                    <span class="mx-2" v-for="size in product.sizes" :key="size.id">
                                                        {{ size.name }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="additional-table">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Tên kích thước</th>
                                                            <td>28</td>
                                                            <td>49</td>
                                                            <td>36</td>
                                                            <td>55</td>
                                                            <td>44</td>
                                                            <td>34</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Waist Stretch</th>
                                                            <td>19</td>
                                                            <td>38</td>
                                                            <td>31</td>
                                                            <td>55</td>
                                                            <td>44</td>
                                                            <td>34</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Hip (7½” below from waist)</th>
                                                            <td>11</td>
                                                            <td>18</td>
                                                            <td>21</td>
                                                            <td>55</td>
                                                            <td>44</td>
                                                            <td>34</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">length (Out seam)</th>
                                                            <td>28</td>
                                                            <td>31</td>
                                                            <td>19</td>
                                                            <td>55</td>
                                                            <td>44</td>
                                                            <td>34</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <p>{{ categoryDescription }}</p>
                                    </div>
                                    <div class="tab-pane fade" id="reviews" role="tabpanel"
                                        aria-labelledby="reviews-tab">
                                        <div class="product-desc-title mb-30">
                                            <h4 class="title">Đánh giá ({{ commentsCount[product.id] || 0 }}) :</h4>
                                        </div>
                                        <div v-for="comment in comments.filter(c => !c.comment.parent_id)"
                                            :key="comment.comment.id">
                                            <div
                                                class="d-flex align-items-center justify-content-start avatar-user-comment">
                                                <img :src="comment.user.avatar" :alt="comment.user.name">
                                                <p>{{ comment.user.name }}</p>
                                            </div>
                                            <p class="adara-review-title">{{ comment.comment.description }}</p>
                                            <div class="review-rating">
                                                <span>Đánh giá của bạn *</span>
                                                <div class="rating">
                                                    <i v-for="i in 5" :key="i"
                                                        :class="i <= comment.comment.rate_level ? 'fas fa-star text-warning' : 'far fa-star text-muted'">
                                                    </i>
                                                </div>
                                            </div>

                                            <!-- DANH SÁCH TRẢ LỜI -->
                                            <div class="comment-reply"
                                                v-for="child in comments.filter(c => c.comment.parent_id === comment.comment.id)"
                                                :key="child.comment.id">
                                                <div
                                                    class="d-flex align-items-center flex-row-reverse avatar-user-comment">
                                                    <img class="img-reply" :src="child.user.avatar"
                                                        :alt="child.user.name">
                                                    <p>{{ child.user.name }}</p>
                                                </div>
                                                <p class="adara-review-title">{{ child.comment.description }}</p>
                                            </div>
                                        </div>
                                        <form action="#" class="comment-form review-form">
                                            <span>Đánh giá của bạn *</span>
                                            <textarea name="message" id="comment-message"
                                                placeholder="Đánh giá của bạn"></textarea>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" placeholder="Tên của bạn*">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="email" placeholder="Email của bạn*">
                                                </div>
                                            </div>
                                            <button class="btn">Gửi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="related-product-wrap">
                        <div class="row">
                            <div class="col-12">
                                <div class="related-product-title">
                                    <h4 class="title">Bạn Cũng Có Thể Thích...</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row related-product-active">
                            <div class="col-xl-3" v-for="productDiff in productsDiff" :key="productDiff.id">
                                <div class="new-arrival-item text-center">
                                    <div class="thumb mb-25">
                                        <div class="discount-tag new">New</div>
                                        <router-link :to="`/shop-details/${productDiff.id}`"><img
                                                :src="productDiff.image" :alt="productDiff.name"></router-link>
                                        <div class="product-overlay-action">
                                            <ul>
                                                <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                                <li><router-link :to="`/shop-details/${productDiff.id}`"><i
                                                            class="far fa-eye"></i></router-link></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h5><router-link :to="`/shop-details/${productDiff.id}`">{{ productDiff.name
                                        }}</router-link></h5>
                                        <span class="price">{{ productDiff.price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- shop-details-area-end -->

        </template>
    </Main>
</template>

<script>
import APIs, { endpoints } from '../../../configs/APIs';
import Main from '../../Main.vue';
import Login from '../../auths/Auth.vue';
import Cookies from 'js-cookie';

export default {
    name: "ShopDetails",
    components: {
        Main,
    },
    data() {
        return {
            product: null,
            previous: null,
            next: null,
            productsDiff: [],
            categoryName: "",
            categoryDescription: "",
            comments: [],
            commentsCount: {},
            selectedSizeId: null,
            selectedColorId: null,
            quantity: 1,
            loading: false,
        };
    },
    created() {
        this.fetchProduct();
        this.initJSPlugins();
        this.fetchComments();
    },
    watch: {
        '$route.params.id': {
            immediate: true,
            handler(newId) {
                this.fetchProduct();
                this.fetchComments();
            }
        }
    },
    methods: {
        async fetchProduct() {
            const productId = this.$route.params.id;
            this.loading = true;
            try {

                let page = 1;
                let allProducts = [];
                let hasMore = true;
                const res = await APIs.get(`${endpoints.productDetails}/${productId}`);
                this.product = res.data.product;
                this.previous = res.data.previous
                this.next = res.data.next


                while (hasMore) {
                    const resDiff = await APIs.get(`${endpoints.products}?page=${page}`);
                    const pageProducts = resDiff.data.products.data;
                    allProducts = allProducts.concat(pageProducts);

                    // Kiểm tra còn trang tiếp theo không
                    const pagination = resDiff.data.products;
                    hasMore = pagination.current_page < pagination.last_page;
                    page++;
                    const productsFilter = allProducts.filter(product => (product.id != productId && product.category_id != res.data.product.category_id));

                    this.productsDiff = productsFilter;
                }
                if (this.product.category_id) {
                    await this.fetchCategoryName(this.product.category_id);
                }
            } catch (error) {
                console.error("Lỗi khi lấy sản phẩm:", error);
            } finally {
                this.loading = false;
            }
        },
        async fetchCategoryName(categoryId) {
            this.loading = true;
            try {
                const res = await APIs.get(`${endpoints.categoryDetails}/${categoryId}`);
                this.categoryName = res.data.category.name;
                this.categoryDescription = res.data.category.description;
            } catch (error) {
                console.error("Lỗi khi lấy tên danh mục:", error);
            } finally {
                this.loading = false;
            }
        },
        async fetchComments() {
            const productId = this.$route.params.id;
            this.loading = true;
            try {
                const res = await APIs.get(endpoints.comments, {
                    params: {
                        product_id: productId
                    }
                });
                this.comments = res.data.comments;

                const dataCountComments = res.data.comments;
                const counts = {};
                dataCountComments.forEach(comment => {
                    const proId = comment.comment.product_id;
                    counts[proId] = (counts[proId] || 0) + 1
                });
                this.commentsCount = counts;

            } catch (error) {
                console.error("Lỗi tải đánh giá: ", error);
            } finally {
                this.loading = false;
            }
        },
        async addToCart(productId) {
            try {
                // Lấy giỏ hàng hiện tại
                const cartRes = await APIs.get(endpoints.carts);
                const cartItems = cartRes.data;

                const existedItem = cartItems.find(item =>
                    item.product_id === productId &&
                    item.size_id === this.selectedSizeId &&
                    item.color_id === this.selectedColorId
                );

                await APIs.get(endpoints['csrf-cookie'], { withCredentials: true });

                if (existedItem) {
                    // Nếu đã có, cập nhật số lượng
                    await APIs.put(`${endpoints.carts}/${existedItem.id}`, {
                        quantity: existedItem.quantity + this.quantity,
                        size_id: this.selectedSizeId,
                        color_id: this.selectedColorId,
                        discount_id: null
                    }, {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN'),
                        },
                        withCredentials: true,
                    });
                    window.dispatchEvent(new Event('cart-updated'));
                    window.showSuccessToast("Đã cập nhật số lượng sản phẩm trong giỏ hàng!");
                } else {
                    // Nếu chưa có, thêm mới
                    await APIs.post(endpoints.cartAdd, {
                        product_id: productId,
                        quantity: this.quantity,
                        size_id: this.selectedSizeId,
                        color_id: this.selectedColorId,
                        discount_id: null
                    }, {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN'),
                        },
                        withCredentials: true,
                    });
                    window.dispatchEvent(new Event('cart-updated'));
                    window.showSuccessToast("Đã thêm vào giỏ hàng!");
                }
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    window.showErrorToast("Bạn cần đăng nhập để thêm vào giỏ hàng!");
                    $('#openModalAuth').modal('show');
                } else {
                    window.showErrorToast("Lỗi khi thêm vào giỏ hàng!");
                    console.error(error);
                }
            }
        },
        increaseQuantity() {
            this.quantity++;
        },
        decreaseQuantity() {
            if (this.quantity > 1) {
                this.quantity--;
            }
        },
        initJSPlugins() {
            if (window.$) {
                if (window.$.fn.slick) {
                    const slickElement = $('.third-slider-active:not(.slick-initialized)');
                    if (slickElement.length) {
                        slickElement.slick({
                            arrows: false,
                            dots: false,
                            autoplay: true,
                            autoplaySpeed: 3000,
                        }); // Khởi tạo lại slick
                    }
                }
                if (window.WOW) {
                    new WOW().init();
                }
            }
        }
    }

}
</script>

<style scoped lang="scss">
.breadcrumb-style-two {

    .breadcrumb {
        align-items: center;

        .breadcrumb-item {
            font-size: 1.6rem;
            align-items: center;
        }
    }
}

.shop-details-area {
    .container {
        .shop-size-list ul li a {
            width: 64px;
        }

        .avatar-user-comment {
            margin-bottom: 10px;

            img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                margin-right: 10px;
            }

            .img-reply {
                margin: 0 0 0 10px;
            }

            p {
                margin-bottom: 0;
            }
        }

        .adara-review-title {
            color: #676565;
        }

        .comment-reply {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: end;
        }
    }
}

.shop-size-list ul li a.active {
    background: #ff6000;
    border-color: #ff6000;
    color: var(--white);
}

.shop-color-list li.active {
    border: 2px solid #ff6000;
}
</style>