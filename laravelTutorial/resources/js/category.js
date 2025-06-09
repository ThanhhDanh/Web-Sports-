document.addEventListener('DOMContentLoaded', function (e) {
    // Show the side bar and keep the state when the error occurs
    var errorElements = document.querySelectorAll('.text-error');

    if (errorElements.length > 0) {
        e.preventDefault();

        var formCategoryId = document.getElementById('formCategoryEdit').classList.contains('show')
            ? 'formCategoryEdit'
            : 'formCategory';

        var formCategory = new window.bootstrap.Offcanvas(document.getElementById(formCategoryId));
        formCategory.show();
    }

    var categoryId;
    var deleteForm = document.forms['delete-form-category'];
    var btnDelete = document.getElementById('btn-delete-category');

    // Show edit modal
    $('#formCategoryEdit').on('shown.bs.offcanvas', function (e) {
        e.preventDefault();
        var btn = $(e.relatedTarget);
        var categoryId = btn.data('id');

        // Cập nhật action của form
        var formAction = '/category/update/' + categoryId;
        $('#category-edit-form').attr('action', formAction);

        // Hiển thị spinner, ẩn form
        $('#category-loading').removeClass('d-none');
        $('#category-form-container').addClass('d-none');

        // Gửi AJAX để lấy thông tin danh mục
        $.ajax({
            url: '/category/edit/' + categoryId,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#formCategoryEdit').find('#name').val(data.name);
                $('#formCategoryEdit').find('#description').val(data.description);
                if (data.image) {
                    $('#formCategoryEdit').find('#image-preview').attr('src', data.image).show();
                }
            },
            error: function () {
                alert('Không thể tải dữ liệu chỉnh sửa.');
            },
            complete: function () {
                $('#category-loading').addClass('d-none');
                $('#category-form-container').removeClass('d-none');
            },
        });
    });

    //Delete category
    $('#delete-category-modal').on('show.bs.modal', function (e) {
        var btn = $(e.relatedTarget);
        categoryId = btn.data('id');
    });

    btnDelete.onclick = function () {
        deleteForm.action = '/category/delete/' + categoryId;
        deleteForm.submit();
    };
});
