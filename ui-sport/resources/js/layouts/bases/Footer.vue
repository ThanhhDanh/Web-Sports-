<template>
    <footer class="dark-bg pt-55 pb-80">
        <div class="container">
            <div class="footer-top-wrap">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-logo">
                            <a href="index.html">
                                <img src="/front_home/img/logo/w_logo.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-middle-wrap">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-link-wrap">
                            <nav class="menu-links">
                                <ul>
                                    <li><router-link :to="'/about-us'">Về chúng tôi</router-link></li>
                                    <li><a href="shop-sidebar.html">Cửa hàng</a></li>
                                    <li><a href="contact.html">Vị trí</a></li>
                                    <li><a href="contact.html">Liên lạc</a></li>
                                    <li><a href="contact.html">Hỗ trợ</a></li>
                                    <li><a href="#">Chính sách</a></li>
                                    <li><a href="#">Câu hỏi thường gặp</a></li>
                                </ul>
                            </nav>
                            <div class="footer-social">
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
                </div>
            </div>
            <div class="copyright-wrap">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="copyright-text">
                            <p>&copy; 2025 <a href="index.html">adara</a>. Tất cả quyền được bảo lưu | Ph (+09) 456
                                457869</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="pay-method-img">
                            <img class="w-auto" src="/front_home/img/images/payment_method_img.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "Footer",
};
</script>

<style scoped lang="scss">
footer {
    .footer-top-wrap {
        .footer-logo {
            a {
                img {
                    width: auto;
                }
            }
        }
    }
}
</style>