<?php
use App\Models\Messages;
$messageCounts = Messages::newMessages();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ Панел</title>
    <link rel=icon href="{{ asset('universal/images/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Datatables CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ url('admin/css/'.$css.'.css') }}">
    <link rel="stylesheet" href="{{ url('admin/css/root.css') }}">

    <script src="{{ url('admin/js/admin_script.js') }}"></script>
</head>
<body>
  <script src="{{ url('admin/js/dataTables.js') }}"></script>
    @include('admin.layout.header')
    @include('admin.layout.sidebar')
    <div class="content">
        @yield('content')  
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript">
      @if(Session::has('success_message'))
        Swal.fire({
            icon: 'success',
            title: "{{ Session::get('success_message') }}",
            titleColor: '#8f7655',
            confirmButtonText: 'Затвори',
            confirmButtonColor: '#8f7655',
        })
      @endif
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    @yield('scripts')
</body>
</html>