<!-- Main modal -->
<div id="modal-{{ Str::slug($agent->agent_name, '-') }}"
     tabindex="-1"
     aria-hidden="true"
     class="hidden fixed top-0 right-0 left-0 z-50 w-full h-[calc(100%-1rem)] max-h-full overflow-y-auto overflow-x-hidden justify-center items-center md:inset-0">

    <div class="relative w-full max-w-2xl max-h-full p-4">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">

            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 dark:border-gray-600 rounded-t">
                <div class="ps-3">
                    <div class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $agent->agent_name }}
                    </div>
                    <div class="text-gray-500 font-normal dark:text-gray-400">
                        {{ $agent->team }}
                    </div>
                </div>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="modal-{{ Str::slug($agent->agent_name, '-') }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4 border-t-2">
                <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800 h-36">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400 mb-3">
                            {{ $agent->agent_name }} - Overall Rating
                        </h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">
                            {{ number_format($agent->avg_performance_rating ?? 0, 2) }}%
                        </span>
                    </div>
                    <div class="w-full" id="agent_overall_charts_{{ Str::slug($agent->agent_name, '-') }}"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $data = $monthlyPerformance[$agent->agent_name] ?? collect();
    $months = $data->pluck('month');
    $ratings = $data->pluck('overall_performance_rating');
@endphp


<script type="module">
if (document.getElementById('agent_overall_charts_{{ Str::slug($agent->agent_name, '-') }}')) {
    const options = {
        series: [{
            name: 'Performance',
            data: @json($ratings),
            color: '#1A56DB',
        }],
        chart: {
            type: 'bar',
            height: '140px',
            fontFamily: 'Inter, sans-serif',
            foreColor: '#4B5563',
            toolbar: { show: false }
        },
        plotOptions: {
            bar: {
                columnWidth: '90%',
                borderRadius: 3,
            }
        },
        xaxis: {
            categories: @json($months),
            labels: { show: false },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: { show: false },
        grid: { show: false },
        dataLabels: { enabled: false },
        legend: { show: false },
        tooltip: {
            y: {
                formatter: (val) => val + '%'
            }
        }
    };

    const chart = new ApexCharts(
        document.getElementById('agent_overall_charts_{{ Str::slug($agent->agent_name, '-') }}'),
        options
    );
    chart.render();
}
</script>
