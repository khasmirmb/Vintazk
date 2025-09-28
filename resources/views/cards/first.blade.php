<div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800 h-36">
    <div class="w-full">
        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400 mb-3">Agent Overall Rating</h3>
        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ number_format($overall_avg_performance ?? 0, 2) }}%</span>
    </div>
    <div class="w-full" id="agent_overall_charts"></div>
</div>

<script type="module">
    // Pass PHP data to JS
    const agents_months = @json($agents_months); // ["01 Feb", "02 Feb", ..., "28 Sep"]
    const performance_differences = @json($performance_differences); // [0, 0.50, -0.20, ...]

    if (document.getElementById('agent_overall_charts')) {
        const options = {
            series: [
                {
                    name: 'Negative',
                    data: agents_months.map((month, index) => ({
                        x: month,
                        y: performance_differences[index] < 0 ? Math.abs(parseFloat(performance_differences[index]) || 0) : 0
                    })),
                    color: '#FF0000'
                },
                {
                    name: 'Positive',
                    data: agents_months.map((month, index) => ({
                        x: month,
                        y: performance_differences[index] >= 0 ? parseFloat(performance_differences[index]) || 0 : 0
                    })),
                    color: '#1A56DB'
                }
            ],
            chart: {
                type: 'bar',
                height: '140px',
                fontFamily: 'Inter, sans-serif',
                foreColor: '#4B5563',
                stacked: true,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '90%',
                    borderRadius: 3,
                    dataLabels: { total: { enabled: false } }
                }
            },
            tooltip: {
                shared: true,
                intersect: false,
                style: {
                    fontSize: '14px',
                    fontFamily: 'Inter, sans-serif'
                },
                y: {
                    formatter: function (value) {
                        return value !== 0 ? value + ' %' : 'No Change';
                    }
                }
            },
            states: {
                hover: {
                    filter: {
                        type: 'darken',
                        value: 1
                    }
                }
            },
            stroke: {
                show: true,
                width: 5,
                colors: ['transparent']
            },
            grid: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                floating: false,
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
            },
            yaxis: {
                show: false
            },
            fill: {
                opacity: 1
            }
        };

        const chart = new ApexCharts(document.getElementById('agent_overall_charts'), options);
        chart.render();
    }
</script>
