<template>
    <div class="modal fade" id="openModalAuth" tabindex="-1" role="dialog" aria-labelledby="openModalAuthTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close d-flex align-items-center justify-content-center"
                        data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="ion-ios-close">X</span>
                    </button>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-6 d-flex">
                        <div class="modal-body p-5 img d-flex img text-center d-flex align-items-center"
                            style="background-image: url(/front_home/img/images/trending_banner03.png);">
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="modal-body p-4 p-md-5 align-items-center color-2">
                            <div class="tabulation tabulation2">
                                <div class="d-flex tabs">
                                    <ul class="nav nav-tabs border-0">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#signin">Đăng Nhập</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#signup">Đăng Ký</a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Tab panes -->
                                <div class="tab-content border-0">
                                    <div class="tab-pane p-0 container active" id="signin">
                                        <div class="text w-100">
                                            <h3 class="mb-4">Đăng Nhập</h3>
                                            <form @submit.prevent="handleLogin" class="signin-form">
                                                <div class="form-group mb-3">
                                                    <label class="label" for="name">Email</label>
                                                    <input type="email" v-model="form.email"
                                                        class="form-control custom-form-control" placeholder="Email">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="label" for="password">Mật khẩu</label>
                                                    <input type="password" v-model="form.password"
                                                        class="form-control custom-form-control" placeholder="Mật khẩu">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" style="color: white !important;"
                                                        class="form-control btn btn-primary rounded submit px-3">
                                                        Đăng nhập
                                                        <div v-if="loading" class="spinner-border text-light"
                                                            role="status">
                                                        </div>
                                                    </button>
                                                </div>
                                                <div class="form-group d-md-flex">
                                                    <div class="form-check w-50 text-left">
                                                        <label class="custom-control fill-checkbox">
                                                            <input type="checkbox" v-model="form.remember"
                                                                class="fill-control-input">
                                                            <span class="fill-control-indicator"></span>
                                                            <span class="fill-control-description">Ghi nhớ!</span>
                                                        </label>
                                                    </div>
                                                    <div class="w-50 text-md-right">
                                                        <a href="#">Quên mật khẩu</a>
                                                    </div>
                                                </div>
                                                <p v-if="errorMessage" style="color:red;">{{ errorMessage }}</p>
                                            </form>
                                            <p>Bạn chưa có tài khoản hãy <a data-toggle="tab" href="#signup">Đăng Ký</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-0 container fade" id="signup">
                                        <div class="text w-100">
                                            <h3 class="mb-4">Đăng Ký</h3>
                                            <form action="#" class="signup-form">
                                                <div class="form-group mb-3">
                                                    <label class="label" for="name">Tên</label>
                                                    <input type="text" class="form-control" placeholder="Tên của bạn">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="label" for="email">Email</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="johndoe@gmail.com">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="label" for="password">Mật khẩu</label>
                                                    <input type="password" class="form-control" placeholder="Password">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" style="color: white !important;"
                                                        class="form-control btn btn-primary rounded submit px-3">Đăng
                                                        ký</button>
                                                </div>
                                            </form>
                                            <p>Nếu bạn đã có tài khoản hãy <a data-toggle="tab" href="#signin">Đăng
                                                    Nhập</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import APIs, { endpoints } from '../../configs/APIs'
import Cookies from 'js-cookie'

