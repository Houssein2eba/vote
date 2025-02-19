@extends('layout.template')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg p-4 rounded-4">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="text-center flex-grow-1">📊 نتائج التصويت | Résultat du vote</h3>
            <a class="btn btn-outline-dark" href="{{ route('home') }}">❌</a>
        </div>

        <div class="mt-4">
            <canvas id="resultsChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const resultsData = @json($results); // Pass the data from PHP to JavaScript
    
    const labels = ['UGEM 01', 'UNEM 02', 'SNEM 03', 'ANEM 04'];
    const unionVotes = [0, 0, 0, 0];

    resultsData.forEach(result => {
        // Ensure that union_id is within the expected range (1-4)
        if (result.union_id >= 1 && result.union_id <= 4) {
            unionVotes[result.union_id - 1] = result.count;
        }
    });

    const ctx = document.getElementById('resultsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '🗳 عدد الأصوات',
                data: unionVotes,
                backgroundColor: ['#FFC107', '#28A745', '#17A2B8', '#FD7E14'],
                borderColor: ['#FFB300', '#218838', '#138496', '#E65A00'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 14
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection
