<template>
    <Main>
        <template v-slot:content>

            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg"
                style="background-image: url(/front_home/img/bg/breadcrumb_bg04.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-content">
                                <h2>Contact Us</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

            <!-- contact-area -->
            <section class="contact-area pt-100 pb-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="contact-wrap">
                                <div class="section-title title-style-three mb-30">
                                    <span class="sub-title">Contact Us Now</span>
                                    <h2 class="title">Write a Message</h2>
                                </div>
                                <form action="#" class="contact-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Your Name *">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" placeholder="Your Email *">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Your Phone">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" placeholder="Subject">
                                        </div>
                                    </div>
                                    <textarea name="message" placeholder="Your Message"></textarea>
                                    <button class="btn">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-7">
                            <aside class="contact-sidebar">
                                <div class="widget">
                                    <div class="contact-sidebar-img mb-20">
                                        <img src="/front_home/img/images/contact_img.jpg" alt="">
                                    </div>
                                </div>
                                <div class="widget">
                                    <div class="contact-info-wrap">
                                        <ul>
                                            <li>
                                                <div class="icon"><i class="flaticon-phone-call"></i></div>
                                                <div class="content">
                                                    <h5>Phone</h5>
                                                    <p><a href="tel:0321654987">+9 444 652 0000</a></p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i class="flaticon-email"></i></div>
                                                <div class="content">
                                                    <h5>Email</h5>
                                                    <p><a href="mailto:adara@info.com">adara@info.com</a></p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon"><i class="flaticon-place"></i></div>
                                                <div class="content">
                                                    <h5>Address</h5>
                                                    <p>71W Park lan Broklyn Street, <br>
                                                        New York. United States</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact-area-end -->

            <!-- contact-map -->
            <div id="contact-map"></div>
            <!-- contact-map-end -->

        </template>
    </Main>
</template>

<script>
import Main from '../../Main.vue';

export default {
    name: 'Contact',
    components: {
        Main
    }
}
</script>