<!DOCTYPE html>
<html lang="en">

@include('admin.components.common.head')

<body id="page-top">

  
@include('admin.components.common.nav')

  <div id="wrapper">

    @include('admin.components.common.slider')

    <div id="content-wrapper">
      <div class="alert"></div>
      <div id="content">
        @yield('content')
      </div>

      @include('admin.components.common.footer')

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  @include('admin.components.common.modal')

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('/') }}vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('/') }}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('/') }}vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('/') }}vendor/chart.js/Chart.min.js"></script>
  <script src="{{ asset('/') }}vendor/datatables/jquery.dataTables.js"></script>
  <script src="{{ asset('/') }}vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('/') }}js/sb-admin.min.js"></script>
  
  <script type="text/javascript">
    const baseURL = "{{ route('home') }}";
    const token = "{{ csrf_token() }}";
  </script>

  <script src="{{ asset('/') }}js/ajaxAdmin.js"></script>

</body>

</html>
