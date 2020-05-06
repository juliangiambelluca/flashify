<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Flashify - Easily create and share beautiful flashcards to help with your studies.">
  <meta name="author" content="Julian Giambelluca">

  <title>@yield('page-title')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ URL::to('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ URL::to('css/sb-admin-2.css') }}" rel="stylesheet">
  <link href="{{ URL::to('css/styles.css') }}" rel="stylesheet">

  <!-- Scripts that need to be loaded first -->
  <script src="{{ URL::to('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ URL::to('vendor/packery/packery.js') }}"></script>

</head>
<script>
  const moveContentForSidebar = () => {
    clearTimeout(contentMoveTimer); 
    var contentMoveTimer = setTimeout(() => { 
      $("#content-wrapper").css("margin-left", $('.sidebar').width());
      $("#sticky-footer").css("padding-left", $('.sidebar').width());
    }, 10 ); 
      }
  moveContentForSidebar();
  </script>
<body id="page-top" onresize="moveContentForSidebar()">

  <!-- Page Wrapper -->
  <div id="wrapper">
      


    @include('components.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" >

        

      @include('components.topbar')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
            <!-- Footer -->
            <footer id="sticky-footer" class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Julian Giambelluca 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ URL::to('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ URL::to('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ URL::to('js/sb-admin-2.min.js') }}"></script>
 
 
  <link href="{{ URL::to('vendor/tags-input/styles.css') }}" rel="stylesheet">

  <script src="{{ URL::to('vendor/tags-input/tagsInput.js') }}"></script>



</body>

</html>
