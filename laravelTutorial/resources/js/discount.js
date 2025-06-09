document.addEventListener('DOMContentLoaded', function (e) {
    // Show the side bar and keep the state when the error occurs
    var errorElements = document.querySelectorAll('.text-error');

    if (errorElements.length > 0) {
        e.preventDefault();
        var formDiscountEdit = document.getElementById('formDiscount') ? 'formDiscount' : 'formDiscountEdit';
        var formDiscount = new window.bootstrap.Offcanvas(document.getElementById(formDiscountEdit));
        formDiscount.show();
    }

    var discountId;
    var deleteForm = document.forms['delete-form-discount'];
    var btnDelete = document.getElementById('btn-delete-discount');

    // Show edit modal
    $('#formDiscountEdit').on('shown.bs.offcanvas', function (e) {
        e.preventDefault();
        var btn = $(e.relatedTarget);
        var discountId = btn.data('id');

        // Cập nhật action của form
        var formAction = '/discount/update/' + discountId;
        $('#discount-edit-form').attr('action', formAction);

        // Hiển thị spinner, ẩn form
        $('#discount-loading').removeClass('d-none');
        $('#discount-form-container').addClass('d-none');

        // Gửi AJAX để lấy thông tin danh mục
        $.ajax({
            url: '/discount/edit/' + discountId,
            method: 'GET',
            success: function (data) {
                $('#formDiscountEdit').find('#name').val(data.name);
                $('#formDiscountEdit').find('#price_discount').val(data.price_discount);
                $('#formDiscountEdit').find('#expirate_time').val(data.expirate_time);
                $('#formDiscountEdit').find('#amount_discount').val(data.amount_discount);
            },
            error: function () {
                alert('Không thể tải dữ liệu chỉnh sửa.');
            },
            complete: function () {
                $('#discount-loading').addClass('d-none');
                $('#discount-form-container').removeClass('d-none');
            },
        });
    });

    //Delete discount
    $('#delete-discount-modal').on('show.bs.modal', function (e) {
        var btn = $(e.relatedTarget);
        discountId = btn.data('id');
    });

    btnDelete.onclick = function () {
        deleteForm.action = '/discount/delete/' + discountId;
        deleteForm.submit();
    };
});
