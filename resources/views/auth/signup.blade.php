@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('favicon.svg')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <title>ChatterBox | Signup</title>
</head>
<body>
    <main class="container background-theme flex-center">
       <section class="m-2 mt-2">
           <p class="welcome-text">Create <br> Account</p>
        <section>
        <section class="mt-5 theme-shadow p-1 border-radius-1">
            <form class="signup-form mt-1" action="{{route('register')}}" method="post">
                @csrf
                

                <input class="" name="username" placeholder="Full Name" id="name" type="text"
                class="@error('username') error @enderror">
                    @error('username')
                    <div class="error-message">
                    {{$message}}
                    </div>
                    @enderror
            

                <input   name="email" placeholder="Email" id="email" type="email" class='
                mt-2
                 @error("email")
                   error
                @enderror'>
                @error('email')
                <div class="error-message">
                   
                    {{$message}}
                </div>
                @enderror

                <input class="mt-2" name="password" placeholder="Password" id="password" type="password" class="
                    @error('password')
                        {{$message}}
                    @enderror">
                    @error('password')
                    <div class="error-message">
                    {{$message}}
                    </div>
                    @enderror
                

                <input class="mt-2" name="password_confirmation" placeholder="Confirm password" id="password_confirmation" type="text">

                <input class="mt-2" name="signup" value="Sign up" id="name" type="submit">
            </form>
            {{--<div class="flex-center mt-2">
                <div class="border-bottom"></div>
                <span class="text-white">Or</span>
                <div class="border-bottom"></div>
            </div>
            <div class="flex-center-10 mt-1">
                <img class="social-icon" src="{{asset('assets/icons/facebook-logo.svg')}}">
                <img class="social-icon" src="{{asset('assets/icons/google-logo.svg')}}">
            </div>--}}
        </section>
       <section class="mt-1">
            <p class="text-white text-center">Already have an account? <a class="link" href="{{route('login')}}">Log in</a></p>
       </section>

    </main>
    
</body>
</html>