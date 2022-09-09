<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Login</title>
    <link rel=icon href="{{ asset('universal/images/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ url('admin/css/login.css') }}">
    <link rel="stylesheet" href="{{ url('admin/css/root.css') }}">
</head>
<body>
    
    <div class="container">
        <div class="login">
            <img src="{{ asset('universal/images/logo.png') }}" alt="Слика није пронађена">
            <h1>Пријави се</h1>
            @if ($errors->any())
                <div class="validationerror">
                    <i class="fas fa-times"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('admin/login') }}" method="post" >@csrf
              <div class="form-group">
                <label>Е-маил адреса</label>
                <input id="email" name="email" type="text" placeholder="Е-маил" data-msg="Молимо вас унесите е-маил" class="form-control">
              </div>
              <div class="form-group">
                <label>Лозинка</label>
                <input id="password" name="password" placeholder="Лозинка" type="password" data-msg="Молимо вас унесите лозинку" class="form-control">
              </div>
              <button class="submit">Пријава</button>
            </form>
        </div>
        <div class="wallpaper">
            <img src="{{ asset('admin/images/loginback.JPG') }}" alt="Слика није пронађена">
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript">
        @if(Session::has('error_message'))
            Swal.fire({
                icon: 'error',
                title: "{{ Session::get('error_message') }}",
                titleColor: '#8f7655',
                confirmButtonText: 'Затвори',
                confirmButtonColor: '#8f7655',
            })
        @endif

        $(".fa-times").click(function() {
            $(".validationerror").slideUp();
        });
    </script>
</body>
</html>