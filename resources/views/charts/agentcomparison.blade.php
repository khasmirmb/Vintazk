<div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
  <div class="flex justify-between mb-4">
    <div>
      <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Analysis for Agents</h5>
      <p class="text-base font-normal text-gray-500 dark:text-gray-400">Monthly averages for agent metrics.</p>
    </div>
  </div>
  <div id="line-chart"></div>
</div>

<script type="module">
    // Pass PHP data to JS
    const months = @json($metrics_months); // ["Jan 2025", "Feb 2025", ..., "Dec 2025"]
    const avg_attendance = @json($avg_attendance); // [95.00, 94.50, ...]
    const avg_kpi = @json($avg_kpi); // [92.80, 93.20, ...]
    const avg_behavior = @json($avg_behavior); // [90.50, 91.00, ...]
    const avg_productivity = @json($avg_productivity); // [93.00, 92.50, ...]
    const avg_agent_overall = @json($avg_agent_overall); // [93.00, 92.50, ...]


    const options = {
      chart: {
        height: "200%",
        maxWidth: "100%",
        type: "line",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
          enabled: false,
        },
        toolbar: {
          show: false,
        },
      },
      tooltip: {
        enabled: true,
        x: {
          show: false,
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 3,
        curve: 'smooth',
      },
      grid: {
        show: true,
        strokeDashArray: 4,
        padding: {
          left: 2,
          right: 2,
          top: -26
        },
      },
      series: [
        {
          name: "Attendance",
          data: avg_attendance,
          color: "#1A56DB", // Blue
        },
        {
          name: "KPI Performance",
          data: avg_kpi,
          color: "#7E3AF2", // Purple
        },
        {
          name: "Behavior",
          data: avg_behavior,
          color: "#10B981", // Green
        },
        {
          name: "Productivity",
          data: avg_productivity,
          color: "#F59E0B", // Yellow
        },
        {
          name: "Overall Rating",
          data: avg_agent_overall,
          color: "#FF0000", // Red
        },
      ],
      legend: {
        show: true,
        position: 'top',
        horizontalAlign: 'right',
        fontSize: '14px',
        markers: { width: 12, height: 12 },
      },
      xaxis: {
        categories: months,
        labels: {
          show: true,
          style: {
            fontFamily: "Inter, sans-serif",
            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
          }
        },
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
      },
      yaxis: {
        show: true,
        labels: {
          show: true,
          formatter: function (value) {
            return value + '%';
          },
          style: {
            fontFamily: "Inter, sans-serif",
            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
          }
        },
      },
    };

    if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
      const chart = new ApexCharts(document.getElementById("line-chart"), options);
      chart.render();
    }
</script>
