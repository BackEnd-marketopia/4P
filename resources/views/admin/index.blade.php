@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
  <div class="container">
    <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
      <h3 class="fw-bold mb-3">{{ __('message.Dashboard') }}</h3>
      <h6 class="op-7 mb-2">4P</h6>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
      <a href="{{ route('admin.vendors.create') }}"
        class="btn btn-secondary btn-round">{{ __('message.Add Vendor') }}</a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
          <div class="icon-big text-center icon-info bubble-shadow-small">
            <i class="fas fa-users"></i>
          </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
          <div class="numbers">
            <p class="card-category">{{ __('message.Users') }}</p>
            <h4 class="card-title">{{ $users }}</h4>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
      <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
          <div class="icon-big text-center icon-info bubble-shadow-small">
            <i class="fas fa-user-check"></i>
          </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
          <div class="numbers">
            <p class="card-category">{{ __('message.Vendors') }}</p>
            <h4 class="card-title">{{ $vendors }}</h4>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
      <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
          <div class="icon-big text-center icon-info bubble-shadow-small">
            <i class="fas fa-chalkboard-teacher"></i>
          </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
          <div class="numbers">
            <p class="card-category">{{ __('message.Providers') }}</p>
            <h4 class="card-title">{{ $providers }}</h4>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
      <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
          <div class="icon-big text-center icon-info bubble-shadow-small">
            <i class="fas fa-user-check"></i>
          </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
          <div class="numbers">
            <p class="card-category">{{ __('message.Subscribed Users') }}</p>
            <h4 class="card-title">{{ $codesPaied }}</h4>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    <div class="row">

      <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
          <div class="icon-big text-center icon-success bubble-shadow-small">
            <i class="fas fa-credit-card"></i>
          </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
          <div class="numbers">
            <p class="card-category">{{ __('message.Codes Paied') }}</p>
            <h4 class="card-title">{{ $codesPaied }}</h4>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
      <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
          <div class="icon-big text-center icon-secondary bubble-shadow-small">
            <i class="fas fa-times-circle"></i>
          </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
          <div class="numbers">
            <p class="card-category">{{ __('message.Codes Unpaid') }}</p>
            <h4 class="card-title">{{ $codesUnpaied }}</h4>
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
      <div class="card card-round">
        <div class="card-header">
        <div class="card-head-row">
          <div class="card-title">{{ __('message.User Statistics')}}</div>
          <div class="card-tools">
          </div>
        </div>
        </div>
        <div class="card-body">
        <div class="chart-container" style="min-height: 375px">
          <canvas id="userStatsChart"></canvas>
        </div>
        <div id="myChartLegend"></div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("userStatsChart").getContext("2d");

    function fetchUserStats() {
      fetch("{{ route('user-stats') }}")
      .then(response => response.json())
      .then(data => {
        data.sort((a, b) => a.month - b.month);

        const labels = data.map(item => getMonthName(item.month));
        const activeUsers = data.map(item => item.total_active_users);
        const subscribedUsers = data.map(item => item.total_subscribed_users);

        const userLang = document.documentElement.lang || navigator.language || "en";

        const translations = {
        en: { active: "Active Users", subscribed: "Subscribed Users", month: "Month", users: "Users" },
        ar: { active: "المستخدمون النشطون", subscribed: "المستخدمون المشتركون", month: "الشهر", users: "المستخدمون" }
        };

        const t = translations[userLang.startsWith("ar") ? "ar" : "en"]; // اختيار الترجمة المناسبة

        new Chart(ctx, {
        type: "line",
        data: {
          labels: labels,
          datasets: [
          {
            label: t.active,
            data: activeUsers,
            backgroundColor: "rgba(54, 162, 235, 0.2)",
            borderColor: "rgba(54, 162, 235, 1)",
            borderWidth: 2,
            fill: true,
            tension: 0.4
          },
          {
            label: t.subscribed,
            data: subscribedUsers,
            backgroundColor: "rgba(255, 99, 132, 0.2)",
            borderColor: "rgba(255, 99, 132, 1)",
            borderWidth: 2,
            fill: true,
            tension: 0.4
          }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
          legend: {
            display: true,
            position: "top"
          }
          },
          scales: {
          x: {
            title: { display: true, text: t.month }
          },
          y: {
            title: { display: true, text: t.users },
            beginAtZero: true
          }
          }
        }
        });
      })
      .catch(error => console.error("Error fetching user stats:", error));
    }

    function getMonthName(month) {
      const userLang = document.documentElement.lang || navigator.language || "en";

      const months = {
      en: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      ar: ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"]
      };

      return months[userLang.startsWith("ar") ? "ar" : "en"][month - 1];
    }

    fetchUserStats();
    });
  </script>


@endsection