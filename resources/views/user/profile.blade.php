<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('favicon.svg')}}">
    <link rel="stylesheet" href="{{asset('assets/icons/fontawesome-free-6.6.0-web/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <title>Chats</title>
</head>
<body>
  
    <main class="">
    @include("layout.header")
    <section class=" scrollable">
        <div class=" flex-center">
        <form class="profile-form mt-5 profile-container" method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
            @csrf
            @session('error')
            {{session()->get('error')}}
                
            @endsession
                <div class="profile-photo-container">
                    <img src='{{asset("storage/user/$photo")}}' alt="profile picture">
                    <div>
                    <input type="file" name="photo">
                        @error('photo')
                            <div class="error-message">

                            {{$message}}
                            </div>

                        @enderror
                    </div>
                </div>
                <div>
                    <input name="name" placeholder="Username" value="{{$name}}" type="text">
                    @error('name')
                    <div class="error-message">
                    {{$message}}
                    </div>

                @enderror
                </div>

                <div>
                    <input placeholder="Email" value="{{$email}}" type="email" readonly>
                </div>
                <div>
                    <input name="email" placeholder="Change Email"  type="email" autocomplete="false">
                    @if($errors->any())
                      @foreach($errors->all() as $error)
                      $error<br>
                      @endforeach
                    @endif
                    @error('email')
                        <div class="error-message">
                        {{$message}}
                        </div>
                    @enderror
                </div>
                <div>
                    <input placeholder="password" name="password"  type="password">
                    @error('password')
                        <div class="error-message">

                        {{$message}}
                        </div>

                    @enderror
                </div>
                <div>
                    <input placeholder="Confirm password" name="password_confirmation" type="text">
                </div>

                <div>
                    <input name="submit" type="submit" value="update">
                </div>

                <div>
                    <a href="{{route('logout')}}"><input type="button" value="Logout"></a>
                </div>

        </form>
</div>
    <section>

        
    </main>
    @include('layout.footer')
</body>
</html>