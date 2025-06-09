import { createPopper } from '@popperjs/core';

document.addEventListener('DOMContentLoaded', function () {
    const btnMore = document.querySelectorAll('.more');
    const tooltip = document.querySelectorAll('.tooltip');

    if (btnMore.length && tooltip.length) {
        btnMore.forEach((btn, index) => {
            const popperInstance = createPopper(btn, tooltip[index], {
                placement: 'bottom-start',
            });

            tooltip[index].style.display = 'none';

            btn.addEventListener('click', () => {
                if (tooltip[index].style.display === 'none') {
                    tooltip[index].style.display = 'block';
                    popperInstance.update();
                } else {
                    tooltip[index].style.display = 'none';
                }
            });

            document.addEventListener('click', (event) => {
                if (!btn.contains(event.target) && !tooltip[index].contains(event.target)) {
                    tooltip[index].style.display = 'none';
                }
            });
        });
    }

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

    // Toast
    Livewire.on('showError', (message) => {
        showErrorToast(message);
    });
});
