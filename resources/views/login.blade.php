<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    
    <section id = "form-section">
        <div class = "illustration-img">
            <img src="{{ asset('images/Login-rafiki.png') }}" alt="Image Not found">
        </div>
        <div class = "form-data">
            <div class = "login-avatar">
                <i class="uil uil-user-circle"></i>
            </div>
            <div class ="login-title">
                WELCOME
            </div>
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif

            @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
            @endif
            <div class = "login-form">
                <form action="{{ route('account.authenticate') }}" method="POST">
                    @csrf
                    <div>
                        <i class="uil uil-user"></i>
                        <input type="text" name = "email" placeholder="Enter Your Username">
                        @error('email')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <!-- <label for="">Username</label> -->
                        <i class="uil uil-lock"></i>
                        <input type="password" name = "password" placeholder="Enter Your Password">
                        @error('password')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="submit" value="Login" name = "submit">
                    </div>
                </form>

            </div>
            <div>
                New User? 
                <a href="{{ route('account.register') }}">
                    Sign Up
                </a>
            </div>
        </div>
    </section>
    
</body>
</html>