<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ !empty($headerTitle) ? $headerTitle : "News Paper" }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


  @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  @include('backend.layouts.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('backend.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->

  @include('backend.layouts.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('backend') }}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('backend') }}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('backend') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('backend') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('backend') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('backend') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend') }}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend') }}/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('backend') }}/dist/js/pages/dashboard.js"></script>

<!-- DataTables -->
<script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  // DataTables
  $(function () {
    $("#dataTable").DataTable();
  });

  // Select2 for Add, Edit News
  $(document).ready(function() {
    $('.news-tags').select2({
      placeholder: 'Select tag',
    });
  });
</script>

<script>
    // Category Wise News Script
    @php
        // Get categoriesWithCount data from AppServiceProvider
        $categoryLabels = $categoriesWithCount->pluck('name')->toArray();
        $categoryData = $categoriesWithCount->pluck('post_count')->toArray();
    @endphp

    function getRandomColor() {
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }

      return color;
    }

    // Generate 50 random colors for categoryWiseNews
    var randomCategoryColors = [];
    for (var i = 0; i < 50; i++) {
        randomCategoryColors.push(getRandomColor());
    }

    var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
    var donutData = {
        labels: @json($categoryLabels),
        datasets: [
            {
                data: @json($categoryData),
                backgroundColor: randomCategoryColors,
            }
        ]
    };

    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    };

    // Create doughnut chart for categoryWiseNews
    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    });

    // Language Wise News Script
    @php
      // Get languageWiseNews data from AppServiceProvider
      $languageLabels = $languageWiseNews->pluck('name')->toArray();
      $languageData = $languageWiseNews->pluck('post_count')->toArray();
    @endphp

    // Generate 50 random colors for languageWiseNews
    var randomLanguageColors = [];
    for (var i = 0; i < 50; i++) {
        randomLanguageColors.push(getRandomColor());
    }

    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = {
        labels: @json($languageLabels),
        datasets: [
            {
                data: @json($languageData),
                backgroundColor: randomLanguageColors,
            }
        ]
    };
    var pieOptions = {
      maintainAspectRatio: false,
      responsive: true,
    }

    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })
    
</script>


@yield('script')
</body>
</html>
