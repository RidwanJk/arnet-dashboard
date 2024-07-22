@extends('layouts.app')

@section('title', 'Telkom | Document')

@section('content')

    @if (session()->has('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="m-0">
                @foreach (session('errors') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title text-uppercase">Core Potential</h6>
                    <div>
                        <a href="{{ route('addcore') }}" class="btn btn-primary mb-4 mt-3">
                            <i class="bi bi-plus me-3"></i>Insert New Core Potential
                        </a>
                    </div>

                    {{-- Render Charts --}}
                    <div class="row">
                        @foreach ($chartData as $data)
                            @if ($data['good'] != 0 || $data['bad'] != 0 || $data['used'] != 0 || $data['total'] != 0)
                                <div class="col-md-6 mb-4">
                                    <div class="chart-container" style="position: relative; height:40vh; width:100%">
                                        <canvas id="chart-{{ $loop->index }}"></canvas>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($chartData);

            chartData.forEach((data, index) => {
                if (data.good != 0 || data.bad != 0 || data.used != 0 || data.total != 0) {
                    const ctx = document.getElementById(`chart-${index}`).getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Good', 'Bad', 'Used', 'Total'],
                            datasets: [{
                                label: `Bar Chart for ${data.ruas}`,
                                data: [data.good, data.bad, data.used, data.total],
                                backgroundColor: [
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(153, 102, 255, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(153, 102, 255, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
