<script>
    async function fetchChartData() {
        try {
            const response = await axios.get('/get-grafik-data');
            const data = response.data;

            const chartContainer = document.getElementById('chartContainer');

            data.criteriaData.forEach((chartData, index) => {
                const count = chartData.datasets[0].data.length;

                if (count === 1) {
                    console.log(`Data terlalu sedikit untuk membuat grafik untuk criteria ${index + 1}.`);
                    return;
                }

                const canvasWrapper = document.createElement('div');
                canvasWrapper.className = 'w-full bg-white p-4 mt-3 rounded-lg shadow justify-center';

                const canvasName = document.createElement('p');
                canvasName.className = 'font-bold text-md mb-4 items-center';
                canvasName.innerText = chartData.criteria

                const canvasElement = document.createElement('canvas');
                canvasElement.id = `criteriaChart${index}`;
                canvasElement.style.height = '100px';

                canvasWrapper.appendChild(canvasName);
                canvasWrapper.appendChild(canvasElement);
                chartContainer.appendChild(canvasWrapper);

                const ctx = canvasElement.getContext('2d');

                let chartType;
                if (count === 2) {
                    chartType = 'bar';
                } else if (count >= 3) {
                    chartType = 'radar';
                }

                new Chart(ctx, {
                    type: chartType,
                    data: chartData,
                    options: {
                        responsive: true,
                        scales: chartType === 'bar' ? {
                            y: {
                                beginAtZero: true
                            }
                        } : {
                            r: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });

            const allDataContainer = document.getElementById('allDataChartContainer');
            data.allData.forEach((chartData, index) => {
                const canvasId = `allDataChart${index}`;
                const canvasElement = document.createElement('canvas');
                canvasElement.id = canvasId;
                canvasElement.className = 'h-screen';
                allDataContainer.appendChild(canvasElement);

                const ctx = canvasElement.getContext('2d');

                new Chart(ctx, {
                    type: 'radar', // Tipe grafik yang sesuai
                    data: chartData,
                    options: {
                        responsive: true,
                        scales: {
                            r: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });

        } catch (error) {
            console.error('Error fetching chart data:', error);
        }
    }

    fetchChartData();
</script>
