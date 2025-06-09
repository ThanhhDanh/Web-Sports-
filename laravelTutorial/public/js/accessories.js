/******/ (() => { // webpackBootstrap
/*!*************************************!*\
  !*** ./resources/js/accessories.js ***!
  \*************************************/
function setupAccessoryEditHandlers(_ref) {
  var type = _ref.type,
    formSelector = _ref.formSelector,
    nameInputSelector = _ref.nameInputSelector;
  document.querySelectorAll(".btn-edit-accessory").forEach(function (button) {
    button.addEventListener('click', function () {
      var id = this.getAttribute('data-id');
      document.getElementById("name-".concat(id)).style.display = 'none';
      document.getElementById("input-name-".concat(id)).style.display = 'block';
      this.style.display = 'none';
      document.querySelector(".btn-confirm-edit-accessory[data-id=\"".concat(id, "\"]")).style.display = 'inline-block';
      var formAction = "/products/accessories/".concat(type, "s/update/").concat(id);
      $(formSelector).attr('action', formAction);
      var currentName = document.getElementById("input-name-".concat(id)).value;
      $(nameInputSelector).val(currentName);
    });
  });
  document.querySelectorAll(".btn-confirm-edit-accessory").forEach(function (button) {
    button.addEventListener('click', function () {
      var id = this.getAttribute('data-id');
      var updatedName = document.getElementById("input-name-".concat(id)).value;
      $(formSelector).find(nameInputSelector).val(updatedName);
      $(formSelector).submit();
    });
  });
}
document.addEventListener('DOMContentLoaded', function () {
  var container = document.querySelector('.container-custom');
  var type = container === null || container === void 0 ? void 0 : container.dataset.accessoryType;
  if (!type) return;
  setupAccessoryEditHandlers({
    type: type,
    formSelector: '#accessory-edit-form',
    nameInputSelector: '#input-name'
  });
});
/******/ })()
;