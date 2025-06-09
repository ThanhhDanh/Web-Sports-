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

            btn.addEventListener('mouseover', () => {
                if (tooltip[index].style.display === 'none') {
                    tooltip[index].style.display = 'block';
                    popperInstance.update();
                } else {
                    tooltip[index].style.display = 'none';
                }
            });

            document.addEventListener('mouseover', (event) => {
                if (!btn.contains(event.target) && !tooltip[index].contains(event.target)) {
                    tooltip[index].style.display = 'none';
                }
            });
        });
    }
});
