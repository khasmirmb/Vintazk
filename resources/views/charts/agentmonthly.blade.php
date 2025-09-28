<div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
  <div class="flex justify-between">
    <div>
      <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Agents: {{ number_format($totalagents) }}</h5>
      <p class="text-base font-normal text-gray-500 dark:text-gray-400">Agents Monthly Average Performance</p>
    </div>
  </div>
  <div id="area-chart"></div>
</div>

<script type="module">
    // Pass PHP data to JS (assuming data is in thousands, e.g., 100k, 99k, etc.)
    const months = @json($agents_months); // ["Jan 2025", "Feb 2025", ..., "Aug 2025"]
    const performance = @json($agents_performance); // [100, 99, 98, ..., 94] (in thousands)

    const options = {
      chart: {
        height: "100%",
        maxWidth: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: { enabled: false },
        toolbar: { show: false },
      },
      tooltip: { enabled: true, x: { show: true } },
      fill: {
        type: "gradient",
        gradient: { opacityFrom: 0.55, opacityTo: 0, shade: "#1C64F2", gradientToColors: ["#1C64F2"] },
      },
      dataLabels: { enabled: false },
      stroke: { width: 6 },
      grid: { show: true, strokeDashArray: 4, padding: { left: 2, right: 2, top: 0 } },
      series: [
        {
          name: "Avg Performance",
          data: performance,
          color: "#1A56DB",
        },
      ],
      xaxis: {
        categories: months,
        labels: {
          show: true,
          style: {
            colors: "#6B7280",
            fontSize: "12px",
          },
        },
        axisBorder: { show: false },
        axisTicks: { show: false },
      },
      yaxis: {
        show: true,
        labels: {
          show: true,
          formatter: function (value) {
            return value + '%';
          },
          style: {
            colors: "#6B7280",
            fontSize: "12px",
          },
        },
      },
    };

    if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
      const chart = new ApexCharts(document.getElementById("area-chart"), options);
      chart.render();
    }
</script>
