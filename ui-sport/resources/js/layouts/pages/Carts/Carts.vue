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
                                <h2>Vỏ Hàng</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Vỏ hàng</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

            <!-- cart-area -->
            <div class="cart-area pt-100 pb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="cart-wrapper">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail"></th>
                                                <th class="product-name">Sản phẩm</th>
                                                <th class="product-price">Giá</th>
                                                <th class="product-thumbnail">Size</th>
                                                <th class="product-thumbnail">Màu</th>
                                                <th class="product-quantity">Số lượng</th>
                                                <th class="product-subtotal">Tổng giá</th>
                                                <th class="product-delete"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="item in cartItems" :key="item.id">
                                                <td class="product-thumbnail">
                                                    <router-link :to="`/shop-details/${item.product?.id}`">
                                                        <img :src="item.product?.image" :alt="item.product?.name">
                                                    </router-link>
                                                </td>
                                                <td class="product-name">
                                                    <h4><router-link :to="`/shop-details/${item.product?.id}`">
                                                            {{ item.product?.name }}
                                                        </router-link></h4>
                                                </td>
                                                <td class="product-price">{{ formatCurrency(item.product?.price) }}</td>
                                                <td class="product-thumbnail">{{ item.size?.name || '—' }}</td>
                                                <td class="product-thumbnail">
                                                    <div class="text-center d-flex justify-content-center">
                                                        <div class="product-bg-color"
                                                            :style="{ backgroundColor: item.color?.code }"></div>
                                                    </div>
                                                </td>
                                                <td class="product-quantity">
                                                    <div class="cart-plus-minus">
                                                        <form action="#" class="num-block">
                                                            <input type="text" class="in-num" v-model="item.quantity"
                                                                readonly="">
                                                            <div class="qtybutton-box">
                                                                <span class="plus"
                                                                    @click.prevent="updateQuantity(item, item.quantity + 1)"><img
                                                                        src="/front_home/img/icon/plus.png"
                                                                        alt=""></span>
                                                                <span class="minus dis"
                                                                    @click.prevent="updateQuantity(item, item.quantity - 1)"><img
                                                                        src="/front_home/img/icon/minus.png"
                                                                        alt=""></span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal"><span>{{ formatCurrency(item.quantity *
                                                    item.product?.price) }}</span></td>
                                                <td class="product-delete">
                                                    <a href="#" @click.prevent="removeCartItem(item)">
                                                        <i class="flaticon-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="shop-cart-bottom mt-20">
                                    <div class="cart-coupon">
                                        <form action="#">
                                            <input type="text" placeholder="Enter Coupon Code...">
                                            <button class="btn">Áp dụng phiếu giảm giá</button>
                                        </form>
                                    </div>
                                    <div class="continue-shopping">
                                        <router-link :to="`/about-us`" class="btn">Cập nhật sản phẩm khác</router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-total pt-95">
                                <h3 class="title">THÔNG TIN VỎ HÀNG</h3>
                                <div class="shop-cart-widget">
                                    <form action="#">
                                        <ul>
                                            <li class="sub-total"><span>TỔNG GIÁ</span> {{ formatCurrency(subTotal) }}
                                            </li>
                                            <li>
                                                <span>VẬN CHUYỂN</span>
                                                <div class="shop-check-wrap">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck2" :checked="!freeShipping" disabled>
                                                        <label class="custom-control-label pl-2" for="customCheck2">
                                                            TỶ SỐ CỐ ĐỊNH: {{ formatCurrency(fixedShipping) }}
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck1" v-model="freeShipping">
                                                        <label class="custom-control-label pl-2" for="customCheck1">
                                                            MIỄN PHÍ VẬN CHUYỂN
                                                        </label>
                                                    </div>
                                                    <a href="#" class="calculate">TÍNH TOÁN VẬN CHUYỂN</a>
                                                </div>
                                            </li>
                                            <li class="cart-total-amount"><span>TỔNG CỘNG</span> <span class="amount">{{
                                                formatCurrency(totalBill) }}</span></li>
                                        </ul>
                                        <router-link
                                            :to="{ path: '/checkout', query: { freeShipping: freeShipping ? '1' : '0' } }"
                                            class="btn">
                                            TIẾN HÀNH THANH TOÁN
                                        </router-link>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- cart-area-end -->

        </template>
    </Main>
</template>
<script>
import APIs, { endpoints } from '../../../configs/APIs';
import { formatCurrency } from '../../../formatCurrency';
import Main from '../../Main.vue';
import Cookies from 'js-cookie';

export default {
    name: "Carts",
    components: {
        Main
    },
    data() {
        return {
            cartItems: [],
            discounts: [],
            fixedShipping: 35000,
            freeShipping: false,
        };
    },
    mounted() {
        this.fetchCart();
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
    methods: {
        async fetchCart() {
            try {
                const response = await APIs.get(endpoints.carts);
                this.cartItems = response.data;

            } catch (error) {
                console.error('Lỗi khi lấy giỏ hàng:', error);
            }
        },

        formatCurrency,

        async updateQuantity(item, newQuantity) {
            if (newQuantity < 1) return;
            try {
                await APIs.get(endpoints['csrf-cookie'], { withCredentials: true });
                await APIs.put(`${endpoints.carts}/${item.id}`, { quantity: newQuantity }, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN'),
                    },
                });
                item.quantity = newQuantity;

                window.dispatchEvent(new Event('cart-updated'));

            } catch (error) {
                window.showErrorToast('Cập nhật số lượng thất bại!');
            }
        },

        async removeCartItem(item) {
            try {
                await APIs.get(endpoints['csrf-cookie'], { withCredentials: true });
                await APIs.delete(`${endpoints.carts}/${item.id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN'),
                    },
                });
                this.cartItems = this.cartItems.filter(ci => ci.id !== item.id);

                window.dispatchEvent(new Event('cart-updated'));

                window.showSuccessToast('Đã xóa sản phẩm khỏi giỏ hàng!');
            } catch (error) {
                window.showErrorToast('Xóa sản phẩm thất bại!');
            }
        },

        async fetchDiscounts() {

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

.product-name {
    width: 410px;

    h4 {
        -webkit-line-clamp: 1;
        line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        display: -webkit-box;
    }
}

.product-thumbnail {
    .product-bg-color {
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }
}

.qtybutton-box>span.minus.dis {
    cursor: pointer;
}
</style>