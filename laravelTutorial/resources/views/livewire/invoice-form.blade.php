<div class="container-fluid px-4">
    <div class="container bg-container">
        <h1 class="mb-5 ps-4 name-create-invoice">Thêm hóa đơn</h1>
        <form wire:submit.prevent="submitInvoice">
            @csrf
            <div class="row px-4">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="form-group mb-3">
                        <label class="@error('selectedUser') text-danger  @enderror" for="name">Tên khách hàng</label>
                        <div class="form-input">
                            <select wire:model="selectedUser" id="name" class="form-select"
                                aria-label="Default select example">
                                <option value="">-- Khách hàng --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="icon-input">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        </div>
                        @error('selectedUser')
                            <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="form-group mb-3">
                        <label class="@error('phone') text-danger  @enderror" for="phone">Số điện thoại khách
                            hàng</label>
                        <div class="form-input">
                            <input type="text" wire:model="phone" class="form-control" name="phone" id="phone"
                                aria-describedby="emailHelp" placeholder="Số điện thoại khách hàng....">
                            <div class="icon-input">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                        </div>
                        @error('phone')
                            <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="form-group mb-3">
                        <label for="status_payment">Trạng thái hóa đơn</label>
                        <div class="form-input">
                            <select wire:model="statusPayment" id="status_payment" class="form-select"
                                aria-label="Default select example">
                                <option value="">-- Trạng thái hóa đơn --</option>
                                <option value="Paid">Đã trả</option>
                                <option value="Pending">Đang chờ</option>
                                <option value="Cancel">Hủy thanh toán</option>
                            </select>
                            <div class="icon-input">
                                <i class="fa-regular fa-face-smile"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="form-group mb-3">
                        <label class="@error('email') text-danger  @enderror" for="email">Email address</label>
                        <div class="form-input">
                            <input type="text" wire:model="email" class="form-control" id="email"
                                aria-describedby="emailHelp" onchange="window.verifyEmail(this)"
                                placeholder="Email khách hàng...">
                            <div class="icon-input">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div id="success" class="icon-input-error me-5">
                                <i class="text-success fa-solid fa-circle-check"></i>
                            </div>
                            <div id="error" class="icon-input-error me-5">
                                <i class="text-danger fa-solid fa-circle-exclamation"></i>
                            </div>
                        </div>
                        @error('email')
                            <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="form-group mb-3">
                        <label class="@error('selectedProducts') text-danger  @enderror" for="product">Sản phẩm</label>
                        <div class="form-input">
                            <select wire:change.prevent="addProduct($event.target.value)" id="product"
                                class="form-select" aria-label="Default select example">
                                <option value="">-- Chọn sản phẩm mua --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-name="{{ $product->name }}"
                                        data-price="{{ $product->price }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('selectedProducts')
                            <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="container container-table">
                <table class="table table-borderless text-center">
                    <thead>
                        <tr class="table-primary">
                            <th style="width: 300px" scope="col">Sản phẩm</th>
                            <th class="w-90" scope="col">Số lượng</th>
                            <th scope="col">Màu</th>
                            <th scope="col">Size</th>
                            <th scope="col">Giá sản phẩm</th>
                            <th scope="col">Thuế</th>
                            <th scope="col">Tổng giá</th>
                            <th scope="col">#####</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($selectedProducts as $id => $product)
                            <tr>
                                <td class="p-10">{{ $product['name'] }}</td>
                                <td class="p-10">
                                    {{ $product['quantity'] }}
                                </td>
                                <td class="p-10">
                                    <select id="color_id" class="form-select"
                                        wire:model="selectedProducts.{{ $id }}.color_id">
                                        @foreach ($productColors[$id] as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="p-10">
                                    <select id="size_id" class="form-select"
                                        wire:model="selectedProducts.{{ $id }}.size_id">
                                        @foreach ($productSizes[$id] as $size)
                                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="p-10">{{ number_format($product['price']) }} VNĐ</td>
                                <td class="p-10">{{ number_format($product['tax'] ?? 0) }}%</td>
                                <td class="p-10">
                                    <strong>
                                        {{ number_format($product['price'] * $product['quantity'] * (1 + $product['tax'] / 100)) }}
                                        VNĐ
                                    </strong>
                                </td>
                                <td>
                                    <button wire:click.prevent="removeProduct({{ $id }})">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="border-top: 1px solid rgb(232 231 231)" class="row ps-4 mt-5">
                <div class="col-xl-4 col-md-6 mt-4">
                    <div class="form-group mb-3">
                        <label for="discount">Giảm giá</label>
                        <div class="form-input">
                            <select wire:change.prevent="addDiscount($event.target.value)" id="discount"
                                name="discount" class="form-select" aria-label="Default select example">
                                <option value="">-- Chọn phiếu giảm --</option>
                                @foreach ($discounts as $discount)
                                    <option value="{{ $discount->id }}">{{ $discount->name }}</option>
                                @endforeach
                            </select>
                            <div class="icon-input">
                                <i class="fa-solid fa-percent"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mt-4">
                    <div class="form-group mb-3">
                        <label for="tax">Thuế</label>
                        <div class="form-input">
                            <input type="number" disabled id="tax" wire:model="tax" class="form-control">
                            <div class="icon-input">
                                <i class="fa-solid fa-percent"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row px-4 my-4">
                <div class="col-xl-6 col-md-6 mt-4">
                    <div class="col-left">
                        <div class="col-xl-12 col-md-12">
                            <div class="form-group mb-5">
                                <label for="methodPayment mb-3">Phương thức thanh toán</label>
                                <div class="form-input">
                                    <select wire:model="paymentMethod" id="methodPayment" name="methodPayment"
                                        class="form-select" aria-label="Default select example">
                                        <option value="">-- Chọn phương thức thanh toán --</option>
                                        <option value="Cash">Thanh toán khi nhận hàng</option>
                                        <option value="Momo">Momo</option>
                                        <option value="VNPay">VNPay</option>
                                    </select>
                                    <div class="icon-input">
                                        <i class="fa-solid fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="form-group mb-3">
                                <label class="mb-3" for="description">Ghi chú</label>
                                <div class="form-textarea">
                                    <textarea wire:model="description" name="description" id="description" class="w-100" rows="3"
                                        placeholder="Ghi chú..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 mt-4">
                    <div class="col-right">
                        <div class="col-item d-flex align-items-center justify-content-between">
                            <span class="label-item mb-3 taxable">Số tiền chịu thuế</span>
                            <span class="money-item taxable-amount">{{ $tax }}%</span>
                        </div>
                        <div class="col-item d-flex align-items-center justify-content-between">
                            <span class="label-item mb-3">Số tiền giảm giá</span>
                            <span class="money-item">
                                {{ is_array($selectedDiscount) && isset($selectedDiscount['amount'])
                                    ? number_format($selectedDiscount['amount'], 0, '.', ',')
                                    : '0' }}
                                VNĐ
                            </span>
                        </div>
                        <div class="col-item d-flex align-items-center justify-content-between">
                            <span class="label-item mb-3 money-bill">Tổng hóa đơn</span>
                            <span class="money-item">{{ $this->getTotalAmount() }}</span>
                        </div>
                        <div class="col-item d-flex align-items-start flex-column">
                            <span class="label-item mb-3 @error('signature') text-danger  @enderror">Chữ
                                ký</span>
                            <div class="form-input">
                                <input wire:model="signature" class="form-control" type="text"
                                    placeholder="Chữ ký của bạn....">
                                <div class="icon-input">
                                    <i class="fa-solid fa-signature"></i>
                                </div>
                            </div>
                            @error('signature')
                                <div id="error" class="my-3 text-danger text-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end pe-4 pb-5">
                <button class="btn btn-cancel">Hủy</button>
                <button type="submit" class="btn btn-create">Tạo</button>
            </div>
        </form>
    </div>
</div>
