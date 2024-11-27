@extends('bases')

@section('titre', 'Statistique || DNEC')

@section('contenu')
<div class="container">
    <br><br><br><br><br>
    <h1 class="my-4 text-center">Graphique des Examens sur 10 Ans</h1>

    @if($examData->isEmpty())
        <p class="text-center">Aucune donnée trouvée</p>
    @else
        <div class="row">
            @foreach($examData as $index => $exam)
                <div class="col-md-6 mb-5">
                    <h2 class="text-center">{{ $exam['nom'] }} - Résultats sur les 10 dernières années</h2>
                    <canvas id="examChart{{ $index }}"></canvas>
                </div>
                @if(($index + 1) % 2 == 0)
                    </div><div class="row"> <!-- Ferme la rangée actuelle et en ouvre une nouvelle tous les 2 graphiques -->
                @endif
            @endforeach
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            @foreach($examData as $index => $exam)
                var ctx = document.getElementById('examChart{{ $index }}').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($exam['labels']) !!},  // Labels des années
                        datasets: [{
                            label: 'Nombre d\'admis',
                            data: {!! json_encode($exam['data']) !!},  // Données des admis
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: false,
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Nombre d\'admis pour ' + '{{ $exam['nom'] }}'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            @endforeach
        </script>
    @endif
</div>
@endsection
