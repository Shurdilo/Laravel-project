<!DOCTYPE html>
<html lang="en">
<head>
    @include('front.layout.head')
</head>
<body>
    @include('front.layout.header')
    <div class="content">
        @yield('content')  
    </div>
    @include('front.layout.footer')

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
</body>
</html>