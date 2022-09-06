<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('bootstrap/bootstrap.min.css', []) }}">
    <link rel="stylesheet" href="{{ url('bootstrap/mycss.css', []) }}">
    <link rel="stylesheet" href="{{ url('/css/mycss.min.css', []) }}">
    <title>LOGIN</title>
</head>
<body>
    
    <div class="wrapper">
        <div class="logo">
        </div>
        <div class="text-center mt-4 name">
            MONITORING 
            <h5>
                PH & Temperature
            </h5>
        </div>
        <form action="{{ route('proses.login') }}" method="post" class="p-3 mt-3">
            @csrf
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="username" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <button type="submit" class="btn mt-3">Login</button>
        </form>
    </div>


    <script src="{{ url('bootstrap/jquery.slim.min.js', []) }}"></script>
    <script src="{{ url('bootstrap/bootstrap.bundle.min.js', []) }}"></script>
    <script src="{{ url('jquery.min.js', []) }}"></script>
    @include('sweetalert::alert')
</body>
</html>