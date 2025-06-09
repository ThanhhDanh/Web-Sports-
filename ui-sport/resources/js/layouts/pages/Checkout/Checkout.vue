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
                                <h2>Trang Thanh Toán</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

            <!-- checkout-area -->
            <section class="checkout-area pt-95 pb-95">
                <div class="d-flex flex-column justify-content-center align-items-center" v-if="loading">
                    Đang tải...
                    <div class="spinner-border text-info" role="status"></div>
                </div>
                <div class="container" v-if="user">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="checkout-wrap">
                                <div class="checkout-top">
                                    <h5 class="title">Chi tiết hóa đơn</h5>
                                    <a href="cart.html" class="back"><i class="fas fa-angle-left"></i> -- Quay lại vỏ
                                        hàng</a>
                                </div>
                                <form action="#" class="checkout-form">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-grp">
                                                <label for="fName">Họ và tên lót <span>*</span></label>
                                                <input type="text" id="fName" v-model="user.last_name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-grp">
                                                <label for="lName">Tên <span>*</span></label>
                                                <input type="text" id="lName" v-model="user.name">
                                            </div>
                                        </div>
                                        <!-- <div class="col-12">
                                            <div class="form-grp">
                                                <label for="cName">Email <small>*</small></label>
                                                <input type="email" id="cName">
                                            </div>
                                        </div> -->
                                        <div class="col-12">
                                            <div class="form-grp">
                                                <label for="address">ĐỊA CHỈ, ĐƯỜNG, XÃ <span>*</span></label>
                                                <input type="text" id="address">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-grp">
                                                <label>Thị trấn / Thành phố <span>*</span></label>
                                                <select class="custom-select">
                                                    <option value="Illinois">Hồ Chí Minh</option>
                                                    <option value="New York">Thủ Đức</option>
                                                    <option value="California">Bình Dương</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-grp">
                                                <label>Quận / Huyện <span>*</span></label>
                                                <select class="custom-select">
                                                    <option value="New York">Hóc Môn</option>
                                                    <option value="California">Củ Chi</option>
                                                    <option value="Los Angeles">Quận 12</option>
                                                    <option value="Chicago">Nhà Bè</option>
                                                    <option value="Illinois">Gò Vấp</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-grp">
                                                <label for="zip">Mã ZIP <span>*</span></label>
                                                <input type="text" id="zip">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-grp">
                                                <label for="phone">Số điện thoại <span>*</span></label>
                                                <input type="number" id="phone" v-model="user.phone">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-grp">
                                                <label for="email">Email <span>*</span></label>
                                                <input type="email" id="email" v-model="user.email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="different-address custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="stda">
                                                <label class="custom-control-label" for="stda">VẬN CHUYỂN ĐẾN ĐỊA CHỈ
                                                    KHÁC?</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-grp mb-0">
                                                <label for="message">Ghi chú
                                                    <small>(KHÔNG BẮT BUỘC)</small></label>
                                                <textarea name="message" id="message"
                                                    placeholder="Ghi chú..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-8">
                            <aside class="checkout-sidebar">
                                <h6 class="title">Tổng hóa đơn</h6>
                                <div class="shop-cart-widget">
                                    <form action="#">
                                        <ul>
                                            <li class="sub-total"><span>Tổng giá</span> {{ formatCurrency(subTotal) }}
                                            </li>
                                            <li>
                                                <span>VẬN CHUYỂN</span>
                                                <div class="shop-check-wrap">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck1" :checked="!freeShipping" disabled>
                                                        <label class="custom-control-label pl-2" for="customCheck1">
                                                            TỶ SỐ CỐ ĐỊNH: {{ formatCurrency(fixedShipping) }}
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck2" v-model="freeShipping">
                                                        <label class="custom-control-label pl-2" for="customCheck2">MIỄN
                                                            PHÍ
                                                            VẬN CHUYỂN</label>
                                                    </div>
                                                    <a href="#" class="calculate">TÍNH TOÁN VẬN CHUYỄN</a>
                                                </div>
                                            </li>
                                            <li class="cart-total-amount"><span>TỔNG CỘNG</span> <span class="amount">
                                                    {{ formatCurrency(totalBill) }}
                                                </span></li>
                                        </ul>
                                        <div class="payment-method-info">
                                            <div class="paypal-method-flex">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="paymentCOD"
                                                        :checked="method_payment === 'cod'"
                                                        @change="selectPayment('cod')">
                                                    <label class="custom-control-label method_payment" for="paymentCOD">
                                                        Tiền mặt khi giao hàng
                                                    </label>
                                                    <p>Thanh toán bằng tiền mặt khi giao hàng.</p>
                                                </div>
                                            </div>

                                            <div class="paypal-method-flex">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="paymentMomo"
                                                        :checked="method_payment === 'momo'"
                                                        @change="selectPayment('momo')">
                                                    <label class="custom-control-label method_payment"
                                                        for="paymentMomo">
                                                        Thanh toán qua ví Momo
                                                    </label>
                                                </div>
                                                <div class="paypal-logo">
                                                    <img src="/front_home/img/images/card-momo.png" alt="Momo"
                                                        style="max-width: 80px;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="payment-terms">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck7"
                                                    v-model="agree">
                                                <label class="custom-control-label pl-2" for="customCheck7">
                                                    Tôi đã đọc và đồng ý với các điều khoản và điều kiện trang web.
                                                </label>
                                            </div>
                                        </div>
                                        <button @click.prevent="fetchCheckout()" class="btn">Đặt hàng</button>
                                    </form>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </section>
            <!-- checkout-area-end -->

        </template>
    </Main>
