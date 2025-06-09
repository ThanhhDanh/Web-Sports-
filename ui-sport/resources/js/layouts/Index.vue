<template>
    <Main>

        <template v-slot:content>
            <!-- slider-area -->
            <section class="slider-area position-relative">
                <div class="third-slider-active">
                    <div v-for="(slide, index) in slides" :key="index" class="third-slider-item third-slider-bg"
                        :style="{ backgroundImage: `url(${slide.bg})` }">
                        <div class="container custom-container-two">
                            <div class="third-slider-wrap">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="slider-content">
                                            <h3 class="sub-title" data-animation-in="fadeInUp" data-delay-in=".2"
                                                data-duration-in="1.5">
                                                {{ slide.subTitle }}
                                            </h3>
                                            <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".4"
                                                data-duration-in="1.5">
                                                {{ slide.title }}
                                            </h2>
                                            <p data-animation-in="fadeInUp" data-delay-in=".6" data-duration-in="1.5">
                                                {{ slide.description }}
                                            </p>
                                            <a :href="slide.link" class="btn" data-animation-in="fadeInUp"
                                                data-delay-in=".8" data-duration-in="1.5">
                                                {{ slide.buttonText }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="third-slider-img">
                                            <div class="img-shape" :style="{ backgroundImage: `url(${slide.shape})` }"
                                                data-animation-in="zoomIn" data-delay-in="1" data-duration-in="1.5">
                                            </div>
                                            <img :src="slide.image" alt="" class="main-img"
                                                data-animation-in="slideInRight2" data-delay-in="1"
                                                data-duration-in="1.5" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- slider-area-end -->

            <!-- shoes-category-area -->
            <ShoesCategoryArea />
            <!-- shoes-category-area-end -->

            <!-- trending-product-area -->
            <TrendingProduct />
            <!-- trending-product-area-end -->

            <!-- new-arrival-area -->
            <section class="new-arrival-area pt-95 pb-45">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-lg-6">
                            <div class="section-title title-style-two text-center mb-45">
                                <h3 class="title">New Arrival Collection</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="new-arrival-nav mb-35">
                                <button class="active" data-filter="*">Best Sellers</button>
                                <button class="" data-filter=".cat-one">New Products</button>
                                <button class="" data-filter=".cat-two">Sales Products</button>
                            </div>
                        </div>
                    </div>
                    <div class="row new-arrival-active">
                        <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two">
                            <div class="new-arrival-item text-center mb-50">
                                <div class="thumb mb-25">
                                    <a href="shop-details.html"><img
                                            src="/front_home/img/product/shoes_arrival_product01.jpg" alt=""></a>
                                    <div class="product-overlay-action">
                                        <ul>
                                            <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                            <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5><a href="shop-details.html">Athletes Shoes</a></h5>
                                    <span class="price">$37.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-one">
                            <div class="new-arrival-item text-center mb-50">
                                <div class="thumb mb-25">
                                    <div class="discount-tag">- 20%</div>
                                    <a href="shop-details.html"><img
                                            src="/front_home/img/product/shoes_arrival_product02.jpg" alt=""></a>
                                    <div class="product-overlay-action">
                                        <ul>
                                            <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                            <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5><a href="shop-details.html">Mountain Shoes</a></h5>
                                    <span class="price">$25.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two cat-one">
                            <div class="new-arrival-item text-center mb-50">
                                <div class="thumb mb-25">
                                    <a href="shop-details.html"><img
                                            src="/front_home/img/product/shoes_arrival_product03.jpg" alt=""></a>
                                    <div class="product-overlay-action">
                                        <ul>
                                            <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                            <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5><a href="shop-details.html">Travelling Shoes</a></h5>
                                    <span class="price">$19.50</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two">
                            <div class="new-arrival-item text-center mb-50">
                                <div class="thumb mb-25">
                                    <div class="discount-tag new">New</div>
                                    <a href="shop-details.html"><img
                                            src="/front_home/img/product/shoes_arrival_product04.jpg" alt=""></a>
                                    <div class="product-overlay-action">
                                        <ul>
                                            <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                            <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5><a href="shop-details.html">Women Shoes</a></h5>
                                    <span class="price">$12.90</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-one">
                            <div class="new-arrival-item text-center mb-50">
                                <div class="thumb mb-25">
                                    <div class="discount-tag">- 20%</div>
                                    <a href="shop-details.html"><img
                                            src="/front_home/img/product/shoes_arrival_product05.jpg" alt=""></a>
                                    <div class="product-overlay-action">
                                        <ul>
                                            <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                            <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5><a href="shop-details.html">Men Shoes</a></h5>
                                    <span class="price">$49.90</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two cat-one">
                            <div class="new-arrival-item text-center mb-50">
                                <div class="thumb mb-25">
                                    <div class="discount-tag new">New</div>
                                    <a href="shop-details.html"><img
                                            src="/front_home/img/product/shoes_arrival_product06.jpg" alt=""></a>
                                    <div class="product-overlay-action">
                                        <ul>
                                            <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                            <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5><a href="shop-details.html">Fashion Shoes</a></h5>
                                    <span class="price">$31.99</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-one">
                            <div class="new-arrival-item text-center mb-50">
                                <div class="thumb mb-25">
                                    <a href="shop-details.html"><img
                                            src="/front_home/img/product/shoes_arrival_product07.jpg" alt=""></a>
                                    <div class="product-overlay-action">
                                        <ul>
                                            <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                            <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5><a href="shop-details.html">New Shoes</a></h5>
                                    <span class="price">$19.99</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two">
                            <div class="new-arrival-item text-center mb-50">
                                <div class="thumb mb-25">
                                    <div class="discount-tag">- 45%</div>
                                    <a href="shop-details.html"><img
                                            src="/front_home/img/product/shoes_arrival_product08.jpg" alt=""></a>
                                    <div class="product-overlay-action">
                                        <ul>
                                            <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                            <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content">
                                    <h5><a href="shop-details.html">Travelling Bags</a></h5>
                                    <span class="price">$9.99</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- new-arrival-area-end -->

            <!-- shoes-banner-area -->
            <section class="shoes-banner-area">
                <div class="container">
                    <div class="shoes-banner-active">
                        <div class="shoes-banner-bg"
                            style="background-image: url('/front_home/img/bg/shoes-banner_bg.png'); background-position: top; background-size: cover;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="shoes-banner-content">
                                        <h6>Giày cầu thủ</h6>
                                        <h2>9 Giày <span>tốt nhất</span> Đứng đánh giá cả ngày 2020</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shoes-banner-bg"
                            style="background-image: url('/front_home/img/bg/shoes-banner_bg.png'); background-position: top; background-size: cover;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="shoes-banner-content">
                                        <h6>Giày cầu thủ</h6>
                                        <h2>3 Giày <span>tốt nhất</span> Đứng đánh giá cả ngày 2021</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shoes-banner-bg"
                            style="background-image: url('/front_home/img/bg/shoes-banner_bg.png'); background-position: top; background-size: cover;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="shoes-banner-content">
                                        <h6>Giày cầu thủ</h6>
                                        <h2>8 Giày <span>tốt nhất</span> Đứng đánh giá cả ngày 2021</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- shoes-banner-area-end -->

            <!-- promo-services -->
            <section class="promo-services pt-70 pb-25">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-6 col-sm-8">
                            <div class="promo-services-item mb-40">
                                <div class="icon"><img src="/front_home/img/icon/promo_icon01.png" alt=""></div>
                                <div class="content">
                                    <h6>payment & delivery</h6>
                                    <p>Delivered, when you receive arrives</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-8">
                            <div class="promo-services-item mb-40">
                                <div class="icon"><img src="/front_home/img/icon/promo_icon02.png" alt=""></div>
                                <div class="content">
                                    <h6>Return Product</h6>
                                    <p>Retail, a Product Return Process</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-8">
                            <div class="promo-services-item mb-40">
                                <div class="icon"><img src="/front_home/img/icon/promo_icon03.png" alt=""></div>
                                <div class="content">
                                    <h6>money back guarantee</h6>
                                    <p>Options Including 24/7</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-8">
                            <div class="promo-services-item mb-40">
                                <div class="icon"><img src="/front_home/img/icon/promo_icon04.png" alt=""></div>
                                <div class="content">
                                    <h6>Quality support</h6>
                                    <p>Support Options Including 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- promo-services-end -->

            <!-- instagram-post-area -->
            <InstagramPostArea />
            <!-- instagram-post-area-end -->
        </template>

    </Main>
</template>
<script>
import Main from './Main.vue';
import InstagramPostArea from './pages/homes/InstagramPostArea.vue';
import ShoesCategoryArea from './Pages/Homes/ShoesCategoryArea.vue';
import TrendingProduct from './Pages/Homes/TrendingProduct.vue';

export default {
    name: 'Index',
    components: {
        Main,
        TrendingProduct,
        ShoesCategoryArea,
        InstagramPostArea
    },
    data() {
        return {
            slides: [
                {
                    subTitle: 'Ưu đãi tốt nhất !',
                    title: 'Giày thể thao',
                    description: 'Chỉ được giảm tới 50% ngay hôm nay',
                    buttonText: 'Mua sắm ngay bây giờ',
                    link: 'shop-sidebar.html',
                    bg: '/front_home/img/slider/third_slider_bg.jpg',
                    shape: '/front_home/img/slider/third_slide_shape.png',
                    image: '/front_home/img/slider/third_slider_img01.png',
                },
                {
                    subTitle: 'Thỏa thuận hàng đầu !',
                    title: 'Cầu thủ chuyên nghiệp',
                    description: 'Chỉ được giảm tới 50% ngay hôm nay',
                    buttonText: 'Mua sắm ngay bây giờ',
                    link: 'shop-sidebar.html',
                    bg: '/front_home/img/slider/third_slider_bg.jpg',
                    shape: '/front_home/img/slider/third_slide_shape.png',
                    image: '/front_home/img/slider/third_slider_img01.png',
                },
                {
                    subTitle: 'Thỏa thuận hàng đầu !',
                    title: 'Giày thể thao mới',
                    description: 'Chỉ được giảm tới 50% ngay hôm nay',
                    buttonText: 'Mua sắm ngay bây giờ',
                    link: 'shop-sidebar.html',
                    bg: '/front_home/img/slider/third_slider_bg.jpg',
                    shape: '/front_home/img/slider/third_slide_shape.png',
                    image: '/front_home/img/slider/third_slider_img01.png',
                },
            ]
        }
    }
}
</script>