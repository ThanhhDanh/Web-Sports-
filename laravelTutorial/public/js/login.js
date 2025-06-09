/******/ (() => { // webpackBootstrap
/*!*******************************!*\
  !*** ./resources/js/login.js ***!
  \*******************************/
document.addEventListener('DOMContentLoaded', function () {
  var btnEyeSee = document.getElementById('eye-see');
  var btnEyeBlind = document.getElementById('eye-blind');
  var password = document.getElementById('password');
  function togglePasswordVisibility() {
    var isPasswordVisible = password.type === 'text';
    password.type = isPasswordVisible ? 'password' : 'text';
    btnEyeSee.style.display = isPasswordVisible ? 'none' : 'block';
    btnEyeBlind.style.display = isPasswordVisible ? 'block' : 'none';
  }
  btnEyeSee.addEventListener('click', togglePasswordVisibility);
  btnEyeBlind.addEventListener('click', togglePasswordVisibility);
});
/******/ })()
;