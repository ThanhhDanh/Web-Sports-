import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function () {
    const ctx1 = document.getElementById('myAreaChart').getContext('2d');
    const dataMonth = document.getElementById('chart-data-month');
    const dataYear = document.getElementById('chart-data-year');
    const ctx2 = document.getElementById('myBarChart').getContext('2d');

    const productsThisMonth = JSON.parse(dataMonth.getAttribute('data-product-month'));
    const productsThisYear = JSON.parse(dataYear.getAttribute('data-product-year'));

    const data1 = productsThisMonth.map((month) => month.total_revenue);
    const label1 = productsThisMonth.map((month) => month.product.name);

    const data2 = productsThisYear.map((year) => year.total_revenue);
    const label2 = productsThisYear.map((year) => year.product.name);

    drawChart(ctx1, label1, 'bar', data1, 'Doanh thu tháng');
    drawChart(ctx2, label2, 'line', data2, 'Doanh thua năm');

    function drawChart(ctx, labels, type, data, label) {
        const color = [];

        for (let i = 0; i < data.length; i++) {
            color.push(`rgba(${parseInt(Math.random() * 255)},
            ${parseInt(Math.random() * 255)},
            ${parseInt(Math.random() * 255)}, 0.6)`);
        }

        new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [
                    {
                        label: label,
                        data: data,
                        borderWidth: 1,
                        backgroundColor: color,
                    },
                ],
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 10,
                            },
                            callback: function (value, index, values) {
                                let label = this.getLabelForValue(value);
                                return label.length > 20 ? label.substring(0, 20) + '...' : label;
                            },
                        },
                    },
                    y: {
                        beginAtZero: true,
                    },
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 20,
                            font: {
                                size: 12,
                            },
                        },
                    },
                    tooltip: {
                        callbacks: {
                            title: function (tooltipItems) {
                                return tooltipItems[0].label;
                            },
                            label: function (tooltipItem) {
                                return `Doanh thu: ${tooltipItem.raw.toLocaleString()} VND`;
                            },
                        },
                    },
                },
            },
        });
    }
});