</template>

<script>
import APIs, { endpoints } from '../../../configs/APIs';
import { formatCurrency } from '../../../formatCurrency';
import Main from '../../Main.vue';


export default {
    name: "Checkout",
    components: {
        Main,
    },
    data() {
        return {
            user: null,
            freeShipping: false,
            fixedShipping: 35000,
            cartItems: [],
            loading: false,
            method_payment: '',
            agree: false
        };
    },
    computed: {
        subTotal() {
            return this.cartItems.reduce((total, item) => {
                const productTotal = item.quantity * (item.product?.price || 0);
                return total + productTotal;
            }, 0);
        },
        totalBill() {
            const shippingCost = this.freeShipping ? 0 : this.fixedShipping;
            return this.subTotal + shippingCost;
        }
    },
    mounted() {

        const userData = localStorage.getItem('user');
        if (userData) {
            this.user = JSON.parse(userData);
        }

        this.freeShipping = this.$route.query.freeShipping === '1';
        this.fetchCart();
    },
    methods: {
        async fetchCart() {
            this.loading = true;
            try {
                const response = await APIs.get(endpoints.carts);
                this.cartItems = response.data;
            } catch (error) {
                console.error('Lỗi khi lấy giỏ hàng:', error);
            } finally {
                this.loading = false;
            }
        },

        selectPayment(method) {
            this.method_payment = this.method_payment === method ? '' : method;
        },

        formatCurrency,

        async fetchCheckout() {
            if (!this.agree) {
                window.showErrorToast("Bạn phải đồng ý với điều khoản trước khi thanh toán.");
                return;
            }

            if (!this.method_payment) {
                window.showErrorToast("Vui lòng chọn phương thức thanh toán.");
                return;
            }

            this.loading = true;

            try {
                const payload = {
                    userId: this.user?.id,
                    description: "Thanh toán đơn hàng",
                    status_payment: 0, // hoặc gì đó backend cần
                    method_payment: this.method_payment,
                    selectedProducts: this.cartItems.map(item => ({
                        id: item.product?.id,
                        quantity: item.quantity
                    })),
                    discountId: this.$route.query.discountId || null,
                };

                const response = await APIs.post(endpoints.checkout, payload);

                if (this.method_payment === 'momo') {
                    const payUrl = response.data?.payUrl;
                    if (payUrl) {
                        window.location.href = payUrl;
                    } else {
                        window.showErrorToast("Không nhận được URL thanh toán từ Momo.");
                    }
                } else {
                    window.showSuccessToast("Thanh toán thành công! Đơn hàng đã được lưu.");
                }

            } catch (error) {
                console.error("Lỗi khi thanh toán:", error);
                window.showErrorToast("Có lỗi xảy ra khi thanh toán. Vui lòng thử lại.");
            } finally {
                this.loading = false;
            }
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

.shop-cart-widget .custom-control-label.method_payment::after {
    top: -1px;
    left: -42px;
    width: 3rem;
    height: 3rem;
}

.different-address .custom-control-label::after {
    top: -2px;
    left: -22px;
    width: 3rem;
    height: 3rem;
}
</style>