export default {
    name: "Login",
    data() {
        return {
            form: {
                email: '',
                password: '',
                remember: false,
            },
            errorMessage: '',
            loading: false,
        }
    },
    mounted() {
        $('#openModalAuth').on('hidden.bs.modal', function () {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        });
    },
    methods: {
        async handleLogin() {
            this.loading = true;
            try {
                //Lấy CSRF cookie
                await APIs.get(endpoints['csrf-cookie'], { withCredentials: true });
                // const token = await APIs.get(endpoints['csrf-token']);

                //Gửi login request
                const response = await APIs.post(endpoints.login, this.form, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN'),
                    },
                    withCredentials: true,
                })
                const user = response.data.user;
                localStorage.setItem('user', JSON.stringify(user));


                // Đóng modal
                $('#openModalAuth').modal('hide');
                this.$router.go();
            } catch (error) {
                console.log(error);

                if (error.response && error.response.status === 422) {
                    this.errorMessage = error.response.data.message || 'Thông tin đăng nhập không hợp lệ.'
                } else if (error.response && error.response.status === 403) {
                    this.errorMessage = 'Bạn không có quyền truy cập.'
                } else {
                    this.errorMessage = 'Có lỗi xảy ra. Vui lòng thử lại.'
                }
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>

<style scoped lang="scss">
a {
    transition: 0.3s all ease;
    color: var(--text-primary);

    &:hover,
    &:focus {
        text-decoration: none !important;
        outline: none !important;
        box-shadow: none;
    }
}

button {
    transition: 0.3s all ease;

    &:hover,
    &:focus {
        text-decoration: none !important;
        outline: none !important;
        box-shadow: none !important;
    }
}

h1,
h2,
h3,
h4,
h5,
.h1,
.h2,
.h3,
.h4,
.h5 {
    line-height: 1.5;
    font-weight: 400;
    font-family: 'Roboto', Arial, sans-serif;
}

//COVER BG
.img,
.blog-img,
.user-img {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}

.ftco-footer-social {
    li {
        list-style: none;
        margin: 0 10px 0 0;
        display: inline-block;

        a {
            height: 40px;
            width: 40px;
            display: block;
            background: rgba(var(--black), 0.05);
            border-radius: 50%;
            position: relative;

            span {
                position: absolute;
                font-size: 2rem;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            &:hover {
                color: var(--white);
            }
        }
    }
}

//FORM CONTROL
.form-control {
    height: 52px;
    background: var(--white);
    color: var(--black);
    font-size: 1.4rem;
    border-radius: 5px;
    box-shadow: none;
    border: 1px solid rgba(0, 0, 0, 0.1);

    &:focus,
    &:active {
        outline: none !important;
        box-shadow: none;
        border: 1px solid transparent;
    }
}

textarea.form-control {
    height: inherit !important;
}

//BUTTON
.btn {
    cursor: pointer;
    border-radius: 4px;
    box-shadow: none !important;
    font-size: 1.5rem;

    &:hover,
    &:active,
    &:focus {
        outline: none;
    }

    &.btn-primary {
        background: var(--text-primary) !important;
        border: 1px solid var(--text-primary) !important;
        color: var(--white) !important;

        &:hover {
            border: 1px solid var(--text-primary);
            background: transparent;
            color: var(--text-primary);
        }

        &.btn-outline-primary {
            border: 1px solid var(--text-primary);
            background: transparent;
            color: var(--text-primary);

            &:hover {
                border: 1px solid transparent;
                background: var(--text-primary);
                color: var(--white);
            }
        }
    }
}

.tabulation2 {
    margin: 0 auto;

    .nav-tabs {
        margin-bottom: 20px;

        .nav-item {
            .nav-link {
                border: none;
                font-size: 1.6rem;
                font-weight: 400;
                color: #999;
                position: relative;
                padding: 0 10px 0 0;

                &.active {
                    background: transparent;
                    color: var(--text-primary);
                }
            }
        }
    }

    .tab-content {
        box-shadow: none;
        background: transparent;
    }
}

.ftco-section {
    background: var(--white);

    h2 {
        margin-bottom: 0;
    }
}

//MODAL 01
.modal-dialog {
    max-width: 900px;
}

.modal-content {
    border: none;
    position: relative;
    padding: 0 !important;
    font-size: 1.4rem;
    border-radius: 0;
    -webkit-box-shadow: 0px 10px 34px 10px rgba(0, 0, 0, 0.24);
    -moz-box-shadow: 0px 10px 34px 10px rgba(0, 0, 0, 0.24);
    box-shadow: 0px 10px 34px 10px rgba(0, 0, 0, 0.24);

    .modal-header {
        padding: 0;
        border: none;
    }

    button.close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 0;
        margin: 0;
        width: 40px;
        height: 40px;
        z-index: 1;
        text-shadow: none;
        color: var(--text-primary);
    }

    .modal-body {
        border: none;
        position: relative;
        z-index: 0;
        color: rgba(255, 255, 255, 0.8);

        &.color-1 {
            background: var(--text-primary);
        }

        &.color-2 {
            background: var(--white);
        }

        .icon {
            span {
                font-size: 10vw;
                line-height: 1;
            }
        }

        .icon-2 {
            position: absolute;
            top: 0;
            left: 20px;
            font-size: 3rem;
        }

        a {
            &:hover {
                color: var(--text-primary);
            }
        }
    }

    .label {
        text-transform: uppercase;
        font-size: 1.2rem;
        letter-spacing: 1px;
    }

    .form-control {
        background: transparent;
        border: none;
        border-radius: 0;
        color: #333 !important;
        padding: 0;
        height: 30px;
        border-bottom: 1px solid rgba(83, 83, 83, 0.1);

        &::-webkit-input-placeholder {
            /* Chrome/Opera/Safari */
            color: #999 !important;
        }

        &::-moz-placeholder {
            /* Firefox 19+ */
            color: #999 !important;
        }

        &:-ms-input-placeholder {
            /* IE 10+ */
            color: #999 !important;
        }

        &:-moz-placeholder {
            /* Firefox 18- */
            color: #999 !important;
        }
    }

    .btn-primary {
        background: var(--text-primary) !important;
        height: 52px;
    }

    @media (max-width: 576px) {
        .img {
            height: 300px;
        }
    }
}

.form-check {
    padding: 0;
}

.fill-checkbox {
    .fill-control-input {
        display: none;

        &:checked~.fill-control-indicator {
            background-color: var(--text-primary);
            border-color: var(--text-primary);
            background-size: 80%;
        }

        &:checked~.fill-control-description {
            color: #999;
        }
    }

    .fill-control-indicator {
        border-radius: 3px;
        display: inline-block;
        position: absolute;
        top: 2px;
        left: -5px;
        width: 16px;
        height: 16px;
        border: 1px solid #999;
        transition: 0.1s;
        background: transperent;
        background-size: 0%;
        background-position: center;
        background-repeat: no-repeat;
        content: 'hey';
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E");
    }

    .fill-control-description {
        color: #999;
    }
}

.form-check {
    &.disabled {
        .fill-checkbox {
            --text-primary: #999;

            .fill-control-description {
                color: #999;
            }
        }
    }
}
</style>