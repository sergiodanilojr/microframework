// Chart

const balanceChart = document.getElementById('balanceChart')

new Chart(balanceChart, {
    type: 'line',
    labels: ['08/2023','07/2023','06/2023','05/2023','04/2023','03/2023',],
    datasets: [
        {
            label: 'Receitas',
            data: [65, 59, 80, 81, 56, 55,],
            fill: false,
            borderColor: 'rgba(75,192,139, 1)',
            tension: 0.1
        },
        {
            label: 'Despesas',
            data: [65, 59, 80, 81, 56, 55, ],
            fill: false,
            borderColor: 'rgba(192,75,75, 1)',
            tension: 0.1
        }
    ]
})