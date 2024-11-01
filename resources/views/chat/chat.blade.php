<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/icons/fontawesome-free-6.6.0-web/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="chatId" content="{{ $receiver['chatId']}}">
    <meta name="user_id" content="{{ $user_id}}">

    <title>Chat | {{$receiver->name}}</title>
</head>
<body>
    <main class="container">
    <section class="inbox-header pl-2">
       <a href="{{route('chat.index')}}"> <i class="fa-solid fa-chevron-left"></i></a>
            <div class="flex-align-justify-center">
                <div class="user-logo">
                    <img src='{{asset("storage/user/".$receiver->photo)}}'>
                </div>
                <div>
                <h3 id="username"> {{$receiver->name}}</h3>
                <p id="online">Online</p>
                </div>
            </div>
           
        </div>
    </section>
    <section id="messages" class="ml-2 mt-2 message-area scrollable">
   

    </section>
    <section class="inbox-footer">
        <form id="message-form">
        @csrf
        <textarea id="message-input"></textarea>
        <input type="hidden" value="{{$receiver->id}}" id="receiver_id">
        <button type="submit">
            <i class="fa-regular fa-paper-plane"></i>
        </button>
        </form>
    </section>
    </main>
</body>
</html>

<script src='{{asset("assets/js/jquery-3.7.1.min.js")}}'></script>
<script src="{{asset('build/assets/app-C302vmmR.js')}}" ></script>
<script src='{{asset("assets/js/chat.js")}}'></script>
