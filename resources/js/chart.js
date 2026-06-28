import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';
Chart.register(ChartDataLabels);

const dashboardChart = document.getElementById('dashboardChart');

if (dashboardChart) {

    const labels = JSON.parse(
        dashboardChart.dataset.labels
    );
    const values = JSON.parse(
        dashboardChart.dataset.values
    );

    new Chart(dashboardChart, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Jumlah Aduan',
                data: values,

                backgroundColor: [
                    '#0f766e', // Sembako
                    '#f59e0b', // Hunian Sementara
                    '#3b82f6'  // Pakaian
                ],

                borderRadius: {
                    topLeft: 0,
                    bottomLeft: 0,
                    topRight: 5,
                    bottomRight: 5
                },

                borderSkipped: false
            }]
        },
        options: {
            indexAxis: 'y',    
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label(context) {
                            const total =
                                context.dataset.data.reduce(
                                    (a, b) => a + b,
                                    0
                                );
                            const value = context.raw;
                            const percent =
                                ((value / total) * 100)
                                .toFixed(1);
                            return `${value} aduan (${percent}%)`;
                        }
                    }
                },
                datalabels: {
                    color: '#111827',
                    anchor: 'end',
                    align: 'right',
                    offset: 8,
                    font: {
                        weight: 'bold',
                        size: 14
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: 'false'
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                y: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            }
        }
    });
}

document
    .getElementById('generate-form')
    .addEventListener('submit', function () {

        const chart =
            Chart.getChart('dashboardChart');

        if (chart) {

            document
                .getElementById('chart-data')
                .value =
                    chart
                        .toBase64Image();

        }

    });