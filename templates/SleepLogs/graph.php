<div class="sleep-logs graph content">
    <h3>Graphique des Cycles de Sommeil</h3>
    <canvas id="sleepChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('sleepChart').getContext('2d');
    const sleepChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($days) ?>, // Les dates
            datasets: [{
                label: 'Cycles de sommeil',
                data: <?= json_encode($cycles) ?>, // Les cycles
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre de cycles'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>
