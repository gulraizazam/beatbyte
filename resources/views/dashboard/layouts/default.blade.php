<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="">

  <meta name="author" content="">

  <title>Beat Byte</title>

  <!-- Bootstrap core CSS-->
 <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template-->

  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

  <link href="{{asset('datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

  <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">

  <!-- <link href="{{asset('css/dropzone.css')}}" rel="stylesheet"> -->

   

</head>



<body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <!-- Navigation-->

    @include('dashboard.layouts.includes.navbar')

    <div class="content-wrapper">

      @yield('content')

      @include('dashboard.layouts.includes.footer')

    

    </div>

</body>

</html>

