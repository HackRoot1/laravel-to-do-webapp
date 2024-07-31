<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
    
</head>
<body>

    <section id = "form-section">

        <div class="form-data">
            <div class ="login-title">
                WELCOME
            </div>
            
            @if(10 == 9) 
                <div id="error"></div>
            @endif 
            
            <div class="login-form">
                <form action="{{ route('account.processRegister') }}" method="POST">
                    @csrf 
                    <div>
                        <label for="fname">First Name:</label>
                        <input type="text" name = "firstName" id = "fname" placeholder="Enter your username">
                    </div>
                    <div>
                        <label for="lname">Last Name:</label>
                        <input type="text" name = "lastName" id = "lname" placeholder="Enter your username">
                    </div>
                    <div>
                        <label for="email">email:</label>
                        <input type="text" name = "email" id = "email" placeholder="Enter your username">
                    </div>
                    <div>
                        <label for="user">User Name:</label>
                        <input type="text" name = "username" id = "user" placeholder="Enter your username">
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" name = "password" id = "password" placeholder="Enter your password">
                    </div>
                    <div>
                        <input type="submit" value="Submit" name = "submit">
                    </div>
                </form>
            </div>
            <div>
                Already Registered? 
                <a href="{{ route('account.login') }}">
                    Sign In
                </a>
            </div>
        </div>
    </section>

    
</body>
</html>
