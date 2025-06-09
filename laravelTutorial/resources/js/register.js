document.addEventListener('DOMContentLoaded', function () {
    var btnEyeSee = document.getElementById('eye-see');
    var btnEyeSeeConfirm = document.getElementById('eye-see-confirm');
    var btnEyeBlind = document.getElementById('eye-blind');
    var btnEyeBlindConfirm = document.getElementById('eye-blind-confirm');
    var password = document.getElementById('password');
    var passwordConfirmation = document.getElementById('password_confirmation');

    function togglePasswordVisibility() {
        var isPasswordVisible = password.type === 'text';
        password.type = isPasswordVisible ? 'password' : 'text';
        btnEyeSee.style.display = isPasswordVisible ? 'none' : 'block';
        btnEyeBlind.style.display = isPasswordVisible ? 'block' : 'none';
    }

    function togglePasswordHasConfirmVisibility() {
        var isPasswordVisible = passwordConfirmation.type === 'text';
        passwordConfirmation.type = isPasswordVisible ? 'password' : 'text';
        btnEyeSeeConfirm.style.display = isPasswordVisible ? 'none' : 'block';
        btnEyeBlindConfirm.style.display = isPasswordVisible ? 'block' : 'none';
    }

    btnEyeSee.addEventListener('click', togglePasswordVisibility);
    btnEyeBlind.addEventListener('click', togglePasswordVisibility);
    btnEyeSeeConfirm.addEventListener('click', togglePasswordHasConfirmVisibility);
    btnEyeBlindConfirm.addEventListener('click', togglePasswordHasConfirmVisibility);

    // Check email
    function verifyEmail(input) {
        var iconSuccess = document.getElementById('success');
        var iconError = document.getElementById('error');
        let email = input.value;
        let regex = new RegExp(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/);
        if (regex.test(email)) {
            iconSuccess.style.display = 'block';
            iconError.style.display = 'none';
        } else {
            iconError.style.display = 'block';
            iconSuccess.style.display = 'none';
        }
    }
    window.verifyEmail = verifyEmail;
});
