<template>
    <!-- preloader  -->
    <div v-if="isLoading" id="preloader">
        <div id="ctn-preloader" class="ctn-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
            </div>
            <div class="loader">
                <div class="row">
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- preloader end -->


    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    <Header></Header>
    <!-- header-area-end -->

    <main>
        <slot name="content">
        </slot>
    </main>

    <!-- footer-area -->
    <Footer></Footer>
    <!-- footer-area-end -->
    <div id="scripts"></div>

    <div id="toast"></div>
</template>

<script>
import Footer from './bases/Footer.vue';
import Header from './bases/Header.vue';

export default {
    name: 'Main',
    components: {
        Header,
        Footer,
    },
    data() {
        return {
            isLoading: true,
        };
    },
    mounted() {
        // Khi component được mount lần đầu, ẩn preloader sau một thời gian ngắn
        setTimeout(() => {
            this.isLoading = false;
            this.initJSPlugins();
        }, 600);

        window.addEventListener('show-login-modal', this.openLoginModal);

    },
    beforeUnmount() {
        window.removeEventListener('show-login-modal', this.openLoginModal);
    },
    methods: {
        openLoginModal() {
            // Đảm bảo modal đã đóng hoàn toàn trước khi mở lại
            $('#openModalAuth').modal('hide');
            setTimeout(() => {
                // Xóa backdrop và class modal-open nếu còn sót lại
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('#openModalAuth').modal('show');
            }, 300);
        },
        initJSPlugins() {
            if (window.$) {
                if (window.$.fn.slick) {
                    const slickElement1 = $('.third-slider-active:not(.slick-initialized)');
                    const slickElement2 = $('.shoes-banner-active:not(.slick-initialized)');
                    const slickElement3 = $('.insta-active:not(.slick-initialized)');
                    if (slickElement1.length) {
                        slickElement1.slick({
                            arrows: false,
                            dots: false,
                            autoplay: true,
                            autoplaySpeed: 3000,
                        });
                    }
                    if (slickElement2.length) {
                        slickElement2.slick({
                            arrows: false,
                            dots: true,
                            autoplay: true,
                            autoplaySpeed: 3000,
                        });
                    }
                    if (slickElement3.length) {
                        slickElement3.slick({
                            variableWidth: true,
                            slidesToShow: 5,
                            slidesToScroll: 3,
                            infinite: true,
                            arrows: false,
                            dots: false,
                            autoplay: true,
                            autoplaySpeed: 4000,
                            speed: 1000,
                            pauseOnHover: true,
                        });
                    }
                }
            }
        }
    },
    beforeRouteUpdate(to, from, next) {
        this.isLoading = true;
        next();
    },
    beforeRouteEnter(to, from, next) {
        // Khi trang được vào lần đầu tiên
        next(vm => {
            vm.isLoading = false;
        });
    }
}
</script>