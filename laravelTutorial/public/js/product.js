/******/ (() => { // webpackBootstrap
/*!*********************************!*\
  !*** ./resources/js/product.js ***!
  \*********************************/
document.addEventListener('DOMContentLoaded', function () {
  var productId;
  var deleteForm = document.forms['delete-form-product'];
  var btnDelete = document.getElementById('btn-delete-product');
  $('#delete-product-modal').on('show.bs.modal', function (e) {
    var btn = $(e.relatedTarget);
    productId = btn.data('id');
  });
  btnDelete.onclick = function () {
    deleteForm.action = '/product/delete/' + productId;
    deleteForm.submit();
  };
});
/******/ })()
;