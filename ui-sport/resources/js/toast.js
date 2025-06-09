window.showSuccessToast = function (message) {
    toast({
        title: 'Success!',
        message: message,
        type: 'success',
        duration: 5000,
    });
};

window.showErrorToast = function (message) {
    toast({
        title: 'Error!',
        message: message,
        type: 'error',
        duration: 5000,
    });
};

function toast({ title = '', message = '', duration = 2000, type = 'info' }) {
    const main = document.getElementById('toast');
    if (main) {
        const toast = document.createElement('div');

        // Auto remove
        const autoRemove = setTimeout(function () {
            if (main.contains(toast)) {
                main.removeChild(toast);
            }
        }, duration + 2000);

        // Remove when clicked
        toast.onclick = function (e) {
            if (e.target.closest('.toast__close')) {
                if (main.contains(toast)) {
                    main.removeChild(toast);
                }
                clearTimeout(autoRemove);
            }
        };

        const icons = {
            success: 'fas fa-check-circle',
            info: 'fas fa-info-circle',
            warning: 'fas fa-exclamation-triangle',
            error: 'fas fa-times-circle',
        };

        const icon = icons[type];
        const delay = (duration / 1000).toFixed(2);
        toast.classList.add('toast', `toast--${type}`);
        toast.style.animation = `slideInleft ease .3s, fadeOut linear 1s ${delay}s forwards`;
        toast.innerHTML = `
            <div class="toast__icon">
                <i class="${icon}"></i>
            </div>
            <div class="toast__body">
                <h3 class="toast__title">${title}</h3>
                <p class="toast__msg">${message}</p>
            </div>
            <div class="toast__close">
                <i class="fas fa-times"></i>
            </div>
        `;
        main.appendChild(toast);
    }
}
