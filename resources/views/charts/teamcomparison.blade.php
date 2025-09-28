<div class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
  <div class="flex justify-between mb-4">
    <div>
      <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Analysis for Teams</h5>
      <p class="text-base font-normal text-gray-500 dark:text-gray-400">Monthly averages for team metrics.</p>
    </div>
  </div>
  <div id="line-chart2"></div>
</div>

<script type="module">
    // Pass PHP data to JS
    const teams_months = @json($teams_months); // ["Jan 2025", "Feb 2025", ..., "Dec 2025"]
    const avg_team_attendance = @json($avg_team_attendance); // [95.00, 94.50, ...]
    const avg_team_kpi = @json($avg_team_kpi); // [92.80, 93.20, ...]
    const avg_team_attrition = @json($avg_team_attrition); // [5.00, 4.50, ...]
    const avg_team_performance = @json($avg_team_performance); // [94.30, 92.80, ...]

    const options = {
      chart: {
        height: "150%",
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
          data: avg_team_attendance,
          color: "#1A56DB", // Blue
        },
        {
          name: "Team KPI",
          data: avg_team_kpi,
          color: "#7E3AF2", // Purple
        },
        {
          name: "Attrition",
          data: avg_team_attrition,
          color: "#10B981", // Green
        },
        {
          name: "Overall Rating",
          data: avg_team_performance,
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
        categories: teams_months,
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

    if (document.getElementById("line-chart2") && typeof ApexCharts !== 'undefined') {
      const chart = new ApexCharts(document.getElementById("line-chart2"), options); // Fixed ID to match HTML
      chart.render();
    }
</script>
