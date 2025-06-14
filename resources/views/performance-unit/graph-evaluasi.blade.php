@extends('layout.dashboard')
@section('title', 'Grafik Evaluasi Kinerja')
@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-bold text-gray-700">Grafik Evaluasi Kinerja</h2>
    <form method="GET" class="flex gap-2">
        <select name="unit_id" onchange="this.form.submit()" class="border rounded p-1 text-sm">
            @foreach($units as $unit)
                <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>
                    {{ $unit->name }}
                </option>
            @endforeach
        </select>
        <select name="year" onchange="this.form.submit()" class="border rounded p-1 text-sm">
            @for($y = now()->year; $y >= now()->year - 5; $y--)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endfor
        </select>
    </form>
</div>

<div id="chartContainer" class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-6 px-4"></div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    async function fetchChartData() {
        const unitId = document.querySelector('select[name="unit_id"]').value;
        const year = document.querySelector('select[name="year"]').value;
        const response = await fetch(`/get-evaluasi-chart-data?unit_id=${unitId}&year=${year}`);
        const data = await response.json();
        const container = document.getElementById('chartContainer');
        container.innerHTML = '';

        const colors = [
            ['rgba(255, 99, 132, 0.2)', 'rgba(255, 99, 132, 1)'],
            ['rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 1)'],
            ['rgba(255, 206, 86, 0.2)', 'rgba(255, 206, 86, 1)'],
            ['rgba(75, 192, 192, 0.2)', 'rgba(75, 192, 192, 1)'],
            ['rgba(153, 102, 255, 0.2)', 'rgba(153, 102, 255, 1)'],
        ];

        data.forEach((chartData, index) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'bg-white p-4 rounded-lg shadow';

            const canvasTitle = document.createElement('p');
            canvasTitle.className = 'text-center font-semibold text-gray-700 mb-2';
            canvasTitle.innerText = `Kriteria: ${chartData.criteria}`;
            wrapper.appendChild(canvasTitle);

            const canvas = document.createElement('canvas');
            canvas.style.height = '300px';
            wrapper.appendChild(canvas);
            container.appendChild(wrapper);

            const ctx = canvas.getContext('2d');
            const bgColor = colors[index % colors.length][0];
            const borderColor = colors[index % colors.length][1];

            chartData.datasets[0].backgroundColor = bgColor;
            chartData.datasets[0].borderColor = borderColor;
            chartData.datasets[0].borderWidth = 1;

            new Chart(ctx, {
                type: chartData.labels.length >= 3 ? 'radar' : 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: chartData.labels.length >= 3 ? {
                        r: { beginAtZero: true, max: 4 }
                    } : {
                        y: { beginAtZero: true, max: 4 }
                    },
                    indexAxis: chartData.labels.length >= 3 ? 'x' : 'y'
                }
            });
        });
    }

    fetchChartData();
</script>
@endsection
