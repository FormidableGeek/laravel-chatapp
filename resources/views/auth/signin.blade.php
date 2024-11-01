@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('favicon.svg')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <title>ChatterBox | Sign in</title>
</head>
<body>
    <main class="container background-theme flex-center">
       <section class="m-2 mt-1">
           <p class="welcome-text">Welcome <br> Back</p>
        <section>
        <section class="mt-5 theme-shadow p-1 border-radius-1">
            <form class="signup-form" method="post" action="{{route('signin')}}">
                @csrf
                <h1 class="text-white">Login</h1>
                <div>
                <input  class="mt-2" name="email" placeholder="Email" id="email" type="email">
                @error('email')
                <div class="error-message">
                   
                    {{$message}}
                </div>
                @enderror
                </div>
                <div>
                <input class="mt-2" name="password" placeholder="Password" id="password" type="password">
                @error('password')
                <div class="error-message">
                   
                    {{$message}}
                </div>
                @enderror
            </div>
                <input class="mt-2" name="signup" value="Sign In" id="name" type="submit">
            </form>
           {{-- <div class="flex-center mt-2">
                <div class="border-bottom"></div>
                <span class="text-white">Or</span>
                <div class="border-bottom"></div>
            </div>
            <div class="flex-center-10 mt-1">
                <img class="social-icon" src="{{asset('assets/icons/facebook-logo.svg')}}">
                <img class="social-icon" src="{{asset('assets/icons/google-logo.svg')}}">
            </div>--}}
        </section>

        <section class="mt-1 flex-center">
            <a class="link " href="{{route('login')}}">Forgot Password?</a>
       </section>
       <section class="mt-1">
            <p class="text-white ">Don't have an account? <a class="link" href="{{route('home')}}">Sign up</a></p>
       </section>

    </main>
    
</body>
</html>