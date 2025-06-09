import Chart from 'chart.js/auto';
import { createPopper } from '@popperjs/core';

// document.addEventListener('DOMContentLoaded', function () {
//     const ctx = document.getElementById('myAreaChart').getContext('2d');

//     const el = document.getElementById('chart-data-comment');
//     const dataComment = JSON.parse(el.getAttribute('data-comment'));

//     const labels = [1, 2, 3, 4, 5];
//     const data = labels.map((level) => dataComment[level.toString()] || 0);

//     const color = [];

//     for (let i = 0; i < data.length; i++) {
//         color.push(`rgba(${parseInt(Math.random() * 255)},
//             ${parseInt(Math.random() * 255)},
//             ${parseInt(Math.random() * 255)}, 0.6)`);
//     }

//     new Chart(ctx, {
//         type: 'bar',
//         data: {
//             labels: labels.map((l) => `⭐ ${l}`),
//             datasets: [
//                 {
//                     label: 'Số lượt đánh giá',
//                     backgroundColor: color,
//                     borderWidth: 1,
//                     data: data,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//             scales: {
//                 y: {
//                     beginAtZero: true,
//                     precision: 0,
//                 },
//             },
//             plugins: {
//                 legend: {
//                     display: false,
//                 },
//             },
//         },
//     });

//     const btnMore = document.querySelectorAll('.more');
//     const tooltip = document.querySelectorAll('.tooltip');

//     if (btnMore.length && tooltip.length) {
//         btnMore.forEach((btn, index) => {
//             const popperInstance = createPopper(btn, tooltip[index], {
//                 placement: 'bottom-start',
//             });

//             tooltip[index].style.display = 'none';

//             btn.addEventListener('click', () => {
//                 if (tooltip[index].style.display === 'none') {
//                     tooltip[index].style.display = 'block';
//                     popperInstance.update();
//                 } else {
//                     tooltip[index].style.display = 'none';
//                 }
//             });

//             document.addEventListener('click', (event) => {
//                 if (!btn.contains(event.target) && !tooltip[index].contains(event.target)) {
//                     tooltip[index].style.display = 'none';
//                 }
//             });
//         });
//     }

//     // Toast
//     Livewire.on('showError', (message) => {
//         showErrorToast(message);
//     });

//     Livewire.on('showSuccess', (message) => {
//         showSuccessToast(message);
//     });

//     var errorElements = document.querySelectorAll('.text-error');

//     if (errorElements.length > 0) {
//         e.preventDefault();

//         var modal = new window.bootstrap.Modal(document.getElementById('createComment'));
//         modal.show();
//     }
// });

window.myChart = null;

function initChartAndTooltip() {
    const ctx = document.getElementById('myAreaChart')?.getContext('2d');
    const el = document.getElementById('chart-data-comment');

    if (!ctx || !el) return;

    const dataComment = JSON.parse(el.getAttribute('data-comment'));

    const labels = [1, 2, 3, 4, 5];
    const data = labels.map((level) => dataComment[level.toString()] || 0);

    const color = data.map(
        () =>
            `rgba(${parseInt(Math.random() * 255)},
            ${parseInt(Math.random() * 255)},
            ${parseInt(Math.random() * 255)}, 0.6)`,
    );

    if (window.myChart) {
        window.myChart.destroy();
    }

    window.myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels.map((l) => `⭐ ${l}`),
            datasets: [
                {
                    label: 'Số lượt đánh giá',
                    backgroundColor: color,
                    borderWidth: 1,
                    data: data,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0,
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
            },
        },
    });

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

    var errorElements = document.querySelectorAll('.text-error');
    if (errorElements.length > 0) {
        var modal = new window.bootstrap.Modal(document.getElementById('createComment'));
        modal.show();
    }

    const sidebar = document.getElementById('commentSidebar');
    const closeBtn = document.getElementById('closeSidebar');
    const commentContent = document.getElementById('commentContent');

    document.querySelectorAll('.view-comment').forEach((button) => {
        button.addEventListener('click', function () {
            const commentId = this.dataset.commentId;

            sidebar.classList.add('open');
            commentContent.innerHTML = 'Đang tải...';

            fetch(`/comments/${commentId}`)
                .then((res) => res.text())
                .then((html) => {
                    commentContent.innerHTML = html;
                });
        });
    });

    closeBtn.addEventListener('click', function () {
        sidebar.classList.remove('open');
    });
}

// Toasts
Livewire.on('showError', (message) => {
    showErrorToast(message);
});

Livewire.on('showSuccess', (message) => {
    showSuccessToast(message);
});

Livewire.on('updateChart', (data) => {
    // Cập nhật lại biểu đồ ở đây
    console.log('Update chart với data:', data);
    console.log('Chart:', window.myChart);

    const chartData = data.rateLevels || {};
    const labels = Object.keys(chartData).map((l) => `⭐ ${l}`);
    const values = Object.values(chartData);

    if (window.myChart) {
        window.myChart.data.labels = labels;
        window.myChart.data.datasets[0].data = values;
        window.myChart.update();
    }
});

document.addEventListener('DOMContentLoaded', initChartAndTooltip);
