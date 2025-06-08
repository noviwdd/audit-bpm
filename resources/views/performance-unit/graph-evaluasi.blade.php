@extends('layout.dashboard')
@section('title', 'Grafik Evaluasi Kinerja')
@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-bold text-gray-700">Grafik Evaluasi Kinerja</h2>
    <form method="GET">
        <select name="unit_id" onchange="this.form.submit()" class="border rounded p-1 text-sm">
            @foreach($units as $unit)
                <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>
                    {{ $unit->name }}
                </option>
            @endforeach
        </select>
    </form>
</div>

<div id="chartContainer"></div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    async function fetchChartData() {
        const unitId = document.querySelector('select[name="unit_id"]').value;
        const response = await fetch(`/get-evaluasi-chart-data?unit_id=${unitId}`);
        const data = await response.json();
        const container = document.getElementById('chartContainer');
        container.innerHTML = '';

        data.forEach((chartData, index) => {
            const canvas = document.createElement('canvas');
            canvas.id = `chart${index}`;
            container.appendChild(canvas);
            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: chartData.labels.length >= 3 ? 'radar' : 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    scales: chartData.labels.length >= 3 ? {
                        r: { beginAtZero: true }
                    } : {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    }

    fetchChartData();
</script>
@endsection
